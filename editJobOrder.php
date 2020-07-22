<?php 


error_reporting(0);
session_start();

require_once('conn.php');

$id= $_GET['id'];

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

$consulta2 = mysqli_query($connect, "SELECT * FROM joborders WHERE id='$id' ORDER BY id asc ") or die ("Error al traer los datos222");
                  

    while ($row = mysqli_fetch_array($consulta2)){  

                $jobId = $row['id'];
                $agent_name=$row['agent_name'];
                $customer_company= $row['customer_company'];
                $customer_name= $row['customer_name']; 
                $customer_telf= $row['customer_telf'];
                $supplier_telf= $row['supplier_telf'];
                $branch= $row['branch'];


                $customer_address= $row['customer_address']; 
                $supplier_address= $row['supplier_address']; 

                $service= $row['service'];
                $commodity= $row['commodity'];
                $wh_receipt= $row['wh_receipt'];
                $remark= $row['remark'];
                $customer_if = $row['customer_name'];


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
                <div class="modal-content" style="width:1200px; position:relative; left:50%; margin-left:-600px;" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title" style="font-size:18px;"><span style="font-weight:600;">Edit</span> Job Order #<?php echo $id;?> </h4>

                        <form method="post">

                        <input style="display:none;" type="text" name="jobId" value="<?php echo $id;?>">

                        <input Onclick="return ConfirmDelete()" type="submit"value="Delete" name="submitDeleteJobOrder" class="deleteAccountBtn" style="position:absolute; left:190px; top:15px;">
</form>
<?php
    if(isset($_POST["submitDeleteJobOrder"]))
          {
              $id= $_POST['jobId'];
  
  $modifica= "DELETE FROM joborders WHERE id='$id'";

  $resultado = mysqli_query($connect, $modifica)
  or die ("Error al insertar los registros");

  mysqli_close($connect);
  echo "<script type='text/javascript'>opener.location.reload(); //This will refresh parent window.
window.close(); //Close child window. You may also use self.close();</script>";

         }
?>



                    </div>
                    <div class="modal-body">


<div style="width:30%; padding:20px; margin-left:55px; margin-top:90px; top:-50px; position:relative; display:inline-block; ">
      
      <span style="font-size:80px; position:absolute; top:-0px; left:130px;" class="glyphicon glyphicon-user"></span>

          <h3 style="text-align:center; color:black; font-weight:600; padding:30px; border-bottom:1px solid #555555;"><br>

              <span style="font-size:18px;color:#B80008; font-weight:600; position:relative; top:10px;"><span style="color:black;">Customer Data</span>
              </span>
          </h3>

                  <form method="POST">

                    <input type="name" name="jobId" style="display:none;" value="<?php echo $jobId; ?>">
                  <div class="input-group">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                  <select name="customer_name" class="form-control select2" style="width:255px;" disabled>
                      <option selected="selected" value="<?php echo $customer_name; ?>"><?php echo $customer_name; ?></option>
                    </select>
                  </div>                 

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-briefcase"></i></span>
                    <input name="customer_company" type="text" class="form-control" placeholder="Company Name" disabled value="<?php echo $customer_company; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="customer_telf" type="text" class="form-control" placeholder="Telephone 2" value="<?php echo $customer_telf; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="position:relative; top:-2px; left:px;"><i style="width:20px;" class="fa fa-location-arrow"></i></span>
                    <textarea style="resize:none;width:100%; height:90px; border:1px solid #D2D6DE;" name="customer_address"><?php echo $customer_address; ?></textarea>
                  </div>

</div> 

<div style="width:30%; padding:20px; margin-top:0px; top:-50px; position:relative; display:inline-block; ">   

        <span style="font-size:80px; position:absolute; top:-0px; left:130px;" class="glyphicon glyphicon-briefcase"></span>
          <h3 style="text-align:center; color:black; font-weight:600; padding:30px; border-bottom:1px solid #555555;"><br>
            <span style="font-size:18px;color:#B80008; font-weight:600; position:relative; top:10px;"><span style="color:black;">Supplier Data</span>
            </span>
          </h3>

                  <div class="input-group" style="margin-top:10px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-briefcase"></i></span>
                    <input name="supplier_company" type="text" class="form-control" placeholder="Company Name" disabled value="<?php echo $supplier_company; ?>">
                    <input style="display:none;" value="<?php echo $supplier_company; ?>" name="supplier_company">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Contact Person" disabled required="required" value="<?php echo $supplier_name; ?>">
                    <input style="display:none;" value="<?php echo $supplier_name; ?>" name="supplier_name">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="supplier_telf" type="text" class="form-control" placeholder="Telephone" value="<?php echo $supplier_telf; ?>">
                  </div>
                

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="position:relative; top:-2px; left:px;"><i style="width:20px;" class="fa fa-location-arrow"></i></span>
                    <textarea style="resize:none;width:100%; height:90px; border:1px solid #D2D6DE;" name="supplier_address"><?php echo $supplier_address; ?></textarea>
                  </div>

                  <div class="input-group" style="position:relative; margin-top:20px;">

                  <span style="position:relative; left:-10px; margin-left:10px;">Branch</span>

                  <?php if ($branch=='USA') { ?>
                      <img src="usaFlag.png" style="width:50px; padding:5px;">
                  <?php } ?>

                  <?php if ($branch=='TAIWAN') { ?>
                      <img src="taiwanflag.png" style="width:50px; padding:5px;">
                  <?php } ?>

                  <?php if ($branch=='' OR $branch==' ') { ?>
                      <img src="./img/chinaFlag.png" style="width:50px; padding:5px;">
                  <?php } ?>
                  <select data-placeholder="Select Branch" name="branch" class="form-control select2" style="">

                    <?php if ($branch=='' OR $branch ==' '){ ?>
                    <option value=" ">[Actual: CHINA]</option>
                    <?php }elseif ($branch=='USA') { ?>
                    <option value="USA">[Actual: USA]</option>
                  <?php }elseif ($branch=='TAIWAN') { ?>
                    <option value="TAIWAN">[Actual: TAIWAN]</option>
                    <?php } ?>


                    <?php if ($branch=='' OR $branch ==' '){ ?>
                    <option value="USA">USA</option>
                    <option value="TAIWAN">TAIWAN</option>
                    <?php }elseif ($branch=='USA') { ?>
                    <option value=" ">CHINA</option>
                  <?php }elseif ($branch=='TAIWAN') { ?>
                    <option value=" ">CHINA</option>
                    <option value="USA">USA</option>
                    <?php } ?>
                    
                    
                  
                  </select>
                </div>





</div>

<div style="width:30%; padding:20px; margin-top:0px; top:32px;  position:relative; display:inline-block; ">

        <span style="font-size:80px; position:absolute; top:-0px; left:130px;" class="glyphicon glyphicon-plane"></span>
            <h3 style="text-align:center; color:black; font-weight:600; padding:30px; border-bottom:1px solid #555555;"><br>
                <span style="font-size:18px;color:#B80008; font-weight:600; position:relative; top:10px;"><span style="color:black;">Service Data</span>
                </span>
            </h3>
            
              <br><br>

                

                  <div class="input-group" style="margin-top:-20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-circle"></i></span>
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

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-plane"></i></span>
                  <select data-placeholder="Select Service" name="service" class="form-control select2" style="width:100%;" required="">
                      <option value="<?php echo $service; ?>"><?php echo $service; ?></option>
                      <?php if ($service!='Air door to door'){ ?>
                      <option value="Air door to door">Air door to door</option>
                      <?php } ?>

                      <?php if ($service!='Pending'){ ?>
                      <option value="Pending">Pending</option>
                      <?php } ?>

                      <?php if ($service!='Ocean door to door'){ ?>
                      <option value="Ocean door to door">Ocean door to door</option>
                    <?php } ?>
                    </select>
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-cube"></i></span>
                    <input name="commodity" type="text" class="form-control" placeholder="Commodity" required="required" value="<?php echo $commodity; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:;" class="fa  fa-folder-open-o"></i></span>
                    <input name="wh_receipt" type="text" class="form-control" placeholder="WH Receipt" value="<?php echo $wh_receipt; ?>">
                  </div>


                  
                  <div class="input-group" style="margin-top:0px;">
                    <h2 style="font-size:16px;">Need Pick-Up?</h2>
                    <label>
                        <input type="radio" name="remark" id="no" value="no" class="ron-red"  required="required" <?php if ($remark=='no'){ ?> checked <?php } ?>>
                        <label for="no">No</label>
                      </label>

                    <label style="margin-left:20px;">
                        <input  type="radio" name="remark" id="yes" value="yes" class="ron-red" required="required" <?php if ($remark=='yes'){ ?> checked <?php } ?> >
                        <label for="yes">Yes</label>
                      </label>
                  </div>

                  <div class="input-group" style="margin-top:0px;">
                    <h2 style="font-size:16px;">Need Payment Assistant?</h2>
                    <label>
                        <input type="radio" name="payment" id="no" value="no" class="ron-red"  required="required" <?php if ($remark=='no'){ ?> checked <?php } ?>>
                        <label for="no">No</label>
                      </label>

                    <label style="margin-left:20px;">
                        <input  type="radio" name="payment" id="yes" value="yes" class="ron-red" required="required" <?php if ($remark=='yes'){ ?> checked <?php } ?>>
                        <label for="yes">Yes</label>
                      </label>
                  </div>
</div>

<input type="submit"value="Edit" name="submitEdit" class="form_1_submit" style="top:-140px; left:-75px; background:#007F46;">
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
  


    $queryModel = mysqli_query($connect, "UPDATE joborders SET customer_address='$customer_address', supplier_address='$supplier_address', agent_name='$agent_name', service='$service', commodity='$commodity', wh_receipt='$wh_receipt', remark='$remark', customer_telf='$customer_telf', supplier_telf='$supplier_telf', branch='$branch' WHERE id='$jobId' ")
or die ("<meta http-equiv=\"refresh\" content=\"0;URL= createAccount.php?message=ErrorSavingAccount\">");


   

    echo "<script type='text/javascript'>opener.location.reload(); //This will refresh parent window.
window.close(); //Close child window. You may also use self.close();</script>";

         }
?>


                    </div>
                    <div class="modal-footer" style="margin-top:-20px;">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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