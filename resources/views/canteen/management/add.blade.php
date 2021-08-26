<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
  </script>

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Menu</div>

                <div class="card-body">
                    <form action="{{route('canteen.Canteen.store')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="name" class="form-control" name="name" value="" required autofocus>
                        </div>
                    </div>
                    <input type="hidden" id="add" name="add" value="add">
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Price</label>
                        <div class="col-md-6">
                            <input id="price" type="text" class="form-control" name="price" value="" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Description</label>
                        <div class="col-md-6">
                            <input id="desc" type="text" class="form-control" name="desc" value="" required autofocus>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Type</label>
                        <div class="col-md-6">
                            <select name="pricerange" id="pricerange" style="width:100%" >
                            @foreach($pricerange as $pricerange)
                                <option value="{{$pricerange->PRICEID}}">{{$pricerange->NAMA}}</option>
                            @endforeach
						</select>
                        </div>
                    </div>



                    <div class="form-group row">
                    <label for="file" class="col-md-3 col-form-label text-md-right">Picture</label>
                        <div class="col-md-6">
                            <input type="file" name="file" required onchange="loadFile(event)">
                        </div>
                    </div>

                    <center>
                        <img id="output" />
                    </center>
                    

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