<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title>Darbų planavimas</title>
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
	

	<h2 style="text-align:center;">Suplanuokite darbus</h2>	
		
	
	<div class="header">
			<h3>Įveskite, kuriomis dienomis metrologai vyks į skirtingas apskritis</h3>
		</div>

	<form action="laikas.php" method="post" style="text-align:center;">
						
		<div class="input-group">
			<label for="date">Data :</label>
			<input type="date" name="date" min="<?php echo date('Y-m-d'); ?>" required>		
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
			<label for="met_pav">Pasirinkite metrologą :</label>
			<input type="search" list="met_pav" name="met_pav" required>	
			<?php
				$query=mysqli_query($db, "SELECT pavarde FROM darbuotojai WHERE pareigos = 'Metrologas' ");
				
				echo "<datalist id='met_pav'>";
					while($row = mysqli_fetch_array($query)){
						echo "<option value=$row[pavarde]>";
					}
				echo "</datalist>";
				$db->close();
			?>
		</div>
					
		<button type="submit" class="btn" name="laik_plan">Pridėti</button>
					
		<?php include('klaidos.php') ?>
					
	</form>
			

	
</body>
</html>