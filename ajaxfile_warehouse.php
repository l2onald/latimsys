<?php
include 'conn.php';
session_start();
$email = $_SESSION['username'];
 $consultaAgent = mysqli_query($connect, "SELECT * FROM agents WHERE email='$email' ")
or die ("Error al traer los Agent");
while ($rowAgent = mysqli_fetch_array($consultaAgent)){  
$level=$rowAgent['level'];

} 
## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = $_POST['search']['value']; // Search value
$from=$_POST['from'];
$to=$_POST['to'];

$serach_text="";
if(isset($_POST['fecha']) && !empty($_POST['fecha'])){
    $serach_text.=" and fecha like '%".$_POST['fecha']."%' ";
}
if(isset($_POST['tracking']) && !empty($_POST['tracking'])){
    $serach_text.=" and tracking like '%".$_POST['tracking']."%' ";
}
if(isset($_POST['supplier_id']) && !empty($_POST['supplier_id'])){
    $serach_text.=" and supplier_id like '%".$_POST['supplier_id']."%' ";
}
if(isset($_POST['consignee_id']) && !empty($_POST['consignee_id'])){
    $serach_text.=" and fecha like '%".$_POST['fecha']."%' ";
}
if(isset($_POST['consignee_id']) && !empty($_POST['consignee_id'])){
    $serach_text.=" and consignee_id like '%".$_POST['consignee_id']."%' ";
}
if(isset($_POST['agent_id']) && !empty($_POST['agent_id'])){
    $serach_text.=" and agent_id like '%".$_POST['agent_id']."%' ";
}
if(isset($_POST['bill_id']) && !empty($_POST['bill_id'])){
    $serach_text.=" and bill_id like '%".$_POST['bill_id']."%' ";
}
if(isset($_POST['reference_id']) && !empty($_POST['reference_id'])){
    $serach_text.=" and reference_id like '%".$_POST['reference_id']."%' ";
}
if(isset($_POST['invoice']) && !empty($_POST['invoice'])){
    $serach_text.=" and invoice like '%".$_POST['invoice']."%' ";
}
if(isset($_POST['delivered_by1']) && !empty($_POST['delivered_by1'])){
    $serach_text.=" and delivered_by1 like '%".$_POST['delivered_by1']."%' ";
}
if(isset($_POST['branch']) && !empty($_POST['branch'])){
    $serach_text.=" and branch like '%".$_POST['branch']."%' ";
}
if(isset($_POST['pickup_number']) && !empty($_POST['pickup_number'])){
    $serach_text.=" and pickup_number like '%".$_POST['pickup_number']."%' ";
}
if(isset($_POST['location1']) && !empty($_POST['location1'])){
    $serach_text.=" and location1 like '%".$_POST['location1']."%' ";
}
if(isset($_POST['location2']) && !empty($_POST['location2'])){
    $serach_text.=" and location2 like '%".$_POST['location2']."%' ";
}
if(isset($_POST['can']) && !empty($_POST['can'])){
    $serach_text.=" and can like '%".$_POST['can']."%' ";
}
if(isset($_POST['instination1']) && !empty($_POST['instination1'])){
    $serach_text.=" and instination1 like '%".$_POST['instination1']."%' ";
}
if(isset($_POST['destination']) && !empty($_POST['destination'])){
    $serach_text.=" and destination like '%".$_POST['destination']."%' ";
}
if(isset($_POST['instination2']) && !empty($_POST['instination2'])){
    $serach_text.=" and instination2 like '%".$_POST['instination2']."%' ";
}
if(isset($_POST['dangerous_goods']) && !empty($_POST['dangerous_goods'])){
    $serach_text.=" and dangerous_goods like '%".$_POST['dangerous_goods']."%' ";
}
if(isset($_POST['seo']) && !empty($_POST['seo'])){
    $serach_text.=" and seo like '%".$_POST['seo']."%' ";
}
if(isset($_POST['insurance']) && !empty($_POST['insurance'])){
    $serach_text.=" and insurance like '%".$_POST['insurance']."%' ";
}
if(isset($_POST['fragile']) && !empty($_POST['fragile'])){
    $serach_text.=" and fragile like '%".$_POST['fragile']."%' ";
}
if(isset($_POST['jobCheckval']) && !empty($_POST['jobCheckval'])){
    $jobCheckval=$_POST['jobCheckval'];
}else{
    $jobCheckval=[];
}

## Search 
$searchQuery = " ";
if($searchValue != ''){
     
    $filter_arr=explode(" ", $searchValue);
    foreach($filter_arr as $key=>$item1){    
        $accented_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E','Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U','Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c','è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o','ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y' );

            $item = strtr( $item1, $accented_array );
            $searchQuery.= " and (id like '%".$item."%' or 
            total_pieces like '%".$item."%' or
            total_weight like '%".$item."%' or 
            total_volume like '%".$item."%' or 
            value like '%".$item."%' or 
            reference_id like '%".$item."%' or  
            destination like '%".$item."%' or  
            status like '%".$item."%' or  
            fecha like '%".$item."%' ) ";
    }
}

## Total number of records without filtering
if ($to!='' && $from!='') {
    $sel = mysqli_query($connect,"select count(*) as allcount from warehouse where 1  ".$serach_text." and  DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' ORDER BY id ASC");
}else{
    $sel = mysqli_query($connect,"select count(*) as allcount from warehouse where 1  ".$serach_text." ORDER BY id ASC");   
}

$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
    if ($to!='' && $from!='') {
        $sel = mysqli_query($connect,"select count(*) as allcount from warehouse WHERE 1  ".$serach_text." and DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' and 1 ".$searchQuery." ORDER BY id ASC");
    }else{
        $sel = mysqli_query($connect,"select count(*) as allcount from warehouse WHERE  1 ".$serach_text." ".$searchQuery." ORDER BY id ASC");   
    }

$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records

if ($to!='' && $from!='') {
    $empQuery = "select * from warehouse WHERE 1  ".$serach_text." and DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' and 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;

}else{
    $empQuery = "select * from warehouse WHERE  1  ".$serach_text." ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
}
$empRecords = mysqli_query($connect, $empQuery);
$data = array();


while ($row = mysqli_fetch_assoc($empRecords)) {

//    $status=$row['status'];
//     if ($row['status']=='IN WAREHOUSE') {$status='<div style="font-weight:600; font-size:9px; color:white; padding:5px;width:80px; border:0.5px solid gray; background:#00a75a; ">'.$status.'</div>';}
//     elseif ($row['status']=='PENDING') {$status='<div style="font-weight:600; font-size:9px; color:white; padding:5px;width:80px; border:0.5px solid gray; background:#db4c39; ">'.$status.'</div>';}
//     elseif ($row['status']=='READY TO CONTACT') {$status='<div style="font-weight:600; font-size:9px; color:white; width:80px; padding:5px; border:0.5px solid gray; background:#00c2f0; ">'.$status.'</div>';}
//     elseif ($row['status']=='CHECK NOTES') {$status='<div style="font-weight:600; font-size:9px; color:purple; padding:5px;width:80px; border:0.5px solid gray; background:#a62c0d8; ">'.$status.'</div>';}
//     else{$status='<div style="font-weight:600; color:black;">'.$status.'</div>';}
//     $shipping = $row['customer_city'].'<br><img src="./img/venezuela.png" style="width:40px;">';
//     $service=$row['service'];
//     if ($service=='') {$service=' ';}
//     elseif ($service=='Air Service') {$service_img='<span style="position:relative; top:-5px;"><img src="./img/air.png" style="width:40px; position:relative; top:10px;"><br>';}
//     elseif($service=='Ocean Service') {$service_img='<span style="position:relative; top:-5px;"><img src="./img/ocean.png" style="width:40px; position:relative; top:10px;"><br>';}
//     else{ $service_img='<span style="position:relative; top:0px;"><img src="./img/pending.png" style="width:20px; position:relative; top:4px;"><br>';}
//     $service = ' '.$service_img.$row['service'].'</span>';
//     $t = strtotime($row['fecha']); date('d/m/y',$t);
//     if(in_array($row["id"], $jobCheckval, true)){
//         $action = '<input type="checkbox" name="jobCheck[]" checked  value="'.$row['id'].'" style="transform : scale(1.5);">';
//     }else{
//         $action = '<input type="checkbox" name="jobCheck[]"  value="'.$row['id'].'" style="transform : scale(1.5);">';
//     }
   
//     $supplier_company = $row['supplier_company'];
//     $attr= "left=20,top=20,width=900,height=700,toolbar=1,resizable=0";
//     $result = $connect->query("SELECT COUNT(*) AS total FROM notes WHERE jobOrderId='".$row["id"]."'")->fetch_array();
//     if($result[0]!='0'){
//         $brage='<span class="label label-success brage">'.$result[0].'</span>';
//     }else{
//         $brage=''; 
//     }
//     $shortcut = '<a href="#" onclick="editJobOrder('.$row['id'].')"><i class="fa fa-edit action"></i></a><a href="#" onclick="viewNotes('.$row['id'].')"><i class="fa fa-file-o action"></i>'.$brage.'</a><a href="./downloadPDF.php?id='.$row['id'].'"    target="blank"><i class="fa fa-file-pdf-o action"></i></a>';
//     $wr='';
//     $consultaWR = mysqli_query($connect, "SELECT * FROM receipt WHERE jobOrderId='".$row['id']."' order by id desc limit 1 ") or die ("Error al traer los Agent");
//         while ($rowWR = mysqli_fetch_assoc($consultaWR)){
//             $WHReceipt=$rowWR['wr'];
//             $wr.='<a href="https://latim.cargotrack.net/appl2.0/warehouse/detail.asp?id='.$WHReceipt.'&redir=../accounts/warehouse.asp?id=&redir_id=738" target="blank"><i class="fa fa-barcode" style="font-size: 30px;color: black;"></i></a><p>WR#'.$WHReceipt.'</p>';
//         }
//         $wr.='<a onclick="addwr('.$row['id'].')" href="#"><button type="button" class="btn btn-secondary btn-sm" style="color:black">ADD WR</button></a>';
//     $customer=$row['customer_name'];
//     if ($customer=='') {$customer=' ';}

//     $trackingJob= $row['tracking'];
//     $tracking='<span style="font-size:10px; font-weight:600;">';
//     if($trackingJob!=''){
//         $tracking.="Tracking J.O:".$trackingJob."<br>";
//     }else{
//         $tracking.=$trackingJob."<br>";
//     }
//     $consultatrackings = mysqli_query($connect, "SELECT * FROM trackings WHERE jobOrderId='".$row['id']."' ORDER BY id DESC ") or die ("Error al traer los datos");

//     while ($rowtrackings = mysqli_fetch_array($consultatrackings)){  

//         $tracking_text= $rowtrackings['tracking'];
//         $carrier= $rowtrackings['carrier']; 
//         $tracking.=$carrier.': '.$tracking_text.".<br>";

//     }
//     $tracking.='</span><a onclick="addtracking('.$row['id'].')" href="#"><button type="button" class="btn btn-secondary btn-sm" style="color:black">+Tracking</button></a>';

//     $agent=$row['agent_name'];
        $t = strtotime($row['fecha']); date('d/m/y',$t);
        $data[] = array(
                "fecha"=>date('m/d/Y',$t),
                "id"=>$row['id'],
                "destination"=>$row['destination'],
                "supplier_id"=>$row['supplier_id'],
                "consignee_id"=>$row['consignee_id'],
                "total_pieces"=>$row['total_pieces'],
                "total_weight"=>$row['total_weight'],
                "total_volume"=>$row['total_volume'],
                "value"=>$row['value'],
                "reference_id"=>$row['reference_id'],
                "status"=>$row['status'],
                "status_ele"=>$row['status'],
            );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);