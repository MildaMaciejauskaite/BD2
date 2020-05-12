<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title> Metrologo suplanuoti darbai </title>
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
	
	<?php if(isset($_SESSION['patvirt'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				
				echo $_SESSION['patvirt'];
				unset($_SESSION['patvirt']);
				
				?>
			</h3>
		</div>
	<?php endif ?>

	<h2 style="text-align:center;">Metrologo suplanuoti darbai</h2>
	<div align="center">
		<h3></h3>
		<?php  
			
			$user = $_SESSION['id'];		
			$sql  = "SELECT laikas.date, user.company, uzsakymas.address, user.phone, uzsakymas.scales_num, uzsakymas.thermometers_num, uzsakymas.id FROM laikas JOIN uzsakymas ON (laikas.id = uzsakymas.date_id) JOIN user ON (user.id = uzsakymas.user_id) WHERE laikas.met_id = $user AND uzsakymas.confirm = 'Taip' AND uzsakymas.done = 'Ne'";
			$result = $db->query($sql );
					
			if ($result->num_rows > 0) {
				echo "<table><tr><th>Užsakymo id</th><th>Data</th><th>Klientas</th><th>Adresas</th><th>Telefono numeris</th><th>Svarstyklių kiekis</th><th>Termometrų kiekis</th><th>Atlikimo patvirtinimas</th></tr>";
				while($row = $result->fetch_assoc()) {
					echo "<tbody><tr><td>" . $row["id"]. "</td><td>" . $row["date"]. "</td><td>" . $row["company"]. "</td><td>" . $row["address"]. "</td><td>" . $row["phone"]. "</td><td>" . $row["scales_num"]. "</td><td>" . $row["thermometers_num"]. "</td>
					<td>"
					?> 
						<a href="suplanuoti.php?atliktas=<?php echo $row['id']; ?>" 
						class="btn"name="atliktas" >Atliktas</a>
					<?php  
					"</td></tr>";
				}
				echo "</tbody></table>";
			} else {
				echo "Neturite suplanuotų užsakymų";
			}

		$db->close();
		?> 
	</div>
	
	
</body>
</html>