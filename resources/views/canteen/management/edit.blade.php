@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Menu</div>

                <div class="card-body">
                    @foreach($menu as $menu)
                    <form action="{{route('canteen.Canteen.store')}}" method="POST" enctype="multipart/form-data">

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
                    <label for="name" class="col-md-3 col-form-label text-md-right">Price</label>
                        <div class="col-md-6">
                            <input id="price" type="text" class="form-control" name="price" value="{{ $menu->Price }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Description</label>
                        <div class="col-md-6">
                            <input id="desc" type="text" class="form-control" name="desc" value="{{ $menu->Description }}" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Picture</label>
                        <div class="col-md-6">
                            <input type="file" name="file" onchange="loadFile(event)">
                        </div>
                    </div>

                    <center>
                        <img id="output" src="/assets/product/{{$menu->file_path}}" style=" width: 259px ; height: 194px"/>
                    </center>

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