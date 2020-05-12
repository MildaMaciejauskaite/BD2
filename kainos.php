<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title>Kainos</title>
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
	
	<?php if(isset($_SESSION['kaina'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				
				echo $_SESSION['kaina'];
				unset($_SESSION['kaina']);
				
				?>
			</h3>
		</div>
	<?php endif ?>
	
	<div class="header">
		<h3>Užpildykite šią formą, norėdami atnaujinti kainas</h3>
	</div>
	
	<form action="met_pridejimas.php" method="post" style="text-align:center;">
		
				<div class="input-group">
					<label for="scales_price">Svarstyklių patikros kaina eurais:</label>
					<input type="scales_price" name="scales_price" required>		
				</div>
				
				<div class="input-group">
					<label for="thermometers_price">Termometro patikros kaina eurais:</label>
					<input type="thermometers_price" name="thermometers_price" required>		
				</div>		

				<button type="submit" class="btn" name="kain_prid">Patvirtinti</button>
			
			<?php include('klaidos.php') ?>
			
	</form>
	
	<div align="center">
		<h3>Kainų istorija</h3>	
		<?php  
				
			$sql  = "SELECT * FROM kainos ORDER BY date ";
			$result = $db->query($sql );
					
			if ($result->num_rows > 0) {
				echo "<table><tr><th>Data</th><th>Svarstyklių patikros kaina</th><th>Termometro patikros kaina</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tr><td>" . $row["date"]. "</td><td>" . $row["scales_price"]." eurai" . "</td><td>" . $row["thermometers_price"]." eurai" . "</td></tr>";
				}
				echo "</table>";
			} else {
				echo "0 results";
			}

		$db->close();
		?> 
	</div>
</body>
</html>