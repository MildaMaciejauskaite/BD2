<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title> Darbų grafikas </title>
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
	
	<?php if(isset($_SESSION['planas'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				
				echo $_SESSION['planas'];
				unset($_SESSION['planas']);
				
				?>
			</h3>
		</div>
	<?php endif ?>
	
	<h2 style="text-align:center;">Būsimi suplanuoti darbai</h2>
	
	<div align="center">
		<?php  
			$sql  = "SELECT * FROM darbuotojai INNER JOIN laikas ON darbuotojai.id = laikas.met_id WHERE date > NOW() ORDER BY date";
			$result = $db->query($sql );
					
			
			if ($result->num_rows > 0) {
				echo "<table><tr><th>Data</th><th>Apskritis</th><th>Vyksiantis metrologas</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tbody><tr><td>" . $row["date"]. "</td><td>" . $row["country"]. "</td><td>" . $row["vardas"]. " " . $row["pavarde"]. "</td></tr>";
				}
				echo "</tbody></table>";
			} else {
				echo "Nėra suplanuotų darbų";
			}

		$db->close();
		?> 
	</div>

</body>
</html>