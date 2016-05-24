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
        header("Location: ../index.php");
      }else echo "Ne valja";
    }else echo "Ne valja 2";
} else header("Location: login.php");
mysqli_close($con);  



?>