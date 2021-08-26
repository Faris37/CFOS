@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Banned Menu <a href="{{route('Admin.SchAdm.addBanned')}}"><button style="float: right;" class="btn btn-primary">Add New Banned Menu</button></a></div>
                
                <div class="card-body">

                <div class="search-container">
                    <form action="{{route('Admin.SchAdm.searchBanned')}}" method="POST">
                            @csrf
                            <input type="text" value="" name="search" id="search" style="width:93%">
                            <input type="hidden" name="searching" id="searching" value="searching">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <center>
                <table style="width:100%">
                    <tr>
                        <th style="padding: 15px; text-align:center; width:50%">Name</th>
                        <th style="padding: 15px; text-align:center; width:50%">Actions</th>
                    </tr>
                    @foreach($banned as $banned)
                    <tr>
                        <td style=" text-align:center;width:50%">{{$banned->Name}}</td>
                        <td style=" text-align:center; width:50%">
                            <a href="{{ route('Admin.SchAdm.deleteBanned' , $banned->id) }}"><button type="button" class="btn btn-warning" onclick="return confirm('Sure Want Delete?')">Delete</button></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                </canter>
                </div>
               
            </div>
        </div>
    </div>
</div>
@endsection
