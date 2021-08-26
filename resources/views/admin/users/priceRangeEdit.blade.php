@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Menu Price Range</div>

                <div class="card-body">
                    @foreach($menu as $menu)
                    <form action="{{route('Admin.SchAdm.editDatapriceMenu')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="name" class="form-control" name="name" value="{{ $menu->Name }}" required autofocus>
                        </div>
                    </div>

                    <input type="hidden" id="add" name="add" value="edit">
                    <input type="hidden" id="id" name="id" value="{{$menu->id}}">

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Minimum Price</label>
                        <div class="col-md-6">
                            <input id="Min" type="text" class="form-control" name="Min" value="{{ $menu->Min }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Maximum Price</label>
                        <div class="col-md-6">
                            <input id="Max" type="text" class="form-control" name="Max" value="{{ $menu->Max }}" required autofocus>
                        </div>
                    </div>

                    <div style="float: right">
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

