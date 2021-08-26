@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Menu Price Range</div>

                <div class="card-body">
                    
                    <form action="{{route('Admin.SchAdm.editDatapriceMenu')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="name" class="form-control" name="name" value="" required autofocus>
                        </div>
                    </div>

                    <input type="hidden" id="add" name="add" value="add">
                    
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Minimum Price</label>
                        <div class="col-md-6">
                            <input id="Min" type="text" class="form-control" name="Min" value="" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Maximum Price</label>
                        <div class="col-md-6">
                            <input id="Max" type="text" class="form-control" name="Max" value="" required autofocus>
                        </div>
                    </div>

                    <div style="float: right">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

