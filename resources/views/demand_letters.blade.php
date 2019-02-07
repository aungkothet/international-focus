@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <table id="demandLetterTable" class="table table-striped table-bordered w-100 col-md-10 offset-md-1">
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
                            <td>{{ date('d-m-Y', strtotime($demandletter->date)) }}</td>
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
@endsection

@section('js')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#demandLetterTable').DataTable();
        } );
    </script>
    
@endsection