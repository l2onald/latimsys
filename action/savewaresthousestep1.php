<?php 

	error_reporting(0);
	require_once('conn.php');
	$fecha= $_POST['fecha'];
	$supplier_id= $_POST['supplier_id'];
	$agent_id= $_POST['agent_id'];
	$bill_id= $_POST['bill_id'];
	$consignee_id= $_POST['consignee_id'];
	$reference_id= $_POST['reference_id'];
	$invoice= $_POST['invoice'];
	$value= $_POST['value'];
	$po= $_POST['po'];
	$marks= $_POST['marks'];
	$delivered_by1= $_POST['delivered_by1'];
	$delivered_by2= $_POST['delivered_by2'];
	$tracking= $_POST['tracking'];
	$description= $_POST['description'];
	$comments= $_POST['comments'];
	$branch= $_POST['branch'];
	$pickup_number= $_POST['pickup_number'];
	$location1= $_POST['location1'];
	$location2= $_POST['location2'];
	$can= $_POST['can'];
	$destination= $_POST['destination'];
	$instination1= $_POST['instination1'];
	$instination2= $_POST['instination2'];
	$terms= $_POST['terms'];
	$condition2= $_POST['condition2'];
	$distribution= $_POST['distribution'];
	$status= $_POST['status'];
	$dangerous_goods= $_POST['dangerous_goods'];
	$seo= $_POST['seo'];
	$fragile= $_POST['fragile'];
	$insurance= $_POST['insurance'];
	$dt = new DateTime($fecha);
	$fecha = $dt->format('Y-m-d H:i:s');
	$queryModel = mysqli_query($connect, 
	"INSERT INTO warehouse (supplier_id, agent_id,  bill_id, consignee_id, reference_id, invoice, value, po, marks, delivered_by1, delivered_by2, tracking, description, comments, branch, pickup_number, location1, location2, distribution,can,destination, instination1, instination2, terms,  condition2, status, dangerous_goods, seo, fragile, insurance, fecha) 
     VALUES ('$supplier_id', '$agent_id', '$bill_id', '$consignee_id', '$reference_id', '$invoice', '$value', '$po','$marks', '$delivered_by1', '$delivered_by2', '$tracking', '$description', '$comments', '$branch', '$pickup_number', '$location1', '$location2','$distribution','$can','$destination', '$instination1', '$instination2', '$terms', '$condition2','$status', '$dangerous_goods', '$seo', '$fragile', '$insurance', '$fecha')")
		or die ("<meta http-equiv=\"refresh\" content=\"0;URL= ../createWarehouse.php?step=1\">");

	$warehouse_id=mysqli_insert_id($connect);

	echo "<meta http-equiv=\"refresh\" content=\"0;URL= ../createWarehouse.php?step=2&warehouse_id=".$warehouse_id."\">";


 ?>