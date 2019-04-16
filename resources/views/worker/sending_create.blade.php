@extends('layouts.app')

@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">    
@endsection

@section('content')
<div class="container">
    <div class="row mt-3" id="form">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    Worker Sending Create Form
                </div>
                <div class="card-body">
                    <form action="{{ url('worker/sending/update') }}" method="POST" id="updateForm">
                        @csrf
                        <input type="hidden" name="demandLetterID" value="{{ $demandLetterID }}">
                        <div class="form-group">
                            <label for="name">Select Worker(s)<span class="text-danger">*</span></label>
                            <select id="workerID" class="form-control" multiple name="nameList[]">                                
                                @foreach ($workerList as $worker)
                            <option value="{{ $worker['id'] }}">{{ $worker['unique_id'] }}({{ $worker['name_eng']}})</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <input type="hidden" name="nameListID" value="" id="nameListID">
                        <div class="form-group">
                            <label for="name">Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" value="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Father Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fatherName" disabled value="">
                        </div>
                        <div class="form-group">
                            <label for="nrc">NRC <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nrc" disabled value="">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender<span class="text-danger">*</span></label>
                            <input type="text" class="form-control"id="gender" disabled value="">
                        </div>
                        <div class="form-group">
                            <label for="dob">Date of Birth<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="dob" value="" disabled>
                        </div>
                        <div class="form-group">
                            <label for="address">Address(MM)<span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" disabled>{{ old('address') }}</textarea>                            
                        </div> 

                        <div class="form-group">
                            <label for="labourcard_no">Labour Card Number<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="labourcard_no" required id="labourcard_no" placeholder="Enter Labour Card Number.."  value="{{ old('labourcard_no') }}">
                            @if($errors->has('labourcard_no'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('labourcard_no') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="issue_labour_date">Issue Date of Labour Card<span class="text-danger">*</span></label>
                            <input type="date" class="form-control" name="issue_labour_date" required id="issue_labour_date" placeholder="Enter Issue Date.." value="{{ old('issue_labour_date') }}">
                            @if($errors->has('issue_labour_date'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('issue_labour_date') }}</strong>
                                </span>
                            @endif
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="nrc">Identification Card<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nrc" required id="nrc" placeholder="Enter Identification Card number.." value="{{ old('nrc') }}">
                            @if($errors->has('nrc'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('nrc') }}</strong>
                                </span>
                            @endif
                        </div> --}}
                        {{-- <div class="form-group">
                            <label for="salary">Salary<span class="text-danger">*</span></label>
                            <input type="number" class="form-control"  name="salary" required id="salary" min="0" placeholder="Enter Salary.." value="{{ old('salary') }}">
                            @if($errors->has('salary'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('salary') }}</strong>
                                </span>
                            @endif
                        </div> --}}
                       
                        <button type="submit" class="btn btn-primary">Submit</button>
                        {{-- <a href="{{ url('demand_letter/detail/'.$demandLetterID) }}" class="btn btn-danger">Back To Detail</a> --}}
                        <a href="{{ url('demand_letter/sending/'.$demandLetterID) }}" class="btn btn-danger">Back To Sending  List</a> 
                    </form> 
                </div>
            </div>
        </div>       
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('js/select2.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#workerID').select2();
    } );
</script>  
@endsection