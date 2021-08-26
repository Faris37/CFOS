@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            @foreach($class as $class)
                <div class="card-header"><strong>Class {{$class->CName}}</strong></div>
            @endforeach
                    <div id="pdf" >
                        <div class="card-body">
                            <center>
                            <table>
                                <tr style="padding: 15px;">
                                    <th style="padding: 15px;">Menu Name</th>
                                    <th style="padding: 15px;">Quantity</th>
                                    <th style="padding: 15px;">Student</th>
                                </tr>
                                @foreach($order as $order)
                                <tr style="padding: 15px;">
                                    <td style="padding: 15px;">{{$order->Menu}}</td>
                                    <td style="padding: 15px; text-align:center; ">{{$order->Quantity}}</td>
                                    <td style="padding: 15px; text-align:center; ">{{$order->Student}}</td>
                                </tr>
                                @endforeach
                            </table>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
