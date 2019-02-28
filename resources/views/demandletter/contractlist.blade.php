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
        <div class="row">
            <div class="col-md-4">
                <a href="{{ url('worker/contract/create/'.$demandLetters['id']) }}" class="btn btn-primary m-1">Add New Worker</a>
            </div>
            <div class="col-md-4">
                <h5> Contract List </h5>
            </div>
            <div class="col-md-4 ">
                <a href="{{ url('demand_letter/passport/'.$demandLetters['id']) }}" class="btn btn-danger m-1 float-right">Back To Passport Name List</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="nameListTable" class="table table-striped table-bordered  nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>UniqueID</th>
                            <th>NRC</th>
                            <th>Gender</th>
                            <th>Address</th>
                            {{-- <th>Operation</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($demandLetters['name_list'] as $key => $name_list)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>
                                    <img src="{{ url(Storage::url(str_replace('public','',$name_list['photo']))) }}" class="rounded" width="50px" height="50px" >
                                </td>
                                <td>{{ $name_list['name_eng'] }}</td>
                                <td>{{ $name_list['unique_id']}}</td>
                                <td>{{ $name_list['nrc_eng'] }}</td>
                                <td>{{ $name_list['gender_eng'] }}</td>
                                <td>{{ $name_list['address_eng'] }}</td>
                                {{-- <td>
                                    <a href="{{ url('worker/edit/'.$name_list['id']) }}" class="btn btn-info">Edit</a>
                                </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row d-none my-3" id="commentForm" >
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Add Comment for this Demand Letter
                    </div>
                    <div class="card-body">
                        <form action="{{ url('demand_letter/contract/comment/'.$demandLetters['id']) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="comment">Comment<span class="text-danger">*</span></label>
                                <textarea class="form-control" name="comment" required id="comment" placeholder="Enter Comment..">{{ old('comment') }}</textarea>
                                @if($errors->has('comment'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('comment') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="photo">Attach File(s) Upload<span class="text-danger">*</span></label> 
                                <input type="file"  name="files[]" required id="photo" placeholder="Upload photo.." multiple>
                                @if($errors->has('photo'))
                                    <span class="text-danger">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="button" class="btn btn-secondary" id="cancelBTN">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>       
        </div>
        <div class="row mt-3">
            <div class="col-md-4 ml-auto">               
            <a href="{{ url('demand_letter/sending/'.$demandLetters['id']) }}" class="btn btn-primary m-1 float-right {{ ($demandLetters['contract_comments'])? :'disabled'}}">Next</a>
            <button class="btn btn-primary m-1 float-right" id="btnNote">Note</a>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#nameListTable').DataTable();
            $('#btnNote').click(function(){
                $('#commentForm').removeClass('d-none');
            });
            $('#cancelBTN').click(function(){
                $('#commentForm').addClass('d-none');
            });

        } );
    </script>
@endsection