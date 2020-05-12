<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title>Atliktos patikros </title>
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
	


	<h2 style="text-align:center;">Atliktų patikrų sąrašas</h2>	
		
	
	<h3 align="center">Svarstyklių patikros</h3>
	
	<div align="center">
		<?php  
					
			$sql  = "SELECT * FROM darbuotojai INNER JOIN svarstykles ON darbuotojai.id = svarstykles.met_id ORDER BY date;";
			$result = $db->query($sql);
					
			
			if ($result->num_rows > 0) {
				echo "<table><tr><th>Data</th><th>Įmonės pavadinimas</th><th>Adresas</th><th>Lipduko numeris</th><th>Tipas</th><th>Serijos numeris</th><th>Klasė</th><th>Min</th><th>Max</th><th>E</th><th>Atlikęs metrologas</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo " <tbody><tr><td>" . $row["date"]. "</td><td>" . $row["company"]. "</td><td>" . $row["address"]. "</td><td>" . $row["sticker"]. "</td><td>" . $row["type"]. "</td><td>" . $row["s_n"]. "</td><td>" . $row["class"]. "</td><td>" . $row["min"]. "</td><td>" . $row["max"]. "</td><td>" . $row["e"]. "</td><td>" . $row["vardas"]. " " . $row["pavarde"]. "</td></tr>";
				}
				echo "</tbody></table>";
			} else {
				echo "Svarstyklių patikrų neatlikta";
			}

		?> 
	</div>
	
	<h3 align="center">Termometrų patikros</h3>
	
	<div align="center">
		<?php  
						
			$sql  = "SELECT * FROM darbuotojai INNER JOIN termometras ON darbuotojai.id = termometras.met_id ORDER BY date;";
			$result = $db->query($sql );
					
			if ($result->num_rows > 0) {
				echo "<table><tr><th>Data</th><th>Įmonės pavadinimas</th><th>Adresas</th><th>Lipduko numeris</th><th>Tipas</th><th>Serijos numeris</th><th>Tikslumas</th><th>Min</th><th>Max</th><th>Atlikęs metrologas</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tbody><tr><td>" . $row["date"]. "</td><td>" . $row["company"]. "</td><td>" . $row["address"]. "</td><td>" . $row["sticker"]. "</td><td>" . $row["type"]. "</td><td>" . $row["s_n"]. "</td><td>" . $row["accuracy"]. "</td><td>" . $row["min"]. "</td><td>" . $row["max"]. "</td><td>" . $row["vardas"]. " " . $row["pavarde"]. "</td></tr>";
				}
				echo "</tbody></table>";
			} else {
				echo "Termometrų patikrų neatlikta";
			}

		$db->close();
		?> 
	</div>
	
</body>
</html>