<?php 

	error_reporting(0);
	require_once('conn.php');


	$branch= '';
	$agent_name= $_POST['agent_name'];
	$company= $_POST['company'];
	$name= $_POST['name'];
	$address_1= $_POST['address_1'];
	$address_2= $_POST['address_2'];
	$city= $_POST['city'];
	$state= $_POST['state'];
	$country= $_POST['country'];
	$telf1= $_POST['telf1'];
	$telf2= $_POST['telf2'];
	$qq= $_POST['qq'];
	$wechat= $_POST['wechat'];
	$email= $_POST['email'];
	$type= $_POST['type'];
	$fecha = date('Y-m-d H:i:s');
	
	// $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
	
	// $password=password_generate(7);
	// // Create salted password 
	// $password = hash('sha512', $password . $random_salt);

	// // Insert the new user into the database 
	// if ($insert_stmt = $mysqli->prepare("INSERT INTO users (username, password, created_at) VALUES (?, ?, ?, ?)")) {
	// 	$insert_stmt->bind_param($email, $password, $fecha);	
	// }

	// function password_generate($chars) 
	// {
	//   $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
	//   return substr(str_shuffle($data), 0, $chars);
	// }


$queryModel = mysqli_query($connect, "INSERT INTO agents(name, phone, email, picture, level) VALUES ('$name','$telf1', '$email', ' ', 'Client')") or die ("<meta http-equiv=\"refresh\" content=\"0;URL= ../createWarehouse.php?step=1&message=Error\">");

$queryModel = mysqli_query($connect, "INSERT INTO accounts(agent, company, name, address_1, address_2, city, state, country, telf1, telf2, qq, wechat, email, type, fecha, branch) 
                VALUES ('$agent_name', '$company', '$name', '$address_1', '$address_2', '$city', '$state', '$country', '$telf1', '$telf2', '$qq', '$wechat', '$email', '$type', '$fecha', '$branch')")
or die ("<meta http-equiv=\"refresh\" content=\"0;URL= ../createWarehouse.php?step=1&message=Error\">");
	$accounts_id=mysqli_insert_id($connect);
	$html='';
	$consulta = mysqli_query($connect, "SELECT * FROM accounts where type='Client' or type='Agent' order by id ")
	or die ("Error al traer los Agent");
	while ($row = mysqli_fetch_array($consulta)){
		$ID=$row['id'];
		$name=$row['name'];
		$company=$row['company'];
		$city=$row['city'];
		if($accounts_id==$ID){
			$html.='<option selected value="'.$ID.'">'.$ID.' '.$name.' / '.$company.' '.$city.'</option>';
		}else{
			$html.='<option  value="'.$ID.'">'.$ID.' '.$name.' / '.$company.' '.$city.'</option>';
		}
	}
	echo $html;


 ?>