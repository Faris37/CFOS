@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu <a href="{{route('canteen.Canteen.create')}}"><button style="float: right;" class="btn btn-primary">Add New Menu</button></a></div>

                    <div class="search-container">
                    <form action="{{route('canteen.Canteen.search')}}" method="POST">
                            @csrf
                            <input type="text" value="" name="search" id="search" style="width:95%">
                            <input type="hidden" name="searching" id="searching" value="searching">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
        
                <div class="card-body">
                <center>
                <table>
                    <tr style="padding: 15px;">
                        <th style="padding: 15px; text-align:center;">Name</th>
                        <th style="padding: 15px; text-align:center;">Price</th>
                        <th style="padding: 15px; text-align:center;" >Actions</th>
                    </tr>
                    @foreach($menu as $menu)
                    <tr style="padding: 15px;">
                        <td style="padding: 15px;">{{$menu->Name}}</td>
                        <td style="padding: 15px;"> RM {{$menu->Price}}</td>
                        <td style="padding: 15px;">
                            <a href="{{route('canteen.Canteen.edit', $menu->id)}}"><button type="button" class="btn btn-primary float-left">Edit</button></a>
                            <form action="{{ route('canteen.Canteen.destroy', $menu->id) }}" method="POST" class="float-left">
                                @csrf
                                {{ method_field('DELETE') }}
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


