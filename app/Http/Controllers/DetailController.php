<?php

namespace App\Http\Controllers;

use App\Detail;
use App\Http\Requests\StoreDetailRequest;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = Detail::all();
        return view('details.index', compact('details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $detail = new Detail(); // болванка для формы

        $sheets = \App\Sheet::orderBy('number')->get();
        $works = \App\Work::all();
        $equipments = \App\Equipment::orderBy('title')->get();

        return view('details.create', compact('detail', 'sheets', 'works', 'equipments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDetailRequest $request)
    {
        $validatedData = $request->validated();

        $detail = new Detail($validatedData);
        $detail->save();
        return redirect()->action('SheetController@show', $detail->sheet_id)->with('success', 'Новое оборудование '. $detail->name .' успешно добавлено в ДВ.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show(Detail $detail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        $sheets = \App\Sheet::orderBy('number')->get();
        $works = \App\Work::all();
        $equipments = \App\Equipment::orderBy('title')->get();

        return view('details.edit', compact('detail', 'sheets', 'works', 'equipments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(StoreDetailRequest $request, Detail $detail)
    {
        $validatedData = $request->validated();

        $detail->update($validatedData);

        return redirect()->action('SheetController@show', $detail->sheet_id)->with('success', 'Оборудование '. $detail->name .' обновлено в ДВ.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail $detail)
    {
        $sheet_id = $detail->sheet_id;
        $detail->delete();
        return redirect()->action('SheetController@show', $sheet_id)->with('success', 'Оборудование удалено');
    }
}
