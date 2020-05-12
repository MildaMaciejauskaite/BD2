<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>
<html>
<head>
	<title> Užsakymų istorija </title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	
	<header>
		<div class="container">
			<img src="logo.jpg" alt="logo" class="logo">
			
			<nav>
				<ul>
					<li><a type="submit" name="uzsakymu_istorija" href="istorija.php">Užsakymų istorija</a></li>
					<li><a type="submit" name="pateikti_uzsakyma" href="uzsakymas.php">Pateikti užsakymą</a></li>
					<li><a type="submit" name="pateikti_uzsakyma" href="paskyra.php">Paskyra</a></li>
					<?php if(isset($_SESSION['email'])) : ?>
					<li><a type="submit" name="pagrindinis" href="logout.php"><i>Atsijungti</i></a></li>
					<?php endif ?>
				</ul>
			</nav>
		</div>
	</header>
	

	<?php if(isset($_SESSION['test'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				
				echo $_SESSION['test'];
				unset($_SESSION['test']);
				
				?>
			</h3>
		</div>
	<?php endif ?>
	
	<?php if(isset($_SESSION['uzsak'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				
				echo $_SESSION['uzsak'];
				unset($_SESSION['uzsak']);
				
				?>
			</h3>
		</div>
	<?php endif ?>

	<h2 style="text-align:center;">Užsakymų istorija</h2>
	
	<div align="center">
		<h3></h3>
		<?php  
			
			$user = $_SESSION['id'];	

			$sql  = "SELECT * FROM laikas INNER JOIN uzsakymas ON laikas.id = uzsakymas.date_id WHERE uzsakymas.user_id = '$user' ORDER BY date";
			$result = $db->query($sql);
					
			if ($result->num_rows > 0) {
				echo "<table><tr><th>ID</th><th>Data</th><th>Adresas</th><th>Svarstyklių kiekis</th><th>Termometrų kiekis</th><th>Preliminari kaina</th><th>Ar patvirtintas</th><th>Ar atliktas</th><th>Užsakymo pakartojimas</th></tr>";
				while($row = $result->fetch_assoc()) {
					
					echo "<tbody><tr><td>" . $row["id"]. "</td><td>" . $row["date"]. "</td><td>" . $row["address"]. "</td><td>" . $row["scales_num"]. " vnt." . "</td><td>" . $row["thermometers_num"]. " vnt." .  "</td><td>" . $row["sum"] . " eurai" .  "</td><td>" . $row["confirm"]. "</td><td>" . $row["done"]. "</td>
					<td>"
					?> 
						<a href="pakartoti.php?pakartoti=<?php echo $row['id']; ?>" 
						class="btn" name="pakartoti">Pakartoti</a>
					<?php  
					"</td></tr>";
				}
				echo "</tbody></table>";
			} else {
				echo "Užsakymų dar neatlikote";
			}

		$db->close();
		?> 
	</div>
	
	
	
</body>
</html>