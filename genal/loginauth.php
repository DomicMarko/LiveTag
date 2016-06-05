	/*	################################################################
	Autor: Aleksandar Genal 2013/0012, tim Elites
	Projekat: LiveTag
	Verzija: 1.0
	
	################################################################# */ 
<?php
include 'config.php';


$con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_errno($con))
{
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 if (isset($_POST['username'])){
    $username = $_POST['username'];
    $password=$_POST['password'];
   $result= mysqli_query($con,"SELECT * FROM korisnik WHERE username='$username'");
   if(mysqli_num_rows($result)==1){
      $row=mysqli_fetch_assoc($result);
      if(password_verify($password,$row["Password"])){
        session_start();
        $_SESSION["loggedin"]=true;
        $_SESSION["userID"]=$row['KorisnikID'];
        $_SESSION["userName"]=$username;
        $_SESSION["userType"]=$row["TipKorisnika"];
        $_SESSION["userAvatar"]=$row["AvatarURL"];
        header("Location: ../index.php");
      }else $output="Username ili password nisu tacni";
    }else $output="Username ili password nisu tacni";
} else header("Location: login.php");
mysqli_close($con);  



?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="form-wrap" style="width:181px;text-align:center">
<h1>LiveTag</h1>
<h2><?php echo $output?>
</h2>
<a style="padding:5px 0px" class="dugme" href="login.php">Pokusaj ponovo</a>

</div>
</body>
