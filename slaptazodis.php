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
	

	
	<div class="header">
		<h2>Slaptažodžio atnaujinimo forma</h2>
	</div>
	
	<form action="slaptazodis.php" method="post" style="text-align:center;">
		
			
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