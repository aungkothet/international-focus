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
    public function index($id)
    {
        $demandLetters = Company::with('demandletter')->find($id);
        return view('demandletter.index',['demandLetters' => $demandLetters]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($companyID)
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
        DemandLetter::create([
            'company_id' => $request->companyID,
            'date' => $request->demand_date,
            'demand_no' => $request->demand_no,
            'count' => [
                'male_count' => $request->male_count,
                'female_count' => $request->female_count,
                'total' => ($request->male_count + $request->female_count)
            ],

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

    public function unlock(Request $request,DemandLetter $demandLetter)
    {
        $demandLetter->update([
            'lock_status' => 0
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
            'count' => [
                'male_count' => $request->male_count,
                'female_count' => $request->female_count,
                'total' => ($request->male_count + $request->female_count)
            ],
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
        ]);
        $data = $demandLetter->attached_files;
        $comment =$demandLetter->comments;
        
        if($request->file('files')) {
            foreach($request->file('files') as $file)
            {          
                $data['demand_attachments'][]  =  $file->store('public/Attachment/DemandLetter/'.$demandLetter->id.'/NameListAttachments');
            }
        }
        else{
            $data['demand_attachments']=[];
        }
        $comment['demand_comments'] = $request->comment;
        $demandLetter->update([
            'comments' => $comment,
            'attached_files' => $data,
            'status' => 1
        ]);
        return \redirect()->back();

    }

    public function addPassportComment(Request $request,DemandLetter $demandLetter)
    {
        $this->validate($request,[
            'comment' => 'required'
        ]);
        $data = $demandLetter->attached_files;
        $comment =$demandLetter->comments;
        if($request->file('files')) {
            foreach($request->file('files') as $file)
            {          
                $data['passport_attachments'][]  =  $file->store('public/Attachment/DemandLetter/'.$demandLetter->id.'/PassportAttachments');
            }
        }
        else{
            $data['passport_attachments']=[];
        }
        $comment['passport_comments'] = $request->comment;
        $demandLetter->update([
            'comments' => $comment,
            'attached_files' => $data,
            'status' => 2
        ]);
        return \redirect()->back();

    }
    
    public function addContractComment(Request $request,DemandLetter $demandLetter)
    {
        $this->validate($request,[
            'comment' => 'required'
        ]);
        $data = $demandLetter->attached_files;
        $comment =$demandLetter->comments;
        if($request->file('files')) {
            foreach($request->file('files') as $file)
            {          
                $data['contract_attachments'][]  =  $file->store('public/Attachment/DemandLetter/'.$demandLetter->id.'/ContractAttachments');
            }
        }
        else{
            $data['contract_attachments']=[];
        }
        $comment['contract_comments'] = $request->comment;
        $demandLetter->update([
            'comments' => $comment,
            'attached_files' => $data,
            'status' => 3
        ]);
        return \redirect()->back();
    }

    public function addSendingComment(Request $request,DemandLetter $demandLetter)
    {
        $this->validate($request,[
            'comment' => 'required'
        ]);
        $data = $demandLetter->attached_files;
        $comment =$demandLetter->comments;
        if($request->file('files')) {
            foreach($request->file('files') as $file)
            {          
                $data['sending_attachments'][]  =  $file->store('public/Attachment/DemandLetter/'.$demandLetter->id.'/SendingAttachments');
            }
        }
        else{
            $data['sending_attachments']=[];
        }
        $comment['sending_comments'] = $request->comment;
        $demandLetter->update([
            'comments' => $comment,
            'attached_files' => $data,
            'status' => 4
        ]);
        return \redirect()->back();
    }

    public function addSummaryComment(Request $request,DemandLetter $demandLetter)
    {
        $this->validate($request,[
            'comment' => 'required'
        ]);
        $data = $demandLetter->attached_files;
        $comment =$demandLetter->comments;
        if($request->file('files')) {
            foreach($request->file('files') as $file)
            {          
                $data['sending_attachments'][]  =  $file->store('public/Attachment/DemandLetter/'.$demandLetter->id.'/SendingAttachments');
            }
        }
        else{
            $data['sending_attachments']=[];
        }
        $comment['sending_comments'] = $request->comment;
        $demandLetter->update([
            'comments' => $comment,
            'attached_files' => $data,
            'status' => 5
        ]);
        return \redirect()->back();
    }


    public function showPassportList(DemandLetter $demandLetter)
    {
        $demandLetters = DemandLetter::with(['namelist' => function ($nameList) {
            $nameList->where('status','>=',1);
         }])->find($demandLetter)->first();
        return view('demandletter.detail2',['demandLetters' => $demandLetters->toArray()]);
    }

    public function showContractList(DemandLetter $demandLetter)
    {
        $demandLetters = DemandLetter::with(['namelist' => function ($nameList) {
            $nameList->where('status','>=',2);
         }])->find($demandLetter)->first();
        return view('demandletter.contractlist',['demandLetters' => $demandLetters->toArray()]);
    }

    public function showSendingList(DemandLetter $demandLetter)
    {
        $demandLetters = DemandLetter::with(['namelist' => function ($nameList) {
            $nameList->where('status','>=',3);
         }])->find($demandLetter)->first();
        return view('demandletter.sendingList',['demandLetters' => $demandLetters->toArray()]);
    }
}
