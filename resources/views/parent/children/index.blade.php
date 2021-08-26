@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Children</div>

                <div class="card-body">
                <form action="{{route('parent.Childrens.store')}}" method="POST">

                <div class="box1">
                    <table style="width:100%">
                        <tr>
                            <th style="text-align:center; width:34%">Name</th>
                            <th style="text-align:center; width:34%">Class Name</th>
                            <th style="text-align:center; width:34%">Actions</th>
                        </tr>
                        @foreach($student as $student)
                        <tr>
                            <td style="text-align:center;">{{$student->Name}}</td>
                            <td style="text-align:center;">{{$student->CName}}</td>
                            @csrf
                            <td style="text-align:center;"> <input type="checkbox" name="student[]" value="{{$student->id}}"> </td>
                        </tr>
                        @endforeach
                    
                    </table>
                </div>
                <div class="box2">
                    <label for="orderdate"><strong>Order Date:</strong></label>
                    <input id="datefield" name = "datefield" type='date' min='1899-01-01' ></input>
                </div>

                    <br>
                    <div style="float:right">
                        <button type="submit" class="btn btn-primary">
                            START ORDER
                        </button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>

.box1 {
    display: block;
    padding: 10px;
    margin-bottom: 100px; /* SIMPLY SET THIS PROPERTY AS MUCH AS YOU WANT. This changes the space below box1 */
    text-align: justify;
}

.box2 {
    display: block;
    padding: 10px;
    text-align: justify;
    margin-top: 100px; /* OR ADD THIS LINE AND SET YOUR PROPER SPACE as the space above box2 */
    text-align: center;
}

</style>

<script>
    window.onload = function(){
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd
        } 
        if(mm<10){
            mm='0'+mm
        } 

        today = yyyy+'-'+mm+'-'+dd;
        document.getElementById('datefield').setAttribute("min", today);
    }
</script>