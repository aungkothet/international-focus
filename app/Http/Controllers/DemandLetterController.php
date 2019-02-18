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

    public function lock(Request $request,DemandLetter $demandLetter)
    {
        $demandLetter->update([
            'lock_status' => 1
        ]);
         return redirect('/');
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
        foreach($request->file('files') as $file)
        {          
            $data[]  =  $file->store('public/Attachment/DemandLetter/'.$demandLetter->id);
        }
        $demandLetter->update([
            'comments' => $request->comment,
            'demand_attached_files' => $data
        ]);
        return \redirect()->back();
       //need to do upload multiple files

    }

    public function addPassportComment(Request $request,DemandLetter $demandLetter)
    {
        $this->validate($request,[
            'comment' => 'required',
            'files' => 'required'
        ]);
        foreach($request->file('files') as $file)
        {          
            $data[]  =  $file->store('public/Attachment/DemandLetter/'.$demandLetter->id);
        }
        $demandLetter->update([
            'passport_comments' => $request->comment,
            'passport_attached_files' => $data
        ]);
        return \redirect()->back();
       //need to do upload multiple files

    }
    
    public function addContractComment(Request $request,DemandLetter $demandLetter)
    {
        $this->validate($request,[
            'comment' => 'required',
            'files' => 'required'
        ]);
        foreach($request->file('files') as $file)
        {          
            $data[]  =  $file->store('public/Attachment/DemandLetter/'.$demandLetter->id);
        }
        $demandLetter->update([
            'contract_comments' => $request->comment,
            'contract_attached_files' => $data
        ]);
        return redirect()->back();
       //need to do upload multiple files

    }

    public function addSendingComment(Request $request,DemandLetter $demandLetter)
    {
        $this->validate($request,[
            'comment' => 'required',
            'files' => 'required'
        ]);
        foreach($request->file('files') as $file)
        {          
            $data[]  =  $file->store('public/Attachment/DemandLetter/'.$demandLetter->id);
        }
        $demandLetter->update([
            'sending_comments' => $request->comment,
            'sending_attached_files' => $data
        ]);
        return redirect()->back();
       //need to do upload multiple files

    }

    public function showPassportList(DemandLetter $demandLetter)
    {
        $demandLetters = DemandLetter::with('nameList')->find($demandLetter)->first()->toArray();
        $collection = collect($demandLetters['name_list']);
        $filterResult = $collection->filter(function ($value,$key)
        {
            return !empty($value['passport_no']);
        });
        $demandLetters['name_list'] = $filterResult->all();
        return view('demandletter.detail2',['demandLetters' => $demandLetters]);
    }

    public function showContractList(DemandLetter $demandLetter)
    {
        $demandLetters = DemandLetter::with('nameList')->find($demandLetter)->first()->toArray();
        $collection = collect($demandLetters['name_list']);
        $filterResult = $collection->filter(function ($value,$key)
        {
            return ($value['pivot']['passport_status']) && ($value['pivot']['contract_status']) ;
        });
        $demandLetters['name_list'] = $filterResult->all();
        return view('demandletter.contractlist',['demandLetters' => $demandLetters]);
    }

    public function showSendingList(DemandLetter $demandLetter)
    {
        $demandLetters = DemandLetter::with('nameList')->find($demandLetter)->first()->toArray();
        $collection = collect($demandLetters['name_list']);
        $filterResult = $collection->filter(function ($value,$key)
        {
            return ($value['pivot']['passport_status']) && ($value['pivot']['contract_status']) && ($value['pivot']['sending_status']) ;
        });
        $demandLetters['name_list'] = $filterResult->all();
        return view('demandletter.sendingList',['demandLetters' => $demandLetters]);
    }
}
