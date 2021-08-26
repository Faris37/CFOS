@extends('layouts.app')

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  margin: 0;
  font-family: Verdana,sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  float:right;
  background-color: #fff;;
  position: fixed;
  height: 100%;
  overflow: auto;
}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}

.sidebar a:hover {
    color: black;
    background-color: #e9ecef;
}

.sidebar a.active {
  background-color: #04AA6D;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
  color: white;
}

div.content {
  margin-right: 200px;
  padding: 1px 16px;
  height: 1000px;
}

@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: right;}
  div.content {margin-right: 0;}
}

@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}


</style>
</head>
<body>

@section('content')
<div class="content">

<input type="hidden" id="date3" name="date3" value="{{$date3}}">

<section class="ftco-section">
    	<div class="container">
    		<div class="row justify-content-center">
    		</div>
	<div class="row">
                @if(isset($menu))
				
                    @foreach($menu as $menu)
					
    			<div class="col-md-6 col-lg-3 ftco-animate">
                    
    				<div class="product">
    					<a href="#" class="img-prod"><img class="img-fluid" src="/assets/product/{{$menu->file_path}}" alt="Colorlib Template">
    						
    					</a>
    					<div class="text py-3 pb-4 px-3 text-center">
    						<h3><a href="#">{{$menu->Name}}</a></h3>
                            
    						<div class="text text-center">
    							<div class="pricing">
		    						<p class="price "><span class="price-sale">RM. {{$menu->Price}}</span></p>
		    					</div>
	    					</div>
	    					<div class="bottom-area d-flex px-2">
	    						<div class="m-auto d-flex">
	    							<a href="{{route('parent.Childrens.editing',[$menu->id,$date3])}}" class="heart d-flex justify-content-center align-items-center  mx-1">
	    								<span><button type="button" class="btn btn-primary">Add To Cart</button></span>
	    							</a>
    							</div>
    						</div>
    					</div>
    				</div>
                <!--{{route('parent.Childrens.edit' , $menu->id ) }} parent/Childrens/editing/{{$menu->id}}/{{$date3}}-->      
    			</div>
                @endforeach
                      @endif 
    		</div>
        
    	</div>
    </section>
</div>



@endsection

</body>