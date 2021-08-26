@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users <a href="{{route('admin.users.add')}}"><button style="float: right;" class="btn btn-primary">Add New User</button></a> </div>

                <div class="card-body">
                    <center>
                <table>
                    <tr>
                        <th style="padding: 15px; text-align:center; width:33%">Name</th>
                        <th style="padding: 15px; text-align:center; width:33%" >Role</th>
                        <th style="padding: 15px; text-align:center; width:33%">Actions</th>
                    </tr>
                    @foreach($users as $users)
                    <tr>
                        <td style=" text-align:center;width:33%">{{$users->name}}</td>
                        <td style=" text-align:center;width:33%">{{ strtoupper(implode(', ', $users->roles()->get()->pluck('name')->toArray())) }}</td>
                        <td style=" text-align:center;width:33%">
                            @can('edit.users')
                            <a href="{{route('admin.users.edit', $users->id)}}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                            @endcan
                            @can('delete.users')
                            <form action="{{ route('admin.users.destroy', $users) }}" method="POST" class="float-left">
                                @csrf
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-warning">Delete</button>
                            </form>
                            @endcan
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
