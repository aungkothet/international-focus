@extends('layouts.app')
@section('css')
    <link href="{{ asset('css/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')    
    <div class="container">
        @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>    
        @endif
        <div class="row mb-4">
            <div class="col-md-4">
                <a href="{{ url('demand_letter/create/'.$demandLetters->id) }}" class="btn btn-primary m-1">Add New Demand Letter</a>
            </div>
            <div class="col-md-4">
                <h5 class="text-center">Demand Letter List</h5>
            </div>
            <div class="col-md-4">
                <a href="{{ url('/') }}" class="btn btn-danger m-1 float-right">Back To Company List</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="demandLetterTable" class="table table-striped table-bordered  nowrap">
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
                        @php $i=1; @endphp
                        @foreach ($demandLetters->demandletter as $key => $demandletter)
                            @auth
                            <tr class="{{ ($name_list['error_status'])? "bg-danger": ''}}">
                                <td>{{ $key+1 }}</td>
                                <td>{{ date('d-M-Y', strtotime($demandletter->date)) }}</td>
                                <td><a href="{{ url('demand_letter/detail/'.$demandletter->id) }}"> {{ $demandletter->demand_no }} </a></td>
                                <td>{{ $demandletter->count['male_count'] }}</td>
                                <td>{{ $demandletter->count['female_count'] }}</td>
                                <td>{{ $demandletter->count['total'] }}</td>
                                <td>
                                    <a href="{{ url('demand_letter/edit/'.$demandletter->id) }}" class="btn btn-info">Edit</a>
                                    @if($demandletter->lock_status)
                                    <a href="{{ url('demand_letter/unlock/'.$demandletter->id) }}" class="btn btn-primary">
                                        <img src="{{ asset('svg/lock.png') }}" width="20px" height="20px" alt="lock this"/>
                                    </a>
                                    @else
                                    <a href="{{ url('demand_letter/lock/'.$demandletter->id) }}" class="btn btn-primary">
                                        <img src="{{ asset('svg/unlock.png') }}" width="20px" height="20px" alt="lock this"/>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                            @else
                                @if (!$demandletter->lock_status)
                                <tr class="{{ ($name_list['error_status'])? "bg-danger": ''}}">
                                    <td>{{ $i++ }}</td>
                                    <td>{{ date('d-M-Y', strtotime($demandletter->date)) }}</td>
                                    <td><a href="{{ url('demand_letter/detail/'.$demandletter->id) }}"> {{ $demandletter->demand_no }} </a></td>
                                    <td>{{ $demandletter->count['male_count'] }}</td>
                                    <td>{{ $demandletter->count['female_count'] }}</td>
                                    <td>{{ $demandletter->count['total'] }}</td>
                                    <td>
                                        <a href="{{ url('demand_letter/edit/'.$demandletter->id) }}" class="btn btn-info">Edit</a>
                                    </td>
                                </tr>
                                @endif
                            @endauth
                            
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