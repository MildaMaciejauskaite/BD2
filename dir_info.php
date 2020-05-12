<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title> Paskyra </title>
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
	
	<?php if(isset($_SESSION['keitimas'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				
				echo $_SESSION['keitimas'];
				unset($_SESSION['keitimas']);
				
				?>
			</h3>
		</div>
	<?php endif ?>
	
	<div align="center">
		<?php  
				
			$id = $_SESSION['id'];
			$sql  = "SELECT * FROM darbuotojai WHERE id = $id";
			$result = $db->query($sql);
					
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tbody><tr><td>" ."<table><tr><th>Asmeninė informacija: </th></tr>";
					echo "<tbody><tr><td>" ."Elektroninis paštas: ".$row["email"]."</td></tr>";
					echo "<tbody><tr><td>" ."Vardas: " .$row["vardas"]."</td></tr>";
					echo "<tbody><tr><td>" ."Pavardė: " .$row["pavarde"]."</td></tr>";
					echo "<tbody><tr><td>" ."Pageigos: " .$row["pareigos"]."</td></tr>";
				}
			} else {
				echo "Jūsų asmeninė informacija neįvesta";
			}
		?> 
	</div>
	
	<h2>Norite atnaujinti savo slaptažodį? </h2>
	
	<div>
		<a class="btn" type="submit" name="slaptazodis" href="dir_slaptazodis.php">Slaptažodžio atnaujinimas</a>
	</div>
		
</body>
</html>