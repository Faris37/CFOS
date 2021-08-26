@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">School Users <a href="{{route('Admin.SchAdm.addUser')}}"><button style="float: right;" class="btn btn-primary">Add New User</button></a></div>

                <div class="search-container">
                    <form action="{{route('Admin.SchAdm.mainSearch')}}" method="POST">
                            @csrf
                            <input type="text" value="" name="search" id="search" style="width:95%">
                            <input type="hidden" name="searching" id="searching" value="searching">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>

                <div class="card-body">
                <center>
                <table>
                    <tr>
                        <th style="padding: 15px; text-align:center; width:25%">Name</th>
                        <th style="padding: 15px; text-align:center; width:25%">Email</th>
                        <th style="padding: 15px; text-align:center; width:25%">Role</th>
                        <th style="padding: 15px; text-align:center; width:25%">Action</th>
                    </tr>
                    @foreach($users as $users)
                    <tr>
                        <td style=" text-align:center; width:25%">{{$users->UNAME}}</td>
                        <td style=" text-align:center; width:25%">{{$users->EMAIL}}</td>
                        <td style=" text-align:center; width:25%">{{$users->RNAME}}</td>
                        <td style="text-align:center; width:25%">
                            <a href="{{ route('Admin.SchAdm.updateUser' , $users->UID) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                            <form action="{{ route('Admin.SchAdm.inactiveUser') }}" method="POST" class="float-left">
                                @csrf
                                <input type="hidden" name="uid" value="{{$users->UID}}" id="uid">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sure Want Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
                </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
