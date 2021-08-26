@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add User</div>

                <div class="card-body">
                    
                    <form action="{{route('admin.users.UserData')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Name</label>
                        <div class="col-md-6">
                            <input id="name" type="name" class="form-control" name="name" value="" required autofocus>
                        </div>
                    </div>
                    <input type="hidden" id="add" name="add" value="add">
                    
                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Email</label>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Password</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" value="" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Role</label>
                        <div class="col-md-6">
                            <select name="role" id="role" style="width:100%" >
                            @foreach($role as $role)
                                <option value="{{$role->id}}">{{strtoupper($role->name)}}</option>
                            @endforeach
						</select>
                        </div>
                    </div>

                    <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-right">Organization</label>
                        <div class="col-md-6">
                            <select name="org" id="org" style="width:100%" >
                            @foreach($org as $org)
                                <option value="{{$org->id}}">{{$org->SName}}</option>
                            @endforeach
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