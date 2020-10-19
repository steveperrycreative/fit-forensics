<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\FitAnalyser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        if (Auth::user()->can('access', $file)) {

            $path = storage_path('app/' . $file->path());
            $fitData = new FitAnalyser($path);
            $currentHash = hash('sha256', file_get_contents($path));

            if ( ! $file->parsed) {
                $file->type = $fitData->getType();
                $file->parsed = true;
                $file->save();
            }

            //$json = json_encode($fitData->data_mesgs);

            return view('files.show', ['file' => $file, 'data' => $fitData, 'currentHash' => $currentHash]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }

    public function download(File $file)
    {
        return Storage::download($file->path());
    }
}
