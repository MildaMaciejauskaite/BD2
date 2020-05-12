<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>


<html>
<head>
	<title> Slaptažodžio keitimas </title>
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
					<li><a type="submit" name="info" href="info.php">Info</a></li>
					<?php if(isset($_SESSION['email'])) : ?>
					<li><a type="submit" name="pagrindinis" href="logout.php"><i>Atsijungti</i></a></li>
					<?php endif ?>
				</ul>
			</nav>
		</div>
	</header>
	

	
	<div class="header">
		<h2>Slaptažodžio atnaujinimo forma</h2>
	</div>
	
	<form action="dir_slaptazodis.php" method="post" style="text-align:center;">
		
			
				<div class="input-group">
					<label for="password">Senas slaptažodis:</label>
					<input type="password" name="password_s" required>		
				</div>
				
				<div class="input-group">
					<label for="password">Naujas slaptažodis :</label>
					<input type="password" name="password_1" required>		
				</div>
			
				<div class="input-group">
					<label for="password">Pakartoti naują slaptažodį :</label>
					<input type="password" name="password_2" required>		
				</div>
			
				<button type="submit" class="btn" name="slaptazodzio_keitimas">Atnaujinti slaptažodį</button>
			
			<?php include('klaidos.php') ?>
			
		</form>
	

	
</body>
</html>