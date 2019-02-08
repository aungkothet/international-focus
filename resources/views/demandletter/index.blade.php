@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ url('demand_letter/') }}" class="btn btn-primary m-1">Add New Demand Letter</a>
            </div>
            <div class="col-md-4 offset-md-4 ">
                <a href="{{ url('/') }}" class="btn btn-danger m-1 float-right">Back To Company List</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="demandLetterTable" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Date</th>
                            <th>Demand No.</th>
                            <th>Male</th>
                            <th>Female</th>
                            <th>Total</th>
                            <th>Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($demandLetters->demandletter as $key => $demandletter)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ date('d-M-Y', strtotime($demandletter->date)) }}</td>
                                <td>{{ $demandletter->demand_no }}</td>
                                <td>{{ $demandletter->male_count }}</td>
                                <td>{{ $demandletter->female_count }}</td>
                                <td>{{ $demandletter->total }}</td>
                                <td>
                                    <a href="#" class="btn btn-info">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#demandLetterTable').DataTable();
        } );
    </script>
    
@endsection