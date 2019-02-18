@extends('layouts.app')

@section('css')
    
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-1">
            <div class="form-group">
                <label for="name">Select Worker To Fill <span class="text-danger">*</span></label>
                <select id="workerID">
                    <option disabled selected>Choose Worker First</option>
                    @foreach ($workerList as $worker)
                        <option value="{{ $worker['id'] }}">{{ $worker['name_mm']}} , {{ $worker['nrc_mm']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <a href="{{ url('demand_letter/passport/'.$demandLetterID) }}" class="btn btn-danger">Back To Passport Name List</a>
        </div>
    </div>
    <div class="row d-none" id="form">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    Worker Passport Issue Form
                </div>
                <div class="card-body">
                    <form action="{{ url('worker/passport/update') }}" method="POST" id="updateForm">
                        @csrf
                        <input type="hidden" name="demandLetterID" value="{{ $demandLetterID }}">
                        <input type="hidden" name="nameListID" value="" id="nameListID">
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
                            <label for="name">Name(ENG)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" required id="name" placeholder="Enter name.." id="name" value="{{ old('name') }}">
                            @if($errors->has('name'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="fatherName">Father Name(ENG)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fatherName" required id="fatherName" placeholder="Enter father name.." value="{{ old('fatherName') }}">
                            @if($errors->has('fatherName'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('fatherName') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="nrc">NRC(ENG) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="nrc" required id="nrc" placeholder="Enter nrc number.." value="{{ old('nrc') }}">
                            @if($errors->has('nrc'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('nrc') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender(ENG)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control"  name="gender" required id="gender" placeholder="Enter gender.." value="{{ old('gender') }}">
                            @if($errors->has('gender'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                        </div>                       
                        <div class="form-group">
                            <label for="address">Address(ENG)<span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" required id="address" placeholder="Enter Address..">{{ old('address') }}</textarea>
                            @if($errors->has('address'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div> 
                        <div class="form-group">
                            <label for="passport_no">Passport No.(ENG)<span class="text-danger">*</span></label>
                            <input type="text" class="form-control"  name="passport_no" required id="passport_no" placeholder="Enter Passport No..." value="{{ old('passport_no') }}">
                            @if($errors->has('passport_no'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('passport_no') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="passport_issue_date">Passport Issue Date(ENG)<span class="text-danger">*</span></label>
                            <input type="date" class="form-control"  name="passport_issue_date" required id="passport_issue_date" placeholder="Enter Passport Issue Date..." value="{{ old('passport_issue_date') }}">
                            @if($errors->has('passport_issue_date'))
                                <span class="text-danger">
                                    <strong>{{ $errors->first('passport_issue_date') }}</strong>
                                </span>
                            @endif
                        </div>                     
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('demand_letter/detail/'.$demandLetterID) }}" class="btn btn-danger">Back To Detail</a>
                    </form> 
                </div>
            </div>
        </div>       
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#workerID').change(function(){   
            @foreach($workerList as $worker)
                if($(this).val() == "{{ $worker['id']}}")
                {
                    $('#form').removeClass('d-none');
                    $('#nameListID').val("{{ $worker['id'] }}");
                    $('#name').val("{{ $worker['name_mm'] }}");
                    $('#fatherName').val("{{ $worker['father_name_mm'] }}");
                    $('#nrc').val("{{ $worker['nrc_mm'] }}");
                    $('#gender').val("{{ $worker['gender_mm'] }}");
                    $('#dob').val("{{ $worker['dob_mm'] }}");
                    $('#address').val("{{ $worker['address_mm'] }}");
                }
            @endforeach            
        });
    });
</script>
@endsection