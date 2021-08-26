@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Organization <a href="{{route('admin.users.Oadd')}}"><button style="float: right;" class="btn btn-primary">Add New Organization</button></a></div>

                <div class="card-body">
                    <center>
                <table>
                    <tr>
                        <th style="padding: 15px; text-align:center; width:33%">Name</th>
                        <th style="padding: 15px; text-align:center; width:33%" >State</th>
                        <th style="padding: 15px; text-align:center; width:33%">Actions</th>
                    </tr>
                    @foreach($org as $org)
                    <tr>
                        <td style=" text-align:center;width:33%">{{$org->SName}}</td>
                        <td style=" text-align:center;width:33%">{{$org->SState}}</td>
                        <td style=" text-align:center;width:33%">
                            @can('edit.users')
                            <a href="{{route('admin.users.edit', $org->id)}}"><button type="button" class="btn btn-primary ">Edit</button></a>
                            @endcan
                            <!--@can('delete.users')
                            <a href="{{route('admin.users.edit', $org->id)}}"><button type="button" class="btn btn-warning ">Delete</button></a>
                            @endcan-->
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
