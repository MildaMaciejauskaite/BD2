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
	
	<?php if(isset($_SESSION['naujas'])) : ?>
		<div style="text-align:center;" class="alert" >
			<h3>
				<?php
				echo $_SESSION['naujas'];
				unset($_SESSION['naujas']);
				
				?>
			</h3>
		</div>
	<?php endif ?>
	
	<div align="center">
		<?php  
				
			$id = $_SESSION['id'];
			$sql  = "SELECT * FROM user WHERE id = $id";
			$result = $db->query($sql);
					
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
					echo "<tbody><tr><td>" ."<table><tr><th>Asmeninė informacija: </th></tr>";
					echo "<tbody><tr><td>" ."Elektroninis paštas: ".$row["email"]."</td></tr>";
					echo "<tbody><tr><td>" ."Įmonės pavadinimas: " .$row["company"]."</td></tr>";
					echo "<tbody><tr><td>" ."Įmonės kodas: " .$row["c_code"]."</td></tr>";
					echo "<tbody><tr><td>" ."PVM kodas: " .$row["pvm"]."</td></tr>";
					echo "<tbody><tr><td>" ."Apskritis: " .$row["country"]."</td></tr>";
					echo "<tbody><tr><td>" ."Kontaktinis telefono numeris: " .$row["phone"]."</td></tr>";
				}
			} else {
				echo "Jūsų asmeninė informacija neįvesta";
			}
		?> 
	</div>
	
	<h2>Norite atnaujinti savo informaciją? </h2>
	
	<div>
		<a class="btn" type="submit" name="eiti_i_keitimas" href="keitimas.php">Informacijos atnaujinimas</a>
	</div>
		
</body>
</html>