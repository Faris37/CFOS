<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Demo in Laravel 7</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    @if(Session::has('download.in.the.next.request'))
         <meta http-equiv="refresh" content="5;url={{ Session::get('download.in.the.next.request') }}">
      @endif
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr class="table-danger">
        <td>Menu</td>
        <td>Quantity</td>
        <td>Student</td>
      </tr>
      </thead>
      <tbody>
        @foreach ($order as $order)
        <tr>
            <td>{{ $order->Menu }}</td>
            <td>{{ $order->Quantity }}</td>
            <td>{{ $order->Student }}</td>
            
        </tr>
        @endforeach
      </tbody>
    </table>
  </body>
</html>