<?php

namespace App\Http\Controllers;

use App\Camera;
use App\Http\Requests\StoreCameraRequest;
use Illuminate\Http\Request;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cameras = Camera::with('cabinet:id,title')->orderBy('location_km')->orderBy('location_piket')->get();
        return view('cameras.index', compact('cameras'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $camera = new Camera(); // пустая болванка для формы
        $cabinets = \App\Cabinet::orderBy('title')->get();

        $cameras = Camera::all();

        return view('cameras.create', compact('camera', 'cabinets', 'cameras'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCameraRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCameraRequest $request)
    {
        $validatedData = $request->validated();

        $camera = new Camera($validatedData);
        $camera->save();
        return redirect()->action('CameraController@index')->with('success', 'Новая камера '. $camera->title .' успешно добавлена.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function show(Camera $camera)
    {
        return view('cameras.show', compact('camera'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function edit(Camera $camera)
    {
        $cabinets = \App\Cabinet::orderBy('title')->get();

        $cameras = Camera::all();

        return view('cameras.edit', compact('camera','cabinets', 'cameras'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCameraRequest $request, Camera $camera)
    {
        $validatedData = $request->validated();

        $camera->update($validatedData);

        return redirect()->action('CameraController@index')->with('success', 'Информация о камере обновлена');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Camera  $camera
     * @return \Illuminate\Http\Response
     */
    public function destroy(Camera $camera)
    {
        //
    }
}
