<?php

namespace App\Http\Controllers;

use App\File;
use App\FitAnalyser;
use App\Investigation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class InvestigationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $investigations = Investigation::all();

        return view('investigation.index', ['investigations' => $investigations]);
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
     * @param  \App\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function show(Investigation $investigation)
    {
        return view('investigation.show', ['investigation' => $investigation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function edit(Investigation $investigation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Investigation $investigation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Investigation  $investigation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Investigation $investigation)
    {
        //
    }


    public function parse(Request $request, Investigation $investigation, File $file = null)
    {
        if ($file) {
            $files = [$file];
        } else {
            $files = $investigation->files->where('parsed', '=', false);
        }

        $success = 0;
        $errors = 0;

        foreach ($files as $file) {

            try {
                $path = storage_path('app/' . $file->investigation->id . '/' . $file->name);
                $fitData = new FitAnalyser($path);
                $file->type = $fitData->getType();
                $file->parsed = true;
                $file->save();
                $success++;
            } catch (Throwable $e) {
                $errors++;
                report($e);

                continue;
            }
        }

        if ($success > 0) {
            $request->session()->flash('status', $success . ' files parsed!');
        }

        if ($errors > 0) {
            $request->session()->flash('error', 'There were '  . $errors . ' errors!');
        }

        return redirect()->back();
    }
}
