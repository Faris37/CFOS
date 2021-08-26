@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Class</div>

                <div class="card-body">
                <table>
                    <tr style="padding: 15px;">
                        <th style="padding: 15px;">Class</th>
                        <th style="padding: 15px;">Actions</th>
                    </tr>
                    @foreach($class as $class)
                    <tr style="padding: 15px;">
                        <td style="padding: 15px;">{{$class->CName}}</td>
                        <td style="padding: 15px;">
                            <a href="{{route('manageorder.Manageorder.show', $class->id)}}"><button type="button" class="btn btn-primary float-left">Details</button></a>
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
