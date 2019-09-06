<?php
session_start();
if(!isset($_SESSION['sess_user'])){
    header("location:index.php");
} else {

global $con,$result,$row,$rowcount;
$con=mysqli_connect("127.0.0.1", "root","", "FTS");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
if(isset($_POST['itemdoll']))
{
  $val=$_POST['itemdoll'];
  $keyword = preg_split("/[.]+/", $val);
  $sql1="SELECT avail FROM dolls WHERE id='$keyword[1]'";
  $resu=mysqli_query($con, $sql1);
  $row = mysqli_fetch_array($resu);
  $qty1=$row['avail'];
  $qty1=$qty1+$keyword[0];
  $sql="UPDATE dolls SET qty=0,avail='$qty1' WHERE id='$keyword[1]'";
  $res=mysqli_query($con, $sql);
}
if(isset($_POST['itemperf']))
{
  $val=$_POST['itemperf'];
  $keyword = preg_split("/[.]+/", $val);
  $sql1="SELECT avail FROM perfumes WHERE id='$keyword[1]'";
  $resu=mysqli_query($con, $sql1);
  $row = mysqli_fetch_array($resu);
  $qty1=$row['avail'];
  $qty1=$qty1+$keyword[0];
  $sql="UPDATE perfumes SET qty=0,avail='$qty1' WHERE id='$keyword[1]'";
  $res=mysqli_query($con, $sql);
}
?>
<!DOCTYPE HTML>
<html>
<head>
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

table {
	color: black;
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;

}

td, th {
    border: 2px solid #000000;
    text-align: left;
    padding: 8px;
	background-color: #dddddd;
}
a{
  background-color: dodgerblue;
  color: white;
  padding: 15px 20px;
  border: solid;
border-color:black;
  cursor: pointer;
  width: 200px ;
  opacity: 0.9;
display: inline-block;
}
button{
    background-color: dodgerblue;
    color: white;
    padding: 15px 20px;
    border: solid;
	border-color:black;
    cursor: pointer;
    width: 200px ;
    opacity: 0.9;
	display: inline-block;

}
button:hover {
  opacity: 1;
}

#buttons :first-child {
    float: none;
}
#buttons :nth-child(2) {
    float: none
}
#buttons {
    text-align: center;
}

</style>
</head>
<body>
  <form action="" method="post">
<?php
$gtot=0;
$query="SELECT id,name,price,qty FROM dolls where qty!=0";
$result = mysqli_query($con, $query);
$query1="SELECT id,name,price,qty FROM perfumes where qty!=0";
$result1= mysqli_query($con, $query1);
while($row1 = mysqli_fetch_array($result)){
$qty=$row1['qty'];
$price=$row1['price'];
$tot=$qty*$price;
$gtot+=$tot;
}
while($row1 = mysqli_fetch_array($result1)){
  $qty=$row1['qty'];
  $price=$row1['price'];
  $tot=$qty*$price;
  $gtot+=$tot;
}
if($gtot!=0 && $gtot>0)
{
 echo'<h1>YOUR CART</h1>';

		echo'<table>
		   <thead>
				<tr>
					<th>Sno</th>
					<th>Item Id</th>
					<th>Item Name</th>
					<th>Item Price</th>
					<th>Quantity</th>
					<th>Total</th>
          <th>Remove from cart</th>
				</tr>
			</thead>
			<tbody>';

		$no 	= 1;
		$gtot=0;
    $result11 = mysqli_query($con, $query);
    $result111 = mysqli_query($con, $query1);
		while ($row = mysqli_fetch_array($result11))
		{
			$qty=$row['qty'];
			$price=$row['price'];
	        $tot=$qty*$price;
			$gtot+=$tot;
      $var=(string)$row['id'];
      $null=".".$var;
			echo '<tr>
					<td>'.$no.'</td>
					<td>'.$row['id'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['price'].'</td>
					<td>'.$row['qty'].'</td>
					<td>'.$tot.'</td>
          <td><button type="submit" value='.$row['qty'],$null.' name="itemdoll">REMOVE ITEM</button></td>
        </tr>';
			$no++;
		}


		while ($row = mysqli_fetch_array($result111))
		{
			$qty=$row['qty'];
			$price=$row['price'];
	        $tot=$qty*$price;
			$gtot+=$tot;
      $var=(string)$row['id'];
      $null=".".$var;
			echo '<tr>
					<td>'.$no.'</td>
					<td>'.$row['id'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['price'].'</td>
					<td>'.$row['qty'].'</td>
					<td>'.$tot.'</td>
          <td><button type="submit" value='.$row['qty'],$null.' name="itemperf">REMOVE ITEM</button></td>
				</tr>';
			$no++;

	}

echo '</tbody></table>';
echo ' <script type="text/javascript">

		function func()
		{
		var num=  JSON.parse('.$gtot.');
		window.location.href = "pay.php?gtot=" + num;
		}
		</script>
		';
    echo '<div style="margin-left:34em" >';
  	echo '<label style="background-color: dodgerblue;
      color: white;
      border: solid;
  	border-color:black;
      cursor: pointer;
      width: 175px ;
      opacity: 0.9;
  	display: inline-block;" for="gtot">GRAND TOTAL<input type="text" style="text-align: center;font-weight:bold;" id="gtot" value='.$gtot.' disabled/></label>';
  	echo '</div>';
  echo'  <div id="buttons">
  <a href = "http://localhost/scripts/td/items.php" target = "page">Back</a>
  <button type="button" name="pay"onclick="func()">PAY</button>
    </div>';
}
else{
  echo'<h1>YOUR CART IS EMPTY</h1>';
  echo'  <div id="buttons">
    <a href = "http://localhost/scripts/td/items.php" target = "page">Back</a>
    </div>';
}
?>
</form>
</body>
</html>
<?php
}
?>
