<?php 
error_reporting(0);
require_once('conn.php');

    $message= $_GET['message'];

    $step= $_GET['step'];
    $customer= $_GET['customer'];
    $supplier= $_GET['supplier'];

    $customer_step1= $_POST['customer_step1'];

$pieces = explode("| ", $customer_step1);

$customer_name=$pieces[0];
$customer_company=$pieces[1];
if ($customer_company=='') {
  $customer_company='Particular';
}


$supplier_step1= $_POST['supplier_step1'];

$pieces2 = explode("| ", $supplier_step1);

$supplier_company=$pieces2[0];
$supplier_name=$pieces2[1];

$supplier_step1= $_POST['supplier_step1'];


$consultaClient = mysqli_query($connect, "SELECT * FROM accounts WHERE name='$customer_name' AND company='$customer_company' AND type='Client'   ") or die ("Error al traer los datos");

                        while ($row = mysqli_fetch_array($consultaClient)){ 

                          $customer_address1=$row['address_1'];
                          $customer_address2=$row['address_2'];
                          $customer_city=$row['city'];
                          $customer_state=$row['state'];
                          $customer_country=$row['country'];
                          $customer_telf1=$row['telf1'];
                          $customer_telf2=$row['telf2'];
                          $customer_qq=$row['qq'];
                          $customer_wechat=$row['wechat'];
                          $customer_email=$row['email'];

                          $customer_address= $customer_address1.' '.$customer_address2.' | '.$customer_city.', '.$customer_state.' - '.$customer_country.'.';           
}  

$consultaSupplier = mysqli_query($connect, "SELECT * FROM accounts WHERE name='$supplier_name' AND company='$supplier_company' AND type='Supplier'   ") or die ("Error al traer los datos");

                        while ($row = mysqli_fetch_array($consultaSupplier)){ 

                          $supplier_address1=$row['address_1'];
                          $supplier_address2=$row['address_2'];
                          $supplier_city=$row['city'];
                          $supplier_state=$row['state'];
                          $supplier_country=$row['country'];
                          $supplier_telf1=$row['telf1'];
                          $supplier_telf2=$row['telf2'];
                          $supplier_qq=$row['qq'];
                          $supplier_wechat=$row['wechat'];
                          $supplier_email=$row['email'];

                          $supplier_address= $supplier_address1.' '.$supplier_address2.' | '.$supplier_city.', '.$supplier_state.' - '.$supplier_country.'.';           
}  

date_default_timezone_set('America/La_Paz');
    $fecha_db= date('Y-m-d H:i:s');
    $fecha_vista= date('d/m/Y');

    include_once 'includes/register.inc.php';
include_once 'includes/functions.php';

// Initialize the session
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
     } 

    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">

    <link rel="icon" type="image/x-icon" href="icoplane.ico" />


  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>System | Create Usa Orders</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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

  <style type="text/css">
    a{color:#e0e0e0;}
    .nav>li>a:hover, .nav>li>a:active, .nav>li>a:focus {
    color: #444;
    background: #910007;
}
.nav .open>a, .nav .open>a:focus, .nav .open>a:hover{background-color:#910007;}

a:hover, a:active, a:focus, .active{color:#FBFFA3; font-weight:800;}

.active{color:yellow; font-weight:800;}

.content-wrapper{background-color:#f0f0f0;}

.shadow2{
    -webkit-box-shadow: 0px 2px 2px 1px rgba(194,192,194,0.75);
-moz-box-shadow: 0px 2px 2px 1px rgba(194,192,194,0.75);
box-shadow: 0px 2px 2px 1px rgba(194,192,194,0.75);

}

  </style>



  <!-- Latim style -->
  <link rel="stylesheet" href="latimstyle.css">


</head>
<body class="hold-transition sidebar-mini">

<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="./img/logo.png" style="width:55px; padding:5px;"></span>
      <!-- logo for regular state and mobile devices -->
      <img src="./img/logo.png" style="width:100px; padding:5px;">
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background:#B80008; color:white;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="color:white;">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu" style="color:white;">
        <ul class="nav navbar-nav">

          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color:white;">
              <img src="<?php echo $picture; ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $agent_name; ?></span>
            </a>
            <ul class="dropdown-menu shadow2">
              <!-- User image -->
              <li class="user-header" >
                <img src="<?php echo $picture; ?>" class="img-circle" alt="User Image">

                <p style="color:black;">
                  <?php echo $agent_name; ?> | <?php echo $level; ?>
                </p>
              </li>

              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="myAccount.php" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>

        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar" style="background:#910007;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo $picture; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p style="color:#e0e0e0;"><?php echo $agent_name; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">

        <li style="border-bottom:1px solid gray; padding:5px;">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        

        <li style="border-bottom:1px solid gray; padding:5px;">
            <span class="" style="text-align:center; color:white; ">Quick Searcher <img src="./img/chinaFlag.png" style="width:30px; position:relative; top:-3px; left:10px;"> </span>
            <form method="get" action="searcherJobOrder.php?">
      <input name="JO" value="<?php echo $JO; ?>" placeholder="J.O# / CLIENT or SUPPLIER NAME" style="width:100%; font-size:12px; text-align:center; border:1px solid gray; padding:15px;">
      <br><br>
      </form>
        </li>

        <center><div style="width:100%; height:20px; position:relative; top:0px; background:#CECAC6; color:#630000; font-weight:600; font-size:14px;">CARGOS</div></center>
        <li class="treeview" style="border-bottom:1px solid gray; padding:5px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-users"></i> <span style="font-size:11px; ">Accounts</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a href="createAccount.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li><a  href="searchAccount.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>

      
        <li class="treeview" style="border-bottom:1px solid gray; padding:5px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-files-o"></i> <span style="font-size:11px; ">Quotations</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right" ></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="createQuotation.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li ><a href="searchQuotation.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>


        <center><div style="width:100%; height:20px; position:relative; top:0px; background:#CECAC6; color:#630000; font-weight:600; font-size:14px;">JOB ORDERS</div></center>

        <li class=" treeview" style="border-bottom:1px solid gray; padding:5px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-files-o"></i> <span style="font-size:11px;">CHINA Orders</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a  href="createJobOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li ><a class="" href="searchJobOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>

        
        <li class="active treeview" style="border-bottom:1px solid gray; padding:5px; margin-top:0px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-files-o"></i> <span style="font-size:11px;">USA Orders</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="active" href="createUsaOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li><a href="searchUsaOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>

        
        <li class="treeview" style="border-bottom:1px solid gray; padding:5px; margin-top:0px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-files-o"></i> <span style="font-size:11px;">LATAM Orders</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="createLATAMOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li ><a href="searchLATAMOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>

        
        <li class=" treeview" style="border-bottom:1px solid gray; padding:5px; margin-top:0px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-files-o"></i> <span style="font-size:11px;">TAIWAN Orders</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="" href="createTAIWANOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li ><a href="searchTAIWANOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>

        <center><div style="width:100%; height:20px; position:relative; top:0px; background:#CECAC6; color:#630000; font-weight:600; font-size:14px;">SUPPORT AREA</div></center>
        <li class="treeview" style="border-bottom:1px solid gray; padding:5px;">
          <a href="#" style="height:25px; position:relative; top:-10px;"> 
            <i class="fa fa-info"></i> <span style="font-size:11px;">Tickets</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a  href="createTicket.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li><a href="searchTicket.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>

    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        USA Orders 
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create USA Orders</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">



      <!-- Form -->
        <div class="form_2 shadow2" style="<?php if ($step=='2'){ ?>min-height:600px;<?php }else{ ?> width:800px; margin-left:-400px; <?php } ?>"> 

          <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">Create USA Order</h3>

<?php if ($message=='JobOrderSaved'){ ?>
                  <br>
                  <div id="mydiv" style="background-color: rgba(0, 127, 70, 1); padding:20px;color:white; position:absolute; left:50%; width:300px; margin-left:140px; top:-80px;">
                    <center>
                      <span style="font-style: oblique; ">Job Order has been created.</span>
                    </center>
                  </div>
                <?php }else{} ?>
                <br>


<script type="text/javascript">
    setTimeout(fade_out, 3000);

function fade_out() {
  $("#mydiv").fadeOut().empty();
}
</script>



          <?php if ($step=='') {$step='1';} ?>

              <?php if ($step=='1'){ ?>

              <div style="width:350px; position:relative; padding:20px; float:left; margin-top:-90px; left:30px;">
                <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:16px; border-bottom:1px solid #555555;"><br>

              <span style="font-size:35px; padding:10px; position:relative; left:115px; top:-8px; " class="glyphicon glyphicon-user"></span>

               <span style="position:relative; top:10px;">Select Client Account</span>

              </h3>


              <form action="?step=2" method="post">
<br>

                <div class="input-group">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                  <select data-placeholder="Select Client" name="customer_step1" class="form-control select2" style="width:263px; " required="required" >

                      <option selected="selected" value="<?php echo $customer; ?>"><?php echo $customer; ?></option>
                      <?php 


                      if ($level=='Seller') { $consulta = mysqli_query($connect, "SELECT * FROM accounts WHERE agent='$agent_name' AND type='Client' ORDER BY name asc ") or die ("Error al traer los datos"); 
                      }else{
                        $consulta = mysqli_query($connect, "SELECT * FROM accounts WHERE type='Client' ORDER BY name asc ") or die ("Error al traer los datos");}



                        while ($row = mysqli_fetch_array($consulta)){ 
                        $company=$row['company'];
                        $name=$row['name'];

                         $customer_if= $name;
                          if ($company!='') { $customer_if .= ' | '.$company; }

                         ?>
                         <?php if ($customer!=$customer_if){ ?>
                           
                         
                      <option value="<?php echo $customer_if; ?>"><?php echo $customer_if; ?></option>
                      <?php }else{} ?>
                      <?php }  ?>
                      
                    </select>
                  </div>

                  <div class="input-group" style="position:relative; left:383px; top:-34.5px; z-index:100;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                  <select data-placeholder="Select Shipper" name="supplier_step1" class="form-control select2" style="width:263px;" required="required" >  

                      <option selected="selected" value="<?php echo $supplier; ?>"><?php echo $supplier; ?></option>
                      <option value="No Shipper Information">No Shipper Information</option>
                      <option value="Amazon">Amazon</option>
                      <option value="Wal-Mart">Wal-Mart</option>
                      <option value="eBay">eBay</option>


                      <?php 


                      if ($level=='Seller') { $consulta = mysqli_query($connect, "SELECT * FROM accounts WHERE agent='$agent_name' AND type='Supplier' AND branch='USA' ORDER BY name asc ") or die ("Error al traer los datos"); 
                      }else{
                        $consulta = mysqli_query($connect, "SELECT * FROM accounts WHERE type='Supplier' AND branch='USA' ORDER BY name asc ") or die ("Error al traer los datos");}



                        while ($row = mysqli_fetch_array($consulta)){ 
                        $company=$row['company'];
                        $name=$row['name'];

                         $customer_if= $name;
                          if ($company!='') { $customer_if .= ' | '.$company; }

                         ?>
                         <?php if ($customer!=$customer_if){ ?>
                           
                         
                      <option value="<?php echo $customer_if; ?>"><?php echo $customer_if; ?></option>
                      <?php }else{} ?>
                      <?php }  ?>
                      
                    </select>
                  </div>

                  <input type="submit" value="Next" class="form_2_submit" style="top:50px; left:130px; width:160px;border-radius:2px;  background:#4C7C67;" onMouseOver="this.style.background='#007F46'"
   onMouseOut="this.style.background='#4C7C67'">
                
              </form>

              <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal1" style="border-radius:2px; position:relative; top:-20px; left:110px; height:40px; background:#B7565B; border:none;"  onMouseOver="this.style.background='#B80008'"
   onMouseOut="this.style.background='#B7565B'">
  <span style="position:relative; font-size:14px; top:-3px;">Add new client</span>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add new client</h4>
      </div>
      <div class="modal-body">
        <form action="saveAccountStep1USA.php" method="POST">
          <input name="supplier" value="<?php echo $supplier; ?>" style="display:none;">

                  <div class="input-group">
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


                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                    <input name="name" type="text" class="form-control" placeholder="Contact Person">
                  </div>

                   <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-briefcase"></i></span>
                    <input name="company" type="text" class="form-control" placeholder="Company Name">
                  </div>


                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-location-arrow"></i></span>
                    <input name="address_1" type="text" class="form-control" placeholder="Address 1" value="">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-location-arrow"></i></span>
                    <input name="address_2" type="text" class="form-control" placeholder="Address 2">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-map-marker"></i></span>
                    <input name="city" type="text" class="form-control" placeholder="City" required="required">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-map-marker"></i></span>
                    <input name="state" type="text" class="form-control" placeholder="State" required="required">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-globe"></i></span>
                  <select name="country" class="form-control select2" style="width:100%;" required="required">
                    <option value="">Select Country</option>
                    <option value="VE">Venezuela</option>
                    <option value="PY">Paraguay</option>
                    <option value="AR">Argentina</option>
                    <option value="US">United States</option>
                    <option value=""></option>
                    <option value="">-------------------</option>
                    <option value=""></option>
  <option value="AF">Afghanistan</option>
  <option value="AX">Åland Islands</option>
  <option value="AL">Albania</option>
  <option value="DZ">Algeria</option>
  <option value="AS">American Samoa</option>
  <option value="AD">Andorra</option>
  <option value="AO">Angola</option>
  <option value="AI">Anguilla</option>
  <option value="AQ">Antarctica</option>
  <option value="AG">Antigua and Barbuda</option>
  
  <option value="AM">Armenia</option>
  <option value="AW">Aruba</option>
  <option value="AU">Australia</option>
  <option value="AT">Austria</option>
  <option value="AZ">Azerbaijan</option>
  <option value="BS">Bahamas</option>
  <option value="BH">Bahrain</option>
  <option value="BD">Bangladesh</option>
  <option value="BB">Barbados</option>
  <option value="BY">Belarus</option>
  <option value="BE">Belgium</option>
  <option value="BZ">Belize</option>
  <option value="BJ">Benin</option>
  <option value="BM">Bermuda</option>
  <option value="BT">Bhutan</option>
  <option value="BO">Bolivia, Plurinational State of</option>
  <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
  <option value="BA">Bosnia and Herzegovina</option>
  <option value="BW">Botswana</option>
  <option value="BV">Bouvet Island</option>
  <option value="BR">Brazil</option>
  <option value="IO">British Indian Ocean Territory</option>
  <option value="BN">Brunei Darussalam</option>
  <option value="BG">Bulgaria</option>
  <option value="BF">Burkina Faso</option>
  <option value="BI">Burundi</option>
  <option value="KH">Cambodia</option>
  <option value="CM">Cameroon</option>
  <option value="CA">Canada</option>
  <option value="CV">Cape Verde</option>
  <option value="KY">Cayman Islands</option>
  <option value="CF">Central African Republic</option>
  <option value="TD">Chad</option>
  <option value="CL">Chile</option>
  
  <option value="CX">Christmas Island</option>
  <option value="CC">Cocos (Keeling) Islands</option>
  <option value="CO">Colombia</option>
  <option value="KM">Comoros</option>
  <option value="CG">Congo</option>
  <option value="CD">Congo, the Democratic Republic of the</option>
  <option value="CK">Cook Islands</option>
  <option value="CR">Costa Rica</option>
  <option value="CI">Côte d'Ivoire</option>
  <option value="HR">Croatia</option>
  <option value="CU">Cuba</option>
  <option value="CW">Curaçao</option>
  <option value="CY">Cyprus</option>
  <option value="CZ">Czech Republic</option>
  <option value="DK">Denmark</option>
  <option value="DJ">Djibouti</option>
  <option value="DM">Dominica</option>
  <option value="DO">Dominican Republic</option>
  <option value="EC">Ecuador</option>
  <option value="EG">Egypt</option>
  <option value="SV">El Salvador</option>
  <option value="GQ">Equatorial Guinea</option>
  <option value="ER">Eritrea</option>
  <option value="EE">Estonia</option>
  <option value="ET">Ethiopia</option>
  <option value="FK">Falkland Islands (Malvinas)</option>
  <option value="FO">Faroe Islands</option>
  <option value="FJ">Fiji</option>
  <option value="FI">Finland</option>
  <option value="FR">France</option>
  <option value="GF">French Guiana</option>
  <option value="PF">French Polynesia</option>
  <option value="TF">French Southern Territories</option>
  <option value="GA">Gabon</option>
  <option value="GM">Gambia</option>
  <option value="GE">Georgia</option>
  <option value="DE">Germany</option>
  <option value="GH">Ghana</option>
  <option value="GI">Gibraltar</option>
  <option value="GR">Greece</option>
  <option value="GL">Greenland</option>
  <option value="GD">Grenada</option>
  <option value="GP">Guadeloupe</option>
  <option value="GU">Guam</option>
  <option value="GT">Guatemala</option>
  <option value="GG">Guernsey</option>
  <option value="GN">Guinea</option>
  <option value="GW">Guinea-Bissau</option>
  <option value="GY">Guyana</option>
  <option value="HT">Haiti</option>
  <option value="HM">Heard Island and McDonald Islands</option>
  <option value="VA">Holy See (Vatican City State)</option>
  <option value="HN">Honduras</option>
  <option value="HK">Hong Kong</option>
  <option value="HU">Hungary</option>
  <option value="IS">Iceland</option>
  <option value="IN">India</option>
  <option value="ID">Indonesia</option>
  <option value="IR">Iran, Islamic Republic of</option>
  <option value="IQ">Iraq</option>
  <option value="IE">Ireland</option>
  <option value="IM">Isle of Man</option>
  <option value="IL">Israel</option>
  <option value="IT">Italy</option>
  <option value="JM">Jamaica</option>
  <option value="JP">Japan</option>
  <option value="JE">Jersey</option>
  <option value="JO">Jordan</option>
  <option value="KZ">Kazakhstan</option>
  <option value="KE">Kenya</option>
  <option value="KI">Kiribati</option>
  <option value="KP">Korea, Democratic People's Republic of</option>
  <option value="KR">Korea, Republic of</option>
  <option value="KW">Kuwait</option>
  <option value="KG">Kyrgyzstan</option>
  <option value="LA">Lao People's Democratic Republic</option>
  <option value="LV">Latvia</option>
  <option value="LB">Lebanon</option>
  <option value="LS">Lesotho</option>
  <option value="LR">Liberia</option>
  <option value="LY">Libya</option>
  <option value="LI">Liechtenstein</option>
  <option value="LT">Lithuania</option>
  <option value="LU">Luxembourg</option>
  <option value="MO">Macao</option>
  <option value="MK">Macedonia, the former Yugoslav Republic of</option>
  <option value="MG">Madagascar</option>
  <option value="MW">Malawi</option>
  <option value="MY">Malaysia</option>
  <option value="MV">Maldives</option>
  <option value="ML">Mali</option>
  <option value="MT">Malta</option>
  <option value="MH">Marshall Islands</option>
  <option value="MQ">Martinique</option>
  <option value="MR">Mauritania</option>
  <option value="MU">Mauritius</option>
  <option value="YT">Mayotte</option>
  <option value="MX">Mexico</option>
  <option value="FM">Micronesia, Federated States of</option>
  <option value="MD">Moldova, Republic of</option>
  <option value="MC">Monaco</option>
  <option value="MN">Mongolia</option>
  <option value="ME">Montenegro</option>
  <option value="MS">Montserrat</option>
  <option value="MA">Morocco</option>
  <option value="MZ">Mozambique</option>
  <option value="MM">Myanmar</option>
  <option value="NA">Namibia</option>
  <option value="NR">Nauru</option>
  <option value="NP">Nepal</option>
  <option value="NL">Netherlands</option>
  <option value="NC">New Caledonia</option>
  <option value="NZ">New Zealand</option>
  <option value="NI">Nicaragua</option>
  <option value="NE">Niger</option>
  <option value="NG">Nigeria</option>
  <option value="NU">Niue</option>
  <option value="NF">Norfolk Island</option>
  <option value="MP">Northern Mariana Islands</option>
  <option value="NO">Norway</option>
  <option value="OM">Oman</option>
  <option value="PK">Pakistan</option>
  <option value="PW">Palau</option>
  <option value="PS">Palestinian Territory, Occupied</option>
  <option value="PA">Panama</option>
  <option value="PG">Papua New Guinea</option>
  
  <option value="PE">Peru</option>
  <option value="PH">Philippines</option>
  <option value="PN">Pitcairn</option>
  <option value="PL">Poland</option>
  <option value="PT">Portugal</option>
  <option value="PR">Puerto Rico</option>
  <option value="QA">Qatar</option>
  <option value="RE">Réunion</option>
  <option value="RO">Romania</option>
  <option value="RU">Russian Federation</option>
  <option value="RW">Rwanda</option>
  <option value="BL">Saint Barthélemy</option>
  <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
  <option value="KN">Saint Kitts and Nevis</option>
  <option value="LC">Saint Lucia</option>
  <option value="MF">Saint Martin (French part)</option>
  <option value="PM">Saint Pierre and Miquelon</option>
  <option value="VC">Saint Vincent and the Grenadines</option>
  <option value="WS">Samoa</option>
  <option value="SM">San Marino</option>
  <option value="ST">Sao Tome and Principe</option>
  <option value="SA">Saudi Arabia</option>
  <option value="SN">Senegal</option>
  <option value="RS">Serbia</option>
  <option value="SC">Seychelles</option>
  <option value="SL">Sierra Leone</option>
  <option value="SG">Singapore</option>
  <option value="SX">Sint Maarten (Dutch part)</option>
  <option value="SK">Slovakia</option>
  <option value="SI">Slovenia</option>
  <option value="SB">Solomon Islands</option>
  <option value="SO">Somalia</option>
  <option value="ZA">South Africa</option>
  <option value="GS">South Georgia and the South Sandwich Islands</option>
  <option value="SS">South Sudan</option>
  <option value="ES">Spain</option>
  <option value="LK">Sri Lanka</option>
  <option value="SD">Sudan</option>
  <option value="SR">Suriname</option>
  <option value="SJ">Svalbard and Jan Mayen</option>
  <option value="SZ">Swaziland</option>
  <option value="SE">Sweden</option>
  <option value="CH">Switzerland</option>
  <option value="SY">Syrian Arab Republic</option>
  <option value="TW">Taiwan, Province of China</option>
  <option value="TJ">Tajikistan</option>
  <option value="TZ">Tanzania, United Republic of</option>
  <option value="TH">Thailand</option>
  <option value="TL">Timor-Leste</option>
  <option value="TG">Togo</option>
  <option value="TK">Tokelau</option>
  <option value="TO">Tonga</option>
  <option value="TT">Trinidad and Tobago</option>
  <option value="TN">Tunisia</option>
  <option value="TR">Turkey</option>
  <option value="TM">Turkmenistan</option>
  <option value="TC">Turks and Caicos Islands</option>
  <option value="TV">Tuvalu</option>
  <option value="UG">Uganda</option>
  <option value="UA">Ukraine</option>
  <option value="AE">United Arab Emirates</option>
  <option value="GB">United Kingdom</option>
  
  <option value="UM">United States Minor Outlying Islands</option>
  <option value="UY">Uruguay</option>
  <option value="UZ">Uzbekistan</option>
  <option value="VU">Vanuatu</option>
  
  <option value="VN">Viet Nam</option>
  <option value="VG">Virgin Islands, British</option>
  <option value="VI">Virgin Islands, U.S.</option>
  <option value="WF">Wallis and Futuna</option>
  <option value="EH">Western Sahara</option>
  <option value="YE">Yemen</option>
  <option value="ZM">Zambia</option>
  <option value="ZW">Zimbabwe</option>
                  </select>
      </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="telf1" type="text" class="form-control" placeholder="Mobile Phone">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="telf2" type="text" class="form-control" placeholder="Office Phone">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="qq" type="text" class="form-control" placeholder="QQ">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="wechat" type="text" class="form-control" placeholder="WeChat">
                  </div>


                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-envelope"></i></span>
                    <input name="email" type="text" class="form-control" placeholder="E-mail">
                  </div>

                   <!-- radio -->
              <div class="input-group" style="margin-top:20px;">

                <label>
                  <input type="radio" name="type" value="Client" class="flat-red" required="required" checked>
                  <label>Client</label>
                </label>

              </div>

              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="background:#B80008; border:none; height:40px; border-radius:2px; color:white; position:relative; left:-30px; width:100px;" data-dismiss="modal">Cancel</button>
        <input type="submit"value="Save" class="form_1_submit" style="top:0px; background:#007F46;">
              </form>
      </div>
    </div>
  </div>
</div>

              </div>


              <div style="width:350px; position:relative; margin-top:-90px;  padding:20px; float:right; left:-30px;">
                <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:16px; border-bottom:1px solid #555555;"><br>

              <span style="font-size:35px; padding:10px; position:relative; left:85px; top:-8px; " class="glyphicon glyphicon-briefcase"></span>

               <span style="position:relative; top:10px;">Select Shipper</span>

              </h3>
<br><br>
              <!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal2" style="border-radius:2px; position:relative; top:30px; left:100px; height:40px; background:#B7565B; border:none;" onMouseOver="this.style.background='#B80008'"
   onMouseOut="this.style.background='#B7565B'">
  <span style="position:relative; font-size:14px; top:-3px;">Add new shipper</span>
</button>

<!-- Modal -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add new shipper</h4>
      </div>
      <div class="modal-body">
        <form action="saveSupplierStep1USA.php" method="POST">   

          <input name="customer" value="<?php echo $customer; ?>" style="display:none;">

          <div class="input-group">
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

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-briefcase"></i></span>
                    <input name="company" type="text" class="form-control" placeholder="Company Name">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                    <input name="name" type="text" class="form-control" placeholder="Contact Person">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-location-arrow"></i></span>
                    <input name="address_1" type="text" class="form-control" placeholder="Address 1">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-location-arrow"></i></span>
                    <input name="address_2" type="text" class="form-control" placeholder="Address 2">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-map-marker"></i></span>
                    <input name="city" type="text" class="form-control" placeholder="City">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-map-marker"></i></span>
                    <input name="state" type="text" class="form-control" placeholder="State" >
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-globe"></i></span>
                  <select name="country" class="form-control select2" style="width:100%;" required="required">
                    <option value="">Select Country</option>
                    <option value="CN">China</option>
                    <option value="VE">Venezuela</option>
                    <option value="PY">Paraguay</option>
                    <option value="AR">Argentina</option>
                    <option value="US">United States</option>
                    <option value=""></option>
                    <option value="">-------------------</option>
                    <option value=""></option>
  <option value="AF">Afghanistan</option>
  <option value="AX">Åland Islands</option>
  <option value="AL">Albania</option>
  <option value="DZ">Algeria</option>
  <option value="AS">American Samoa</option>
  <option value="AD">Andorra</option>
  <option value="AO">Angola</option>
  <option value="AI">Anguilla</option>
  <option value="AQ">Antarctica</option>
  <option value="AG">Antigua and Barbuda</option>
  
  <option value="AM">Armenia</option>
  <option value="AW">Aruba</option>
  <option value="AU">Australia</option>
  <option value="AT">Austria</option>
  <option value="AZ">Azerbaijan</option>
  <option value="BS">Bahamas</option>
  <option value="BH">Bahrain</option>
  <option value="BD">Bangladesh</option>
  <option value="BB">Barbados</option>
  <option value="BY">Belarus</option>
  <option value="BE">Belgium</option>
  <option value="BZ">Belize</option>
  <option value="BJ">Benin</option>
  <option value="BM">Bermuda</option>
  <option value="BT">Bhutan</option>
  <option value="BO">Bolivia, Plurinational State of</option>
  <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
  <option value="BA">Bosnia and Herzegovina</option>
  <option value="BW">Botswana</option>
  <option value="BV">Bouvet Island</option>
  <option value="BR">Brazil</option>
  <option value="IO">British Indian Ocean Territory</option>
  <option value="BN">Brunei Darussalam</option>
  <option value="BG">Bulgaria</option>
  <option value="BF">Burkina Faso</option>
  <option value="BI">Burundi</option>
  <option value="KH">Cambodia</option>
  <option value="CM">Cameroon</option>
  <option value="CA">Canada</option>
  <option value="CV">Cape Verde</option>
  <option value="KY">Cayman Islands</option>
  <option value="CF">Central African Republic</option>
  <option value="TD">Chad</option>
  <option value="CL">Chile</option>
  
  <option value="CX">Christmas Island</option>
  <option value="CC">Cocos (Keeling) Islands</option>
  <option value="CO">Colombia</option>
  <option value="KM">Comoros</option>
  <option value="CG">Congo</option>
  <option value="CD">Congo, the Democratic Republic of the</option>
  <option value="CK">Cook Islands</option>
  <option value="CR">Costa Rica</option>
  <option value="CI">Côte d'Ivoire</option>
  <option value="HR">Croatia</option>
  <option value="CU">Cuba</option>
  <option value="CW">Curaçao</option>
  <option value="CY">Cyprus</option>
  <option value="CZ">Czech Republic</option>
  <option value="DK">Denmark</option>
  <option value="DJ">Djibouti</option>
  <option value="DM">Dominica</option>
  <option value="DO">Dominican Republic</option>
  <option value="EC">Ecuador</option>
  <option value="EG">Egypt</option>
  <option value="SV">El Salvador</option>
  <option value="GQ">Equatorial Guinea</option>
  <option value="ER">Eritrea</option>
  <option value="EE">Estonia</option>
  <option value="ET">Ethiopia</option>
  <option value="FK">Falkland Islands (Malvinas)</option>
  <option value="FO">Faroe Islands</option>
  <option value="FJ">Fiji</option>
  <option value="FI">Finland</option>
  <option value="FR">France</option>
  <option value="GF">French Guiana</option>
  <option value="PF">French Polynesia</option>
  <option value="TF">French Southern Territories</option>
  <option value="GA">Gabon</option>
  <option value="GM">Gambia</option>
  <option value="GE">Georgia</option>
  <option value="DE">Germany</option>
  <option value="GH">Ghana</option>
  <option value="GI">Gibraltar</option>
  <option value="GR">Greece</option>
  <option value="GL">Greenland</option>
  <option value="GD">Grenada</option>
  <option value="GP">Guadeloupe</option>
  <option value="GU">Guam</option>
  <option value="GT">Guatemala</option>
  <option value="GG">Guernsey</option>
  <option value="GN">Guinea</option>
  <option value="GW">Guinea-Bissau</option>
  <option value="GY">Guyana</option>
  <option value="HT">Haiti</option>
  <option value="HM">Heard Island and McDonald Islands</option>
  <option value="VA">Holy See (Vatican City State)</option>
  <option value="HN">Honduras</option>
  <option value="HK">Hong Kong</option>
  <option value="HU">Hungary</option>
  <option value="IS">Iceland</option>
  <option value="IN">India</option>
  <option value="ID">Indonesia</option>
  <option value="IR">Iran, Islamic Republic of</option>
  <option value="IQ">Iraq</option>
  <option value="IE">Ireland</option>
  <option value="IM">Isle of Man</option>
  <option value="IL">Israel</option>
  <option value="IT">Italy</option>
  <option value="JM">Jamaica</option>
  <option value="JP">Japan</option>
  <option value="JE">Jersey</option>
  <option value="JO">Jordan</option>
  <option value="KZ">Kazakhstan</option>
  <option value="KE">Kenya</option>
  <option value="KI">Kiribati</option>
  <option value="KP">Korea, Democratic People's Republic of</option>
  <option value="KR">Korea, Republic of</option>
  <option value="KW">Kuwait</option>
  <option value="KG">Kyrgyzstan</option>
  <option value="LA">Lao People's Democratic Republic</option>
  <option value="LV">Latvia</option>
  <option value="LB">Lebanon</option>
  <option value="LS">Lesotho</option>
  <option value="LR">Liberia</option>
  <option value="LY">Libya</option>
  <option value="LI">Liechtenstein</option>
  <option value="LT">Lithuania</option>
  <option value="LU">Luxembourg</option>
  <option value="MO">Macao</option>
  <option value="MK">Macedonia, the former Yugoslav Republic of</option>
  <option value="MG">Madagascar</option>
  <option value="MW">Malawi</option>
  <option value="MY">Malaysia</option>
  <option value="MV">Maldives</option>
  <option value="ML">Mali</option>
  <option value="MT">Malta</option>
  <option value="MH">Marshall Islands</option>
  <option value="MQ">Martinique</option>
  <option value="MR">Mauritania</option>
  <option value="MU">Mauritius</option>
  <option value="YT">Mayotte</option>
  <option value="MX">Mexico</option>
  <option value="FM">Micronesia, Federated States of</option>
  <option value="MD">Moldova, Republic of</option>
  <option value="MC">Monaco</option>
  <option value="MN">Mongolia</option>
  <option value="ME">Montenegro</option>
  <option value="MS">Montserrat</option>
  <option value="MA">Morocco</option>
  <option value="MZ">Mozambique</option>
  <option value="MM">Myanmar</option>
  <option value="NA">Namibia</option>
  <option value="NR">Nauru</option>
  <option value="NP">Nepal</option>
  <option value="NL">Netherlands</option>
  <option value="NC">New Caledonia</option>
  <option value="NZ">New Zealand</option>
  <option value="NI">Nicaragua</option>
  <option value="NE">Niger</option>
  <option value="NG">Nigeria</option>
  <option value="NU">Niue</option>
  <option value="NF">Norfolk Island</option>
  <option value="MP">Northern Mariana Islands</option>
  <option value="NO">Norway</option>
  <option value="OM">Oman</option>
  <option value="PK">Pakistan</option>
  <option value="PW">Palau</option>
  <option value="PS">Palestinian Territory, Occupied</option>
  <option value="PA">Panama</option>
  <option value="PG">Papua New Guinea</option>
  
  <option value="PE">Peru</option>
  <option value="PH">Philippines</option>
  <option value="PN">Pitcairn</option>
  <option value="PL">Poland</option>
  <option value="PT">Portugal</option>
  <option value="PR">Puerto Rico</option>
  <option value="QA">Qatar</option>
  <option value="RE">Réunion</option>
  <option value="RO">Romania</option>
  <option value="RU">Russian Federation</option>
  <option value="RW">Rwanda</option>
  <option value="BL">Saint Barthélemy</option>
  <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
  <option value="KN">Saint Kitts and Nevis</option>
  <option value="LC">Saint Lucia</option>
  <option value="MF">Saint Martin (French part)</option>
  <option value="PM">Saint Pierre and Miquelon</option>
  <option value="VC">Saint Vincent and the Grenadines</option>
  <option value="WS">Samoa</option>
  <option value="SM">San Marino</option>
  <option value="ST">Sao Tome and Principe</option>
  <option value="SA">Saudi Arabia</option>
  <option value="SN">Senegal</option>
  <option value="RS">Serbia</option>
  <option value="SC">Seychelles</option>
  <option value="SL">Sierra Leone</option>
  <option value="SG">Singapore</option>
  <option value="SX">Sint Maarten (Dutch part)</option>
  <option value="SK">Slovakia</option>
  <option value="SI">Slovenia</option>
  <option value="SB">Solomon Islands</option>
  <option value="SO">Somalia</option>
  <option value="ZA">South Africa</option>
  <option value="GS">South Georgia and the South Sandwich Islands</option>
  <option value="SS">South Sudan</option>
  <option value="ES">Spain</option>
  <option value="LK">Sri Lanka</option>
  <option value="SD">Sudan</option>
  <option value="SR">Suriname</option>
  <option value="SJ">Svalbard and Jan Mayen</option>
  <option value="SZ">Swaziland</option>
  <option value="SE">Sweden</option>
  <option value="CH">Switzerland</option>
  <option value="SY">Syrian Arab Republic</option>
  <option value="TW">Taiwan, Province of China</option>
  <option value="TJ">Tajikistan</option>
  <option value="TZ">Tanzania, United Republic of</option>
  <option value="TH">Thailand</option>
  <option value="TL">Timor-Leste</option>
  <option value="TG">Togo</option>
  <option value="TK">Tokelau</option>
  <option value="TO">Tonga</option>
  <option value="TT">Trinidad and Tobago</option>
  <option value="TN">Tunisia</option>
  <option value="TR">Turkey</option>
  <option value="TM">Turkmenistan</option>
  <option value="TC">Turks and Caicos Islands</option>
  <option value="TV">Tuvalu</option>
  <option value="UG">Uganda</option>
  <option value="UA">Ukraine</option>
  <option value="AE">United Arab Emirates</option>
  <option value="GB">United Kingdom</option>
  
  <option value="UM">United States Minor Outlying Islands</option>
  <option value="UY">Uruguay</option>
  <option value="UZ">Uzbekistan</option>
  <option value="VU">Vanuatu</option>
  
  <option value="VN">Viet Nam</option>
  <option value="VG">Virgin Islands, British</option>
  <option value="VI">Virgin Islands, U.S.</option>
  <option value="WF">Wallis and Futuna</option>
  <option value="EH">Western Sahara</option>
  <option value="YE">Yemen</option>
  <option value="ZM">Zambia</option>
  <option value="ZW">Zimbabwe</option>
                  </select>
      </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="telf1" type="text" class="form-control" placeholder="Mobile">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="telf2" type="text" class="form-control" placeholder="Office">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="qq" type="text" class="form-control" placeholder="QQ">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="wechat" type="text" class="form-control" placeholder="WeChat">
                  </div>



                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-envelope"></i></span>
                    <input name="email" type="text" class="form-control" placeholder="E-mail">
                  </div>


                                     <!-- radio -->
              <div class="input-group" style="margin-top:20px;">

                <label>
                  <input type="radio" name="type" value="Supplier" class="flat-red" required="required" checked>
                  <label>Supplier</label>
                </label>

              </div>

              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="background:#B80008; border:none; height:40px; border-radius:2px; color:white; position:relative; left:-30px; width:100px;" data-dismiss="modal">Cancel</button>
        <input type="submit"value="Save" class="form_1_submit" style="top:0px; background:#007F46;">

              </form>
      </div>
    </div>
  </div>
</div>

              </div>



                
              <?php } ?>

              <?php if ($step=='2'){ ?>
                
                <div style="width:30%; padding:20px; margin-left:55px; margin-top:-40px; top:-120px; position:relative; display:inline-block; ">
                    <span style="font-size:40px; position:absolute; top:-0px; left:150px;" class="glyphicon glyphicon-user"></span>

                   <h3 style="text-align:center; color:black; font-weight:600; padding:30px; margin-top:-40px; border-bottom:1px solid #555555;"><br>


                <span style="font-size:18px;color:#B80008; font-weight:600; position:relative; top:10px;"><span style="color:black;">Customer Data</span></span>

              </h3>

                  <form action="saveJobOrderUSA.php" method="POST">

                    <?php

                    $jobId='300';
                     $consultaId = mysqli_query($connect, "SELECT * FROM joborders ORDER BY id DESC LIMIT 1") or die ("Error al traer los datos");

    while ($rowId = mysqli_fetch_array($consultaId)){

$rowcount=mysqli_num_rows($consultaId); 
if($rowcount > 0){ 
  $jobId=$rowId['id']+1;
  }
  else
  { 

  }  
 } ?>


              <input style="display:none;" type="number" name="jobId" value="<?php echo $jobId; ?>">
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
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:-5px;" class="fa fa-phone"></i> Mobile</span>
                    <input name="customer_telf1" type="text" class="form-control" placeholder="Mobile" value="<?php echo $customer_telf1; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:-5px;" class="fa fa-phone"></i> Office</span>
                    <input name="customer_telf2" type="text" class="form-control" placeholder="Office" value="<?php echo $customer_telf2; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:-5px;" class="fa fa-phone"></i> QQ</span>
                    <input name="customer_qq" type="text" class="form-control" placeholder="QQ" value="<?php echo $customer_qq; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:-5px;" class="fa fa-phone"></i> WeChat</span>
                    <input name="customer_wechat" type="text" class="form-control" placeholder="WeChat" value="<?php echo $customer_wechat; ?>">
                  </div>



                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-envelope"></i></span>
                    <input name="customer_email" type="text" class="form-control" placeholder="E-mail" value="<?php echo $customer_email; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="position:relative; top:-2px; left:px;"><i style="width:20px;" class="fa fa-location-arrow"></i></span>
                    <textarea style="resize:none;width:100%; height:90px; border:1px solid #D2D6DE;" name="customer_address"><?php echo $customer_address; ?></textarea>
                    <input name="customer_city" type="text" style="display:none;" class="form-control" placeholder="City" value="<?php echo $customer_city; ?>">
                    <input name="customer_state" type="text" style="display:none;" class="form-control" placeholder="City" value="<?php echo $customer_state; ?>">
                    <input name="customer_country" type="text" style="display:none;" class="form-control" placeholder="City" value="<?php echo $customer_country; ?>">
                  </div>

              </div> 




              <div style="width:30%; padding:20px; margin-top:0px; top:-120px; position:relative; display:inline-block; ">   

                <span style="font-size:40px; position:absolute; top:-0px; left:150px;" class="glyphicon glyphicon-briefcase"></span>

                  <h3 style="text-align:center; color:black; font-weight:600; padding:30px; margin-top:-40px; border-bottom:1px solid #555555;"><br>



                <span style="font-size:18px;color:#B80008; font-weight:600; position:relative; top:10px;"><span style="color:black;">Shipper Data</span></span>

              </h3>

                  <div class="input-group" style="margin-top:10px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-briefcase"></i></span>
                    <input name="supplier_company" type="text" class="form-control" placeholder="Company Name" disabled value="<?php echo $supplier_company; ?>">
                    <input style="display:none;" value="<?php echo $supplier_company; ?>" name="supplier_company">
                  </div>

                  <?php if ($supplier_company=='eBay' or $supplier_company=='Wal-Mart' or $supplier_company=='Amazon'){ ?>
                    
                  <?php }else{ ?>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                    <input type="text" class="form-control" placeholder="Contact Person" disabled required="required" value="<?php echo $supplier_name; ?>">
                    <input style="display:none;" value="<?php echo $supplier_name; ?>" name="supplier_name">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:-5px;" class="fa fa-phone"></i> Mobile</span>
                    <input name="supplier_telf1" type="text" class="form-control" placeholder="Mobile" value="<?php echo $supplier_telf1; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:-5px;" class="fa fa-phone"></i> Office</span>
                    <input name="supplier_telf2" type="text" class="form-control" placeholder="Office" value="<?php echo $supplier_telf2; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:-5px;" class="fa fa-phone"></i> QQ</span>
                    <input name="supplier_qq" type="text" class="form-control" placeholder="QQ" value="<?php echo $supplier_qq; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:-5px;" class="fa fa-phone"></i> WeChat</span>
                    <input name="supplier_wechat" type="text" class="form-control" placeholder="WeChat" value="<?php echo $supplier_wechat; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-envelope"></i></span>
                    <input name="supplier_email" type="text" value="<?php echo $supplier_email ?>" class="form-control" placeholder="E-mail">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="position:relative; top:-2px; left:px;"><i style="width:20px;" class="fa fa-location-arrow"></i></span>
                    <textarea style="resize:none;width:100%; height:90px; border:1px solid #D2D6DE;" name="supplier_address"><?php echo $supplier_address; ?></textarea>
                  </div>
                  <?php } ?>

                </div>



                <div style="width:30%; padding:20px; margin-top:0px; top:-38px;  position:relative; display:inline-block; ">

                  <span style="font-size:40px; position:absolute; top:63px; left:150px;" class="glyphicon glyphicon-plane"></span>

                  <h3 style="text-align:center; color:black; font-weight:600; padding:30px;  border-bottom:1px solid #555555;"><br>


                <span style="font-size:18px;color:#B80008; font-weight:600; position:relative; top:10px;"><span style="color:black;">Service Data</span></span>

              </h3>
              <br><br>



                <div class="input-group" style=" position:relative; top:-40px;">
                  <div class="input-group date" >
                  <div class="input-group-addon" >
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text"  class="form-control pull-right" data-provide="datepicker" name="fecha" data-date-format="dd-mm-yyyy" placeholder="Select date" value="<?php echo $fecha_vista; ?>" required style="width:260px;">

                  <input name="hora" style="display:none;" value="<?php echo date('H:i:s') ?>">
                </div>
              </div>

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
                      <option></option>
                      <option value="Pending">Pending</option>
                      <option value="Air door to door">Air door to door</option>
                      <option value="Ocean door to door">Ocean door to door</option>
                    </select>
                  </div>      


      

                
                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-cube"></i></span>
                    <select data-placeholder="Commodity" id="state" class="js-example-basic-single" name="commodity" type="text" multiple style="width:100%">


  <?php $consulta22 = mysqli_query($connect, "SELECT DISTINCT commodity FROM joborders  ") or die ("Error al traer los datos");

                        while ($row = mysqli_fetch_array($consulta22)){ 
                        $commodity=$row['commodity'];
                         ?>

                      <option value="<?php echo $commodity; ?>"><?php echo $commodity; ?></option>
                      <?php }  ?>
</select>


                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:;" class="fa  fa-folder-open-o"></i></span>
                    <input name="wh_receipt" type="text" class="form-control" placeholder="WH Receipt" value="">
                  </div>

                  <div class="input-group" style="margin-top:20px; border:1px solid red;">
                    <span class="input-group-addon"><i style="width:20px; position:relative; left:; " class="fa  fa-square"></i></span>
                    <textarea name="tracking" type="text" style="" class="form-control" placeholder="Tracking Number" value=""></textarea>
                  </div>
                

                  <div class="input-group" style="margin-top:0px;">
                    <h2 style="font-size:16px;">Need Pick-Up?</h2>
                    <label>
                        <input type="radio" name="remark" id="no" value="no" class="ron-red"  required="required" checked>
                        <label for="no">No</label>
                      </label>

                    <label style="margin-left:20px;">
                        <input  type="radio" name="remark" id="yes" value="yes" class="ron-red" required="required" >
                        <label for="yes">Yes</label>
                      </label>
                  </div>

                  <div class="input-group" style="margin-top:0px;">
                    <h2 style="font-size:16px;">Need Payment Assistant?</h2>
                    <label>
                        <input type="radio" name="payment" id="no" value="no" class="ron-red"  required="required" checked>
                        <label for="no">No</label>
                      </label>

                    <label style="margin-left:20px;">
                        <input  type="radio" name="payment" id="yes" value="yes" class="ron-red" required="required" >
                        <label for="yes">Yes</label>
                      </label>
                  </div>




                </div>


                <br><br>

                  

                  


                  <input type="submit"value="Save" class="form_1_submit" style="top:-290px; left:-70px; background:#007F46;">
              </form>



              </div> 


              <?php } ?>

              <br><br>

        </div>

      <!-- /Form -->
   
      

     


          
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->



  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->

      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

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


    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm-dd-yyyy", {"placeholder": "mm-dd-yyyy"});
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

  
$(document).ready(function() {
    $("#state").select2({
      tags: true
    });
      
    $("#btn-add-state").on("click", function(){
      var newStateVal = $("#new-state").val();
      // Set the value, creating a new option if necessary
      if ($("#state").find("option[value='" + newStateVal + "']").length) {
        $("#state").val(newStateVal).trigger("change");
      } else { 
        // Create the DOM option that is pre-selected by default
        var newState = new Option(newStateVal, newStateVal, true, true);
        // Append it to the select
        $("#state").append(newState).trigger('change');
      } 
    });  
});

    //Initialize Select2 Elements
    $(".select2").select2();


    jQuery(function ($) {        
  $('form').bind('submit', function () {
    $(this).find(':input').prop('disabled', false);
  });
});
</script>



</body>
</html>
