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
</head>
<body>
<div style="width:180px">
<form name="regform" method="POST" action="registerauth.php" onsubmit="return validate()">
	
	<input name="ime" type="text" placeholder="Ime"></input>
	<input name="prezime" type="text" placeholder="Prezime"></input>
	Datum rodjenja<br>
<?php
	$days = range(1, 31);
	$months=range(1,12);
	$years=range(date('Y'),1930);
?>
<select name="day">
<?php
foreach($days as $day) {
?>
  <option value="<?php echo($day) ?>"><?php echo($day) ?></option>
<?php
}
?>
</select>
<select name="month">
<?php
foreach($months as $month) {
?>
  <option value="<?php echo($month) ?>"><?php echo($month) ?></option>
<?php
}
?>
</select>
<select name="year">
<?php
foreach($years as $year) {
?>
  <option value="<?php echo($year) ?>"><?php echo($year) ?></option>
<?php
}
?>

</select>
	<input name="mesto" type="text" placeholder="Mesto stanovanja"></input>
	<input name="pol" type="radio" value="M">Musko</input>
	<input name="pol" type="radio" value="Z">Zensko</input>
	<input name="email" type="text" placeholder="Email"></input>
	<input name ="username" type="text" placeholder="Username"></input>
	<input name ="password" type="password" placeholder="Password"></input>
	<input name ="reapeatpass" type="password" placeholder="PonoviP assword"></input>
	<input name ="submit" type="submit" value="Registruj se"></input>
</form> 
<a href="login.php">Login</a>
</div>

</body>
<script type="text/javascript">
   function validateEmail(){
         var emailID = document.regform.email.value;
         atpos = emailID.indexOf("@");
         dotpos = emailID.lastIndexOf(".");
         
         if (atpos < 1 || ( dotpos - atpos < 2 )) 
         {
            alert("Please enter correct email ID")
            document.regform.email.focus() ;
            return false;
         }
         return( true );
      }
      function validate(){
      
         if( document.regform.ime.value == "" ){
            alert( "Napisite svoje ime" );
            document.regform.ime.focus() ;
            return false;
         }
         
         if( document.regform.prezime.value == "" ){
            alert( "Napisite svoje prezime" );
            document.regform.prezime.focus() ;
            return false;
         }
         if( document.regform.mesto.value == "" ){
           	alert( "Napisite svoje mesto stanovanja" );
            document.regform.mesto.focus() ;
            return false;
         }
         if( !document.regform.pol[0].checked && !document.regform.pol[1].checked){
           	alert( "Izaberite pol" );
            document.regform.email.focus() ;
            return false;
         }
         if( document.regform.email.value == "" ){
           	alert( "Napisite svoj email" );
            document.regform.email.focus() ;
            return false;
         }
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
         if(document.regform.password.value != document.regform.reapeatpass.value){
         	alert("Password se ne poklapa");
         	document.regform.password.focus();
         	return false;
         }
         if(!validateEmail()){
         	return false;
         }
         
         
         return (true);
      }
   //-->
</script>
</html>