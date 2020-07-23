<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectorRequest;
use App\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ToDo: переделать на использование ресурса
        $sectors = Sector::withCount('cabinets')->get();
        return view('sectors.index', compact('sectors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sector = new Sector(); // пустая болванка для формы
        return view('sectors.create', compact('sector'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreSectorRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectorRequest $request)
    {
        $validatedData = $request->validated();

        $sector = new Sector($validatedData);
        $sector->save();
        return redirect()->action('SectorController@index')->with('success', 'Новая опорный пункт '. $sector->title .' успешно добавлен.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        return view('sectors.show', compact('sector'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        return view('sectors.edit', compact('sector'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSectorRequest $request, Sector $sector)
    {
        $validatedData = $request->validated();

        $sector->update($validatedData);

        return redirect()->action('SectorController@index')->with('success', 'Информация об ОПО обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sector $sector)
    {
        //
    }
}
