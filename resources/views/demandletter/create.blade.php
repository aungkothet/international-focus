@extends('layouts.app')

@section('css')
    
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header">
                    Demand Letter Create Form
                </div>
                <div class="card-body">
                    <form action="{{ url('demand_letter/store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="companyID" value="{{ $companyID }}">
                        <div class="form-group">
                            <label for="demandletterno">Demand Letter No</label>
                            <input type="text" class="form-control" name="demand_no" required id="demandletterno" placeholder="Enter Demand Letter No..">
                        </div>
                        <div class="form-group">
                            <label for="malecount">Male Count</label>
                            <input type="number" class="form-control" name="male_count" required min="0" step="1" id="malecount" value="0" placeholder="Enter total number of male..">
                        </div>
                        <div class="form-group">
                            <label for="femalecount">Female Count</label>
                            <input type="number" class="form-control" name="female_count" required min="0" step="1" id="femalecount" value="0" placeholder="Enter total number of female..">
                        </div>
                        <div class="form-group">
                            <label for="damanddate">Demand Date</label>
                            <input type="date" class="form-control" name="demand_date" required id="damanddate" placeholder="Enter Demand Date..">
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