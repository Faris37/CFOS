@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Organization</div>

                <div class="card-body">
                    
                    <form action="{{route('admin.users.OaddData')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="name" class="form-control" name="name" value="" required autofocus>
                        </div>
                    </div>
                    <input type="hidden" id="add" name="add" value="add">
                    
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Address</label>
                        <div class="col-md-6">
                            <input id="address" type="text" class="form-control" name="address" value="" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Telephone No.</label>
                        <div class="col-md-6">
                            <input id="phone" type="text" class="form-control" name="phone" value="" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">State</label>
                        <div class="col-md-6">
                            <select name="state" id="state" style="width:100%" >
                                <option value="PERLIS">PERLIS</option>
                                <option value="KEDAH">KEDAH</option>
                                <option value="PULAU PINANG">PULAU PINANG</option>
                                <option value="PERAK">PERAK</option>
                                <option value="SELANGOR">SELANGOR</option>
                                <option value="NEGERI SEMBILAN">NEGERI SEMBILAN</option>
                                <option value="MELAKA">MELAKA</option>
                                <option value="JOHOR">JOHOR</option>
                                <option value="PAHANG">PAHANG</option>
                                <option value="TERENGGANU">TERENGGANU</option>
                                <option value="KELANTAN">KELANTAN</option>
                                <option value="SABAH">SABAH</option>
                                <option value="SARAWAK">SARAWAK</option>
						</select>
                        </div>
                    </div>

                    <div style="float: right">
                        <button type="submit" class="btn btn-primary">
                            Create
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
 function showDiv(select){
   if(select.value==6){
    document.getElementById('hidden_div').style.display = "flex";
   } else{
    document.getElementById('hidden_div').style.display = "none";
   }
} 
</script>