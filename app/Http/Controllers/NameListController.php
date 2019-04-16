<?php

namespace App\Http\Controllers;

use App\DemandLetter;
use App\DemandLetterNameList;
use App\NameList;
use App\Rules\OlderThan;
use Illuminate\Http\Request;
use File;
use QrCode;
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
            'nrc' => 'required|unique:name_lists,nrc_mm',
            'dob' => 'required',
            'address' => 'required',
            'photo' => 'nullable'
        ]);
        $unique_id = strtoupper(bin2hex(openssl_random_pseudo_bytes(4)));
        if($request->file('photo')) {
            $photoPath = $request->file('photo')->store('public/workerPhoto/'.$unique_id);
        } else {
            $photoPath = '';
        }

        $pngImage = QrCode::format('png')
        ->size(500)->errorCorrection('H')
        ->generate($unique_id);

        $path = storage_path('app/public/workerPhoto/'.$unique_id.'/');
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        $qr_name = storage_path('app/public/workerPhoto/'.$unique_id.'/'. $unique_id .'.png');
        file_put_contents($qr_name ,$pngImage);
        
        $qr_name = 'public/workerPhoto/'.$unique_id.'/'.$unique_id .'.png';
        $nameList = NameList::create([
            'name_mm' => $request->name ,
            'father_name_mm' => $request->fatherName,
            'gender_mm' => $request->gender,
            'nrc_mm' => $request->nrc,
            'dob_mm' => $request->dob,
            'address_mm' => $request->address,
            'photo' => $photoPath,
            'unique_id' => $unique_id ,
            'qrcode' => $qr_name,
            'nrc_requirement' => $request->nrc_req,
            'repersentative_name' => $request->representative_name,
            'phone_number' => $request->phone_no,
            'card_number' => $request->card_number
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
    public function edit(NameList $nameList,$demandLetterID)
    {
        return view('worker.edit_namelist',['workerDetail' => $nameList, 'demandLetterID' => $demandLetterID]);
    }

    public function editPassport(NameList $nameList,$demandLetterID)
    {
        return view('worker.edit_passport',['workerDetail' => $nameList, 'demandLetterID' => $demandLetterID]);
    }

    public function editToDoPassport(NameList $nameList,$demandLetterID)
    {
        return view('worker.edit_todopassport',['workerDetail' => $nameList, 'demandLetterID' => $demandLetterID]);
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
        $this->validate($request,[
            'name' => 'required',
            'fatherName' => 'required',
            'gender' => 'required',
            'nrc' => 'required',
            'dob' => 'required',
            'address' => 'required',
           
        ]);
        if($request->file('photo'))
        {
            $photoPath = $request->file('photo')->store('public/workerPhoto');
        } else {
            $photoPath = '';
        }

        $nameList->update([
            'name_mm' => $request->name ,
            'father_name_mm' => $request->fatherName,
            'gender_mm' => $request->gender,
            'nrc_mm' => $request->nrc,
            'dob_mm' => $request->dob,
            'address_mm' => $request->address,
            'photo' => ($photoPath)? $photoPath : $nameList->photo
        ]);      
        
        return \redirect()->back()->with('status',"Update Success");
        
    }

    public function passportUpdate(Request $request, NameList $nameList)
    {
        $this->validate($request,[
            'name' => 'required',
            'fatherName' => 'required',
            'gender' => 'required',
            'nrc' => 'required',
            'dob' => 'required',
            'address' => 'required',
           
        ]);

        $nameList->update([
            'name_eng' => $request->name ,
            'father_name_eng' => $request->fatherName,
            'gender_eng' => $request->gender,
            'nrc_eng' => $request->nrc,
            'dob_eng' => $request->dob,
            'address_eng' => $request->address,
            'passport_no' => $request->passport,
            'issue_date_of_passport' => $request->passport_issue_date,
            
        ]);
        return \redirect()->back()->with('status',"Update Success");
    }

    public function todopassportUpdate(Request $request, NameList $nameList)
    {
        if($request->file('photo'))
        {
            $photoPath = $request->file('photo')->store('public/workerPhoto');
        } else {
            $photoPath = $nameList->photo;
        }
        $nameList->update([
            'photo' => $photoPath,
            'religion' => $request->religion,
            'error_status' => ($request->error_status)? 0: $nameList->error_status
        ]);
        return redirect()->back();
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
    public function createToDoPassport(DemandLetter $demandLetterID)
    {
        $demandLetters = $demandLetterID->with(['namelist' => function ($nameList) {
            $nameList->whereStatus(0);
         }])->first();
        return view('worker.todopassport_create',['workerList' => $demandLetters->namelist, 'demandLetterID' => $demandLetters['id']]);
        
    }

    public function updateToDoPassport(Request $request)
    {
        if($request->file('photo'))
        {
            $photoPath = $request->file('photo')->store('public/workerPhoto');
        } else {
            $photoPath = '';
        }
        $nameList = NameList::find($request->nameListID);
        $nameList->update([
            'photo' => ($photoPath)? $photoPath : $nameList->photo,
            'religion' => $request->religion,
            'status' => 1
        ]);
        return redirect()->back();
    }


    public function createPassport(DemandLetter $demandLetterID)
    {
        $demandLetters = $demandLetterID->with(['namelist' => function ($nameList) {
            $nameList->whereStatus(1)->whereErrorStatus(0);
         }])->first();
        return view('worker.passport_create',['workerList' => $demandLetters->namelist, 'demandLetterID' => $demandLetters['id']]);
        
    }

    public function updatePassport(Request $request)
    {
        
        $nameList = NameList::find($request->nameListID);
        if($request->file('photo'))
        {
            $photoPath = $request->file('photo')->store('public/workerPhoto');
        } else {
            $photoPath = $nameList->photo;
        }
        
        $nameList->update([
            'name_eng' => $request->name ,
            'father_name_eng' => $request->fatherName,
            'gender_eng' => $request->gender,
            'nrc_eng' => $request->nrc,
            'dob_eng' => $request->dob_eng,
            'address_eng' => $request->address,
            'passport_no' => $request->passport_no,
            'issue_date_of_passport' => $request->passport_issue_date,
            'photo' => $photoPath,
            'status' => 2
        ]);
        $demandLetterNameList = DemandLetterNameList::where('demand_letter_id',$request->demandLetterID)
            ->whereNameListId($request->nameListID)->first();
        $demandLetterNameList->update(['salary'=>$request->salary]);
        
        return redirect()->back();
    }

    public function createContract(DemandLetter $demandLetterID)
    {
        $demandLetters = $demandLetterID->with(['namelist' => function ($nameList) {
            $nameList->whereStatus(2)->whereErrorStatus(0);
         }])->first();
        return view('worker.contract_create',['workerList' => $demandLetters->namelist, 'demandLetterID' => $demandLetters->id]);
    }

    public function updateContract(Request $request)
    {
        $demandLetterNameList = DemandLetterNameList::whereDemandLetterId($request->demandLetterID)->whereNameListId($request->nameListID)->first();
        $demandLetterNameList->update([
            'labour_card_no' => $request->labourcard_no,
            'issue_labour_date' => $request->issue_labour_date,
        ]);
        
        $nameList = NameList::find($request->nameListID);
        $nameList->update([
            'status' => 3
        ]);
        return redirect()->back();
    }

    public function createSending(DemandLetter $demandLetterID)
    {
        $demandLetters = $demandLetterID->with(['namelist' => function ($nameList) {
            $nameList->whereStatus(3);
         }])->first();
        return view('worker.sending_create',['workerList' => $demandLetters->namelist, 'demandLetterID' => $demandLetters['id']]);
    }

    public function updateSending(Request $request)
    {
        $namelist = NameList::whereIn("id",$request->nameList)->update(['status'=>4]);   
        return redirect('demand_letter/sending/'.$request->demandLetterID);
    }

    public function downloadQR(NameList $nameList)
    {
        return Storage::download($nameList->qrcode,$nameList->unique_id.'.png');
    }
   
    public function changeStatus(NameList $nameList,$demandLetterID)
    {
        $nameList->update([
            'error_status' => 1,
        ]);
        return \redirect('/demand_letter/todopassport/'.$demandLetterID);
    }
}
