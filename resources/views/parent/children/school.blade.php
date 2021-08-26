@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">School</div>
                <div class="card-body">
                <table>
                    <tr>
                        <th style="padding: 5px; text-align:center;">School Name</th>
                        <th style="width:40%"></th>
                        <th style="padding: 5px; text-align:center; ">Actions</th>
                    </tr>
                    @foreach($school as $school)
                    <tr>
                        <td style="padding: 5px;">{{$school->SName}}</td>
                        <td></td>
                        <td style=" text-align:right;">
                            <a href="{{route('parent.Childrens.show', $school->id)}}"><button type="button" class="btn btn-primary float-left">Select</button></a>
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
