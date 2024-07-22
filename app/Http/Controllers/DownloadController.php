<?php

namespace App\Http\Controllers;

use App\Models\Donwload;

class DownloadController extends Controller
{
    public function index()
    {
        $download = Donwload::all();
        return view('download', ['downloads' => $download]);
    }
}
