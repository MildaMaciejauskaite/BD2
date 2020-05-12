<?php
include('serveris.php');
if(!isset($_SESSION['email'])){
	
	$_SESSION['msg'] = "Turite prisijungti";
	header("location : prisijungimas.php");
}
?>


<html>
<head>
	<title> Informacijos atnaujinimas </title>
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
	

	
	<?php
	$id = $_SESSION['id']; 
	$test = mysqli_query($db, "SELECT * FROM user WHERE id= '$id' ");                              
	$row = mysqli_fetch_assoc($test);
	
	$company = $row['company'];                               
	$c_code = $row['c_code'];
	$pvm = $row['pvm'];
	$email = $row['email'];
	$country = $row['country'];
	$phone = $row['phone'];

	
	?>
	
	<div class="header">
		<h2>Registracijos atnaujinimo forma</h2>
	</div>
	
	<form action="keitimas.php" method="post" style="text-align:center;">
		
				<div class="input-group">
					<label for="company">Įmonės pavadinimas :</label>
					<input type="company" value= "<?php echo $company;?>" name="company" required>		
				</div>
				
				<div class="input-group">
					<label for="c_code">Įmonės kodas :</label>
					<input type="c_code" value= "<?php echo $c_code;?>" name="c_code" required>		
				</div>
				
				<div class="input-group">
					<label for="pvm">PVM kodas :</label>
					<input type="pvm" value= "<?php echo $pvm;?>" name="pvm">		
				</div>
				
				<div class="input-group">
					<label for="country">Apskritis :</label>
					<input type="search" value= "<?php echo $country;?>" list="country" name="country" required>	
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
					<input type="phone" value= "<?php echo $phone;?>" name="phone" required>		
				</div>
				
				<div class="input-group">
					<label for="email">Elektroninis paštas :</label>
					<input type="email" value= "<?php echo $email;?>" name="email" required>		
				</div>
				
				<div class="input-group">
					<label for="password">Senas slaptažodis:</label>
					<input type="password" name="password_s" required>		
				</div>
				
				<div class="input-group">
					<label for="password">Naujas slaptažodis :</label>
					<input type="password" name="password_1">		
				</div>
			
				<div class="input-group">
					<label for="password">Pakartoti naują slaptažodį :</label>
					<input type="password" name="password_2">		
				</div>
			
				<button type="submit" class="btn" name="keitimas">Atnaujinti duomenis</button>
			
			<?php include('klaidos.php') ?>
			
		</form>
	

	
</body>
</html>