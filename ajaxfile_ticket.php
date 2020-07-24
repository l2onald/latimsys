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
$type=$_POST['type'];
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
            name like '%".$item."%' or
            supplier like '%".$item."%' or 
            service like '%".$item."%' or 
            type like '%".$item."%' or 
            agent_name like '%".$item."%' or  
            service like '%".$item."%' or  
            status like '%".$item."%' or  
            fecha like '%".$item."%') ";
    }
}

## Total number of records without filtering
if ($level=='Seller' && $type=='PENDING') { 
    if ($to!='' && $from!='') {
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets where agent_email='$email' AND status='PENDING' AND DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' ORDER BY id ASC");
    }else{
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets where agent_email='$email' AND status='PENDING'  ORDER BY id ASC");   
    }
  }elseif($level=='Seller' && $type!='PENDING'){
    if ($to!='' && $from!='') {
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets where agent_email='$email'  AND DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' ORDER BY id ASC");
    }else{
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets where agent_email='$email'  ORDER BY id ASC");   
    }
    
}
if ($level=='Administrator' && $type=='PENDING') { 
    if ($to!='' && $from!='') {
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets where  status='PENDING' AND DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' ORDER BY id ASC");
    }else{
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets where status='PENDING' ORDER BY id ASC");   
    }
    }elseif($level=='Administrator' && $type!='PENDING'){
    if ($to!='' && $from!='') {
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets  where DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' ORDER BY id ASC"); 
    }else{
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets   ORDER BY id ASC");   
    }
    
}
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of records with filtering
if ($level=='Seller' && $type=='PENDING') {     
    if ($to!='' && $from!='') {
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets WHERE agent_email='$email' AND status='PENDING' AND DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' and 1 ".$searchQuery." ORDER BY id ASC");
    }else{
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets WHERE agent_email='$email' AND status='PENDING' and 1 ".$searchQuery." ORDER BY id ASC");   
    }  
  }elseif($level=='Seller' && $type!='PENDING'){
    if ($to!='' && $from!='') {
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets WHERE agent_email='$email'  AND DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' and 1 ".$searchQuery." ORDER BY id ASC");
    }else{
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets WHERE agent_email='$email'  and 1 ".$searchQuery." ORDER BY id ASC");   
    }  
    
}
if ($level=='Administrator' && $type=='PENDING') {   
    if ($to!='' && $from!='') {
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets WHERE status='PENDING' AND DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' and 1 ".$searchQuery." ORDER BY id ASC");   
    
    }else{
        $sel = mysqli_query($connect,"select count(*) as allcount from tickets WHERE status='PENDING' AND 1 ".$searchQuery." ORDER BY id ASC");   
    }
    }elseif($level=='Administrator' && $type!='PENDING'){
        if ($to!='' && $from!='') {
            $sel = mysqli_query($connect,"select count(*) as allcount from tickets WHERE  DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' and 1 ".$searchQuery." ORDER BY id ASC");   
        
        }else{
            $sel = mysqli_query($connect,"select count(*) as allcount from tickets WHERE  1 ".$searchQuery." ORDER BY id ASC");   
        }
    
}


$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];
## Fetch records
if ($level=='Seller' && $type=='PENDING') {     
    if ($to!='' && $from!='') {
        $empQuery = "select * from tickets WHERE agent_email='$email' AND status='PENDING' AND DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' and 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;

    }else{
        $empQuery = "select * from tickets WHERE agent_email='$email' AND status='PENDING' and 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    }  
  }elseif($level=='Seller' && $type!='PENDING'){
    if ($to!='' && $from!='') {
        $empQuery = "select * from tickets WHERE agent_email='$email'  AND DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' and 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;

    }else{
        $empQuery = "select * from tickets WHERE agent_email='$email'  and 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
    }
    
}
if ($level=='Administrator' && $type=='PENDING') {   
        if ($to!='' && $from!='') {
            $empQuery = "select * from tickets WHERE status='PENDING' AND DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' and 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;    

        }else{
            $empQuery = "select * from tickets WHERE status='PENDING' AND 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;    
        }

    }elseif($level=='Administrator' && $type!='PENDING'){
        if ($to!='' && $from!='') {
            $empQuery = "select * from tickets WHERE  DATE_FORMAT(`fecha`,'%Y-%m-%d') BETWEEN '$from' and '$to' and 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;    
    
        }else{
            $empQuery = "select * from tickets WHERE  1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;    
        }
    
}

$empRecords = mysqli_query($connect, $empQuery);
$data = array();


while ($row = mysqli_fetch_assoc($empRecords)) {
    $tipo = $row['type'];

    $supplier = $row['supplier'];
    $warehouse_receipt = $row['warehouse_receipt'];
    $tracking_number = $row['tracking_number'];

    if ($row['status']=='READY TO CONTACT') {$status='<button type="buton" class="btn btn-sm btn-info"><i class="fa fa-info"></i> '.$row['status'].'</button>';}
    elseif ($row['status']=='PENDING' OR $row['status']=='CANCELED' OR $row['status']=='CHECK NOTES') {$status='<button type="buton" class="btn btn-sm btn-danger"><i class="fa fa-warning"></i> '.$row['status'].'</button>';}
    elseif ($row['status']=='SHIPPED') {$status='<button type="buton" class="btn btn-sm btn-info"><i class="fa fa-info"></i> '.$row['status'].'</button>';}
    elseif ($row['status']=='SOLVED') {$status='<button type="buton" class="btn btn-sm btn-success"><i class="fa fa-check"></i> '.$row['status'].'</button>';}
    elseif ($row['status']=='CARGO SENT') {$status='<button type="buton" class="btn btn-sm btn-success"><i class="fa fa-check"></i> '.$row['status'].'</button>';}
   
    if ($row['service']=='Air door to door' OR $row['service']=='Air Service') {$service_img='<i class="fa fa-plane" style="font-size:24px;"></i>';}
    elseif ($row['service']=='Ocean door to door' OR $row['service']=='Ocean Service') {$service_img='<i class="fa fa-ship" style="font-size:24px;"></i>';}
    elseif ($row['service']=='Pending') {$service_img='<i class="fa fa-hourglass-2" style="font-size:24px;"></i>';}
    else{$service_img='';}
    $service=$service_img.'<br>'.$row['service'];
    if($tipo=='warehouse'){
        $type='<span>Warehouse Inquiry</span><br>';
        $type.=' <a href="https://latim.cargotrack.net/appl2.0/warehouse/detail.asp?id='.$warehouse_receipt.'&redir=../accounts/warehouse.asp?id=&redir_id=738" name="submitViewWR" target="blank">
        <i class="fa fa-barcode" style="font-size: 36px;color: #000;"></i><br><button type="button" class="btn btn-sm" style="color:#000">WR #'.$warehouse_receipt.'</button></a>';
    }else{
        $type='<span style="color:#CC0000;">Missing Cargo</span><br><span>Tracking: <br>['.$tracking_number.'].</span>';
    }
    if(in_array($row["id"], $jobCheckval, true)){
        $action = '<input type="checkbox" name="jobCheck[]" checked  value="'.$row['id'].'" style="transform : scale(1.5);">';
    }else{
        $action = '<input type="checkbox" name="jobCheck[]"  value="'.$row['id'].'" style="transform : scale(1.5);">';
    }
   
    $result = $connect->query("SELECT COUNT(*) AS total FROM notes WHERE jobOrderId='".$row["id"]."'")->fetch_array();
    if($result[0]!='0'){
        $brage='<span class="label label-success brage">'.$result[0].'</span>';
    }else{
        $brage=''; 
    }
    $shortcut = '<a href="#" onclick="editticket('.$row['id'].')"><i class="fa fa-search-plus" style="color: #B80008;font-size: 24px;"></i></a>';
   
    
    $agent='<i class="fa fa-user" style="font-size:25px;"></i><br><span>'.$row['agent_name'].'</span>';
    if ($agent=='') {$agent=' ';}
    
        $data[] = array(
                "fecha"=>$row['fecha'],
                "id"=>$row['id'],
                "name"=>utf8_encode($row['name']),
                "supplier"=>utf8_encode($row['supplier']),
                "type"=>$type,
                "service"=>$service,
                "agent_name"=>$agent,
                "status"=>$status,
                "shortcut"=>$shortcut,
                "action"=>$action
            );
}

## Response
$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data,
    "staus" => $level
);

echo json_encode($response);