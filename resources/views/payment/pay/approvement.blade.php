
<head>
<style>
td {
  padding: 9px;
}
</style>
</head>
<body>
       
<center> 
<img src="/logo/logo-bank-islam.png" alt="Bank Islam Internet Banking" style="height: 75px;">
    <div class="widget-header">
        <i class="icon-lock"></i>
        <h3>You are in a secure site</h3>
    </div> <!-- /widget-header -->
    <p class="text-right hidden-print">
    as at
    <p id="time" name="time" ></p></p>
        

<table>
<tr>
    <td>
    <strong>
        From Account*
    </strong>
    </td>
</tr>
<tr>
    <td>
        
        Savings Account - 01234567890 MYR 400.00
        
    </td>
</tr>
<tr>
    <td>
    <strong>
        Seller
    </strong>
    </td>
</tr>
<tr>
    @foreach ($org as $org)
    <td>
        {{$org->SName}}
    </td>
    @endforeach
</tr>
<tr>
    <td>
    <strong>
        FPX Transaction ID
    </strong>
    </td>
</tr>
<tr>
    <td>
        2106060142280775
    </td>
</tr>
<tr>
    <td>
    <strong>
        Amount
    </strong>
    </td>
</tr>
<tr>
    <td>
        MYR {{number_format($price ,2)}}
    </td>
</tr>
<tr>
    <td>
    <strong>
        i-Access Code
    </strong>
    </td>
</tr>
<tr>
    <td>
        <input class="input-small" type="password" id="tac" name="tac" value="" maxlength="6" autocomplete="off" onkeyup="s()"></input>
        <br>
        <p onclick="myFunction()">Request i-Access Code</p>
    </td>
</tr>
<tr>
    <td>
        <a href="{{route('pay.Payment.show', $pid) }}"><button id="abc2" disabled onclick="myFunc()">Pay</button></a>
    </td>
</tr>
</table>
</center>
           
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script> 
<script>
var today = new Date();
var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
var dateTime = date+' '+time+' MYT';

document.getElementById("time").innerHTML = dateTime;

function myFunction() {
  
  var x = Math.floor((Math.random() * 1000000) + 100000);
  alert(x);
  
}

function s(){
var i=document.getElementById("tac");
if(i.value=="")
    {
    document.getElementById("abc2").disabled=true;
    }
else
    document.getElementById("abc2").disabled=false;}

function myFunc() {
  alert("Payment Success");
}
</script>