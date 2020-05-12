<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title> Metrologo atliktos patikros </title>
	<link rel="stylesheet" href="style.css">
</head>

<body>
	
	<header>
		<div class="container">
			<img src="logo.jpg" alt="logo" class="logo">
			
			<nav>
				<ul>
					<li><a type="submit" name="atlikti_uzsakymai" href="metrologas.php">Užsakymai</a></li>
					<li><a type="submit" name="laiko_planavimas" href="suplanuoti.php">Patvirtinti užsakymai</a></li>
					<li><a type="submit" name="svarstykliu_pridejimas" href="svarstykles.php">Svarstyklių patikra</a></li>
					<li><a type="submit" name="termometro_pridejimas" href="termometras.php">Termometro patikra</a></li>
					<li><a type="submit" name="patikru_sarasas" href="sarasas.php">Sąrašas</a></li>
					<li><a type="submit" name="info" href="info.php">Info</a></li>
					<?php if(isset($_SESSION['email'])) : ?>
					<li><a type="submit" name="pagrindinis" href="logout.php"><i>Atsijungti</i></a></li>
					<?php endif ?>
				</ul>
			</nav>
		</div>
	</header>
	
	<?php if(isset($_SESSION['prid'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				
				echo $_SESSION['prid'];
				unset($_SESSION['prid']);
				
				?>
			</h3>
		</div>
	<?php endif ?>
	
	<h2 style="text-align:center;">Atliktų patikrų sąrašas</h2>

	<div align="center">
		<h3>Svarstyklių patikros</h3>
		<?php  
			
			$met = $_SESSION['id'];
			$sql  = "SELECT * FROM svarstykles WHERE met_id = $met ORDER BY id";
			$result = $db->query($sql);
					
			
			if ($result->num_rows > 0) {
				echo "<table><tr><th>Data</th><th>Įmonės pavadinimas</th><th>Adresas</th><th>Lipduko numeris</th><th>Tipas</th><th>Serijos numeris</th><th>Klasė</th><th>Min</th><th>Max</th><th>E</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo " <tbody><tr><td>" . $row["date"]. "</td><td>" . $row["company"]. "</td><td>" . $row["address"]. "</td><td>" . $row["sticker"]. "</td><td>" . $row["type"]. "</td><td>" . $row["s_n"]. "</td><td>" . $row["class"]. "</td><td>" . $row["min"]. "</td><td>" . $row["max"]. "</td><td>" . $row["e"]. "</td></tr>";
				}
				echo "</tbody></table>";
			} else {
				echo "Svarstyklių patikrų neatlikote";
			}

		?> 
	</div>
	
	<div align="center">
		<h3>Termometrų patikros</h3>
		<?php  
			
			$met = $_SESSION['id'];		
			$sql  = "SELECT * FROM termometras WHERE met_id = $met ORDER BY id";
			$result = $db->query($sql );
					
			
			if ($result->num_rows > 0) {
				echo "<table><tr><th>Data</th><th>Įmonės pavadinimas</th><th>Adresas</th><th>Lipduko numeris</th><th>Tipas</th><th>Serijos numeris</th><th>Tikslumas</th><th>Min</th><th>Max</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tbody><tr><td>" . $row["date"]. "</td><td>" . $row["company"]. "</td><td>" . $row["address"]. "</td><td>" . $row["sticker"]. "</td><td>" . $row["type"]. "</td><td>" . $row["s_n"]. "</td><td>" . $row["accuracy"]. "</td><td>" . $row["min"]. "</td><td>" . $row["max"]. "</td></tr>";
				}
				echo "</tbody></table>";
			} else {
				echo "Termometrų patikrų neatlikote";
			}

		$db->close();
		?> 
	</div>
	

</body>
</html>