<?php 

include 'conn.php';
session_start();
$email = $_SESSION['username'];
$consultaAgent = mysqli_query($connect, "SELECT * FROM agents WHERE email='$email' ")
    or die ("Error al traer los Agent");
    while ($rowAgent = mysqli_fetch_array($consultaAgent)){

    $agent_name=$rowAgent['name'];
    $phone=$rowAgent['phone'];
    $picture=$rowAgent['picture'];
    $level=$rowAgent['level'];

    $noteBy=$rowAgent['name'];
    }
if(isset($_POST["editorder"]) && !empty($_POST["editorder"])){

 $jobId= $_POST['jobId'];
    $agent_name= $_POST['agent_name'];
    $customer_address= $_POST['customer_address'];
    $supplier_address= $_POST['supplier_address'];
    $customer_telf= $_POST['customer_telf'];
    $supplier_telf= $_POST['supplier_telf'];
    $service= $_POST['service'];
    $commodity= $_POST['commodity'];
    $remark= $_POST['remark'];
    $branch= $_POST['branch'];
    $wh_receipt= $_POST['wh_receipt'];
    $queryModel = mysqli_query($connect, "UPDATE joborders SET customer_address='$customer_address', supplier_address='$supplier_address', agent_name='$agent_name', service='$service', commodity='$commodity', wh_receipt='$wh_receipt', remark='$remark', customer_telf='$customer_telf', supplier_telf='$supplier_telf', branch='$branch' WHERE id='$jobId' ");

    if($queryModel){
        return true;
    }else{
        return false;
    }
}
if(isset($_POST["createnote"]) && !empty($_POST["createnote"])){

    $jobOrderId= $_POST['jobOrderId'];
    $note= $_POST['note'];
    $noteBy= $_POST['noteBy'];
    $agent_name= $_POST['agent_name'];
    $dt = new DateTime($fecha);
    $fecha = $dt->format('Y-m-d H:i:s');
    $queryModel = mysqli_query($connect, "INSERT INTO notes(agent_name, jobOrderId, note, fecha)  VALUES ('$noteBy', '$jobOrderId', '$note', '$fecha')");
       if($queryModel){
           return true;
       }else{
           return false;
       }
   }

if(isset($_POST["order_delete"]) && !empty($_POST["order_delete"])){

    $id= $_POST['jobId'];        
    $modifica= "DELETE FROM joborders WHERE id='$id'";
    $resultado = mysqli_query($connect, $modifica);
    if($resultado){
        return true;
    }else{
        return false;
    }
}

if(isset($_POST["status_Update"]) && !empty($_POST["status_Update"])){

    if(!empty($_POST["jobCheck"])){
            foreach($_POST["jobCheck"] as $jobCheck)
            {
                $dt = new DateTime($fecha);
                $fecha = $dt->format('Y-m-d H:i:s');
                $statusUpdate = $_POST["statusUpdate"];
                $queryModel = mysqli_query($connect, "UPDATE joborders SET status='$statusUpdate' WHERE id='$jobCheck' ") or die ('error');
                $queryModel = mysqli_query($connect, "INSERT INTO notes(agent_name, jobOrderId, note, fecha) VALUES ('$agent_name', '$jobCheck', 'Updated to:  $statusUpdate.', '$fecha')");
            }
        }
    return true;

}
if(isset($_POST["addwr"]) && !empty($_POST["addwr"])){

        $jobOrderId= $_POST['jobOrderId'];
        $wr= $_POST['wr'];
        $agent_name= $_POST['agent_name'];
        $dt = new DateTime($fecha);
        $fecha = $dt->format('Y-m-d H:i:s');
        $queryModel = mysqli_query($connect, "INSERT INTO receipt(jobOrderId, wr, fecha) VALUES ('$jobOrderId', '$wr', '$fecha')");
        $queryModel2222 = mysqli_query($connect, "UPDATE joborders SET status='IN WAREHOUSE' WHERE id='$jobOrderId' ") or die ('error');
        $queryModel2333 = mysqli_query($connect, "INSERT INTO notes(agent_name, jobOrderId, note, fecha)  VALUES ('$agent_name', '$jobOrderId', 'Updated to:  IN WAREHOUSE.', '$fecha')");
        return true;
        
}
if(isset($_POST["delete_wr"]) && !empty($_POST["delete_wr"])){
    $id= $_POST['jobId'];
    $modifica= "DELETE FROM receipt WHERE jobOrderId='$id'";
    $resultado = mysqli_query($connect, $modifica)   or die ("Error al insertar los registros");
    if($resultado){
        return true;
    }else{
        return false;
    }
}
if(isset($_POST["addtracking"]) && !empty($_POST["addtracking"])){

    $jobOrderId= $_POST['jobOrderId'];
    $tracking= $_POST['tracking'];
    $trackingBy= $_POST['trackingBy'];
    $carrier= $_POST['carrier'];
    $fecha = date('Y-m-d H:i:s');
    $queryModel = mysqli_query($connect, "INSERT INTO trackings(agent_name, jobOrderId, carrier,  tracking, fecha) 
      VALUES ('$trackingBy', '$jobOrderId', '$carrier', '$tracking', '$fecha')")  or die ("Error al insertar los registros");
    return true;
     
}
if(isset($_GET["delete_tracking"]) && !empty($_GET["delete_tracking"])){

    $trackingId= $_GET["delete_tracking"];
    $queryModel = mysqli_query($connect, "DELETE FROM trackings WHERE id='$trackingId'")  or die ("Error al insertar los registros");
    return true;
     
}


if(isset($_POST["create_quotation"]) && !empty($_POST["create_quotation"])){

    $jobOrderId= $_POST['jobOrderId'];
    $note= $_POST['note'];
    $noteBy= $_POST['noteBy'];
    $fecha = date('Y-m-d H:i:s');
    $queryModel = mysqli_query($connect, "INSERT INTO notes(agent_name, jobOrderId, note, fecha) 
    VALUES ('$noteBy', '$jobOrderId', '$note', '$fecha')");
       return true; 
   }
if(isset($_POST["edit_quotation"]) && !empty($_POST["edit_quotation"])){

    $id=$_POST['jobId'];
    $agent_name= $_POST['agent_name'];
    $agent_email= $_POST['agent_email'];
    $initial_date= $_POST['initial_date'];
    $expiration_date= $_POST['expiration_date'];
    $service= $_POST['service'];
    $remarks= $_POST['remarks'];
    $dt = new DateTime($initial_date);
    $initial_date = $dt->format('Y-m-d');
    $dt2 = new DateTime($expiration_date);
    $expiration_date = $dt2->format('Y-m-d');
    if(isset($_POST['containerQuantity']) && !empty($_POST['containerQuantity'])){
        $containerQuantity= $_POST['containerQuantity'];
    }else{
        $containerQuantity=1;
    }

    $queryModel = mysqli_query($connect, "UPDATE quotations SET agent_name = '".$agent_name."', 
                                                                initial_date = '".$initial_date."', 
                                                                expiration_date = '".$expiration_date."', 
                                                                service = '".$service."', 
                                                                containerQuantity = '".$containerQuantity."', 
                                                                remarks = '".$remarks."', 
                                                                agent_email = '".$agent_email."'  
                                                                WHERE id='".$id."'");

    if(isset($_POST['byVolume_qty']) && !empty($_POST['byVolume_qty'])){
        $queryModel = mysqli_query($connect, "DELETE FROM quotationcontents WHERE quotationID='$id' and type='By Volume'");    
        $byVolume_qty= $_POST['byVolume_qty'];
		$byVolume_volume= $_POST['byVolume_volume'];
		$byVolume_weight= $_POST['byVolume_weight'];
        $queryQuotationByVolume = mysqli_query($connect, "INSERT INTO quotationcontents(quotationID, byVolume_qty, byVolume_volume, byVolume_weight, type) 
        VALUES ('$id', '$byVolume_qty', '$byVolume_volume', '$byVolume_weight', 'By Volume' )");
            
    }
    if(isset($_POST['byBoxes_qtyX']) && !empty($_POST['byBoxes_qtyX'])){
        $queryModel = mysqli_query($connect, "DELETE FROM quotationcontents WHERE quotationID='$id' and type=''");  
        foreach($_POST['byBoxes_qtyX'] as $key=>$item){
            if($_POST['byBoxes_qtyX'][$key]){
                $queryQuotationContents = mysqli_query($connect, "INSERT INTO quotationcontents(quotationID, byBoxes_qty, byBoxes_width, byBoxes_lenght, byBoxes_height, byBoxes_weight) 
                VALUES ('$id', '".$_POST['byBoxes_qtyX'][$key]."', '".$_POST['byBoxes_widthX'][$key]."', '".$_POST['byBoxes_lenghtX'][$key]."', '".$_POST['byBoxes_heightX'][$key]."', '".$_POST['byBoxes_weightX'][$key]."' )");
 
            }
        }
    }
    $queryModel = mysqli_query($connect, "DELETE FROM quotationcharges WHERE quotationID='$id'");
    if(isset($_POST['freightid']) && !empty($_POST['freightid'])){
        
        foreach($_POST['freightid'] as $key=>$item){
            if($_POST['freightChargeX'][$key]){
                $queryModel = mysqli_query($connect, "INSERT INTO quotationcharges(quotationID,  charge, quantity, description, type) 
                VALUES ('$id', '".$_POST['freightChargeX'][$key]."', '".$_POST['freightChargeQX'][$key]."', '".$_POST['freightDescX'][$key]."', 'Freight Charges' )");
            }
        }
    }
    if(isset($_POST['originid']) && !empty($_POST['originid'])){        
        foreach($_POST['originid'] as $key=>$item){
            if($_POST['originChargeX'][$key]){
                $queryModel = mysqli_query($connect, "INSERT INTO quotationcharges(quotationID,  charge, quantity, description, type) 
                VALUES ('$id', '".$_POST['originChargeX'][$key]."', '".$_POST['originChargeQX'][$key]."', '".$_POST['originDescX'][$key]."', 'Origin Charges' )");
            }
        }
    }
    if(isset($_POST['destinationid']) && !empty($_POST['destinationid'])){        
        foreach($_POST['destinationid'] as $key=>$item){
            if($_POST['destinationChargeX'][$key]){
                $queryModel = mysqli_query($connect, "INSERT INTO quotationcharges(quotationID,  charge, quantity, description, type) 
                VALUES ('$id', '".$_POST['destinationChargeX'][$key]."', '".$_POST['destinationChargeQX'][$key]."', '".$_POST['destinationDescX'][$key]."', 'Destination Charges' )");
            }
        }
    }   
   echo true;
   }

if(isset($_POST["quotation_delete"]) && !empty($_POST["quotation_delete"])){
    $id= $_POST['jobId'];
    $resultado = mysqli_query($connect, "DELETE FROM quotations WHERE id='$id'")   or die ("Error al insertar los registros");
    $resultado2 = mysqli_query($connect, "DELETE FROM quotationcharges WHERE quotationID='$id'")   or die ("Error al insertar los registros");
    $resultado3 = mysqli_query($connect, "DELETE FROM quotationcontents WHERE quotationID='$id'")   or die ("Error al insertar los registros");
    return true;
    
}

if(isset($_POST["question_Update"]) && !empty($_POST["question_Update"])){

    if(!empty($_POST["jobCheck"])){
            foreach($_POST["jobCheck"] as $jobCheck)
            {
                $fecha = date('Y-m-d H:i:s');
                $statusUpdate = $_POST["statusUpdate"];
                $queryModel = mysqli_query($connect, "UPDATE joborders SET status='$statusUpdate' WHERE id='$jobCheck' ") or die ('error');
                $queryModel = mysqli_query($connect, "INSERT INTO notes(agent_name, jobOrderId, note, fecha) VALUES ('$agent_name', '$jobCheck', 'Updated to:  $statusUpdate.', '$fecha')");
            }
        }
    return true;

}
