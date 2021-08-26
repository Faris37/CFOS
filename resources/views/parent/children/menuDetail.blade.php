@extends('layouts.app')

@section('content')
@foreach($menuDetails as $menuDetails)
<center>
<form action="{{route('menu.Menu.store')}}" method="POST">
@csrf

<div class="col-md-6 col-lg-3 ftco-animate">
    <div class="product">
    	<a href="#" class="img-prod"><img class="img-fluid" src="/assets/product/{{$menuDetails->file_path}}" alt="Colorlib Template">
    	</a>
    	<div class="text py-3 pb-4 px-3 text-center">
    		<h3>{{$menuDetails->Name}}</h3>
            <h4>{{$menuDetails->Description}}</h4>
                <div class="text text-center">
    				<div class="pricing">
		    			<p class="price "><span class="price-sale">RM. {{$menuDetails->Price}}</span></p>
		    		</div>
	    		</div>
				<div class="text text-center">
				
				<table>
				<tr>
					<td>
						<label for="Order">Order For : </label>
					</td>
					<td>
						<select name="stu" id="stu" style="width:100%">
  							<option value="0">All</option>
								@foreach($stuName as $stuName)
  									<option value="{{$stuName->id}}">{{$stuName->Name}}</option>
								@endforeach
						</select>
					</td>
				</tr>

					<tr>
						<td>
							<label for="Remarks">Remarks : </label>
						</td>
						<td>
							<input type="text" id="remarks" name="remarks" style="width:100%">
						</td>
					</tr>

					<tr>
	    				<td>
                        	<label for="quantity">Quantity : </label>
						</td>
						<td>
                        	<input type="number" id="quantity" name="quantity" min="1" max="5" style="width:100%">
						</td>
						<td>
                        	<input type="hidden" id="date3" name="date3" value="{{$date}}" >
						</td>
						<td>
                        	<input type="hidden" id="id" name="id" value="{{$menuDetails->id}}">
						</td>
						<td>
                        	<input type="hidden" id="oid" name="oid" value="{{$menuDetails->organization_id}}">
						</td>
    				
					</tr>
				</table>
    			</div>
                <br>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
    		</div>
    	</div>
    </div>
</div>
</form>
</center>
@endforeach
@endsection