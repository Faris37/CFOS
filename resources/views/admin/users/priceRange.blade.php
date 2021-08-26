@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu Price Range <a href="{{route('Admin.SchAdm.addpriceMenu')}}"><button style="float: right;" class="btn btn-primary">Add New Menu Price Range</button></a></div>
                
                <div class="card-body">

                <div class="search-container">
                    <form action="{{route('Admin.SchAdm.searchpriceMenu')}}" method="POST">
                            @csrf
                            <input type="text" value="" name="search" id="search" style="width:93%">
                            <input type="hidden" name="searching" id="searching" value="searching">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <center>
                <table style="width:100%">
                    <tr>
                        <th style="padding: 15px; text-align:center; width:25%">Name</th>
                        <th style="padding: 15px; text-align:center; width:25%">Min</th>
                        <th style="padding: 15px; text-align:center; width:25%">Max</th>
                        <th style="padding: 15px; text-align:center; width:25%">Actions</th>
                    </tr>
                    @foreach($menu as $menu)
                    <tr>
                        <td style=" text-align:center;width:25%">{{$menu->Name}}</td>
                        <td style=" text-align:center;width:25%">{{$menu->Min}}</td>
                        <td style=" text-align:center;width:25%">{{$menu->Max}}</td>
                        <td style=" text-align:center; width:25%">
                            <a href="{{ route('Admin.SchAdm.editpriceMenu' , $menu->id) }}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                            <a href="{{ route('Admin.SchAdm.deleteBanned' , $menu->id) }}"><button type="button" class="btn btn-warning" onclick="return confirm('Sure Want Delete?')">Delete</button></a>
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
