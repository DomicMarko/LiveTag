<?php 
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]=true){
  header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="form-wrap" style="width:181px">
<div style="text-align:center">
<h1>LiveTag</h1>
</div>

<form name="regform" method="POST" action="loginauth.php" onsubmit="return validate()">
	<input name="username" type="text" placeholder="Username">
	<input name="password" type="password" placeholder="Password">
	<input class="dugme" name ="submit" type="submit" value="Login">
</form> 


<form action="guest.php" name="gostform" method="POST" >
  <input class="dugme" name ="submit2" type="submit" value="Udji kao gost">
</form>

<div style="text-align:center">
<a class="reglog" href="register.php">Registruj se</a>
</div>
</div>

</body>
<script type="text/javascript">
  
      function validate(){
      
         if( document.regform.username.value == "" ){
            alert( "Napisite svoj username" );
            document.regform.username.focus() ;
            return false;
         }
         if( document.regform.password.value == "" ){
            alert( "Napisite svoj password" );
            document.regform.password.focus() ;
            return false;
         }
         
         
         return (true);
      }
   //-->
</script>
</html>