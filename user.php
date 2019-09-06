<?php
session_start();
if(!isset($_SESSION['sess_user'])){
    header("location:index.php");
} else {
?>
<!doctype html>
<html>
<head>
<style>
body{
	background:url('assets/trade.jpg') no-repeat;
	background-size:cover;
	font-family:Arial;
	color:white;
}
ul{
margin:0px;
paddding:0px;
list-style:none;
}
ul li{
float:left;
width:320px;
height:40px;
background-color:black;
opacity:0.5;
line-height:40px;
text-align:center;
font-size:20px;
}
ul li a{
text-decoration:none;
color:white;
display:block;
}
ul li a:hover{
	background-color:blue;
}
iframe{
	width:1270px;
	height:500px;
	margin: 25px 25px 25px 25px;

	}
</style>
<title>
 User
</title>
</head>

<body>
<?php
$_SESSION['sess']=$_SESSION['sess_user'];
?>
	  <ul>
		<li><a href =" http://localhost/scripts/td/youracc.php" target="page">Your Account</a></li>
		<li><a href = "http://localhost/scripts/td/items.php" target = "page">Import</a></li>
		<li><a>Export</a></li>
		<li><a>Your Orders</a></li>
	  </ul>
      <iframe name = "page" />
</body>
</html>
<?php
}
?>
