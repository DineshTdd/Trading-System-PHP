<?php
session_start();
if(!isset($_SESSION["sess_user"])){
    header("location:index.php");
} else {

?>
<!doctype html>
<html>
<head>
<style>
.top{
 padding:100px;
}
body {
	text-align:center;font-family:courier;color:Black;background-image: url("assets/bg.jpg");
	height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.i {
  border-style: solid;
  border-color: coral;
}
</style>
<title>
Available Items
</title>
</head>

<body >
<header>
<h1>AVAILABLE ITEMS</h1>
</header>
<h3 style="padding-left: 460px;float:left;display:inline-block;">Dolls</h3> <h3 style="padding-right:250px;display:inline-block;">Perfumes</h3>
<div class="top">
<form action>
<a href="dolls.php">
<img src="assets/dolls.jpg" class="i" width="200" height="200" border="3">
</a>
<a href="perf.php">
<img src="assets/perf.jpg"  class ="i" width="200" height="200" border="3">
</a>
</form>
</div>
</body>
</html>
<?php
}
?>
