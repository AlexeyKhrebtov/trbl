<?php

namespace App\Http\Controllers;

use App\Cabinet;
use App\Http\Requests\StoreCabinetRequest;
use Illuminate\Http\Request;

class CabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabinets = Cabinet::with('sector:id,title')->withCount('cameras')->orderBy('location_km')->get();
        return view('cabinets.index', compact('cabinets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cabinet = new Cabinet(); // пустая болванка для формы
        $sectors = \App\Sector::orderBy('title')->get();

        return view('cabinets.create', compact('cabinet', 'sectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCabinetRequest $request)
    {
        $validatedData = $request->validated();

        $cabinet = new Cabinet($validatedData);
        $cabinet->save();
        return redirect()->action('CabinetController@index')->with('success', 'Новый шкаф '. $cabinet->title .' успешно добавлен.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cabinet  $cabinet
     * @return \Illuminate\Http\Response
     */
    public function show(Cabinet $cabinet)
    {
        return view('cabinets.show', compact('cabinet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cabinet  $cabinet
     * @return \Illuminate\Http\Response
     */
    public function edit(Cabinet $cabinet)
    {
        $sectors = \App\Sector::orderBy('title')->get();
        return view('cabinets.edit', compact('cabinet', 'sectors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cabinet  $cabinet
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCabinetRequest $request, Cabinet $cabinet)
    {
        $validatedData = $request->validated();

        $cabinet->update($validatedData);

        return redirect()->action('CabinetController@index')->with('success', 'Информация о шкафе обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cabinet  $cabinet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cabinet $cabinet)
    {
        //
    }
}
