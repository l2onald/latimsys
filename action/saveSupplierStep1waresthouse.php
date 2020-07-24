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
	



$queryModel = mysqli_query($connect, "INSERT INTO accounts(agent, company, name, address_1, address_2, city, state, country, telf1, telf2, qq, wechat, email, type, fecha, branch) 
                VALUES ('$agent_name', '$company', '$name', '$address_1', '$address_2', '$city', '$state', '$country', '$telf1', '$telf2', '$qq', '$wechat', '$email', '$type', '$fecha', '$branch')")
or die ("<meta http-equiv=\"refresh\" content=\"0;URL= ../createWarehouse.php?step=1&message=Error\">");

if ($name!=''){ $company .= ' | '.$name; } 


echo "<meta http-equiv=\"refresh\" content=\"0;URL= ../createWarehouse.php?step=1\">";


 ?>