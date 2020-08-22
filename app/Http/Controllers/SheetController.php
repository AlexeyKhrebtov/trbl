<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSheetRequest;
use App\Sector;
use App\Sheet;
use Illuminate\Http\Request;

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
        $sheets = Sheet::with('details')->get();
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
        //
    }
}
