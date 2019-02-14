<?php

namespace App\Http\Controllers;

use App\DemandLetter;
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
            'unique_id' => strtoupper(bin2hex(openssl_random_pseudo_bytes(4))),
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

    public function createPassport(DemandLetter $demandLetterID)
    {
        $demandLetters = DemandLetter::with('nameList')->find($demandLetterID)->first()->toArray();
        $collection = collect($demandLetters['name_list']);
        $filterResult = $collection->filter(function ($value,$key)
        {
            return empty($value['passport_no']);
        });
        return view('worker.passport_create',['workerList' => $filterResult->all(), 'demandLetterID' => $demandLetters['id']]);
        
    }

    public function updatePassport(Request $request)
    {
        $nameList = NameList::find($request->nameListID);
        $nameList->update([
            'name_eng' => $request->name ,
            'father_name_eng' => $request->fatherName,
            'gender_eng' => $request->gender,
            'nrc_eng' => $request->nrc,
            'dob_eng' => $nameList->dob_mm,
            'address_eng' => $request->address,
            'passport_no' => $request->passport_no,
            'issue_date_of_passport' => $request->passport_issue_date,
        ]);
        $demandLetterNameList = DemandLetterNameList::where('demand_letter_id',$request->demandLetterID)->where('name_list_id',$request->nameListID)->first();
        $demandLetterNameList->update(['passport_status'=>1]);
        
        return redirect()->back();
    }

    public function createContract(DemandLetter $demandLetterID)
    {
        $demandLetters = DemandLetter::with('nameList')->find($demandLetterID)->first()->toArray();
        $collection = collect($demandLetters['name_list']);
        $filterResult = $collection->filter(function ($value,$key)
        {
            return ($value['pivot']['passport_status']) && (!$value['pivot']['contract_status']);
        });
        return view('worker.contract_create',['workerList' => $filterResult->all(), 'demandLetterID' => $demandLetters['id']]);
    }

    public function updateContract(Request $request)
    {
        $demandLetterNameList = DemandLetterNameList::where('demand_letter_id',$request->demandLetterID)->where('name_list_id',$request->nameListID)->first();
        $demandLetterNameList->update([
            'contract_status'=>1,
            'labour_card_no' => $request->labourcard_no,
            'issue_labour_date' => $request->issue_labour_date,
            'salary' => $request->salary
            ]);
        
        return redirect()->back();
    }
}
