<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title> Užsakymų informacija </title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	
	<header>
		<div class="container">
			<img src="logo.jpg" alt="logo" class="logo">
			
			<nav>
				<ul>
					<li><a type="submit" name="atlikti_uzsakymai" href="direktorius.php">Užsakymai</a></li>
					<li><a type="submit" name="atliktas_patikros" href="dir_sarasas.php">Patikros</a></li>
					<li><a type="submit" name="darbu_planas" href="planas.php">Planas</a></li>
					<li><a type="submit" name="laiko_planavimas" href="laikas.php">Planavimas</a></li>
					<li><a type="submit" name="metrologu_pridejimas" href="met_pridejimas.php">Metrologai</a></li>
					<li><a type="submit" name="kainu_sarasas" href="kainos.php">Kainos</a></li>
					<li><a type="submit" name="info" href="dir_info.php">Info</a></li>
					<?php if(isset($_SESSION['email'])) : ?>
					<li><a type="submit" name="pagrindinis" href="logout.php"><i>Atsijungti</i></a></li>
					<?php endif ?>
				</ul>
			</nav>
		</div>
	</header>
	
	<?php if(isset($_SESSION['test'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				
				echo $_SESSION['test'];
				unset($_SESSION['test']);
				
				?>
			</h3>
		</div>
	<?php endif ?>
	
	<h2 style="text-align:center;">Užsakymų istorija</h2>	
	
	<div align="center">
		<?php  
				
			$sql  = "SELECT * FROM laikas JOIN uzsakymas ON (laikas.id = uzsakymas.date_id) JOIN darbuotojai ON (darbuotojai.id = laikas.met_id) JOIN user ON (user.id = uzsakymas.user_id) ORDER BY laikas.date";
			$result = $db->query($sql );
						
			if ($result->num_rows > 0) {
				echo "<table><tr><th>Data</th><th>Klientas</th><th>Adresas</th><th>Telefono numeris</th><th>Svarstyklių kiekis</th><th>Termometrų kiekis</th><th>Apskritis</th><th>Metrologas</th><th>Ar patvirtintas</th><th>Ar atliktas</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tbody><tr><td>" . $row["date"]. "</td><td>" . $row["company"]. "</td><td>" . $row["address"]. "</td><td>" . $row["phone"]. "</td><td>" . $row["scales_num"]. " vnt." ."</td><td>" . $row["thermometers_num"]. " vnt." ."</td><td>" . $row["country"]. "</td><td>" . $row["vardas"]. " " . $row["pavarde"]. "</td><td>" . $row["confirm"]. "</td><td>" . $row["done"]. "</td></tr>";
				}
				echo "</tbody></table>";
			} else {
				echo "Užsakymų dar nėra";
			}

		$db->close();
		?> 
	</div>
</body>
</html>