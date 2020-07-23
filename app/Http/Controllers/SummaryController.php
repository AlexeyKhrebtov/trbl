<?php

namespace App\Http\Controllers;

use App\Camera;
use App\Sector;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    /**
     * Сводная таблица
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $sectors = Sector::all();
        $cameras = Camera::with('cabinet')->orderBy('location_km')->get();
        return view('summaries.index', compact('sectors', 'cameras'));
    }
}
