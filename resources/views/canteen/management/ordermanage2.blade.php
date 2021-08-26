@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @foreach($class as $class)
                <div class="card-header">Class {{$class->CName}} <a href="{{route('manageorder.Manageorder.edit' , $class->id)}}"><button  style="float: right; margin:5px;" class="btn btn-primary">Notified</button></a> <a href="{{route('canteen.Canteen.show' , $class->id)}}"><button style="float: right; margin:5px;" class="btn btn-primary">Save as PDF</button></a></div>
            @endforeach
            <div id="pdf">
                <div class="card-body">
                <table>
                    <tr style="padding: 15px;">
                        <th style="padding: 15px;">Menu Name</th>
                        <th style="padding: 15px;">Quantity</th>
                        
                    </tr>
                    @foreach($order as $order)
                    <tr style="padding: 15px;">
                        <td style="padding: 15px;">{{$order->MNAME}}</td>
                        <td style="padding: 15px; text-align:center; ">{{$order->count}}</td>
                    </tr>
                    @endforeach
                </table>

                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
