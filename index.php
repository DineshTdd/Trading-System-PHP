
<?php

global $con;

if(isset($_POST["submit1"])){


if(!empty($_POST['user']) && !empty($_POST['pass'])) {
    $user=$_POST['user'];
    $pass=$_POST['pass'];

    $con=mysqli_connect("127.0.0.1", "root", "", "FTS");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
    $query="SELECT * FROM login WHERE username='".$user."' AND password='".$pass."'";
    if ($result = mysqli_query($con, $query))
    {
    while($row = mysqli_fetch_assoc($result))
    {
    $dbusername=$row['username'];
    $dbpassword=$row['password'];
    }
    if(!empty($dbusername))
	{
    if($user == $dbusername && $pass == $dbpassword)
    {
    session_start();
    $_SESSION['sess_user']=$user;
    /* Redirect browser */
    header("Location: user.php");
    }
     else {
    echo "Invalid username or password!";
    }
	}
	else {
    echo "Invalid username or password!";
    }


} else {
    echo "All fields are required!";
}
}
}
if(isset($_POST["submit2"])){
if(!empty($_POST['uname']) && !empty($_POST['psw1'])&& !empty($_POST['psw2']) ) {
    $user=$_POST['uname'];
    $pass=$_POST['psw1'];
	$pass1=$_POST['psw2'];
		function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
	$email = test_input($user);

if (filter_var($email, FILTER_VALIDATE_EMAIL))
	{
	if($pass==$pass1)
	{
    $con=mysqli_connect("127.0.0.1", "root", "", "FTS");
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
    $query="SELECT * FROM login WHERE username='".$email."'";
    $numrows=mysqli_query($con,$query);
    if($numrows)
    {
      function randstr()
      {
        $pool = 'abcdefghijklmnopqrstuvwxyz';

               $str = '';
               for ($i=0; $i < 8; $i++)
               {
                   $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
               }
               return $str;
      }
      $tab=randstr();
      $tab = mysqli_real_escape_string($con,$tab);
      $sql1="CREATE TABLE `".$tab."` (id varchar(10),name varchar(20),price int(10),qty int(10))";
      $res=mysqli_query($con, $sql1);
      $sql1="INSERT INTO `".$tab."` (id,name,price) SELECT id,name,price FROM dolls";
      $res=mysqli_query($con, $sql1);
      $sql1="INSERT INTO `".$tab."` (id,name,price) SELECT id,name,price FROM perfumes";
      $res=mysqli_query($con, $sql1);
      $sql="INSERT INTO login(username,password,export) VALUES('$email','$pass','$tab')";

    $result=mysqli_query($con, $sql);
        if($result){
    echo '<script>window.alert("Account Successfully Created!");</script>';
    } else {
    echo "Failure!";
    }

    } else {
    echo '<script>window.alert("That username already exists! Please try again with another.");</script>';
    }
	}
	else
	{
	 echo '<script>window.alert("Passwords does not match!");</script>';
	}
	}
	else{
		echo "Enter a valid EmailID";
	}

} else {
    echo "All fields are required!";
}
}
?>
<?php

if(isset($_POST["submit3"])){

if(!empty($_POST['user']) && !empty($_POST['pass'])) {
    $user=$_POST['user'];
    $pass=$_POST['pass'];

    $con=mysqli_connect("127.0.0.1", "root", "", "FTS");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
    $table='adminlogin';
    $query="SELECT * FROM ".$table." WHERE username='".$user."' AND password='".$pass."'";
    if ($result = mysqli_query($con, $query))
    {
    while($row = mysqli_fetch_assoc($result))
    {
    $dbusername=$row['username'];
    $dbpassword=$row['password'];
    }
    if(!empty($dbusername))
	{
    if($user == $dbusername && $pass == $dbpassword)
    {
    session_start();
    $_SESSION['sess_user']=$user;

    /* Redirect browser */
    header("Location: user.php");
    }
     else {
    echo "Invalid username or password!";
    }
	}
	else {
    echo "Invalid username or password!";
    }


} else {
    echo "All fields are required!";
}
}
}
?>
<html><head><title>LOGIN</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Mono:700i" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Concert+One" rel="stylesheet">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 10px;
}

span.psw {
    float: right;
    padding-top: 10px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 0px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 0% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 40%; /* Could be more or less, depending on screen size */
	height: 100%;
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)}
    to {-webkit-transform: scale(1)}
}

@keyframes animatezoom {
    from {transform: scale(0)}
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
:root {
    --penguin-size: 300px;
    --penguin-skin: black;
    --penguin-belly: white;
    --penguin-beak: orange;
  }

  body{
    background-image: url("image-assets/ice.jpg");
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
	}

  .penguin {
    position: relative;
   margin: auto;
    display: block;
    margin-top: 5%;
    width: var(--penguin-size, 300px);
    height: var(--penguin-size, 700px);
	}

  .right-cheek {
    top: 15%;
    left: 35%;
    background: var(--penguin-belly, white);
    width: 60%;
    height: 70%;
    border-radius: 70% 70% 60% 60%;
  }

  .left-cheek {
    top: 15%;
    left: 5%;
    background: var(--penguin-belly, white);
    width: 60%;
    height: 70%;
    border-radius: 70% 70% 60% 60%;
  }

  .belly {
    top: 60%;
    left: 2.5%;
    background: var(--penguin-belly, white);
    width: 95%;
    height: 100%;
    border-radius: 120% 120% 100% 100%;
  }

  .penguin-top {
    top: 10%;
    left: 25%;
    background: var(--penguin-skin, gray);
    width: 50%;
    height: 45%;
    border-radius: 70% 70% 60% 60%;
  }

  .penguin-bottom {
    top: 40%;
    left: 23.5%;
    background: var(--penguin-skin, gray);
    width: 53%;
    height: 45%;
    border-radius: 70% 70% 100% 100%;
  }

  .right-hand {
    top: 5%;
    left: 25%;
    background: var(--penguin-skin, black);
    width: 30%;
    height: 60%;
    border-radius: 30% 30% 120% 30%;
    transform: rotate(130deg);
    z-index: -1;
    animation-duration: 3s;
    animation-name: wave;
    animation-iteration-count: infinite;
    transform-origin:0% 0%;
    animation-timing-function: linear;
  }

  @keyframes wave {
      10% {
        transform: rotate(110deg);
      }
      20% {
        transform: rotate(130deg);
      }
      30% {
        transform: rotate(110deg);
      }
      40% {
        transform: rotate(130deg);
      }
    }

  .left-hand {
    top: 0%;
    left: 75%;
    background: var(--penguin-skin, gray);
    width: 30%;
    height: 60%;
    border-radius: 30% 30% 30% 120%;
    transform: rotate(-45deg);
    z-index: -1;
  }

  .right-feet {
    top: 85%;
    left: 60%;
    background: var(--penguin-beak, orange);
    width: 15%;
    height: 30%;
    border-radius: 50% 50% 50% 50%;
    transform: rotate(-80deg);
    z-index: -2222;
  }

  .left-feet {
    top: 85%;
    left: 25%;
    background: var(--penguin-beak, orange);
    width: 15%;
    height: 30%;
    border-radius: 50% 50% 50% 50%;
    transform: rotate(80deg);
    z-index: -2222;
  }

  .right-eye {
    top: 45%;
    left: 60%;
    background: black;
    width: 15%;
    height: 17%;
    border-radius: 50%;
  }

  .left-eye {
    top: 45%;
    left: 25%;
    background: black;
    width: 15%;
    height: 17%;
    border-radius: 50%;
  }

  .sparkle {
    top: 25%;
    left:-23%;
    background: white;
    width: 150%;
    height: 100%;
    border-radius: 50%;
  }

  .blush-right {
    top: 65%;
    left: 15%;
    background: pink;
    width: 15%;
    height: 10%;
    border-radius: 50%;
  }

  .blush-left {
    top: 65%;
    left: 70%;
    background: pink;
    width: 15%;
    height: 10%;
    border-radius: 50%;
  }

  .beak-top {
    top: 60%;
    left: 40%;
    background: var(--penguin-beak, orange);
    width: 20%;
    height: 10%;
    border-radius: 50%;
  }

  .beak-bottom {
    top: 65%;
    left: 42%;
    background: var(--penguin-beak, orange);
    width: 16%;
    height: 10%;
    border-radius: 50%;
  }

  .penguin * {
    position: absolute;
  }
  .input-container {
  display: flex;
  width: 100%;
  margin-bottom: 15px;
}
.icon {
  padding: 10px;
  background: dodgerblue;
  color: white;
  min-width: 25px;
  text-align: center;
  border: solid;
	border-color:black;
}
 .btn{
    background-color: dodgerblue;
    color: white;
    padding: 15px 20px;
    border: solid;
	border-color:black;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}
.btn:hover {
  opacity: 1;
}
 </style>
  <script  type="text/javascript">
  <!--
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
//-->
</script>
 <h1 style="text-align:center;font-family: 'Concert One', cursive;font-size:60px">WELCOME TO FOREIGN TRADING SYSTEM</h1>
</head>
<body class="asyncImage" data-src="image-assets/ice-min.jpg" >

 <div class="page-wrap">
  <div class="penguin">
  <div class="penguin-bottom">
    <div class="right-hand"></div>
    <div class="left-hand"></div>
    <div class="right-feet"></div>
    <div class="left-feet"></div>
  </div>
  <div class="penguin-top">
    <div class="right-cheek"></div>
    <div class="left-cheek"></div>
    <div class="belly"></div>
    <div class="right-eye">
      <div class="sparkle"></div>
    </div>
    <div class="left-eye">
      <div class="sparkle"></div>
    </div>
    <div class="blush-right"></div>
    <div class="blush-left"></div>
    <div class="beak-top"></div>
    <div class="beak-bottom"></div>
  </div>
  </div>

 <fieldset style="display: inline-block;width: 280px;float: right;
  clear: right;
  margin: -13.0em 1.5em 0  0;
  padding: 20;">

  <legend style="font-family: 'Roboto Mono', monospace;color:black;">TRADER LOGIN</legend>
   <form  action="" method="POST">
  <div class="input-container">
    <i class="fa fa-user icon"></i>
  <input type="text" name="user" placeholder="mail" required></br></br>
  </div>
  <div class="input-container">
   <i class="fa fa-key icon"></i>
  <input type="password" name="pass" placeholder="Password" required></br>
  </div>
  <div>
  <button class="btn" type="submit" name="submit1" >Login</button>
  </div>
  </br>
  </form>
  <button class="btn" onclick="document.getElementById('id01').style.display='block'" >Register</button>
  <span class="psw">Forgot <a href="#">password?</a></span>
</fieldset>

<div id="id01" class="modal">

  <form class="modal-content animate" method="POST" action="">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="image-assets/img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
	  <div class="input-container">
    <i class="fa fa-user icon"></i>
      <input type="text" placeholder="Enter mailid" name="uname" required>
	</div>
      <label for="psw"><b>Password</b></label>
	  <div class="input-container">
   <i class="fa fa-key icon"></i>
      <input type="password" placeholder="Enter Password" name="psw1" required>
       </div>
	    <div class="input-container">
   <i class="fa fa-key icon"></i>
      <input type="password" placeholder="ReEnter Password" name="psw2" required>
       </div>
      <button class="btn" type="submit" name="submit2" >Register</button>
    </div>
  </form>
</div>

<form  action="" method="POST">
 <fieldset style="display: inline-block;width: 300px; float: left;
  clear: left;
  margin: -10.5em 0 1.5em 0;
  padding: 25;">

  <legend style="font-family: 'Roboto Mono', monospace;color:black;">ADMIN LOGIN</legend>
  <div class="input-container">
    <i class="fa fa-user icon"></i>
  <input type="text" name="user" placeholder="Username" required></br></br>
  </div>
  <div class="input-container">
   <i class="fa fa-key icon"></i>
  <input type="password" name="pass" placeholder="Password" required></br>
  </div>
  <div>
  <button class="btn" type="submit" name="submit3" >Login</button>
  </div>
	</fieldset>
</form>
<script>
var modal = document.getElementById('id01');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
(() => {
  'use strict';
  // Page is loaded
  const objects = document.getElementsByClassName('asyncImage');
  Array.from(objects).map((item) => {
    // Start loading image
    const img = new Image();
    img.src = item.dataset.src;
    // Once image is loaded replace the src of the HTML element
    img.onload = () => {
      item.classList.remove('asyncImage');
      return item.nodeName === 'IMG' ?
        item.src = item.dataset.src :
        item.style.backgroundImage = `url(${item.dataset.src})`;
    };
  });
})();
</script>


</body>

</html>
