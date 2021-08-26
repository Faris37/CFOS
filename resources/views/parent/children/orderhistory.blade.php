@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order History</div>

                <div class="card-body">
                <table>
                    <tr style="padding: 15px;">
                        <th style="padding: 15px;">Order Date</th>
                        <th style="padding: 15px;">Order Cost</th>
                        <th style="padding: 15px;">Order From</th>
                        <th style="padding: 15px;">Actions</th>
                    </tr>
                    @foreach($order as $order)
                    <tr style="padding: 15px;">
                        <td style="padding: 15px;">{{date( "d-m-Y" , strtotime($order->Date))}}</td>
                        <td style="padding: 15px;">RM {{number_format($order->count,2)}}</td>
                        <td style="padding: 15px;">{{$order->SNAME}}</td>
                        <td style="padding: 15px;">
                            <a href="{{route('menu.Menu.edit', $order->ID)}}"><button type="button" class="btn btn-primary float-left">View</button></a>
                        </td>
                    </tr>
                    @endforeach 
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
