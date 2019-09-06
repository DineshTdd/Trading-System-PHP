<?php
session_start();
if(!isset($_SESSION['sess_user'])){
    header("location:index.php");
} else {
  echo "<h1>WELCOME TO TRADING SYSTEM <?h1>";
  echo "<h2> Your E-mail: ".$_SESSION["sess_user"]."</h2>";
?>
<!Doctype>
<html>
<head>
<style>
body {
	text-align:center;font-family:courier;color:Black;background-image: url("bg.jpg");
	height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
</style>
</head>
<body>
</body>
</html>
<?php
}
?>
