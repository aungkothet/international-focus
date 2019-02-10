<?php

namespace App\Http\Controllers;

use App\Company;
use App\DemandLetter;
use App\DemandLetterNameList;
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
        
        return view('demandletter.create',['companyID' => $companyID]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        DemandLetter::create([
            'company_id' => $request->companyID,
            'date' => $request->demand_date,
            'demand_no' => $request->demand_no,
            'male_count' => $request->male_count,
            'female_count' => $request->female_count,
            'total' => ($request->male_count + $request->female_count)
        ]);
        return redirect('demand_letters/'.$request->companyID)->with("status",'Saved Success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DemandLetter  $demandLetter
     * @return \Illuminate\Http\Response
     */
    public function show($demandLetter)
    {
        $demandLetters = DemandLetter::with('nameList')->find($demandLetter);
        
        return view('demandletter.detail',['demandLetters' => $demandLetters]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DemandLetter  $demandLetter
     * @return \Illuminate\Http\Response
     */
    public function edit(DemandLetter $demandLetter)
    {
        return view('demandletter.edit',['demandletter' => $demandLetter]);
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
        $demandLetter->update([
            'company_id' => $request->companyID,
            'date' => $request->demand_date,
            'demand_no' => $request->demand_no,
            'male_count' => $request->male_count,
            'female_count' => $request->female_count,
            'total' => ($request->male_count + $request->female_count)
        ]);
        return redirect('demand_letters/'.$request->companyID)->with("status",'Update Success!');

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

    public function addComment(Request $request,DemandLetter $demandLetter)
    {
        $this->validate($request,[
            'comment' => 'required',
            'files' => 'required'
        ]);
       //need to do upload multiple files

    }
}
