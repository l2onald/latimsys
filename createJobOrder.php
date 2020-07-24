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

    $cus_id=$row['id'];

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

    $client_id=$row['client_id'];

    $customer_address= $customer_address1.' '.$customer_address2.' | '.$customer_city.', '.$customer_state.' - '.$customer_country.'.';           
}  

$consultaSupplier = mysqli_query($connect, "SELECT * FROM accounts WHERE name='$supplier_name' AND company='$supplier_company' AND type='Supplier'   ") or die ("Error al traer los datos");

    while ($row = mysqli_fetch_array($consultaSupplier)){ 


      $supp_id=$row['id'];

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
      $supplier_id=$row['client_id'];

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
  <title>System | Create Job Orders</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link href='plugins/select2/select2.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">    
    <link rel="stylesheet" href=" https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link href='plugins/datatables/jquery.dataTables.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="./plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="./plugins/datepicker/datepicker3.css">    
    <link rel="stylesheet" href="plugins/iCheck/all.css">
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="latimstyle.css">
    <link href='assets/css/style.css' rel='stylesheet' type='text/css'>
    <!-- <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script> -->
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <!-- <script src="plugins/jQuery/jquery-2.2.3.min.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="plugins/datatables/jquery.dataTables.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/select2/select2.js"></script>  
    <script src="./plugins/input-mask/jquery.inputmask.js"></script>
    <script src="./plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="./plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="./plugins/daterangepicker/daterangepicker.js"></script>
    <script src="./plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="./plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="plugins/fastclick/fastclick.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>  


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
        <li class=" treeview" style="border-bottom:1px solid gray; padding:5px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-home"></i> <span style="font-size:11px; ">Warehouse</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a class="" href="createWarehouse.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li><a href="searchAccount.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>
        <center><div style="width:100%; height:20px; position:relative; top:0px; background:#CECAC6; color:#630000; font-weight:600; font-size:14px;">JOB ORDERS</div></center>

        <li class="active treeview" style="border-bottom:1px solid gray; padding:5px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-files-o"></i> <span style="font-size:11px;">CHINA Orders</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class=""><a class="active" href="createJobOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li ><a class="" href="searchJobOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>

        
        <li class="treeview" style="border-bottom:1px solid gray; padding:5px; margin-top:0px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-files-o"></i> <span style="font-size:11px;">USA Orders</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a class="" href="createUsaOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
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
        Job Orders 
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create Job Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

    <?php if ($step=='') {$step='1';} ?>

    <?php if ($step=='1'){ ?>
      <div class="row" style="margin: 0px;"> 
            <div class="col-md-offset-2 col-md-8 shadow2" style="    background: white;margin-top:50px">
              <div class="row">
                <div class="col-md-12">
                  <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">Create Job Order

                  </h3>
                </div>
              </div>
              <form action="?step=2" method="post">
                <div class="row" style="margin:30px 50px">
                  <div class="col-md-6">
                      <div class="form-group ">
                          <div class="text-center" style="border-bottom:1px solid #555555; margin-bottom:20px">
                              <span style="font-size:35px; padding:10px;" class="glyphicon glyphicon-user"></span><br>
                              <span style="padding-top:15px;font-size:16px;">Select Client Account</span>                        
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-md-12" >
                            <div class=" input-group">
                              <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                              <select data-placeholder="Select Client" name="customer_step1" class="form-control select2" style="width:100%; " required="required" >

                                <option selected="selected" value="<?php echo $customer; ?>"><?php echo $customer; ?></option>
                                <?php 

                                if ($level=='Seller') { $consulta = mysqli_query($connect, "SELECT * FROM accounts WHERE agent='$agent_name' AND type='Client' ORDER BY name asc ") or die ("Error al traer los datos"); 
                                }else{
                                  $consulta = mysqli_query($connect, "SELECT * FROM accounts WHERE type='Client' ORDER BY name asc ") or die ("Error al traer los datos");
                                }
                                  while ($row = mysqli_fetch_array($consulta)){ 
                                    $company=$row['company'];
                                    $name=$row['name'];

                                    $customer_if= $name;
                                    if ($company!='') { $customer_if .= ' | '.$company; } 
                                    if ($customer!=$customer_if){ ?>
                                    
                                      
                                    <option value="<?php echo $customer_if; ?>"><?php echo $customer_if; ?></option>
                                    <?php }?>
                                <?php }  ?>
                              </select>
                            </div>                  
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-md-12 text-center">
                              <button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#myModal1">Add New Client</button>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-group ">
                          <div class="text-center" style="border-bottom:1px solid #555555; margin-bottom:20px">
                              <span style="font-size:35px; padding:10px;" class="glyphicon glyphicon-briefcase"></span><br>
                              <span style="padding-top:15px;font-size:16px;">Select Supplier Account</span>                        
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-md-12" >
                            <div class=" input-group">
                              <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                              <select data-placeholder="Select Supplier" name="supplier_step1" class="form-control select2" style="width:100%" required="required">
                                  <option selected="selected" value="<?php echo $supplier; ?>"><?php echo $supplier; ?></option>
                                  <option value="No Supplier Information">No Supplier Information</option>
                                  <?php $consulta = mysqli_query($connect, "SELECT * FROM accounts WHERE type='Supplier' order by name ") or die ("Error al traer los datos");
                                        while ($row = mysqli_fetch_array($consulta)){ 
                                          $company=$row['company'];
                                          $name=$row['name'];
                                          $supplier_if= $company;
                                          if ($name!='') { $supplier_if .= ' | '.$name; }
                                          if ($supplier!=$supplier_if){ ?>
                                      <option value="<?php echo $supplier_if; ?>"><?php echo $supplier_if; ?></option>
                                      <?php } ?>
                                      <?php }  ?>
                                </select>
                            </div>                  
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-md-12 text-center">
                              <button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#myModal2">Add New Supplier</button>
                          </div>
                      </div>
                  </div>
                  
                </div>
                <div class="row" style="padding-bottom:30px">
                      <div class="col-md-12 text-center">
                          <button type="submit" class="btn btn-success" style="width:200px">Next</button>
                      </div>
                </div>
              </form>
            </div>
          </div>
          <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add new client</h4>
                    </div>
                    <form action="action/saveAccountStep1.php" method="POST">
                    <div class="modal-body">
                        
                            <input name="supplier" value="<?php echo $supplier; ?>" style="display:none;">

                            <div class="input-group">
                                <span class="input-group-addon"><i style="width:20px;" class="fa fa-circle"></i></span>
                                <select data-placeholder="Select Agent" <?php if ($level!='Seller' ){ ?> name="agent_name"
                                    <?php } ?> class="form-control select2" <?php if ($level=='Seller'){ ?> disabled <?php } ?>
                                    style="width:100%;">

                                    <option value="<?php echo $agent_name; ?>"><?php echo $agent_name; ?></option>

                                    <?php 

                                $consultaList = mysqli_query($connect, "SELECT * FROM agents ORDER BY name asc ") or die ("Error al traer los datos");

                                  while ($rowList = mysqli_fetch_array($consultaList)){ 

                                  $agent_List=$rowList['name']; ?>


                                    <?php if ($agent_name!=$agent_List){ ?>

                                    <option value="<?php echo $agent_List; ?>"><?php echo $agent_List; ?></option>
                                    <?php } }  ?>

                                  </select>

                                <?php if ($level=='Seller'){ ?>
                                <input type="text" name="agent_name" style="display:none;" value="<?php echo $agent_name; ?>">
                                <?php } ?>



                            </div>

                            <div class="input-group" style="margin-top:20px;">
                                <span class="input-group-addon">CargoTrack ID <br><br>
                                  <a style="background:#D85050;" href="https://latim.cargotrack.net/appl2.0/accounts/add.asp"
                                    onclick="window.open(this.href, 'mywin',
                                            'left=200,top=20,width=1280,height=650,toolbar=1,resizable=0'); return false;"><button
                                      style=" background:#D85050; border:none; font-size:12px; padding:5px; position:relative; top:-5px;">Click
                                      to Add [cargotrack.net]</button></a></span>
                                <input style="display:none;" value="<?php echo $cus_id; ?>" name="cus_id">
                                <input name="client_id" style="height:65px;" type="number" class="form-control" placeholder="# ..." value="<?php echo $client_id; ?>">
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
                        <input type="submit" value="Save" class="form_1_submit" style="top:0px; background:#007F46;">
                        
                    </div>
                    </form>
                </div>                                
            </div>
          </div>
          <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Add new supplier</h4>
                    </div>
                    <form action="action/saveSupplierStep1.php" method="POST">
                    <div class="modal-body">
                        

                            <input name="customer" value="<?php echo $customer; ?>" style="display:none;">

                            <div class="input-group" style="margin-top:20px;">
                                <span class="input-group-addon">CargoTrack ID <br><br>
                                  <a style="background:#D85050;" href="https://latim.cargotrack.net/appl2.0/accounts/add.asp"
                                    onclick="window.open(this.href, 'mywin',
                                  'left=200,top=20,width=1280,height=650,toolbar=1,resizable=0'); return false;"><button
                                      style=" background:#D85050; border:none; font-size:12px; padding:5px; position:relative; top:-5px;">Click
                                      to Add [cargotrack.net]</button></a></span>
                                <input style="display:none;" value="<?php echo $supp_id; ?>" name="supp_id">
                                <input name="supplier_id" style="height:65px;" type="number" class="form-control" placeholder="# ..." value="<?php echo $supplier_id; ?>">


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
                                <input name="state" type="text" class="form-control" placeholder="State">
                            </div>

                            <div class="input-group" style="margin-top:20px;">
                                <span class="input-group-addon"><i style="width:20px;" class="fa fa-globe"></i></span>
                                <select name="country" class="form-control select2" style="width:100%;" required="required">
                                <option value="">Select Country</option>
                                <option value="CN">China</option>
                                <option value="TAIWAN">Taiwan</option>
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
                        <input type="submit" value="Save" class="form_1_submit" style="top:0px; background:#007F46;">

                        
                    </div>
                    </form>
                </div>
            </div>
          </div>
        <?php } ?>

        <?php if ($step=='2'){ ?>
       
            <div class="searchPage shadow2" style=" background: white;margin-top:50px">
              <div class="row">
                <div class="col-md-12">
                  <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">Create Job Order
                  </h3>
                </div>
              </div>
              <form action="action/saveJobOrder.php" method="POST">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group row text-center">
                      <div class="col-md-12">
                          <i class="fa fa-user icon"></i>
                          <h4 class="title">Customer Data</h4>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class=" input-group">
                              <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                              <input type="text" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>" disabled placeholder="">
                              <input type="hidden"name="customer_name" value="<?php echo $customer_name; ?>">
                          </div>
                      </div>
                  </div>
                  
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class=" input-group" >
                          <?php if($supplier_company!='No Supplier Information'){ ?>
                              <div class="input-group-addon" >
                                      <span>CargoTrack ID</span><br> 
                                      <a  href="https://latim.cargotrack.net/appl2.0/accounts/add.asp" style="padding: 2px; font-size: 10px; margin-top: 3px;" onclick="window.open(this.href, 'mywin','left=200,top=20,width=1280,height=650,toolbar=1,resizable=0'); return false;"  class="btn btn-danger btn-sm">Click to Add [cargotrack.net]</a> 
                              </div>
                          <?php }else{ ?>
                            <div class="input-group-addon">
                                      <span>CargoTrack ID</span><br> 
                              </div>
                          <?php } ?>
                              <input type="hidden" value="<?php echo $cus_id; ?>" name="cus_id">
                              <input name="client_id" style=" <?php if ($supplier_company=='No Supplier Information'){ ?>height:34px;<?php }else{ ?>height:52px;<?php } ?>" type="number" class="form-control" placeholder="# ..." value="<?php if ($supplier_company=='No Supplier Information'){echo '927';}else{ echo $client_id; }?>">                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-phone input-fa"></i>&nbsp;Mobile</div>
                              <input type="text" name="customer_telf1" class="form-control" value="<?php echo $customer_telf1; ?>" placeholder="Mobile">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-phone input-fa"></i>&nbsp;Office</div>
                              <input type="text" name="customer_telf2" class="form-control" value="<?php echo $customer_telf2; ?>" placeholder="Office">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-phone input-fa"></i>&nbsp;QQ</div>
                              <input type="text" name="customer_qq" class="form-control" value="<?php echo $customer_qq; ?>" placeholder="QQ">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-phone input-fa"></i>&nbsp;WeChat</div>
                              <input type="text" name="customer_wechat" class="form-control" value="<?php echo $customer_wechat; ?>" placeholder="WeChat">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-envelope input-fa"></i></div>
                              <input type="text" name="customer_email" class="form-control" value="<?php echo $customer_email; ?>" placeholder="E-mail">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class=" input-group">
                              <div class="input-group-addon"><i class="fa fa-location-arrow input-fa"></i></div>
                              <textarea name="customer_address" id="" cols="30" rows="4" class="form-control"><?php echo $customer_address; ?></textarea>
                              <input name="customer_city" type="hidden"  class="form-control" placeholder="City" value="<?php echo $customer_city; ?>">
                              <input name="customer_state" type="hidden"  class="form-control" placeholder="City" value="<?php echo $customer_state; ?>">
                              <input name="customer_country" type="hidden"  class="form-control" placeholder="City" value="<?php echo $customer_country; ?>">
                          </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row text-center">
                        <div class="col-md-12">
                            <i class="fa fa-briefcase icon"></i>
                            <h4 class="title">Supplier Data</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-briefcase input-fa"></i></div>
                                <input type="text" class="form-control"  value="<?php echo $supplier_company; ?>" disabled placeholder="Company Name">
                                <input type="hidden" value="<?php echo $supplier_company; ?>" name="supplier_company">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                                <input type="text" class="form-control" value="<?php echo $supplier_name; ?>" disabled placeholder="Contact Person">
                                <input type="hidden" value="<?php echo $supplier_name; ?>" name="supplier_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-md-12">
                          <div class=" input-group" >
                          <?php if($supplier_company!='No Supplier Information'){ ?>
                              <div class="input-group-addon" >
                                      <span>CargoTrack ID</span><br> 
                                      <a  href="https://latim.cargotrack.net/appl2.0/accounts/add.asp" style="padding: 2px; font-size: 10px; margin-top: 3px;" onclick="window.open(this.href, 'mywin','left=200,top=20,width=1280,height=650,toolbar=1,resizable=0'); return false;"  class="btn btn-danger btn-sm">Click to Add [cargotrack.net]</a> 
                              </div>
                          <?php }else{ ?>
                            <div class="input-group-addon">
                                      <span>CargoTrack ID</span><br> 
                              </div>
                          <?php } ?>
                              <input type="hidden" value="<?php echo $supp_id; ?>" name="supp_id">
                              <input name="supplier_id" style=" <?php if ($supplier_company=='No Supplier Information'){ ?>height:34px;<?php }else{ ?>height:52px;<?php } ?>" type="number" class="form-control" placeholder="# ..." value="<?php if ($supplier_company=='No Supplier Information'){echo '927';}else{ echo $supplier_id; }?>">    
                          </div>
                      </div>
                      <div class="col-md-12 text-center">
                          <?php if ($supplier_company=='No Supplier Information'){ ?>
                            <span style="font-weight:600; font-size:12px; ">(<span style="font-size:10px; color:red;">PENDING</span> CargoTrack ID is: 927).</span>
                            <?php } ?>
                      </div>
                    </div>                    
                    <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-phone input-fa"></i>&nbsp;Mobile</div>
                              <input type="text" name="supplier_telf1" class="form-control" value="<?php echo $supplier_telf1; ?>" placeholder="Mobile">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-phone input-fa"></i>&nbsp;Office</div>
                              <input type="text" name="supplier_telf2" class="form-control" value="<?php echo $supplier_telf2; ?>" placeholder="Office">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-phone input-fa"></i>&nbsp;QQ</div>
                              <input type="text" name="supplier_qq" class="form-control" value="<?php echo $supplier_qq; ?>" placeholder="QQ">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-phone input-fa"></i>&nbsp;WeChat</div>
                              <input type="text" name="supplier_wechat" class="form-control" value="<?php echo $supplier_wechat; ?>" placeholder="WeChat">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-envelope input-fa"></i></div>
                              <input type="text" name="supplier_email" class="form-control" value="<?php echo $supplier_email; ?>" placeholder="E-mail">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class=" input-group">
                              <div class="input-group-addon"><i class="fa fa-location-arrow input-fa"></i></div>
                              <textarea name="supplier_address" id="" cols="30" rows="4" class="form-control"><?php echo $supplier_address; ?></textarea>                            
                          </div>
                      </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group row text-center">
                      <div class="col-md-12">
                          <i class="fa fa-plane icon"></i>
                          <h4 class="title">Service Data</h4>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-calendar input-fa"></i></div>
                              <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-date-format="dd-mm-yyyy" placeholder="Select date" value="<?php echo $fecha_vista; ?>" required >
                              <input name="hora" type="hidden" value="<?php echo date('H:i:s') ?>">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class=" input-group">
                              <div class="input-group-addon"><i class="fa fa-circle input-fa"></i></div>
                              <select id="" class="form-control select2" placeholder="Select Agent" <?php if ($level!='Seller'){ ?> name="agent_name" <?php } ?> <?php if ($level=='Seller'){ ?> disabled <?php } ?>>
                              <option value="<?php echo $agent_name; ?>"><?php echo $agent_name; ?></option>
                              <?php 
                                  $consultaList = mysqli_query($connect, "SELECT * FROM agents ORDER BY name asc ") or die ("Error al traer los datos");

                                  while ($rowList = mysqli_fetch_array($consultaList)){ 

                                  $agent_List=$rowList['name']; 
                                  if ($agent_name!=$agent_List){ 
                                  ?>
                                  <option value="<?php echo $agent_List; ?>"><?php echo $agent_List; ?></option>
                                  <?php }   ?>
                                  <?php }  ?>
                              </select>
                              <?php if ($level=='Seller'){ ?>
                              <input type="text" name="agent_name" type="hidden" value="<?php echo $agent_name; ?>">
                              <?php } ?>
                          </div>
                      </div>
                  </div>
                  <input type="hidden" name="agent_email" value="<?php echo $email; ?>">
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class=" input-group">
                              <div class="input-group-addon"><i class="fa fa-plane input-fa"></i></div>
                              <select name="service" id="" class="form-control select2" data-placeholder="Select Service" required>
                                    <option></option>
                                    <option value="Pending">Pending</option>
                                    <option value="Air Service">Air Service</option>
                                    <option value="Ocean Service">Ocean Service</option>
                                    <option value="Busqueda / Agenciamiento de compra">Busqueda / Agenciamiento de compra</option>
                                    <option value="Inspecciones / Auditorias">Inspecciones / Auditorias</option>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-cube input-fa"></i></div>
                              <select data-placeholder="Commodity" id="state" class="form-control select2" name="commodity" type="text" multiple>


                              <?php $consulta22 = mysqli_query($connect, "SELECT DISTINCT commodity FROM joborders  ") or die ("Error al traer los datos");

                                      while ($row = mysqli_fetch_array($consulta22)){ 
                                      $commodity=$row['commodity'];
                                      ?>

                              <option value="<?php echo $commodity; ?>"><?php echo $commodity; ?></option>
                              <?php }  ?>
                              </select>
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <div class="input-group">
                              <div class="input-group-addon"><i class="fa fa-folder-open-o input-fa"></i></div>
                              <input type="text" name="wh_receipt" class="form-control"  value="" placeholder="WH Receipt">
                          </div>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <label for="">Need Pick-Up?</label>
                      </div>
                      <div class="col-md-12">
                          <label class="radio-inline">
                              <input type="radio" name="remark" id="no" value="no" checked  > No
                              </label>
                          <label class="radio-inline">
                              <input type="radio"   name="remark" id="yes" value="yes"  > Yes
                              </label>
                      </div>
                  </div>
                  <div class="form-group row">
                      <div class="col-md-12">
                          <label for="">Need Payment Assistant?</label>
                      </div>
                      <div class="col-md-12">
                          <label class="radio-inline">
                              <input type="radio" name="payment" id="no" value="no" checked> No
                              </label>
                          <label class="radio-inline">
                              <input type="radio" name="payment" id="yes" value="yes" > Yes
                              </label>
                      </div>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                <div class="form-group">
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
                </div>
                </div>
              </div>
              </form>
          </div>        
        <?php } ?>
      <!-- Form -->
      </section>
</div>
<!-- ./wrapper -->

<!-- Page script -->
<script>
  $(function () {

    $(".select2").select2();
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

    
  });



    //Initialize Select2 Elements



    jQuery(function ($) {        
  $('form').bind('submit', function () {
    $(this).find(':input').prop('disabled', false);
  });
});
</script>



</body>
</html>
