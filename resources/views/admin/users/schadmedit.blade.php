@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit User</div>

                <div class="card-body">
                    @foreach($users as $users)
                    <form action="{{route('Admin.SchAdm.updateDataUser')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="name" class="form-control" name="name" value="{{ $users->name }}" required autofocus>
                        </div>
                    </div>
                    <input type="hidden" id="add" name="add" value="edit">
                    <input type="hidden" id="id" name="id" value="{{$users->id}}">
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="text" class="form-control" name="email" value="{{ $users->email }}" required autofocus>
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

<script>
  var loadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
      output.width = 259;
      output.height = 194;
    };
    reader.readAsDataURL(event.target.files[0]);
  };
</script>