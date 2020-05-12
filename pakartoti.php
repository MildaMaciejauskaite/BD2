<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";	
	header("location : prisijungimas.php");
}
$country = $_SESSION['country'];

?>
<html>
<head>
	<title> Užsakymo pakartojimas </title>
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

	
	<h2 style="text-align:center;">Pakartoti užsakymą</h2>
	
	<?php
	$id = $_GET['pakartoti']; 
	$test = mysqli_query($db, "SELECT * FROM uzsakymas WHERE id= '$id' ");                              
	$row = mysqli_fetch_assoc($test);
	
	$address = $row['address'];                               
	$scales_num = $row['scales_num'];
	$thermometers_num = $row['thermometers_num'];
	?>
	
	
	<div class="header">
		<h2>Užsakymo pateikimo forma</h2>
	</div>
	
	<form id="regForm" action="uzsakymas.php" method="post" style="text-align:center;">
								
				<div class="input-group">
					<label for="date_id">Data:</label>
					<input type="search" list="date_id" name="date_id" required>	
					<?php		
						$query=mysqli_query($db, "SELECT date FROM laikas WHERE country = '$country' ORDER BY date");
						
						echo "<datalist id='date_id'>";
							while($row = mysqli_fetch_array($query)){
								if ($row['date']>date("Y-m-d")){
									echo "<option value=$row[date]>";
								}
							}
						echo "</datalist>";
					?>
				</div>
				
				
				<div class="input-group">
					<label for="address">Adresas:</label>
					<input type="text"  value= "<?php echo $address;?>" name="address" required>		
				</div>
				
								
				<div class="input-group">
					<label for="scales_num">Pasirinkite kiek svarstyklių norite tikrinti:</label>
					<input type="number" value= "<?php echo $scales_num;?>" name="scales_num">		
				</div>		

				<div class="input-group">
					<label for="thermometers_num">Pasirinkite kiek termometrų norite tikrinti:</label>
					<input type="number"value= "<?php echo $thermometers_num;?>"  name="thermometers_num">		
				</div>	
				
			
				<button type="submit"  class="btn" name="uzsak_prid">Patvirtinti</button>
			
			
			<?php include('klaidos.php') ?>
			
	</form>
	
		<div align="center">
		<?php  
				
			$sql  = "SELECT * FROM kainos WHERE date=(SELECT MAX(date) FROM kainos)";
			$result = $db->query($sql );
					
			if ($result->num_rows > 0) {
				
				echo "<table><tr><th>Metrologinių patikrų kainos:</th></tr>";
				while($row = $result->fetch_assoc()) {
					
					echo "<tbody><tr><td>" . "Svarstyklių patikros kaina: ".$row["scales_price"]. "</td></tr>";
					echo "<tbody><tr><td>" . "Termometro patikros kaina: " .$row["thermometers_price"]. "</td></tr>";
				}
				echo "</tbody></table>";
			} else {
				echo "Patikrų kainos nėra nustatytos";
			}
		?> 
	</div>
	
	
</body>
</html>