<?php

session_start();
function kapcsolodas(){
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "galleria";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		 die("Connection failed: " . $conn->connect_error);
		} 
	$conn->set_charset("utf8");
	
	return $conn;
	
	}

	$felhasznalonev = $_POST['felhasznalonev'];
	$jelszo = $_POST['jelszo'];
	
	if($felhasznalonev && $jelszo){
		
		$kapcsolodas = mysql_connect('localhost','root','');
		$adatbazis = mysql_select_db('users',$kapcsolodas);
		
		$query = mysql_query("SELECT * FROM info WHERE username = '$felhasznalonev'");
		$numrows = mysql_num_rows($query);
		
	if($numrows != 0){
		 while($rows = mysql_fetch_assoc($query)){
			 $dbfelhasznalonev = $rows['username'];
			 $dbjelszo = $rows['password'];
		 }
		 
		  if($felhasznalonev = $dbfelhasznalonev && md5($jelszo) == $dbjelszo){
			 $_SESSION['felhasznalonev'] = $felhasznalonev;
		
			 echo "Bejelentkeztél! <a href='felhasznalo.php'>itt!</a>";
		  } else 
			  
			 die("Nem megfelelő a jelszó!");
		} else 
			
			die("nem egyezik meg a felhasználói név és jelszó");
		
	} else 
		die("kérem a felhasználónevet és jelszót!");
	
	
	
?>