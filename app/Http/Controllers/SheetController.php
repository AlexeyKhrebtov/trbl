<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSheetRequest;
use App\Sector;
use App\Sheet;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReader;

class SheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Sector::all();
        //$sheets = Sheet::with('details')->get();
        $sheets = [];
        // Какой год использовать для фильтрации (по-умолчанию текущий)
        $year = $request->input('year', date('Y'));
        
        switch ($year) {
            case 'all':
                $sheets = Sheet::with('details')->get();
                break;
            case 2020:
                $sheets = Sheet::whereYear('date', $year)->with('details')->get();
                break;
            default:
                $sheets = Sheet::whereYear('date', date('Y'))->with('details')->get();
                break;
        }
        
        return view('sheets.index', compact('sheets', 'sectors'));
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
}
