<?php 



	require_once('conn.php');


	$quotationIDerase= $_POST['quotationID'];

	$modifica= "DELETE FROM quotations WHERE id='$quotationIDerase'";
	$resultado = mysqli_query($connect, $modifica)
	or die ("Error al insertar los registros");


	$modifica= "DELETE FROM quotationcharges WHERE quotationID='$quotationIDerase'";
	$resultado = mysqli_query($connect, $modifica)
	or die ("Error al insertar los registros");

	$modifica= "DELETE FROM quotationcontents WHERE quotationID='$quotationIDerase'";
	$resultado = mysqli_query($connect, $modifica)
	or die ("Error al insertar los registros");

	$agent_name= $_POST['agent_name'];
	$client_name= $_POST['client_name'];
	$initial_date= $_POST['initial_date'];
	$expiration_date= $_POST['expiration_date'];
	$origin= $_POST['origin'];
	$destination= $_POST['destination'];
	$service= $_POST['service'];
	$commodity= $_POST['commodity'];
	$remarks= $_POST['remarks'];
	$containerQuantity= $_POST['containerQuantity'];


	if ($containerQuantity=='') {$containerQuantity=1;}

	$dt = new DateTime($initial_date);

$initial_date = $dt->format('Y-m-d');

$dt2 = new DateTime($expiration_date);

$expiration_date = $dt2->format('Y-m-d');



	

	 $consultaQuotations = mysqli_query($connect, "SELECT * FROM quotations ORDER BY id DESC LIMIT 1 ")
    or die ("Error al traer los Quotations");


     while ($rowQuotations = mysqli_fetch_array($consultaQuotations)){

        $quotationID=$rowQuotations['id'];
}

$queryQuotation = mysqli_query($connect, "INSERT INTO quotations(id, agent_name, client_name, initial_date, expiration_date, origin, destination, service, commodity, containerQuantity, remarks, agent_email) VALUES ('$quotationIDerase', '$agent_name', '$client_name', '$initial_date', '$expiration_date', '$origin', '$destination', '$service', '$commodity', $containerQuantity, '".nl2br($remarks)."'$agent_email )")or die ("Error");


$quotationID++;

	$byVolume_qty= $_POST['byVolume_qty'];
	$byVolume_volume= $_POST['byVolume_volume'];
	$byVolume_weight= $_POST['byVolume_weight'];
		

		if ($byVolume_qty!='') {

		$queryQuotationByVolume = mysqli_query($connect, "INSERT INTO quotationcontents(quotationID, byVolume_qty, byVolume_volume, byVolume_weight) 
                VALUES ('$quotationIDerase', '$byVolume_qty', '$byVolume_volume', '$byVolume_weight' )");

	}


	$byBoxes_qtyX= $_POST['byBoxes_qtyX'];
	$byBoxes_widthX= $_POST['byBoxes_widthX'];
	$byBoxes_lenghtX= $_POST['byBoxes_lenghtX'];
	$byBoxes_heightX= $_POST['byBoxes_heightX'];
	$byBoxes_weightX= $_POST['byBoxes_weightX'];
	$countBoxes=-1;

	foreach ($byBoxes_qtyX as $byBoxes_qtyX => $byBoxes_qty) {

		$countBoxes++;

		

		if ($byBoxes_qty!='') {

			echo $byBoxes_qty.' ['.$byBoxes_widthX[$countBoxes].'] <br>';

		$queryQuotationContents = mysqli_query($connect, "INSERT INTO quotationcontents(quotationID, byBoxes_qty, byBoxes_width, byBoxes_lenght, byBoxes_height, byBoxes_weight) 
                VALUES ('$quotationIDerase', '$byBoxes_qty', '$byBoxes_widthX[$countBoxes]', '$byBoxes_lenghtX[$countBoxes]', '$byBoxes_heightX[$countBoxes]', $byBoxes_weightX[$countBoxes] )");

	}
}




	


	$freightChargeX= $_POST['freightChargeX'];
	$freightDescX= $_POST['freightDescX'];
	$countFreight=-1;

	

	foreach ($freightChargeX as $freightChargeX => $freightCharge) {

		$countFreight++;

		

		if ($freightCharge!='') {

			echo $freightCharge.' ['.$freightDescX[$countFreight].'] <br>';

		$queryQuotationChargesx = mysqli_query($connect, "INSERT INTO quotationcharges(quotationID, quantity, charge, description, type) 
                VALUES ('$quotationIDerase', '1', '$freightCharge', '$freightDescX[$countFreight]', 'Freight Charges' )");

	}
}



	$originChargeX= $_POST['originChargeX'];
	$originDescX= $_POST['originDescX'];
	$countOrigin=-1;

	

	foreach ($originChargeX as $originChargeX => $originCharge) {

		$countOrigin++;

		if ($originCharge!='') {

			echo $originCharge.' ['.$originDescX[$countOrigin].'] <br>';

		$queryQuotationChargesx = mysqli_query($connect, "INSERT INTO quotationcharges(quotationID, quantity, charge, description, type) 
                VALUES ('$quotationIDerase', '1', '$originCharge', '$originDescX[$countOrigin]', 'Origin Charges')");

	}
}


	$destinationChargeX= $_POST['destinationChargeX'];
	$destinationDescX= $_POST['destinationDescX'];
	$countDestination=-1;


	

	foreach ($destinationChargeX as $destinationChargeX => $destinationCharge) {

		$countDestination++;

		if ($destinationCharge!='') {

			echo $destinationCharge.' ['.$destinationDescX[$countDestination].'] <br>';

		$queryQuotationChargesx = mysqli_query($connect, "INSERT INTO quotationcharges(quotationID, quantity, charge, description, type) 
                VALUES ('$quotationIDerase', '1', '$destinationCharge', '$destinationDescX[$countDestination]', 'Destination Charges')");

	}
}




 ?>