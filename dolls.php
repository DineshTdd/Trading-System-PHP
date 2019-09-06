<?php
session_start();
if(!isset($_SESSION['sess_user'])){
    header("location:index.php");
} else {
global $con;
$con=mysqli_connect("127.0.0.1", "root","", "FTS");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
$query="SELECT * FROM dolls";
$result = mysqli_query($con, $query);
if (!$result) {
	die ('SQL Error: ' . mysqli_error($con));
}
if(isset($_POST['dolls']))
{
  $p=$_POST['dollss'];
  $inc=$p+1;
$qty = $_POST['dolls'];
$len=sizeof($qty);
if (is_array($qty))
{
  $sql1="SELECT qty FROM dolls WHERE sno='$inc'";
  $resu=mysqli_query($con, $sql1);
  $row = mysqli_fetch_array($resu);
  $qty1=$row['qty'];
  $qty1=$qty1+$qty[$p];
  $sql="UPDATE dolls SET qty='$qty1' WHERE sno='$inc'";
  $res=mysqli_query($con, $sql);
  $sql1="SELECT avail FROM dolls WHERE sno='$inc'";
  $resu=mysqli_query($con, $sql1);
  $row = mysqli_fetch_array($resu);
  $avail=$row['avail'];
  $avail=$avail-$qty[$p];
  $sql="UPDATE dolls SET avail='$avail' WHERE sno='$inc'";
  $res=mysqli_query($con, $sql);
}
header("Refresh:0");
}
?>
<!doctype html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
<style>
body {
		text-align:center;
	font-family: 'Source Sans Pro', sans-serif;
	background-image: url("http://www.sclance.com/backgrounds/webpage-background-images/webpage-background-images_2359439.jpg");
	height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width:70%; 
    margin-left:15%; 
    margin-right:15%;

}

td, th {
    border: 2px solid #000000;
    text-align: left;
    padding: 8px;
	background-color: #dddddd;
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
.btn{
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
#buttons :first-child {
    float: none;
}
#buttons :nth-child(2) {
    float: none
}
#buttons {
    text-align: center;
}

<!--tr:nth-child(even) {
    background-color: #dddddd;
}-->
</style>
</head>
<body>

<h2>Dolls</h2>
<form method="post" action="">
<table>
<thead>
  <tr>
    <th>Sno</th>
    <th>Item Id</th>
    <th>Item Name</th>
	<th>Item Price</th>
	<th>Availability</th>
	<th>Quantity Needed</th>
  </tr>
  </thead>
  <tbody>
  <?php
    $n=0;
		$no 	= 1;
		$number='number';
		$dolls='dolls[]';
		while ($row = mysqli_fetch_array($result))
		{
			echo '<tr>
					<td>'.$no.'</td>
					<td>'.$row['id'].'</td>
					<td>'.$row['name'].'</td>
					<td>'.$row['price'].'</td>
					<td>'.$row['avail'].'</td>
					<td><input type='.$number.' name='.$dolls.' value=0 min="0" required>
          <button  type="submit" value='.$n.' name="dollss">ADD TO CART</button></td>
				</tr>';
			$no++;
      $n++;
		}
	?>
	</tbody>
</table>

</form>

<form method="get" action="payment.php">
<div id="buttons">
<a href = "http://localhost/scripts/td/items.php" target = "page" class="btn">Back</a>
<button  type="submit">VIEW CART</button>
</div>
</form>
</body>
</html>
<?php
}
?>
