@extends('layouts.app')

@section('css')
    
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    Worker Create Form
                </div>
                <div class="card-body">
                    <form action="{{ url('worker/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="demandLetterID" value="{{ old('demandLetterID')? old('demandLetterID') : $demandLetterID }}">
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required id="name" placeholder="Enter name.." value="{{ old('name') }}">
                            @if($errors->has('name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Father Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fatherName" required id="fatherName" placeholder="Enter father name.." value="{{ old('fatherName') }}">
                            @if($errors->has('fatherName'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('fatherName') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nrc">NRC <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nrc" required id="nrc" placeholder="Enter nrc number.." value="{{ old('nrc') }}">
                            @if($errors->has('nrc'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('nrc') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="gender" required id="gender" placeholder="Enter gender.." value="{{ old('gender') }}">
                            @if($errors->has('gender'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="dob" required id="dob" placeholder="Enter Date of Birth.." value="{{ old('dob') }}">
                            @if($errors->has('dob'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('dob') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="address">Address<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" required id="address" placeholder="Enter Address..">{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo Upload<span class="text-danger">*</span></label> 
                            <input type="file"  name="photo" required id="photo" placeholder="Upload photo..">
                            @if($errors->has('photo'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('photo') }}</strong>
                                </span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>       
    </div>
</div>
@endsection

@section('js')
    
@endsection