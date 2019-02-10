<?php

namespace App\Http\Controllers;

use App\DemandLetterNameList;
use App\NameList;
use App\Rules\OlderThan;
use Illuminate\Http\Request;
use Storage;

class NameListController extends Controller
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
    public function create($demandLetterID)
    {
        return view('worker.create',['demandLetterID' => $demandLetterID]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $this->validate($request,[
            'name' => 'required',
            'fatherName' => 'required',
            'gender' => 'required',
            'nrc' => 'required',
            'dob' => ['required', new OlderThan(18)],
            'address' => 'required',
            'photo' => 'required'
        ]);

        $nameList = NameList::create([
            'name_mm' => $request->name ,
            'father_name_mm' => $request->fatherName,
            'gender_mm' => $request->gender,
            'nrc_mm' => $request->nrc,
            'dob_mm' => $request->dob,
            'address_mm' => $request->address,
            'photo' => $request->file('photo')->store('public/workerPhoto'),
        ]);      
        
        DemandLetterNameList::create([
            'demand_letter_id' => $request->demandLetterID ,
            'name_list_id' => $nameList->id
        ]);
        return redirect('demand_letter/detail/'.$request->demandLetterID);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NameList  $nameList
     * @return \Illuminate\Http\Response
     */
    public function show(NameList $nameList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NameList  $nameList
     * @return \Illuminate\Http\Response
     */
    public function edit(NameList $nameList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NameList  $nameList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NameList $nameList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NameList  $nameList
     * @return \Illuminate\Http\Response
     */
    public function destroy(NameList $nameList)
    {
        //
    }
}
