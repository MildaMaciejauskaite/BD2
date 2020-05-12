<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title> Darbuotojo pridėjimas </title>
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
	
	
	<?php if(isset($_SESSION['darbuotojas'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				
				echo $_SESSION['darbuotojas'];
				unset($_SESSION['darbuotojas']);
				
				?>
			</h3>
		</div>
	<?php endif ?>
	
	<div class="header">
			<h3>Užpildykite šią formą, norėdami pridėti darbuotoją</h3>
	</div>

	<form action="met_pridejimas.php" method="post" style="text-align:center;">
		
            
				<div class="input-group">
					<label for="name">Vardas :</label>
					<input type="name" name="name" required>		
				</div>
				
				<div class="input-group">
					<label for="surname">Pavardė :</label>
					<input type="surname" name="surname" required>		
				</div>
				
				<div class="input-group">
					<label for="email">Elektroninis paštas :</label>
					<input type="email" name="email" required>		
				</div>		

				<div class="input-group">
					<label for="position">Pareigos :</label>
					<input list="position" name="position" required>
					<datalist id="position">
						<option value="Metrologas">
						<option value="Direktorius">
					</datalist>					
				</div>	
			
				<div class="input-group">
					<label for="password">Slaptažodis :</label>
					<input type="password" name="password_1" required>		
				</div>
			
				<div class="input-group">
					<label for="password">Pakartoti slaptažodį :</label>
					<input type="password" name="password_2" required>		
				</div>
			
				<button type="submit" class="btn" name="met_prid">Patvirtinti</button>
			
			
			<?php include('klaidos.php') ?>
			
	</form>
	
	<div align="center">
	
	<?php  
							
		$sql  = "SELECT vardas, pavarde FROM darbuotojai WHERE pareigos = 'Metrologas' ";
		$result = $db->query($sql );
				
		if ($result->num_rows > 0) {
			echo "<table><tr><th>Šiuo metu įdarbintų metrologų sąrašas :</th></tr>";
			while($row = $result->fetch_assoc()) {
				echo "<tbody><tr><td>" . $row["vardas"]. " " . $row["pavarde"]. "</td></tr>";
			}
			echo "</tbody></table>";
		} else {
			echo "0 results";
		}
	?> 
		
	
	</div>
	
	

</body>
</html>