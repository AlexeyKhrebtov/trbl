<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Http\Requests\StoreSheetRequest;
use App\Sector;
use App\Sheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sectors = Sector::all();
        //$sheets = Sheet::with('details')->get();
        $sheets = [];
        // Какой год использовать для фильтрации (по-умолчанию текущий)
        $year = $request->input('year', date('Y'));
        $year_list = [2020, 2021, 2022, 'all'];
        if ($year == 'all') {
            $sheets = Sheet::with('details')->withCount('attachments')->get();
        }
        elseif (in_array($year, $year_list)) {
             $sheets = Sheet::whereYear('date', $year)->with('details')->withCount('attachments')->get();
        }
        else {
            $year = date('Y');
            $sheets = Sheet::whereYear('date', $year)->with('details')->withCount('attachments')->get();
        }

        return view('sheets.index', compact('sheets', 'sectors', 'year', 'year_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Болванка для формы
        $sheet = new Sheet();
        // По-умолчанию используем текущую дату
        $sheet->date = today()->format('Y-m-d');

        $status_options = $sheet->statusOptions();

        $sectors = \App\Sector::orderBy('title')->get();

        return view('sheets.create', compact('sheet', 'sectors', 'status_options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSheetRequest $request)
    {
        $validatedData = $request->validated();

        $sheet = new Sheet($validatedData);
        $sheet->save();
        return redirect()->action('SheetController@index')->with('success', 'Новая ДВ '. $sheet->number .' успешно добавлена.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function show(Sheet $sheet)
    {
        // Для формы добавления нового оборудования в отчет
        $detail = new \App\Detail(); // болванка для формы
        $works = \App\Work::all();
        $equipments = \App\Equipment::orderBy('title')->get();

        return view('sheets.show', compact('sheet', 'detail', 'works', 'equipments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function edit(Sheet $sheet)
    {
        $status_options = $sheet->statusOptions();

        $sectors = \App\Sector::orderBy('title')->get();

        return view('sheets.edit', compact('sheet','sectors', 'status_options'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSheetRequest $request, Sheet $sheet)
    {
        $validatedData = $request->validated();

        $sheet->update($validatedData);

        return redirect()->action('SheetController@index')->with('success', 'Информация в ДВ обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sheet  $sheet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sheet $sheet)
    {
        try {
            if ($sheet->attachments()->count()) {
                $files = $sheet->attachments;
                foreach($files as $file) {
                    if (Storage::disk('attach')->delete($file->path)) {
                        $file->delete();
                    }
                    else {
                        throw new \Exception('Не удалось удалить файл с сервера');
                    }
                }
            }
        } catch (\Exception $e) {
            return redirect()->action('SheetController@show', $sheet)->with('warning', $e->getMessage());
        }
        $sheet->delete();
        return redirect()->action('SheetController@index')->with('success', 'ДВ удалена');
    }

    /**
     * Экспорт в эксель
     * @param Sheet $dv
     * @return string
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
    public function export(Sheet $dv)
    {
        $template_path = storage_path("app/public/dv_template.xls");
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($template_path);

        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue("C19", $dv->number); // Номер документа
        $sheet->setCellValue("C22", $dv->sector->inventory_number); // Инвентарный номер
        $sheet->setCellValue("E19", (new \Carbon\Carbon($dv->date))->format('d.m.Y')); // Дата составления
        $sheet->setCellValue("D23", $dv->sector->object_location); // Местонахождение объекта
        $sheet->setCellValue("D24", $dv->sector->region); // Регион
        $sheet->setCellValue("A27", $dv->sector->route_part . ' ' . $dv->sector->fio); // ПЧ + ФИО

        // Таблица со списком работ
        $line = 45; // номер строки
        $i = 1;

        foreach ($dv->details as $detail) {

            if ($i > 1) {
                $cellValues = $sheet->rangeToArray('A'.$line.':K'.$line);
                $line++;
                $sheet->insertNewRowBefore($line,1); // insert row
                $sheet->mergeCells('B'.$line.':C'.$line);
                $sheet->mergeCells('I'.$line.':J'.$line);
                for ($c = 'A'; $c != 'K'; ++$c) {
                    $sheet->duplicateStyle($sheet->getStyle($c.($line-1)),$c.$line.':'.$c.$line);
                    $sheet->fromArray($cellValues, null, 'A'.$line);
                }
            }

            $sheet->setCellValue("A".$line, $i); // № п.п
            $cell_text = $detail->equipment->title . ' ';
            $cell_text .= $detail->name . ' ';
            $cell_text .= $detail->work->title;
            $sheet->setCellValue("B".$line, $cell_text); // Наименование изделия, узла, агрегата, конструкции, подлежащего ремонту
            $sheet->setCellValue("K".$line, $detail->comment); // Примечание

            $i++;
        }

        $line = 49 + $i;
        $sheet->setCellValue("B".$line, $dv->sector->route_part); // Должность
        $sheet->setCellValue("H".$line, $dv->sector->fio); // ФИО

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');

        $filename = "{$dv->status} {$dv->number} ДВ ОПО {$dv->sector->title}.xls";


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'"');

        $writer->save('php://output');

        return 'ok';
    }

    /**
     * Загрузить файл для ведомости
     *
     * @param Sheet $dv ведомость
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function attach(Sheet $dv, Request $request): \Illuminate\Http\RedirectResponse
    {
        if (!$request->file('attach')) {
            return redirect()->action('SheetController@show', $dv)->with('warning', 'Не был передан файл для загрузки');
        }

        /*
         *  php_value post_max_size=15M
            php_value upload_max_filesize=15M
         */

        $request->validate([
           'attach' => 'required|file|max:2048|mimes:jpeg,png,pdf'
        ]);

        $ext = $request->file('attach')->getClientOriginalExtension();
        $size = $request->file('attach')->getSize();
        $filename = $request->file('attach')->getClientOriginalName();

        // 20210430-0816-zj8bq5vv3i4i.jpeg
        $attach_filename = Carbon::now()->format('Ymd-hi') .'-'. Str::lower(Str::random(12)) .'.'. $ext;
        $attach_path = $request->file('attach')->storeAs('',$attach_filename, 'attach');

        $attach = new Attachment;
        $attach->filename = $filename;
        $attach->size = $size;
        $attach->ext = $ext;
        $attach->path = $attach_path;

        $dv->attachments()->save($attach);

        return redirect()->action('SheetController@show', $dv)->with('success', 'Файл прикреплен');
    }

    /**
     * Удаление файла
     *
     * @param Sheet $dv
     * @param Attachment $file
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function removeFile(Sheet $dv, Attachment $file, Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($file->attachable_id != $dv->id) {
            return redirect()->action('SheetController@show', $dv)->with('error', 'Не удалось удалить указанный файл!');
        }

        try {
            if (Storage::disk('attach')->delete($file->path)) {
                $file->delete();
            }
            else {
                throw new \Exception('Не удалось удалить файл с сервера');
            }
        } catch (\Exception $e) {
            return redirect()->action('SheetController@show', $dv)->with('error', $e->getMessage());
        }
        return redirect()->action('SheetController@show', $dv)->with('success', 'Файл удален');
    }
}
