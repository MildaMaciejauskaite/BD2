<?php include('serveris.php') ?>

<html>
<head>
	<title> Registracija </title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
	<header>
		<div class="container">
			<img src="logo.jpg" alt="logo" class="logo">
			
			<nav>
				<ul>
					<li><a type="submit" name="pagrindinis" href="index.php">Pagrindinis puslapis</a></li>
					<li><a type="submit" name="apie" href="apie.php">Apie mus</a></li>
					<li><a type="submit" name="duk" href="duk.php">DUK</a></li>
					<li><a type="submit" name="kontaktai" href="kontaktai.php">Kontaktai</a></li>
					<li><a type="submit" name="prisijungti" href="prisijungimas.php">Prisijungti</a></li>
					<li><a type="submit" name="registruotis" href="registracija.php">Registruotis</a></li>
				</ul>
			</nav>
		</div>
	</header>


		
		<div class="header">
			<h2>Registracijos forma</h2>
		</div>
		
		<form action="registracija.php" method="post" style="text-align:center;">
		
				<div class="input-group">
					<label for="company">Įmonės pavadinimas :</label>
					<input type="company" name="company" required>		
				</div>
				
				<div class="input-group">
					<label for="c_code">Įmonės kodas :</label>
					<input type="c_code" name="c_code" required>		
				</div>
				
				<div class="input-group">
					<label for="pvm">PVM kodas :</label>
					<input type="pvm" name="pvm">		
				</div>
				
				<div class="input-group">
					<label for="country">Apskritis :</label>
					<input type="search" list="country" name="country" required>	
					<datalist id="country">
						<option value="Alytaus">
						<option value="Kauno">
						<option value="Klaipėdos">
						<option value="Marijampolės">
						<option value="Panevėžio">
						<option value="Šiaulių">
						<option value="Tauragės">
						<option value="Telšių">
						<option value="Utenos">
						<option value="Vilniaus">
					</datalist>
				</div>
				
				<div class="input-group">
					<label for="phone">Telefono numeris :</label>
					<input type="phone" name="phone" required>		
				</div>
				
				<div class="input-group">
					<label for="email">Elektroninis paštas :</label>
					<input type="email" name="email" required>		
				</div>
				
				<div class="input-group">
					<label for="password">Slaptažodis :</label>
					<input type="password" name="password_1" required>		
				</div>
			
				<div class="input-group">
					<label for="password">Pakartoti slaptažodį :</label>
					<input type="password" name="password_2" required>		
				</div>
			
				<button type="submit" class="btn" name="reg_user">Patvirtinti</button>
			
			<p> Esate užsiregistravęs? <a href="prisijungimas.php"><b>Prisijungti</b></a></p>
			
			<?php include('klaidos.php') ?>
			
		</form>
	</div>
	
</body>
</html>	
	