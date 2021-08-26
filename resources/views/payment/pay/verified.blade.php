<!DOCTYPE html>
<html>
  
<head>
      
    <!-- Style to set text-element
        to center -->
    <style>
    .topnav {
        background-color: #A7A9AC;
        overflow: hidden;
}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #333;
  color: white;
}

        .center {
            text-align-last: left;
            border: 2px solid black;
            font-family: "Helvetica Neue" , Arial, sans-serif;
            background-color: #AF0A3D;
            
        }
    </style>
</head>
  
<body>

<div class="topnav">
  <a  href="#home"></a>
</div>

    <div class="navbar-inner hidden-print">
        <a class="brand span3" href="http://www.bankislam.com.my/home/">
            <img src="/logo/logo-bank-islam.png">
        </a>
    </div>

<form action="{{route('pay.Payment.store')}}" method="POST">
@csrf
    <div class="center">
    <div class="saje" style="margin-left: 30px; margin-top: 50px;">
    <div class="widget-header" style="color:#ffffff">
            <h3>Welcome to Bank Islam <br> Internet Banking</h3>
        </div>
        <div class="navbar-inner hidden-print">
        <a class="brand span3">
            <img src="/logo/iconm.png" style="width:200px;height:200px;">
        </a>
    </div>
    <br>
    <div style="color:#ffffff">
    <p>Private Word :&nbsp;<strong>Banking</strong></p>
    <p class="message">If this is not the chosen Private Image and Private Word, do not login. Please call Bank Islam Contact Center at 603-26 900 900</p>
    <p class="message">
        <input type="hidden" name="_null"><input type="checkbox" name="null" id="authImgWordAck">
        I acknowledge this is my Private Image and Private Word.</p>
    <label class="control-label" for="username">User ID</label><br>
    <div style="color:#ffe48e;">
    {{$user}}
    </div>

    <br>
        <div class="control-group" id="div_username" style="display:none">
            <label class="control-label" for="password">Password</label><br>
            <input type="password" id="password" name="password" value="" class="login username-field" maxlength="18">
            <input type="hidden" id="add" name="add" value="verified">
            <input type="hidden" id="test" name="test" value="{{$test}}">
        </div>
    </div>
        <br>
        <div class="control-group">
            <button type="back" class="btn btn-primary">
                cancel
            </button>
        </div>
        <br>
        <div id="button_die" style="display:none; Float:left">
            <button type="submit" class="btn btn-primary">
                Pay
            </button>
        </div>
        <div class="control-group" style="float:right; margin-right: 50px">
            <input type="submit" name="cancel" value="Cancel Transaction" class="button btn btn-login" style="#808285">
        </div>
        <br>
        <br>
        <div class="row-fluid" style="background: #BF4B66; padding: 5px 15px; width: 90%;">
                <span style="font-size: 13px; font-weight: bold; color:#ffffff">I have a problem logging in</span><br>
                <ul style="font-size: 11px; padding-left: 15px;">
                    <p style="color:#ffffff">&gt; Forgot User ID / Password</p>
                </ul>
            </div>
        <br>
    </div>
    </div>
</form>
</body>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>

$(document).ready(function(){
$('#authImgWordAck').change(function(){
if(this.checked)
{
$('#div_username').show();
$('#button_die').show();
}
else
{
$('#div_username').hide() ;
$('#button_die').hide() ;
}

});
});

</script>
  
</html>         