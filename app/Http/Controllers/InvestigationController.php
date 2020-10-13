<?php

namespace App\Http\Controllers;

use App\Models\Carve;
use App\Models\File;
use App\Models\FitAnalyser;
use App\Models\Investigation;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\In;
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
        $investigations = Auth::user()->currentTeam->investigations->all();

        return view('investigations.index', ['investigations' => $investigations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        $this->authorize('create', Investigation::class);

        return view('investigations.create', ['user' => $request->user()]);
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
        $this->authorize('access', $investigation);

        return view('investigations.show', ['investigation' => $investigation]);
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


    public function search(Request $request, Investigation $investigation)
    {
        $this->authorize('access', $investigation);

        $imageName = $investigation->image;

        Carve::searchForFiles($request, $imageName, $investigation);

        return redirect()->back();
    }


    public function carve(Request $request, Investigation $investigation)
    {
        $this->authorize('access', $investigation);

        Carve::extractFiles($request, $investigation);

        return redirect()->back();
    }


    public function parse(Request $request, Investigation $investigation)
    {
        $this->authorize('access', $investigation);

        Carve::parseFiles($request, $investigation);

        return redirect()->back();
    }
}
