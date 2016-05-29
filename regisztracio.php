<?php
if(isset($_POST['submit'])){
	

$felhasznalonev = strip_tags($_POST['felhasznalonev']);
$email = strip_tags($_POST['email']);
$jelszo = md5(strip_tags($_POST['password']));
$jelszoujra = strip_tags($_POST['repassword']);

if($felhasznalonev&&$email&&$jelszo&&$jelszoujra){
	if($jelszo==$jelszoujra){
		if(6<strlen($jelszo)&&20>=strlen($jelszo)){
			if(4<strlen($felhasznalonev)&&20>=strlen($jelszo)){
				
		$kapcsolodas = mysql_connect('localhost','root','');
		$adatbazis = mysql_select_db('users',$kapcsolodas);
		
		$query = mysql_query("SELECT * FROM info WHERE username = '$felhasznalonev'");
		$numrows = mysql_num_rows($query);
		
				if($numrows==0){
				$query2 = mysql_query("SELECT * FROM info WHERE username = '$email'");
				$numrows2 = mysql_num_rows($query2);
					if($numrows == 0){
						
						$kapcsolodas = mysql_connect('localhost','root','');
						$adatbazis = mysql_select_db('users',$kapcsolodas);
						$password = md5($jelszo);
						$datum = date("Y-m-d");
						$query3 = mysql_query("
							
						INSERT INTO info VALUES ('','$felhasznalonev','$password','$email','$datum')
						
						");
		
						die("Regisztáltál! <a href='oldal.php'>Bejelentkezés</a>");
					} else {
						echo "ez a email már létezik!";
					}
				} else {
					echo "Ez a felhasználó név már létetzik!";
				}
				echo "Regisztáltál!";
			} else {
				echo "legyen több 4-nél, de 21-nél kevesebb.";
			}
			echo "eddig ok";
		} else {
			echo "legyen több 6-nál, de 21-nél kevesebb.";
		}
		echo "eddig ok";
	} else {
	echo "nem jó valami!";
	}
}
else
{
	echo "kérlek töltsd ki!";
}
}
?>
<html>
 <form action="regisztracio.php" method="POST">
	Email:	 <input type="text" name="email" value="<?php if(isset($_POST['submit'])){echo $email;} ?>" />
	username: <input type="text" name="felhasznalonev" value="<?php if(isset($_POST['submit'])){echo $felhasznalonev;} ?>" />
	password: <input type="password" name="password" value="<?php if(isset($_POST['submit'])){echo $jelszo;} ?>"/>
	újra:	 <input type="password" name="repassword" value="<?php if(isset($_POST['submit'])){echo $jelszoujra;} ?>"/>
		
		<input type="submit" name="submit" value="Regiszráció">
</html>