
<?php
if(isset($_POST["submit"])){
if(!empty($_POST['user']) && !empty($_POST['pass'])) {
    $user=$_POST['uname'];
    $pass=$_POST['psw1'];
	$pass1=$_POST['psw2'];
	if($pass==$pass1)
	{
    $con=mysqli_connect("127.0.0.1", "root", "", "FTS");
  if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
    $query="SELECT * FROM login WHERE username='".$user."'";
    $numrows=mysqli_query($con,$query);
    if($numrows)
    {
    func rand()
    {
      $pool = 'abcdefghijklmnopqrstuvwxyz';

             $str = '';
             for ($i=0; $i < 8; $i++)
             {
                 $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
             }
             return $str;
    }
    $tab=rand();
    $sql="INSERT INTO login(username,password,export) VALUES('$user','$pass','$tab')";
    $result=mysqli_query($con, $sql);
        if($result){
    echo "Account Successfully Created";
    } else {
    echo "Failure!";
    }

    } else {
    echo "That username already exists! Please try again with another.";
    }
	}
	else
	{
	 echo "Passwords does not match!";
	}

} else {
    echo "All fields are required!";
}
}
?>
