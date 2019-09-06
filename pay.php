<?php
session_start();
if(!isset($_SESSION['sess_user'])){
    header("location:index.php");
} else {

global $con;
$gtot=$_GET['gtot'];
$con=mysqli_connect("127.0.0.1", "root","", "FTS");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if(isset($_POST["submit1"]))
{
  $pin1=0;
	$accno=$_POST['accno'];
	$pin=$_POST['pin'];
	$query="select * from bank where accno='".$accno."'";
	$result=mysqli_query($con,$query);
	while($row = mysqli_fetch_assoc($result))
    {
    $pin1=$row['pin'];
	$balance=intval($row['balance']);
    }
	if($pin1==$pin)
	{
	if($balance!=0 && $balance>$gtot)
	{
	$balance=$balance-$gtot;
	//echo $balance;
	$query="update bank set balance='".$balance."' where accno='".$accno."'";
	if($result=mysqli_query($con,$query))
	{
    $sql="UPDATE dolls SET qty=0";
    $res=mysqli_query($con, $sql);
    $sql="UPDATE perfumes SET qty=0";
    $res=mysqli_query($con, $sql);
    echo'<script>
    window.alert("Payment Successful!");
    document.write("Wait while page is redirecting..");
    setTimeout(function() {
      window.location.href = "items.php";
    }, 3000);
    </script>';
	}
	else{echo '<script>window.alert("Transaction Failed!");</script>';}
	}
	else{echo '<script>window.alert("Balance Insufficient!");</script>';}
	}
	else{echo '<script>window.alert("Invalid pin or Account Number!");</script>';}
    }

?>
<!Doctype>
<html>
<head>
  <script>
  window.onbeforeunload = function() {
        return "Dude, are you sure you want to refresh? Think of the kittens!";
}
  </script>
  <style>
  body {
	color: white;
	text-align:center;
	font-family: 'Source Sans Pro', sans-serif;
	background-image: url("https://www.wallpaperflare.com/static/10/985/276/pattern-vector-dark-background-white-wallpaper.jpg");
	height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
button{
    background-color: black;
    color: white;
    padding: 15px 20px;
    border: solid;
	border-color: dodgerblue;
    cursor: pointer;
    width: 200px ;
    opacity: 0.9;
	display: inline-block;

}
  </style>
</head>
<body>
	<center><h1>PAYMENT</h1></center>
	<br>
	<br>
	<form action="" method="post">
	<label style="margin-left: 50px;font-size: 20px">Enter Account no.:</label>
	<input type="text" name="accno" style="margin-left:4em;height:25px;width:305px;"required ><br><br>
	<label style="margin-left: 50px;font-size: 20px">Enter pin:</label>
	<input type="text" name="pin" style="margin-left:10em;height:25px;width:305px;"required ><br><br>
	<?php

	echo '<h1 style="margin-left:15em;height:25px;width:305px;text-shadow: 4px 4px 8px black;">Total Amount:   '.$gtot.'<h1>';
	?>
	<button style="margin-left:60px;" type="submit" name="submit1">Confirm Pay</button>
	</form>
  <script type="text/javascript">
        <!--
           function getConfirmation(){
              var retVal = confirm("Do you want to cancel payment ?");
              if( retVal == true ){
                document.write("Wait while page is redirecting..");
                setTimeout(function() {
                  window.location.href = "items.php";
                }, 3000);
                 return true;
              }
              else{

                 return false;
              }
           }
        //-->
     </script>
	<button type="button" name="Back" onclick="getConfirmation();">Back</button>
<!--onclick="location.href='items.php' -->
</body>
</html>
<?php
}
?>
