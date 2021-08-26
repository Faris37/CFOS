@extends('layouts.app')

@section('content')
@foreach($menuDetails as $menuDetails)
<center>
<form action="{{route('corder.COrder.store')}}" method="POST">
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
	    		<div class="bottom-area d-flex px-2">
	    			<div class="m-auto d-flex">
                        <label for="quantity">Quantity : </label>
                        <input type="number" id="quantity" name="quantity" min="0" max="5">
                        <input type="hidden" id="id" name="id" value="{{$menuDetails->id}}">
                        <input type="hidden" id="oid" name="oid" value="{{$menuDetails->organization_id}}">
						<input type="hidden" id="orderid" name="orderid" value="{{$menuDetails->order}}">
    				</div>
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