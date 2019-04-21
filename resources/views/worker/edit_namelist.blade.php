@extends('layouts.app')

@section('css')
    
@endsection

@section('content')
<div class="container">
    @if (\Session::has('status')) 
    <div class="alert alert-success" role="alert">
            {{ Session::get('status') }}
    </div>
    @endif
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    Worker Edit Form (ျမန္မာဘာသာျဖင့္ ျဖည့္ရန္)
                </div>
                <div class="card-body">
                    <form action="{{ url('worker/update/'.$workerDetail->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required id="name" placeholder="Enter name.." value="{{ (old('name'))? old('name') : $workerDetail->name_mm }}">
                            @if($errors->has('name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Father Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fatherName" required id="fatherName" placeholder="Enter father name.." value="{{ (old('fatherName'))? old('fatherName') : $workerDetail->father_name_mm }}">
                            @if($errors->has('fatherName'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('fatherName') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nrc">NRC <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nrc" required id="nrc" placeholder="Enter nrc number.." value="{{ (old('nrc'))? old('nrc') : $workerDetail->nrc_mm }}">
                            @if($errors->has('nrc'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('nrc') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="gender" required id="gender" placeholder="Enter gender.." value="{{ (old('gender'))? old('gender') : $workerDetail->gender_mm }}">
                            @if($errors->has('gender'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="dob" required id="dob" placeholder="Enter Date of Birth.." value="{{ (old('dob'))? old('dob') : $workerDetail->dob_mm }}">
                            @if($errors->has('dob'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" required id="address" placeholder="Enter Address..">{{ (old('address'))? old('address') : $workerDetail->address_mm }}</textarea>
                            @if($errors->has('address'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo Upload</label> 
                            <input type="file" name="photo" id="photo" placeholder="Upload photo..">
                            @if($errors->has('photo'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nrc_req">NRC Requirement</label>
                            <input type="text" class="form-control" name="nrc_req"  id="nrc_req" placeholder="Enter NRC requirement" value="{{ (old('nrc_req'))? old('nrc_req') : $workerDetail->nrc_requirement }}">
                            @if($errors->has('nrc_req'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('nrc_req') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="repersentative_name">Representative Name</label>
                            <input type="text" class="form-control" name="repersentative_name"  id="repersentative_name" placeholder="Enter representative name" value="{{ (old('repersentative_name'))? old('repersentative_name') : $workerDetail->repersentative_name }}">
                            @if($errors->has('repersentative_name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('repersentative_name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="phone_no">Phone Number</label>
                            <input type="text" class="form-control" name="phone_no"  id="phone_no" placeholder="Enter Phone Number" value="{{ (old('phone_no'))? old('phone_no') : $workerDetail->phone_number }}">
                            @if($errors->has('phone_no'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('phone_no') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="card_number">ခ်ိတ္ကဒ္ Number</label>
                            <input type="text" class="form-control" name="card_number"  id="card_number" placeholder="Enter Phone Number" value="{{ (old('card_number'))? old('card_number') : $workerDetail->card_number }}">
                            @if($errors->has('card_number'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('card_number') }}</strong>
                                </span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('demand_letter/detail/'.$demandLetterID) }}" class="btn btn-danger">Back To Name List</a>
                    </form>
                </div>
            </div>
        </div>       
    </div>
</div>
@endsection

@section('js')
    
@endsection