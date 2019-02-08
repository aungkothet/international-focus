<?php

namespace App\Http\Controllers;

use App\Company;
use App\DemandLetter;
use Illuminate\Http\Request;

class DemandLetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id)
    {
        $demandLetters = Company::with('demandletter')->find($id);
        // dd($demandLetters->toArray());
        return view('demandletter.index',['demandLetters' => $demandLetters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$companyID)
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
     * @param  \App\DemandLetter  $demandLetter
     * @return \Illuminate\Http\Response
     */
    public function show(DemandLetter $demandLetter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DemandLetter  $demandLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(DemandLetter $demandLetter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DemandLetter  $demandLetter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DemandLetter $demandLetter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DemandLetter  $demandLetter
     * @return \Illuminate\Http\Response
     */
    public function destroy(DemandLetter $demandLetter)
    {
        //
    }
}
