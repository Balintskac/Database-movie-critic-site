
<html>
<head>
<charset language="UTF-8">
<title>Filmkritika oldal</title>

</head>
<body>
    <td><a href='felhasznalo.php?oldal=menu'>Főoldal</a></td>&nbsp; 
	<td><a href='felhasznalo.php?oldal=kritika'>kritikák megtekintése</a></td>&nbsp; 
	<td><a href='felhasznalo.php?oldal=ujkritika'>Vélemény rögzítés</a></td>&nbsp; 
	<td><a href='felhasznalo.php?oldal=kedvencek'>kedvencek közé felvett filmek</a></td>&nbsp; 
	<td><a href='felhasznalo.php?oldal=profil'>Profil megtekintése</a></td>&nbsp; 
	<td><a href='felhasznalo.php?oldal=oldaltetszik'>Oldal értékelése</a></td>&nbsp; 
	
<?php
if(isset($_GET['oldal'])){
	if($_GET['oldal']=='menu') menu();
	if($_GET['oldal']=='kritika') kritika();
	if($_GET['oldal']=='ujkritika') ujkritika();
	if($_GET['oldal']=='kedvencek') kedvencek();
	if($_GET['oldal']=='profil') profil();
	if($_GET['oldal']=='oldaltetszik') oldaltetszik();

	}
	else menu();
?>
	
	
</body>
</html>
<?php
function kapcsolodas(){
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "movies";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
		 die("Connection failed: " . $conn->connect_error);
		} 
	$conn->set_charset("utf8");
	
	return $conn;
	
	}
	
function ujkritika(){
	
$conn = kapcsolodas();
	echo "Új vélemény hozzáadása<br />";

		if (isset($_GET["felvetel"])) {
			
			$query = "INSERT INTO kritika 
				(id,title,style,rank,opinion)
			VALUES
				(

				'".$_GET['title']."',
				".$_GET['style'].",
				".$_GET['rank'].",
				".$_GET['opinion']."
			
				);
			";

		$conn->query($query);
	
			?>
			Felvétel tovább lépéséhez menj rá:
			<a href='felhasznalo.php?oldal=ujkritika'>Felvétel</a>
			<?php
			} else {
			?>
			<form method='get'>
				<input type='hidden' name='oldal' value='felvetel'></br>
				Film címe:<input type='text' name='title'></br></br>
				zsáner:
			
					<select name="style">
						<option value="Akció">Akció</option>
						<option value="Vígjáték">Vígjáték</option>
						<option value="Thiller">Thiller</option>
						<option value="Horror">Horror</option>
						<option value="Romantika">Romantika</option>
						<option value="Sci-fi">Sci-fi</option>
						<option value="Krimi">Krimi</option>
						<option value="Dráma">Dráma</option>
						
					</select>
				</br></br>
				Pontozása:
					
					1:<input type="radio" name="rank" value="1">
					2:<input type="radio" name="rank" value="2"> 
					3:<input type="radio" name="rank" value="3"> 
					4:<input type="radio" name="rank" value="4"> 
					5:<input type="radio" name="rank" value="5"> 
					6:<input type="radio" name="rank" value="6"> 
					7:<input type="radio" name="rank" value="7"> 
					8:<input type="radio" name="rank" value="8"> 
					9:<input type="radio" name="rank" value="9"> 
			     	10:<input type="radio" name="rank" value="10"> 
				</br></br>

				Vélemény:
				</br></br>
					<textarea name="opinion" rows="10" cols="30" placeholder="Írj saját véleményt a film kapcsán"></textarea>
						<br>
				
				<input type='submit' value='kritika hozzáadása' name='felvetel'>
			</form>
			<?php
			}
	
	$conn->close();	
	
	}
	
function kritika(){
		?>
	<table class="list">
 <tr>
	<td>id</td>
	<td>Film címe</td>
	<td>Zsáner</td>
	<td>Pontozása</td>
	<td>Vélemény</td>
</tr>
	<?php
	$conn = kapcsolodas();

	echo "Adatok listázása<br />";
	
		$sql = "SELECT * FROM kritika";
		$result = $conn->query($sql);
		$i = 1;

		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				?>
				</tr>
				<td><?php echo $i?></td>
				<td><?php echo $row["title"]?></td>
				<td><?php echo $row["style"]?></td>
				<td><?php echo $row["rank"]?></td>
				<td><?php echo $row["opinion"]?></td>
		  </tr><?php
		  $i++;
			}
		} else {
			echo "Nincs találat!";
		}
	
	$conn->close();	
	
	}
		
		

	
	
?>

	<?php

if(isset($_SESSION['felhasznalonev'])){
	echo "Hello".$_SESSION['felhasznalonev']."";
	echo " <a href='kijelentkezes.php'>Kijelentkezés!</a>";	
}

?>	