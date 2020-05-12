<?php

session_start();

//kintamieji

$email = "";
$errors = array();

//prisijungimas prie db

$db = mysqli_connect('localhost', 'root', '', 'login') or die ("negalima prisijungti prie duomenų bazės");

$db1 = new mysqli('localhost', 'root', '', 'login');

//naudotojo registracija

if(isset($_POST['reg_user'])){

	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	$company = mysqli_real_escape_string($db, $_POST['company']);
	$c_code = mysqli_real_escape_string($db, $_POST['c_code']);
	$pvm = mysqli_real_escape_string($db, $_POST['pvm']);
	$country = mysqli_real_escape_string($db, $_POST['country']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);

	if(empty($email)) {array_push($errors, "Elektroninis paštas yra privalomas");}
	if(empty($password_1)) {array_push($errors, "Slaptažodis yra privalomas");}
	if(empty($password_2)) {array_push($errors, "Slaptažodis yra privalomas");}
	if(empty($company)) {array_push($errors, "Įmonės pavadinimas yra privalomas");}
	if(empty($c_code)) {array_push($errors, "Įmonės kodas yra privalomas");}
	if(empty($country)) {array_push($errors, "Apskritis yra privaloma");}
	if(empty($phone)) {array_push($errors, "Kontaktinis telefono numeris yra privalomas");}
	if($password_1!= $password_2){array_push($errors, "Jūsų įvesti slaptažodžiai nesutampa");}
	
	//patikrinti db ar nėra tokio email

	$email_chech_query = "SELECT * FROM user WHERE email = '$email' LIMIT 1";

	$result = mysqli_query($db, $email_chech_query);
	$user = mysqli_fetch_assoc($result);

	//jeigu vartotojas jau yra
	
	if($user['email'] === $email) {array_push($errors, "Elektroninis paštas jau užregistruotas");}

	//naudotojo registracija jeigu nera klaidu

	if(count($errors) == 0){
		$password = md5($password_1); 
		$query = "INSERT INTO user (company, c_code, pvm, country, phone, email, password) VALUES ('$company', '$c_code', '$pvm', '$country', '$phone', '$email', '$password')";
		mysqli_query($db, $query);
		$_SESSION['id'] = $logged_in_user["id"];
		$_SESSION['email'] = $email;
		$_SESSION['country'] = $country;
		$_SESSION['test'] = "Prisijungėte sėkmingai";
		header('location: istorija.php');
	}
}

//naudotojo informacijos atnaujinimas

if(isset($_POST['keitimas'])){

	$id = $_SESSION['id'];
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_s = mysqli_real_escape_string($db, $_POST['password_s']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	$company = mysqli_real_escape_string($db, $_POST['company']);
	$c_code = mysqli_real_escape_string($db, $_POST['c_code']);
	$pvm = mysqli_real_escape_string($db, $_POST['pvm']);
	$country = mysqli_real_escape_string($db, $_POST['country']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);

	if(empty($email)) {array_push($errors, "Elektroninis paštas yra privalomas");}
	if(empty($password_s)) {array_push($errors, "Senas slaptažodis yra privalomas, norint atnaujinti informaciją");}
	if(empty($company)) {array_push($errors, "Įmonės pavadinimas yra privalomas");}
	if(empty($c_code)) {array_push($errors, "Įmonės kodas yra privalomas");}
	if(empty($country)) {array_push($errors, "Apskritis yra privaloma");}
	if(empty($phone)) {array_push($errors, "Kontaktinis telefono numeris yra privalomas");}

	//jeigu slaptazodis atnaujinamas

	if (!empty($password_1)) {
		
		if($password_1!= $password_2){array_push($errors, "Jūsų įvesti nauji slaptažodžiai nesutampa");}
		
		$passwords = md5($password_s);
		$query = "SELECT * FROM user WHERE id='$id' AND password='$passwords' ";                                  
		$results = mysqli_query($db, $query);
			
		if(mysqli_num_rows($results)){
			if(count($errors) == 0){
				$password = md5($password_1); 
				$query = "UPDATE user SET company='$company', c_code= '$c_code', pvm= '$pvm', country= '$country', phone= '$phone', email= '$email', password= '$password' WHERE id= '$id'";
				mysqli_query($db, $query);
				$_SESSION['naujas'] = "Informaciją atnaujinote sėkmingai!";
				header('location: paskyra.php');
			}
		}else{		
			array_push($errors, "Blogas senas slaptažodis");			
		}
		
	}
	
	//jeigu slaptazodis nera atnaujinamas
	
	$password = md5($password_s); 
	$query = "SELECT * FROM user WHERE id='$id' AND password='$password' ";                         
	$results = mysqli_query($db, $query);
		
	if(mysqli_num_rows($results)){
		if(count($errors) == 0){
			$query = "UPDATE user SET company='$company', c_code= '$c_code', pvm= '$pvm', country= '$country', phone= '$phone', email= '$email', password= '$password' WHERE id= '$id'";
			mysqli_query($db, $query);
			$_SESSION['naujas'] = "Informaciją atnaujinote sėkmingai!";
			header('location: paskyra.php');
		}
	}else{		
		array_push($errors, "Blogas senas slaptažodis");			
	}
	
}
 
//naudotojo prijungimas

if(isset($_POST['login_user'])){

	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	if(empty($email)){array_push($errors, "Elektroninis paštas yra privalomas");}
	if(empty($password)){array_push($errors, "Slaptažodis yra privalomas");}
	
	if(count($errors) == 0 ){
		$password = md5($password);
		$query = "SELECT * FROM user WHERE email='$email' AND password='$password' ";
		$results = mysqli_query($db, $query);
		
		if(mysqli_num_rows($results)){
			
			$logged_in_user = mysqli_fetch_assoc($results);
			$_SESSION['id'] = $logged_in_user["id"];
			$_SESSION['email'] = $email;
			$_SESSION['country'] = $logged_in_user['country'];
			$_SESSION['test'] = "Prisijungėte sėkmingai";
			header('location: istorija.php');
			
		}else{
			$query_1 = "SELECT * FROM darbuotojai WHERE email='$email' AND slaptazodis='$password' AND pareigos='Direktorius' ";
			$results_1 = mysqli_query($db, $query_1);
			
			if(mysqli_num_rows($results_1)){
			
			$logged_in_user = mysqli_fetch_assoc($results_1);
			$_SESSION['id'] = $logged_in_user["id"];
			$_SESSION['test'] = "Prisijungėte sėkmingai";
			$_SESSION['email'] = $email;
			header('location: direktorius.php');
			
			}else{
				
				$query_2 = "SELECT * FROM darbuotojai WHERE email='$email' AND slaptazodis='$password' AND pareigos='Metrologas'";
				$results_2 = mysqli_query($db, $query_2);
				
				if(mysqli_num_rows($results_2)){

					$logged_in_user = mysqli_fetch_assoc($results_2);
					$_SESSION['id'] = $logged_in_user["id"];
					$_SESSION['test'] = "Prisijungėte sėkmingai";
					$_SESSION['email'] = $email;
					header('location: metrologas.php');
					
				}else{
					
					array_push($errors, "Blogas el. paštas arba slaptažodis");
					
				}
			}
		}
	}
}

//darbuotojo pridejimas 

if(isset($_POST['met_prid'])){
	
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$surname = mysqli_real_escape_string($db, $_POST['surname']);
	$email_1 = mysqli_real_escape_string($db, $_POST['email']);
	$position = mysqli_real_escape_string($db, $_POST['position']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	
	if(empty($name)) {array_push($errors, "Vardas yra privalomas");}
	if(empty($surname)) {array_push($errors, "Pavardė yra privalomas");}
	if(empty($email_1)) {array_push($errors, "Elektroninis paštas yra privalomas");}
	if(empty($position)) {array_push($errors, "Pareigos yra privalomos");}
	if(empty($password_1)) {array_push($errors, "Slaptažodis yra privalomas");}
	if(empty($password_2)) {array_push($errors, "Slaptažodis yra privalomas");}
	if($password_1!= $password_2){array_push($errors, "Jūsų įvesti slaptažodžiai nesutampa");}
	
	$email_chech_query = "SELECT * FROM darbuotojai WHERE email = '$email_1' LIMIT 1";

	$result = mysqli_query($db, $email_chech_query);
	$darbuotojai = mysqli_fetch_assoc($result);
	if($darbuotojai['email'] === $email_1) {array_push($errors, "Elektroninis paštas jau užregistruotas");}
	
	if(count($errors) == 0){
		$password = md5($password_1); 
		print $password;
		$query = "INSERT INTO darbuotojai (email, vardas, pavarde, pareigos, slaptazodis) VALUES ('$email_1', '$name', '$surname', '$position', '$password')";
		mysqli_query($db, $query);
		$_SESSION['darbuotojas'] = "Darbuotojas pridėtas sėkmingai!";
		header('location: met_pridejimas.php');
	}
}

//darbu plano pridejimas 

if(isset($_POST['laik_plan'])){

	$date = mysqli_real_escape_string($db, $_POST['date']);
	$country = mysqli_real_escape_string($db, $_POST['country']);
	$met_pav = mysqli_real_escape_string($db, $_POST['met_pav']);
	
	$test = mysqli_query($db, "SELECT * FROM darbuotojai WHERE pavarde = '$met_pav'");                                  
	$row = mysqli_fetch_assoc($test);
	$met_id = $row['id'];                            

	if(empty($date)) {array_push($errors, "Data yra privaloma");}
	if(empty($country)) {array_push($errors, "Pasirinkti apskritį yra privaloma");}
	if(empty($met_pav)) {array_push($errors, "Pasirinkti metrologą yra privaloma");}
		
	if(count($errors) == 0){
		$query = "INSERT INTO laikas (date, country, met_id) VALUES ('$date', '$country', '$met_id')";
		mysqli_query($db, $query);
		$_SESSION['planas'] = "Planas pridėtas sėkmingai!";
		header('location: planas.php');
	}

}

//svarstykliu patikros pridejimas

if(isset($_POST['svarst_prid'])){
	
	$met_id = $_SESSION['id'];
	$date = mysqli_real_escape_string($db, $_POST['date']);
	$company = mysqli_real_escape_string($db, $_POST['company']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$sticker = mysqli_real_escape_string($db, $_POST['sticker']);
	$type = mysqli_real_escape_string($db, $_POST['type']);
	$s_n = mysqli_real_escape_string($db, $_POST['s_n']);
	$class = mysqli_real_escape_string($db, $_POST['class']);
	$min = mysqli_real_escape_string($db, $_POST['min']);
	$max = mysqli_real_escape_string($db, $_POST['max']);
	$e = mysqli_real_escape_string($db, $_POST['e']);
	
	if(empty($date)) {array_push($errors, "Data yra privaloma");}
	if(empty($company)) {array_push($errors, "Įmonės pavadinimas yra privalomas");}
	if(empty($address)) {array_push($errors, "Adresas yra privalomos");}
	if(empty($sticker)) {array_push($errors, "Lipduko numeris yra privalomas");}
	if(empty($type)) {array_push($errors, "Svarstyklių tipas yra privalomas");}
	if(empty($s_n)) {array_push($errors, "Serijos numeris yra privalomos");}
	if(empty($class)) {array_push($errors, "Klasė yra privalomas");}
	if(empty($min)) {array_push($errors, "Min reikšmė yra privalomas");}
	if(empty($max)) {array_push($errors, "Max reikšmė yra privalomas");}
	if(empty($e)) {array_push($errors, "E reikšmė yra privalomas");}
	
	//patikrinti db ar nėra tokio lipduko
	$sticker_chech_query = "SELECT * FROM svarstykles WHERE sticker = '$sticker' LIMIT 1";
	$result = mysqli_query($db, $sticker_chech_query);
	$stickert = mysqli_fetch_assoc($result);
	if($stickert['sticker'] === $sticker) {array_push($errors, "Šis lipukas jau įvestas");}
	
	if(count($errors) == 0){
		$query = "INSERT INTO svarstykles (met_id, date, company, address, sticker, type, s_n, class, min, max, e) VALUES ('$met_id', '$date', '$company', '$address', '$sticker', '$type', '$s_n', '$class', '$min', '$max', '$e')";
		mysqli_query($db, $query);
		$_SESSION['prid'] = "Svarstyklių patikra pridėta sėkmingai!";
		header('location: sarasas.php');
	}
}

//termometro patikros pridejimas

if(isset($_POST['term_prid'])){
	
	$met_id = $_SESSION['id'];
	$date = mysqli_real_escape_string($db, $_POST['date']);
	$company = mysqli_real_escape_string($db, $_POST['company']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$sticker = mysqli_real_escape_string($db, $_POST['sticker']);
	$type = mysqli_real_escape_string($db, $_POST['type']);
	$s_n = mysqli_real_escape_string($db, $_POST['s_n']);
	$accuracy = mysqli_real_escape_string($db, $_POST['accuracy']);
	$min = mysqli_real_escape_string($db, $_POST['min']);
	$max = mysqli_real_escape_string($db, $_POST['max']);
	
	if(empty($date)) {array_push($errors, "Data yra privaloma");}
	if(empty($company)) {array_push($errors, "Įmonės pavadinimas yra privalomas");}
	if(empty($address)) {array_push($errors, "Adresas yra privalomos");}
	if(empty($sticker)) {array_push($errors, "Lipduko numeris yra privalomas");}
	if(empty($type)) {array_push($errors, "Svarstyklių tipas yra privalomas");}
	if(empty($s_n)) {array_push($errors, "Serijos numeris yra privalomos");}
	if(empty($accuracy)) {array_push($errors, "Tikslumas yra privalomas");}
	if(empty($min)) {array_push($errors, "Min reikšmė yra privalomas");}
	if(empty($max)) {array_push($errors, "Max reikšmė yra privalomas");}
	
	//patikrinti db ar nėra tokio lipduko
	$sticker_chech_query = "SELECT * FROM termometras WHERE sticker = '$sticker' LIMIT 1";
	$result = mysqli_query($db, $sticker_chech_query);
	$stickert = mysqli_fetch_assoc($result);
	if($stickert['sticker'] === $sticker) {array_push($errors, "Šis lipukas jau įvestas");}
	
	if(count($errors) == 0){
		$query = "INSERT INTO termometras (met_id, date, company, address, sticker, type, s_n, accuracy, min, max) VALUES ('$met_id', '$date', '$company', '$address', '$sticker', '$type', '$s_n', '$accuracy', '$min', '$max')";
		mysqli_query($db, $query);
		$_SESSION['prid'] = "Termometro patikra pridėta sėkmingai!";
		header('location: sarasas.php');
	}
}

//kainu atnaujinimas

if(isset($_POST['kain_prid'])){
	
	$date = date("Y-m-d");
	$scales_price = mysqli_real_escape_string($db, $_POST['scales_price']);
	$thermometers_price = mysqli_real_escape_string($db, $_POST['thermometers_price']);

	if(empty($scales_price)) {array_push($errors, "Įveskite svarstyklių kainą");}
	if(empty($thermometers_price)) {array_push($errors, "Įveskite termometro kainą");}
		
	if(count($errors) == 0){
		$query = "INSERT INTO kainos (date, scales_price, thermometers_price) VALUES ('$date', '$scales_price', '$thermometers_price')";
		mysqli_query($db, $query);
		$_SESSION['kaina'] = "Kainos atnaujintos sėkmingai!";
		header('location: kainos.php');
	}
}


//uzsakymo pridejimas

if(isset($_POST['uzsak_prid'])){
	
	$user_id = $_SESSION['id'];
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$date = mysqli_real_escape_string($db, $_POST['date_id']); 
	
	$test = mysqli_query($db, "SELECT * FROM laikas WHERE date= '$date'");                                 
	$row = mysqli_fetch_assoc($test);
	$date_id = $row['id'];

	$scales_num = (int)mysqli_real_escape_string($db, $_POST['scales_num']);
	$thermometers_num = (int)mysqli_real_escape_string($db, $_POST['thermometers_num']);
	$price_id = (int)mysqli_query($db, "SELECT id FROM kainos WHERE date=(SELECT MAX(date) FROM kainos)");
	$confirm = 'Ne';
	$done = 'Ne';
	
	$sql_1  = "SELECT * FROM kainos WHERE date=(SELECT MAX(date) FROM kainos)";
	$result_1 = $db->query($sql_1);
	if ($result_1->num_rows > 0) {
		while($row_1 = $result_1->fetch_assoc()) {
			$svarst = $row_1["scales_price"];
			$term = $row_1["thermometers_price"];
		}
	}
									
	$kaina = $scales_num * $svarst + $thermometers_num * $term;
	
	if(empty($address)) {array_push($errors, "Adresas yra privalomas");}
	
	if(count($errors) == 0){
		$query = "INSERT INTO uzsakymas (user_id, address, date_id, scales_num, thermometers_num, price_id, confirm, done, sum) VALUES ('$user_id', '$address', '$date_id', '$scales_num', '$thermometers_num', '$price_id', '$confirm', '$done', '$kaina')";
		mysqli_query($db, $query);
		$_SESSION['uzsak'] = "Užsakymas sėkmingai pridėtas!";
		header('location: istorija.php');
	}
}

//uzsakymo patvirtinimas - atlieka metrologas

if(isset($_GET['patvirtinti'])){
	$id = $_GET['patvirtinti'];
	
	$query = "UPDATE uzsakymas SET confirm='Taip' WHERE id= '$id' ";
	mysqli_query($db, $query);
	$_SESSION['patvirt'] = "Užsakymas patvirtintas!";
	header('location: suplanuoti.php');

}

//atlikto uzsakymo patvirtinimas - atlieka metrologas

if(isset($_GET['atliktas'])){
	$id = $_GET['atliktas'];
	 
	$query = "UPDATE uzsakymas SET done='Taip' WHERE id= '$id' ";
	mysqli_query($db, $query);
	$_SESSION['patvirtinti'] = "Užsakymas pažymėtas atliktu!";
	header('location: svarstykles.php');

}

//darbuotojo slaptazodio keitimas

if(isset($_POST['slaptazodzio_keitimas'])){

	$id = $_SESSION['id'];
	$password_s = mysqli_real_escape_string($db, $_POST['password_s']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	if(empty($password_s)) {array_push($errors, "Senas slaptažodis yra privalomas, norint atnaujinti");}
	if(empty($password_1)) {array_push($errors, "Naujas slaptažodis yra privalomas");}
	if(empty($password_2)) {array_push($errors, "Pakartotinas slaptažodis yra privalomas");}
	if($password_1!= $password_2){array_push($errors, "Jūsų įvesti nauji slaptažodžiai nesutampa");}
		
	$passwords = md5($password_s);
	$query = "SELECT * FROM darbuotojai WHERE id='$id' AND slaptazodis='$passwords' ";                                  
	$results = mysqli_query($db, $query);
	
			
	if(mysqli_num_rows($results)){
		if(count($errors) == 0){
			$password = md5($password_1); 
			$query = "UPDATE darbuotojai SET slaptazodis= '$password' WHERE id= '$id'";
			mysqli_query($db, $query);
			$_SESSION['keitimas'] = "Slaptažodį atnaujinote sėkmingai!";
			$row = mysqli_fetch_assoc($results);
			$pareigos = $row['pareigos'];
			if ($pareigos == 'Metrologas'){
				header('location: info.php');
			} else {
				header('location: dir_info.php');
			}
		}
	}else{		
		array_push($errors, "Blogas senas slaptažodis");			
	}
}

?>