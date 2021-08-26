<!DOCTYPE html>
<html lang="en">
<head>
<title>CFOS</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

/* Style the header */
.header {
  padding: 80px;
  text-align: center;
  /*background: #1abc9c;*/
  background-image: url('/assets/product/canteen.jpg');
  background-repeat: no-repeat;
  max-width: 100%;
  height: auto;
  color: #b9e567;
}

/* Increase the font size of the h1 element */
.header h1 {
  font-size: 40px;
}

/* Style the top navigation bar */
.navbar {
  overflow: hidden;
  background-color: #333;
}

/* Style the navigation bar links */
.navbar a {
  float: left;
  display: block;
  color: white;
  text-align: center;
  padding: 14px 20px;
  text-decoration: none;
}

/* Right-aligned link */
.navbar a.right {
  float: right;
}

/* Change color on hover */
.navbar a:hover {
  background-color: #ddd;
  color: black;
}

/* Column container */
.row {  
  display: flex;
  flex-wrap: wrap;
}

.column1 {
  float: left;
  width: 33.33%;
  padding: 5px;
}

/* Clear floats after image containers */
.row1::after {
  content: "";
  clear: both;
  display: table;
}

/* Create two unequal columns that sits next to each other */
/* Sidebar/left column */
.side {
  flex: 30%;
  background-color: #f1f1f1;
  padding: 20px;
}

/* Main column */
.main {   
  flex: 70%;
  background-color: white;
  padding: 20px;
}

/* Fake image, just for this example */
.fakeimg {
  background-color: #aaa;
  width: 100%;
  padding: 20px;
}

/* Footer */
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
}

/* Responsive layout - when the screen is less than 700px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 700px) {
  .row {   
    flex-direction: column;
  }
}

/* Responsive layout - when the screen is less than 400px wide, make the navigation links stack on top of each other instead of next to each other */
@media screen and (max-width: 400px) {
  .navbar a {
    float: none;
    width:100%;
  }
}
</style>
</head>
<body>

<div class="header">
  <h1>Canteen Food Ordering System</h1>
  <p>CFOS</p>
</div>

<div class="navbar">
    @if (Route::has('login'))
        <div class="top-right links">
        @auth
        <a href="{{ url('/home') }}" class="right">Home</a>
    @else
        <a href="{{ route('login') }}" class="right">Login</a>
    @if (Route::has('register'))
        <a href="{{ route('register') }}" class="right">Register</a>
    @endif
    @endauth
    </div>
     @endif
</div>

<div class="row">
  <div class="main">
  <center>
    <h1>Your children's favourite lunch delivered hot and fresh to their class</h1>
    <h5>Great news! Now you can order your children's lunch using CFOS</h5>
    <br>
    <h1>Why order CFOS?</h1>
    
    <div class="row1">
        <div class="column1">
            <img src="/assets/product/lunch.jpg" style="width:100%">
            <p>No more skipping lunch.</p>
        </div>
    <div class="column1">
            <img src="/assets/product/contact.jpg"  style="width:67%">
            <p>Reduce the number of cases at school</p>
    </div>
    <div class="column1">
            <img src="/assets/product/expense.jpg"  style="width:100%">
            <p>Keep track of expenses at school</p>
    </div>
    </div>
  </div>
</center>
</div>

<div class="footer">
  <h2>CFOS</h2>
    <img src="/assets/product/CFOS.png" style="width: 100%; max-width: 100px" />
</div>

</body>
</html>
