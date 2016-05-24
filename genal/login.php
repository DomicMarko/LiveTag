<?php 
session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]=true){
  header("Location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
</head>
<body>
<div style="width:180px">
<form name="regform" method="POST" action="loginauth.php" onsubmit="return validate()">
	
	<input name="username" type="text" placeholder="Username"></input>
	<input name="password" type="password" placeholder="Password"></input>
	<input name ="submit" type="submit" value="Login"></input>
</form> 
<a href="register.php">Registruj se</a>
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