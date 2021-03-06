<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title> Svarstyklių patikros registravimas </title>
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
	
	<?php if(isset($_SESSION['patvirtinti'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				
				echo $_SESSION['patvirtinti'];
				unset($_SESSION['patvirtinti']);
				
				?>
			</h3>
		</div>
	<?php endif ?>
	
	
	<div class="header">
		<h3>Užpildykite duomenis apie svarstyklių patikrą</h3>
	</div>
	
	<form action="svarstykles.php" method="post" style="text-align:center;">
	
				<div class="input-group">
					<label for="date">Data :</label>
					<input type="date" name="date" required>		
				</div>
				
				<div class="input-group">
					<label for="company">Įmonės pavadinimas :</label>
					<input type="company" name="company" required>		
				</div>		

				<div class="input-group">
					<label for="address">Patikros atlikimo vieta :</label>
					<input type="address" name="address" required>		
				</div>
				
				<div class="input-group">
					<label for="sticker">Lipduko numeris :</label>
					<input type="sticker" name="sticker" required>		
				</div>
				
				<div class="input-group">
					<label for="type">Svarstyklių tipas :</label>
					<input type="type" name="type" required>		
				</div>		

				<div class="input-group">
					<label for="s_n">Serijos numeris :</label>
					<input type="s_n" name="s_n" required>		
				</div>	
				
				<div class="input-group">
					<label for="class">Klasė :</label>
					<input list="class" name="class" required>	
					<datalist id="class">
						<option value="I">
						<option value="II">
						<option value="III">
						<option value="IV">
					</datalist>
				</div>
			
				<div class="input-group">
					<label for="min">Min reikšmė :</label>
					<input type="min" name="min" required>		
				</div>
				
				<div class="input-group">
					<label for="max">Max reikšmė :</label>
					<input type="max" name="max" required>		
				</div>
			
				<div class="input-group">
					<label for="e">E reikšmė :</label>
					<input type="e" name="e" required>		
				</div>
			
				<button type="submit"  class="btn" name="svarst_prid">Patvirtinti</button>
			
			
			<?php include('klaidos.php') ?>
			
	</form>
	

</body>
</html>