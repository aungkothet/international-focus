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
                    Worker Passport Edit Form (English Only)
                </div>
                <div class="card-body">
                    <form action="{{ url('worker/updatePassport/'.$workerDetail->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf                       
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required id="name" placeholder="Enter name.." value="{{ (old('name'))? old('name') : $workerDetail->name_eng }}">
                            @if($errors->has('name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Father Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fatherName" required id="fatherName" placeholder="Enter father name.." value="{{ (old('fatherName'))? old('fatherName') : $workerDetail->father_name_eng }}">
                            @if($errors->has('fatherName'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('fatherName') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nrc">NRC <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nrc" required id="nrc" placeholder="Enter nrc number.." value="{{ (old('nrc'))? old('nrc') : $workerDetail->nrc_eng }}">
                            @if($errors->has('nrc'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('nrc') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="gender" required id="gender" placeholder="Enter gender.." value="{{ (old('gender'))? old('gender') : $workerDetail->gender_eng }}">
                            @if($errors->has('gender'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="dob" required id="dob" placeholder="Enter Date of Birth.." value="{{ (old('dob'))? old('dob') : $workerDetail->dob_mm }}">
                            @if($errors->has('dob'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" required id="address" placeholder="Enter Address..">{{ (old('address'))? old('address') : $workerDetail->address_eng }}</textarea>
                            @if($errors->has('address'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="passport">Passport No.<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="passport" required id="passport" placeholder="Enter passport.." value="{{ (old('passport'))? old('passport') : $workerDetail->passport_no }}">
                            @if($errors->has('passport'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('passport') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="passport_issue_date">Passport Issue Date<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="passport_issue_date" required id="passport_issue_date" placeholder="Enter Date of Birth.." value="{{ (old('passport_issue_date'))? old('passport_issue_date') : $workerDetail->issue_date_of_passport }}">
                            @if($errors->has('passport_issue_date'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('passport_issue_date') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('demand_letter/passport/'.$demandLetterID) }}" class="btn btn-danger">Back To Passport List</a>
                    </form>
                </div>
            </div>
        </div>       
    </div>
</div>
@endsection

@section('js')
    
@endsection