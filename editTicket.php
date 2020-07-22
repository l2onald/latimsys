<?php 


error_reporting(0);
session_start();

require_once('conn.php');


// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

$email = $_SESSION['username'];



 $consultaAgent = mysqli_query($connect, "SELECT * FROM agents WHERE email='$email' ")
    or die ("Error al traer los Agent");
     while ($rowAgent = mysqli_fetch_array($consultaAgent)){
        $agent_name=$rowAgent['name'];
        $phone=$rowAgent['phone'];
        $picture=$rowAgent['picture'];
        $level=$rowAgent['level'];
        $noteBy=$rowAgent['name'];
        $customer_address= $row['customer_address']; 
        $supplier_address= $row['supplier_address'];
        $customer_cityCountry = explode(" | ", $customer_address);
        $customer_cityCountry = $customer_cityCountry[1];
        $customer_Country = explode(" - ", $customer_cityCountry);
        $customer_Country = $customer_Country[1];
     } 
$from= $_GET['from'];

if ($from!='') {

$tFrom = strtotime($from);

$from1day = strtotime('-1 day', $tFrom);
   
$from=date('Y/m/d',$from1day);
}

$to= $_GET['to'];

if ($to!='') {
$tTo = strtotime($to);

$to1day = strtotime('+1 day', $tTo);
$to=date('Y/m/d',$to1day);
}

$dt = new DateTime($fecha);

$fecha = $dt->format('Y-m-d H:i:s');


$id= $_GET['id'];
$ticket_id=$id;

$YesNo= $_POST['YesNo'];

$update= $_POST['update'];

$change_ticket= $_POST['change_ticket'];

$service= $_POST['service'];


$client = $_POST['client'];
$job_order = $_POST['job_order'];
$notes = $_POST['notes'];
$warehouse_receipt = $_POST['warehouse_receipt'];
$supplier = $_POST['supplier'];
$supplier_phone = $_POST['supplier_phone'];
$supplier_address = $_POST['supplier_address'];

$tracking_number = $_POST['tracking_number'];
$change_photo = $_POST['change_photo'];

$message = $_POST['message'];


  
if ($YesNo=='SOLVED') {

   $queryModel = mysqli_query($connect, "UPDATE tickets SET status='SOLVED' WHERE id='$ticket_id' ")
or die ("<meta http-equiv=\"refresh\" content=\"0;URL= createAccount.php?message=ErrorSavingAccount\">");

$queryModel = mysqli_query($connect, "INSERT INTO ticket_notes(agent_name, ticket_id, note, fecha) 
                VALUES ('$agent_name', '$ticket_id', 'Ticket Status Updated: SOLVED.', '$fecha')");

echo('<script language="Javascript">opener.window.location.reload(false); window.close();</script>');
}

if ($YesNo=='PENDING') {

   $queryModel = mysqli_query($connect, "UPDATE tickets SET status='PENDING' WHERE id='$ticket_id' ")
or die ("<meta http-equiv=\"refresh\" content=\"0;URL= createAccount.php?message=ErrorSavingAccount\">");

$queryModel = mysqli_query($connect, "INSERT INTO ticket_notes(agent_name, ticket_id, note, fecha) 
                VALUES ('$agent_name', '$ticket_id', 'Ticket Status Updated: PENDING.', '$fecha')");

echo('<script language="Javascript">opener.window.location.reload(false); window.close();</script>');

}





if ($change_ticket=='missing') {

   $queryModel = mysqli_query($connect, "UPDATE tickets SET type='missing' WHERE id='$ticket_id' ")
or die ("<meta http-equiv=\"refresh\" content=\"0;URL= createAccount.php?message=ErrorSavingAccount\">");

$queryModel = mysqli_query($connect, "INSERT INTO ticket_notes(agent_name, ticket_id, note, fecha) 
                VALUES ('$agent_name', '$ticket_id', 'Ticket Type Updated: Missing Ticket.', '$fecha')");

}

if ($change_ticket=='warehouse') {

   $queryModel = mysqli_query($connect, "UPDATE tickets SET type='warehouse' WHERE id='$ticket_id' ")
or die ("<meta http-equiv=\"refresh\" content=\"0;URL= createAccount.php?message=ErrorSavingAccount\">");

$queryModel = mysqli_query($connect, "INSERT INTO ticket_notes(agent_name, ticket_id, note, fecha) 
                VALUES ('$agent_name', '$ticket_id', 'Ticket Type Updated: Warehouse Ticket.', '$fecha')");


}



if ($update=='yes') {

if ($warehouse_receipt!='') {
  $message='WarehouseUploaded';
}



   $queryModel = mysqli_query($connect, "UPDATE tickets SET name='$client', job_order='$job_order', service='$service', supplier='$supplier', supplier_phone='$supplier_phone', supplier_address='$supplier_address',  warehouse_receipt='$warehouse_receipt', notes='$notes' WHERE id='$ticket_id' ");

   echo('');

}

if ($change_photo=='yes') {




  $consulta_ticket = mysqli_query($connect, "SELECT * FROM tickets ORDER BY id DESC LIMIT 1");

     $num_rows_ticket = mysqli_num_rows($consulta_ticket);

if($num_rows_ticket==0)
{
  $ticket=1;
  $mensaje='No existen Tickets';
}
else
{

  while ($extraido_ticket = mysqli_fetch_array($consulta_ticket)) {

        $ticket= $extraido_ticket['id'];
        
    }

  $ticket=$ticket+1;
}


  $ruta="../images/Tickets/";//ruta carpeta donde queremos copiar las imágenes 
    
    $uploadfile_temporal1=$_FILES['image']['tmp_name'];
    $extension1 = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

    if ($uploadfile_temporal1=='') {
    }else{
    $uploadfile_nombre1=$ruta.$ticket.'-1.'.$extension1; 


    if (is_uploaded_file($uploadfile_temporal1)) 
    { 
        move_uploaded_file($uploadfile_temporal1,$uploadfile_nombre1); 
    } 
    else 
    { 
    echo "error"; 
    } 
}



   $queryModel = mysqli_query($connect, "UPDATE tickets SET tracking_number='$tracking_number', imagen1='$uploadfile_nombre1' WHERE id='$ticket_id' ")
or die ("<meta http-equiv=\"refresh\" content=\"0;URL= editTicket.php?message=ErrorSavingAccount\">");

echo('');

}

 
 

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>

  <!-- Latim style -->
  <link rel="stylesheet" href="latimstyle.css">

  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/select2.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">

</head>
<body>

<?php

$consulta2 = mysqli_query($connect, "SELECT * FROM tickets WHERE id='$id' ORDER BY id asc ") or die ("Error al traer los datos222");
                  

    while ($row = mysqli_fetch_array($consulta2)){  

                $jobId = $row['id'];
                $customer_company= $row['customer_company'];
                $customer_name= $row['customer_name']; 
                $customer_telf= $row['customer_telf'];
                $supplier_telf= $row['supplier_telf'];
                $branch= $row['branch'];

                $service= $row['service'];


                $customer_address= $row['customer_address']; 
                $supplier_address= $row['supplier_address']; 

                $service= $row['service'];
                $commodity= $row['commodity'];
                $wh_receipt= $row['wh_receipt'];
                $remark= $row['remark'];
                $customer_if = $row['customer_name'];



                $imagen1 = $row['imagen1'];
                $imagen2 = $row['imagen2'];
                $imagen3 = $row['imagen3'];

                $type = $row['type'];
                $notes = $row['notes'];
                $client= $row['name'];
                $job_order= $row['job_order'];

                $supplier= $row['supplier'];
                $supplier_phone= $row['supplier_phone'];
                $supplier_address= $row['supplier_address'];

                $tracking_number = $row['tracking_number'];
                $warehouse_receipt = $row['warehouse_receipt'];

                $status= $row['status'];


                          if ($customer_company!='') { $customer_if .= ', '.$customer_company; }else{}


                         ?>
                <?php $supplier_company= $row['supplier_company'];
                $supplier_name= $row['supplier_name']; 

                $supplier_if = $row['supplier_name'];

                          if ($supplier_company!='') { $supplier_if .= ', '.$supplier_company; }else{} }?>

<script>
function ConfirmDelete() {
  return confirm("Are you sure you want to delete?");
}
</script>

  <!-- Modal Edit-->
        <div>
            <div class="modal-dialog">
                <!-- Modal content -->
                <div class="modal-content" style="width:1400px; position:relative; height:730px; margin-top:-20px; left:50%; margin-left:-700px;" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="font-size:18px; display:inline-block;"><span style="font-weight:600;">Inquiry</span> Ticket #<?php echo $id;?> </h4>

                        <?php if ($update=='yes'){ ?>
                  <br>
                  <div id="mydiv" style="background-color: rgba(0, 127, 70, 1); padding:20px;color:white; position:absolute; left:50%; width:300px; margin-left:140px; top:80px;">
                    <center>
                      <span style="font-style: oblique; ">Ticket has been updated.</span>
                    </center>
                  </div>
                  <script type="text/javascript">
    setTimeout(fade_out, 3000);

function fade_out() {
  $("#mydiv").fadeOut().empty();
}
</script>
<?php }else{ ?>

<?php } ?>


                        <h4 class="modal-title" style="font-size:18px; display:inline-block; position:relative; left:150px;"><span style="font-weight:600;">Inquiry Type:</span> <?php if ($type=='missing'){ ?>
                          Missing Cargos <span style="font-size:12px; color:red; font-weight:600;">[Find Warehouse Receipt Number]</span>
                        <?php }else{ ?>Warehouse Receipt Inquiry <span style="font-size:12px; color:red; font-weight:600;">[Resolve the problem using notes in the right area]</span><?php } ?>.</h4>




                        <div class="input-group" style="position:absolute; background:#D85050; width:300px; right:80px; padding:5px; border:1px solid gray; top:0px; margin-top:0px;">
                    <h2 style="font-size:11px; color:white; font-weight:400; margin-top:0px; "><center>Change Ticket</center></h2>

                    <center>
<form method="POST" style="font-size:11px;" name="form3" id="form3">
<input type="text" name="id" style="display:none;" value="<?php echo $ticket_id; ?>">
<label>
<input id="missing" type="radio" name="change_ticket"  class="ron-red" value="missing" onclick="this.form.submit();" <?php if ($type=='missing'){ ?> checked <?php } ?>>
<label style="font-weight:400; color:white;" for="missing">Missing Cargo</label>
</label>

<label style="margin-left:20px;">
<input id="warehouse" type="radio" name="change_ticket"  class="ron-red" value="warehouse" onclick="this.form.submit();" <?php if ($type=='warehouse'){ ?> checked <?php } ?>>
<label style="font-weight:400;  color:white;" for="warehouse">Warehouse Inquiry</label>
</label>
</form>



</center>

                  </div>

                        <form method="post">

                        <input style="display:none;" type="text" name="jobId" value="<?php echo $id;?>">

                        <input Onclick="return ConfirmDelete()" type="submit"value="Delete" name="submitDeleteJobOrder" class="deleteAccountBtn" style="position:absolute; left:190px; top:15px;">
</form>
<?php
    if(isset($_POST["submitDeleteJobOrder"]))
          {
              $id= $_POST['jobId'];
  
  $modifica= "DELETE FROM tickets WHERE id='$id'";

  $resultado = mysqli_query($connect, $modifica)
  or die ("Error al insertar los registros");

  mysqli_close($connect);
  echo "<script type='text/javascript'>opener.location.reload(); //This will refresh parent window.
window.close(); //Close child window. You may also use self.close();</script>";

         }
?>





                    </div>
                    <div class="modal-body">

<div style="width:25%; padding:20px; margin-top:-100px; top:100px; position:relative; height: 600px; overflow-y: scroll; overflow-x:; display:inline-block; ">   
<form action="action/saveEditPhoto.php" method="post" enctype="multipart/form-data">
  <input type="text" name="id" style="display:none;" value="<?php echo $ticket_id; ?>">
<input type="name" style="display:none;" name="change_photo" value="yes">
          <h3 style="text-align:center; color:black; font-weight:600; margin-top:-40px; padding:30px; border-bottom:1px solid #555555;"><br>
            <span style="font-size:30px; top:10px; left:40px;" class="glyphicon glyphicon-paperclip"></span><span style="font-size:18px;color:#B80008; font-weight:600; position:relative; top:25px; left:-15px;"><span style="color:black;"><?php if ($type=='missing'){ ?>Tracking<?php }else{ ?>  Photos<?php } ?></span>
            </span>
          </h3>

                  <?php if ($type=='missing'){ ?>


                    <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#EFEFEF;"><i style="width:20px;" class="fa fa-barcode"></i></span>
                    <input name="tracking_number" type="text" class="form-control" placeholder="Tracking Number" value="<?php echo $tracking_number; ?>">
                  </div>



                  <?php }else{ ?><?php } ?>

                  <div class="form-group has-feedback" style="margin-top:10px;">
                  <label>Change File/Photo ↓</label>
                  <input name="image" class="form-control" type="file">
                  <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:22px;"></span>

                </div>
       
       <center>
                  <div class="input-group" style="position:relative; top:45px;">
                    <input type="submit"value="Save" class="form_1_submit" style="position:relative; font-weight:400;<?php if ($type=='missing'){ ?><?php }else{ ?><?php } ?>  width:90px;   height:40px; background:#007F46;">
                  </div>
                  </center>


</form>
                  <style type="text/css">
                    /* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 99999; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 3% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
.container {
  position: relative;
  width: 50%;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  width: 300px;
  opacity: 0;
  transition: .5s ease;
  background-color: #000;
  left:15px;
}

.container:hover .overlay {
  opacity: 0.5;
}

.text {
  color: white;
  font-size: 20px;
  position: absolute;
  top: 10%;
  left: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  text-align: center;
}
                  </style>

               <a id="myBtn"><div class="container img-wrapper input-group img-magnifier-container" style="margin-top:20px; cursor:pointer; margin-left:-35px; z-index:999; ">
                    <img id="myimage" style="width:300px;" src="images/<?php echo $imagen1; ?>">
                    <div class="overlay">
                      <div class="text"><span style="font-size:18px;">Click to Full Size</div>
                    </div>
                  </div></a>   

                  <div id="myModal" class="modal">

  <!-- Modal content -->

    <div class="modal-content input-group img-magnifier-container" style="margin-top:20px; width:700px;">
                    <img id="myimage" style="width:700px;" src="images/<?php echo $imagen1; ?>">
                  </div>


</div>

                  



                  <script type="text/javascript">
                    // Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
                  </script>

<script>
/* Execute the magnify function: */
magnify("myimage", 3);
/* Specify the id of the image, and the strength of the magnifier glass: */
</script>


      </div>


<div style="width:30%; padding:20px; top:100px; position:relative; margin-top:-80px; height:600px; overflow-y: scroll; overflow-x:; display:inline-block; ">   
    
      <span style="font-size:30px; color:black; position:absolute; top:25px; left:185px; " class="glyphicon glyphicon-listxx"></span>

          <h3 style="text-align:center; color:black; font-weight:600; padding:30px; margin-top:-33px; border-bottom:1px solid #555555;"><br>

              <span style="font-size:18px;color:#B80008; font-weight:600; position:relative; top:25px; left:0px;"><span style="color:black;">Inquiry Information</span>
              </span>
          </h3>




                  

                    <div class="input-group" style="position:absolute; background:#D85050; width:150px; left:123px; padding:5px; border:1px solid gray; top:0px; margin-top:0px;">
                    <h2 style="font-size:14px; color:white; font-weight:400; margin-top:0px; "><center>Inquiry solved?</center></h2>

                    <center>
                      <form method="POST" name="form2" id="form2">
                      <input type="text" name="id" style="display:none;" value="<?php echo $ticket_id; ?>">
                      <label>
                      <input id="rNo" type="radio" name="YesNo"  class="ron-red" value="PENDING" onclick="this.form.submit();" <?php if ($status=='PENDING'){ ?> checked <?php } ?>>
                      <label style="font-weight:400; color:white;" for="rNo">No</label>
                      </label>

                      <label style="margin-left:20px;">
                      <input id="rYes" type="radio" name="YesNo"  class="ron-red" value="SOLVED" onclick="this.form.submit();" <?php if ($status=='SOLVED'){ ?> checked <?php } ?>>
                      <label style="font-weight:400;  color:white;" for="rYes">Yes</label>
                      </label>
                      </form>



</center>

                  </div>

                  <form method="post">

                    <input type="name" name="update" style="display:none;" value="yes">



                    <input type="name" name="jobId" style="display:none;" value="<?php echo $jobId; ?>">

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#EFEFEF;"><i style="width:65px; " class="fa fa-editxx">client</i></span>
                    <input name="client" type="text" class="form-control" placeholder=""  value="<?php echo $client; ?>">
                  </div>       

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#EFEFEF; "><i style="width:65px; " class="fa fa-editxx">job order</i></span>
                    <input name="job_order" type="text" class="form-control" placeholder=""  value="<?php echo $job_order; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-plane"></i></span>
                  <select data-placeholder="Select Service" name="service" class="form-control select2" style="width:100%;" required="">
                      <option value="<?php echo $service; ?>"><?php echo $service; ?></option>
                      <?php if ($service!='Air Service'){ ?>
                      <option value="Air Service">Air Service</option>
                      <?php } ?>

                      <?php if ($service!='Ocean Service'){ ?>
                      <option value="Ocean Service">Ocean Service</option>
                    <?php } ?>

                    <?php if ($service!='Pending'){ ?>
                      <option value="Pending">Pending</option>
                      <?php } ?>
                      
                    </select>
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#D85050; color:white;"><i style="width:65px; " class="fa fa-editxx">inquiry notes</i></span>
                    <textarea name="notes" type="text" style="resize:none; height:80px;" class="form-control" ><?php echo $notes; ?></textarea>
                  </div>      

                  

                  

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="<?php if ($type=='missing'){ ?>background:#D85050; color:white;<?php }else{ ?>background:#EFEFEF;<?php } ?>"><i style="width:65px;" class="fa fa-file-word-oxx">warehouse<?php if ($type=='missing'){ ?> *<?php }else{ ?><?php } ?></i></span>
                    <input name="warehouse_receipt" type="text" class="form-control" placeholder="" value="<?php echo $warehouse_receipt; ?>">
                  </div>
                  <span style="font-size:10px;"><?php if ($type=='missing'){ ?>* required to close the inquiry.<?php }else{ ?><?php } ?></span>
                  

                  <div style="margin-top:60px; border-top:0px solid black; ">

                    <span style="font-size:30px; color:black; position:absolute; top:25px; left:185px; " class="glyphicon glyphicon-listxx"></span>

          <h3 style="text-align:center; color:black; font-weight:600; padding:30px; margin-top:-33px; border-bottom:1px solid #555555;">

              <span style="font-size:18px;color:#B80008; font-weight:600; position:relative; top:25px; left:0px;"><span style="color:black;">Supplier Information</span>
              </span>
          </h3>



          <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#EFEFEF;"><i style="width:65px; " class="fa fa-editxx">supplier</i></span>
                    <input name="supplier" type="text" class="form-control" placeholder=""  value="<?php echo $supplier; ?>">
                  </div>             

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#EFEFEF;"><i style="width:65px;" class="fa fa-file-word-oxx">phone</i></span>
                    <input name="supplier_phone" type="text" class="form-control" placeholder="" value="<?php echo $supplier_phone; ?>">
                  </div>


                <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="position:relative; top:-2px; background:#EFEFEF;"><i style="width:65px;" class="fa fa-location-arroxxw">address</i></span>
                    <textarea style="resize:none;width:100%; height:90px; border:1px solid #D2D6DE;" name="supplier_address"><?php echo $supplier_address; ?></textarea>
                  </div>
                


                  <center>
                  <div class="input-group" style="position:relative; top:-280px;">
                    <input type="submit"value="Save" class="form_1_submit" style="position:relative; font-weight:400;<?php if ($type=='missing'){ ?><?php }else{ ?><?php } ?>  width:90px;   height:40px; background:#007F46;">
                  </div>
                  </center>
                    
                  </div>

</div> 



</form>



<?php
    if(isset($_POST["submitEdit"]))
          {
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
  


    $queryModel = mysqli_query($connect, "UPDATE tickets SET warehouse_receipt='$warehouse_receipt' WHERE id='$ticket_id' ")
or die ("<meta http-equiv=\"refresh\" content=\"0;URL= searchTicket.php?message=ErrorSavingAccount\">");


   

    echo "<script type='text/javascript'>opener.location.reload(); //This will refresh parent window.
window.close(); //Close child window. You may also use self.close();</script>";

         }
?>







<div style="width:40%; padding:20px; margin-top:-365px; top:100px; height: 600px; overflow-y: scroll; overflow-x:; position:relative; display:inline-block; ">

        
            <h3 style="text-align:center; color:black; font-weight:600; margin-top:-30px; padding:30px; border-bottom:1px solid #555555;"><br>
                <span style="font-size:30px; top:10px; left:40px;" class="glyphicon glyphicon-comment"></span><span style="font-size:18px;color:#B80008; font-weight:600; position:relative; top:25px;"><span style="color:black;">Notes</span>
                </span>
            </h3>
            
              <br><br>


              <form method="POST" action="action/saveTicketNote.php" enctype="multipart/form-data">

                <input type="text" name="ticket_id" style="display:none;" value="<?php echo $id; ?>">

                  <div class="input-group" style="margin-top:-20px;">
                    <span class="input-group-addon" style="background:#EFEFEF;"><i style="width:60px;" class="fa fa-userxx">agent</i></span>
                  <select data-placeholder="Select Agent" <?php if ($level!='Seller'){ ?>
                      name="agent_name"
                    <?php } ?> class="form-control select2" <?php if ($level=='Seller'){ ?>
                      disabled
                    <?php } ?> style="width:100%;">

                      <option value="<?php echo $agent_name; ?>"><?php echo $agent_name; ?></option>

                      <?php 

                      $consultaList = mysqli_query($connect, "SELECT * FROM agents ORDER BY name asc ") or die ("Error al traer los datos");

                        while ($rowList = mysqli_fetch_array($consultaList)){ 

                        $agent_List=$rowList['name']; ?>
                           

                          <?php if ($agent_name!=$agent_List){ ?>

                      <option value="<?php echo $agent_List; ?>"><?php echo $agent_List; ?></option> 
                      <?php } }  ?>
                      
                    </select>



                      

                    </select>

                    <?php if ($level=='Seller'){ ?>
                      <input type="text" name="agent_name" style="display:none;" value="<?php echo $agent_name; ?>">
                    <?php } ?>
                  </div>   

                  <input style="display:none;" name="agent_email" value="<?php echo $email; ?>">

                  <br>

                  <div class="form-group has-feedback" style="margin-top:0px;">
                  <label>File/Photo ↓</label>
                  <input name="image" class="form-control" type="file">
                  <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:22px;"></span>

                </div>


                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#EFEFEF;"><i style="width:60px;" class="fa fa-userx">notes</i></span>
                    <textarea name="notes" style="resize:none; height:100px;" type="text" class="form-control" placeholder=""></textarea>
                  </div>
                  <br>
                  <label style="position:relative; top:20px;">Notes History ↓</label>
                  <input type="submit" value="Upload" name="submitNote" class="form_1_submit" style="background:#007F46; width:140px; height:30px; position:relative; left:0px; top:-8px; z-index:9999; font-weight:400;">
                  <br><br>

                </form>

                  <table class="table table-hover" style="">
                <tr>
                  <th></th>
                  <th><center>Date</center></th>
                  <th><center>By</center></th>
                  <th><center>Note</center></th>
                  <th><center>File</center></th>
                </tr>

                <?php
                 $consultaNotes = mysqli_query($connect, "SELECT * FROM ticket_notes WHERE ticket_id='$id' ORDER BY id DESC ") or die ("Error al traer los datos");

    while ($rowNotes = mysqli_fetch_array($consultaNotes)){  
              $id_ticket_note = $rowNotes['id'];
              $agent_name_notes = $rowNotes['agent_name'];
              $note= $rowNotes['note'];
              $fecha_note= $rowNotes['fecha'];
              $file= $rowNotes['imagen']; 
              $ext = end((explode(".", $file))); # extra () to prevent notice

              ?>

                <tr>  
                  <td><a Onclick="return ConfirmDelete()" href="action/deleteTicketNote.php?id_ticket_note=<?php echo $id_ticket_note; ?>&id_ticket=<?php echo $id; ?>"><div style="width:12px;height:12px; color:white; background:#CE0000; position:relative; top:2px; "><span style="position:relative; font-size:10px; top:-7px; left:3px;">x</span></div></a></td>
                  <td style="color:black; text-align:center; font-size:10px"><center><?php echo $fecha_note; ?></center></td>
                  <td style="color:black; text-align:center; font-size:10px"><center><?php echo $agent_name_notes; ?></center></td>
                  <td style="color:black; text-align:center; font-size:10px"><center><?php echo $note; ?></center></td>
                  <td style="color:black; text-align:center;"><a style="font-size:10px;" href='download.php?file=images/<?php echo $file; ?>'>
                    <?php
$file= (explode("../images/Tickets/notes/",$file));
?>
                    <?php echo $file[1]; ?>
                      
                    </a></td>

                </tr>

<?php }  ?>
              </table>

</div>


                    </div>
                </div> <!-- End Modal Edit-->



<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm-dd-yyyy", {"placeholder": "mm-dd-/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>

<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,

    });
  });


    $('#example1').DataTable( {
        "order": [[ 0, "desc" ]]
    } );






</script>

<script type="text/javascript">
  $(document).ready( function () {
  var table = 
} );

</script>

<script type="text/javascript">
  
</script>
<!-- CK Editor -->
<script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
    //bootstrap WYSIHTML5 - text editor
    $(".textarea").wysihtml5();
    CKEDITOR.disableAutoInline = true;
    CKEDITOR.inline( 'editor1' );
  });
</script>



<script type="text/javascript">
  $('#example1 tbody').on('click', document.getElementById('modal'), function () {
var modalBtns = [...document.querySelectorAll(".button")];
modalBtns.forEach(function(btn){
  btn.onclick = function() {
    var modal = btn.getAttribute('data-modal');
    document.getElementById(modal).style.display = "block";
  }
});

var closeBtns = [...document.querySelectorAll(".close")];
closeBtns.forEach(function(btn){
  btn.onclick = function() {
    var modal = btn.closest('.modal');
    modal.style.display = "none";
  }
});

window.onclick = function(event) {
  if (event.target.className === "modal") {
    event.target.style.display = "none";
  }
}
});
</script>



<script type="text/javascript">
  $('#example1 tbody').on('click', document.getElementById('modal'), function () {

});
</script>

</body>
</html>