<?php

include 'config.php';

$con=mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
if (mysqli_connect_errno($con))
{
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 if (isset($_POST['username'])){
	 $username = $_POST['username'];
	 $email=$_POST['email'];
	$result= mysqli_query($con,"SELECT * FROM korisnik WHERE username='$username' OR Email='$email'");
	if(mysqli_num_rows($result)==0){
		$ime=$_POST['ime'];
		$prezime=$_POST['prezime'];
		$datum=$_POST['year']."-".$_POST['month']."-".$_POST['day'];
		$mesto=$_POST['mesto'];
		$pol=$_POST['pol'];
		$email=$_POST['email'];
		$password=$_POST['password'];
		$hash=password_hash($password,PASSWORD_DEFAULT);
		 $statement = mysqli_prepare($con,"INSERT INTO korisnik (Username,Password,Ime,Prezime,DatumRodjenja,MestoStanovanja,Pol,Email,BrojPoena,TipKorisnika,StiglaPoruka) VALUES (?,?,?,?,?,?,?,?,0,'basic',0)");
		mysqli_stmt_bind_param($statement,"ssssssss",$username,$hash,$ime,$prezime,$datum,$mesto,$pol,$email );
		mysqli_stmt_execute($statement);
		mysqli_stmt_close($statement);
		
		$result= mysqli_query($con,"SELECT * FROM korisnik WHERE Username='$username' LIMIT 1");
		
		 if(mysqli_num_rows($result)==1){
		 	echo 'Uspesno ste napravili nalog <br><a href="login.php" >Login</a>';
		 	exit();
		 }else {echo 'Greska proverite podatke i<br><a href="register.php" >Pokusajte ponovo</a>';exit();}
	}else {echo 'Username ili email vec postoji <br><a href="register.php" >Pokusajte ponovo</a>'; exit();}
}else header("Location: ../index.php");
mysqli_close($con);	



?>