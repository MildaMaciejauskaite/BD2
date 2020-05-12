<?php include('serveris.php') ?>

<html>
<head>
	<title> Prisijungimas </title>
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
			<h2>Prisijungimas</h2>
		</div>
		
		<form action="prisijungimas.php" method="post" style="text-align:center;">

				<div class="input-group">
					<label for="email">Elektroninis paštas :</label>
					<input type="email" name="email" required>		
				</div>
			
				<div class="input-group">
					<label for="password">Slaptažodis :</label>
					<input type="password" name="password" required>		
				</div>
			
				<div class="input-group">
					<button type="submit" class="btn" name="login_user">Prisijungti</button>
				</div>
			
			<p> Nesate užsiregistravęs? <a href="registracija.php"><b>Užsiregistruoti</b></a></p>
			
			<?php include('klaidos.php') ?>
			
		</form>
	</div>
</body>
</html>