<?php 
error_reporting(0);
require_once('conn.php');   
session_start();
$message= $_GET['message'];
$step= $_GET['step'];
$warehouse_id= $_GET['warehouse_id'];
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
    <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

    a:hover, a:active, a:focus, .active{color:#FBFFA3; font-weight:800;}

    .active{color:yellow; font-weight:800;}

    .content-wrapper{background-color:#f0f0f0;}

    .shadow2{
        -webkit-box-shadow: 0px 2px 2px 1px rgba(194,192,194,0.75);
    -moz-box-shadow: 0px 2px 2px 1px rgba(194,192,194,0.75);
    box-shadow: 0px 2px 2px 1px rgba(194,192,194,0.75);

    }
    .add_btn{
      padding: 0px !important;
      border-color:#B80008 !important;
    }
    .add_btn button{
      border-radius: 0px !important;
      border:0px !important;
      
    }
    .control-label{
        padding-top: 10px;
      font-weight: 300;
      font-size: 16px;
    }
    .span_custom{
      background-color:#B80008 !important;
      color:#fff;
      min-width:92px;
      border-color:#B80008 !important;
    }

.card{
    border: 1px solid #D2D6DE;
    padding: 15px;
    margin-bottom:20px;
}
.col-item{
    padding-left: 5px;
    padding-right: 5px;
}
.item{
    margin-left: 20px;
}
.btn_plus{
    background-color: #007F46;
    color: #fff;
    font-weight: bold;
    border-radius: 0px;
}
.item .form-group label{
    font-size:11px;
    text-align:center;
}

#input-file-now{
    width: 100%;
    height: 100%;
    opacity: 0;
    /* overflow: hidden; */
    position: absolute;
}

  table.dataTable, table.dataTable th, table.dataTable td {
    height: unset;
}
</style>
</head>
<body  >



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
            <li ><a class="" href="createAccount.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li><a href="searchAccount.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
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

        <li class="active treeview" style="border-bottom:1px solid gray; padding:5px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-home"></i> <span style="font-size:11px; ">Warehouse</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a  href="createWarehouse.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li><a href="searchAccount.php" class="active" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
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
            <li class=""><a href="createJobOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
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
  <div class="content-wrapper" >
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Warehouse 
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create Warehouse</li>
      </ol>
    </section>

    <section class="content">

<?php if ($step=='') {$step='1';} ?>

<?php if ($step=='1'){ ?>
      <div class="row" style="margin: 0px;"> 
        <div class="col-md-offset-2 col-md-8 shadow2" style="background: white;margin-top:50px">
          <div class="row">
            <div class="col-md-12">
              <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">SEARCHER WAREHOUSE RECEIPT</h3>
            </div>
          </div>
          <form action="searchWarehouse.php" id="step1_form"  method="get">
            <input name="step" type="hidden"  value="2" class="form-control">
            <div class="row" style="margin:30px 0px">
              <div class="col-md-6">   
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar input-fa"></i></div>
                            <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-date-format="yyyy-mm-dd" placeholder="Select date" value=""  >
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Tracking</span>
                        <input name="tracking" type="text"  class="form-control">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Supplier</span>
                        <select name="supplier_id" id="" class="form-control select2" data-placeholder="Select Supplier" style="width:100%" >
                          <option value="">--Select Supplier--</option>
                        <?php 
                          $consulta = mysqli_query($connect, "SELECT * FROM accounts where type='Supplier' order by id ")
                          or die ("Error al traer los Agent");
                           while ($row = mysqli_fetch_array($consulta)){
                      
                              $ID=$row['id'];
                              $name=$row['name'];
                              $company=$row['company'];
                              $city=$row['city'];
                            
                        ?>
                          <option value="<?php echo $ID; ?>"><?php echo $ID; ?> <?php echo $name; ?>/<?php echo $company; ?> <?php echo $city; ?></option>
                           <?php } ?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Consignee</span>
                      <select name="consignee_id" id="" class="form-control select2" data-placeholder="Select Consignee" style="width:100%" >
                          <option value="">--Select Consignee--</option>
                        <?php 
                          $consulta = mysqli_query($connect, "SELECT * FROM accounts where type='Client' or type='Agent' order by id ")
                          or die ("Error al traer los Agent");
                           while ($row = mysqli_fetch_array($consulta)){
                      
                              $ID=$row['id'];
                              $name=$row['name'];
                              $company=$row['company'];
                              $city=$row['city'];
                            
                        ?>
                          <option value="<?php echo $ID; ?>"><?php echo $ID; ?> <?php echo $name; ?>/<?php echo $company; ?> <?php echo $city; ?></option>
                           <?php } ?>
                        </select>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Agent</span>
                      <select name="agent_id" id="" class="form-control select2" data-placeholder="Select Agent" style="width:100%" >
                          <option value="">--Select Agent--</option>
                        <?php 
                          $consulta = mysqli_query($connect, "SELECT * FROM agents  where level='Administrator' or level='Seller' order by id ")
                          or die ("Error al traer los Agent");
                           while ($row = mysqli_fetch_array($consulta)){
                      
                              $ID=$row['id'];
                              $name=$row['name'];
                        ?>
                          <option value="<?php echo $ID; ?>"><?php echo $ID; ?> <?php echo $name; ?></option>
                           <?php } ?>
                        </select>
                    </div>
                  </div>                  
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Bill to</span>
                      <select name="bill_id" id="" class="form-control select2" data-placeholder="Select Bill" style="width:100%" >
                          <option value="">--Select Bill--</option>
                        <?php 
                          $consulta = mysqli_query($connect, "SELECT * FROM accounts where type='Client' or type='Agent' order by id ")
                          or die ("Error al traer los Agent");
                           while ($row = mysqli_fetch_array($consulta)){
                      
                              $ID=$row['id'];
                              $name=$row['name'];
                              $company=$row['company'];
                              $city=$row['city'];
                            
                        ?>
                          <option value="<?php echo $ID; ?>"><?php echo $ID; ?> <?php echo $name; ?>/<?php echo $company; ?> <?php echo $city; ?></option>
                           <?php } ?>
                        </select>
                    </div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Reference</span>
                        <input type="text" name="reference_id" class="form-control" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group row">                  
                    <div class="col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon span_custom" style="">Invoice</span>
                          <input type="text" name="invoice" class="form-control" placeholder="">
                      </div>
                    </div>                    
                </div>
                <div class="form-group row">                  
                  <div class="col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon span_custom" style="">PO</span>
                          <input type="text" name="po" class="form-control" placeholder="">
                      </div>
                  </div>    
                </div>                 
                <div class="form-group row">                  
                    <div class="col-md-12">
                      <div class="input-group">
                        <span class="input-group-addon span_custom" style="font-size:12px">Delivered By</span>
                          <input type="text" name="delivered_by1" class="form-control" placeholder="">
                      </div>
                    </div>                    
                </div>                
              </div>  
              <div class="col-md-6"> 
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Branch</span>
                        <input type="text" name="branch" class="form-control" placeholder="Branch">
                    </div>
                  </div>
                </div>
                
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom" style="font-size:10px">Pickup Number</span>
                        <input type="text" name="pickup_number" class="form-control" placeholder="Pickup Number">
                    </div>
                  </div>
                </div>
                <div class="form-group row">                  
                    <div class="col-md-8">
                      <div class="input-group">
                        <span class="input-group-addon span_custom">Location</span>
                          <input type="text" name="location1" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4">                    
                          <input type="text" name="location2" class="form-control" placeholder="">
                    </div>
                </div>
                <div class="form-group row">                  
                    <div class="col-md-8">
                      <div class="input-group">
                        <span class="input-group-addon span_custom">Can</span>
                          <input type="text" name="can" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4">                    
                      <label  class="control-label"><input type="checkbox" name="distribution">&nbsp;Distribution</label>
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom" style="font-size:13px;">Destination</span>
                        <input type="text" name="destination" class="form-control" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group row">                  
                    <div class="col-md-8">
                      <div class="input-group">
                        <span class="input-group-addon span_custom">Instination</span>
                          <input type="text" name="instination1" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4">                    
                          <input type="text" name="instination2" class="form-control" placeholder="">
                    </div>
                </div>
                <!-- <div class="form-group row">
                  <label class="control-label col-md-4" >Status</label>
                    <div class="col-md-8">
                          <label class="control-label radio-inline"><input type="radio" name="status" value="received" checked>Received</label>
                          <label class="control-label radio-inline"><input type="radio" name="status" value="pre-alert">Pre-alert</label>
                    </div>                   
                </div> -->
                <div class="form-group row">
                  <label class="control-label col-md-4" ></label>
                    <div class="col-md-8">
                      <div class="row">
                        <div class="col-md-12">
                          <label class="control-label radio-inline"><input type="checkbox" name="dangerous_goods" >&nbsp;Dangerous Goods</label>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label class="control-label radio-inline"><input type="checkbox"  name="seo" >&nbsp;SED</label>
                          <label class="control-label radio-inline"><input type="checkbox"  name="fragile">&nbsp;FRAGILE</label>
                        </div>
                      </div> 
                      <div class="row">
                        <div class="col-md-12">
                          <label class="control-label radio-inline"><input type="checkbox"  name="insurance" >&nbsp;Insurance</label>
                        </div>
                      </div> 
                    </div>                   
                </div>
              </div>
            </div>
            <div class="row" style="padding-bottom:30px">
                  <div class="col-md-12 text-right">
                      <button type="submit" class="btn btn-success" >Next&nbsp;<i class="fa fa fa-chevron-right"></i></button>
                  </div>
            </div>
          </form>
        </div>
      </div>     
<?php } ?>

    <?php if ($step=='2'){ ?>
   
        <div class="searchPage shadow2" style="background: white;margin-top:50px">
          <div class="row">
            <div class="col-md-12">
              <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">SEARCHER WAREHOUSE RECEIPT</h3>
            </div>
          </div>           
          <div class="row">
              <div class="col-md-12 text-right">
                <a class="toggle-vis btn btn-success btn-sm" data-column="0">Status</a>
                <a class="toggle-vis btn btn-success btn-sm" data-column="1">Number</a>
                <a class="toggle-vis btn btn-success btn-sm" data-column="2">Dest</a>
                <a class="toggle-vis btn btn-success btn-sm" data-column="3">Date</a>
                <a class="toggle-vis btn btn-success btn-sm" data-column="4">Pieces</a>
                <a class="toggle-vis btn btn-success btn-sm" data-column="5">Weight</a>
                <a class="toggle-vis btn btn-success btn-sm" data-column="6">Volume</a>
                <a class="toggle-vis btn btn-success btn-sm" data-column="7">Value</a>
                <a class="toggle-vis btn btn-success btn-sm" data-column="8">Shipper</a>
                <a class="toggle-vis btn btn-success btn-sm" data-column="9">Consignee</a>
                <a class="toggle-vis btn btn-success btn-sm" data-column="10">Reference</a>
              </div>
              <div class="col-md-12" style="margin-top:20px;">
                <form clsss="row text-center" action="#" id="filter">
                    <div class="col-md-offset-3 col-md-2">                        
                        <div class=" input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar input-fa"></i></div>
                            <input type="text" class="form-control" data-provide="datepicker" id="from"
                            data-date-format="yyyy-mm-dd" laceholder="To" value="1990-01-01"   placeholder="From">
                        </div>                          
                    </div>
                    <div class="col-md-2">                        
                        <div class=" input-group">
                            <input t type="text" class="form-control" data-provide="datepicker" id="to"
                                  data-date-format="yyyy-mm-dd" laceholder="To" value="<?php echo date('Y-m-d') ?>"   placeholder="To">
                        </div>                    
                    </div>
                    <div class="col-md-2">
                        <div class="form-group row">                            
                            <button  type="submit" class="btn btn-success "><i class="fa fa-search"></i>&nbsp;Filter</button>                                
                        </div>
                    </div>
                </form>
              </div>
              <div class="col-md-12">
                  
                  <div class="table-responsive">
                      <table id='empTable' style="width:100%;" class='display dataTable'>
                          <thead>
                              <tr class="text-center">
                                 <th>Status</th>
                                  <th>Number</th>
                                  <th>Dest</th>
                                  <th >Date</th>
                                  <th>Pieces</th>
                                  <th>Weight</th>
                                  <th>Volume</th>
                                  <th>Value</th>
                                  <th>Shipper</th>
                                  <th>Consignee</th>
                                  <th>Reference</th>
                              </tr>
                          </thead>
                      </table>
                  </div>
              </div>
          </div> 
        </div>
    <?php } ?>
  <!-- Form -->
  </section>
</div>

<script> 
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    var from='', to='';
    var table=$('#empTable').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          'processing': true,
          'serverSide': true,        
          'serverMethod': 'post',
          "order": [
              [1, "desc"]
          ],
          'columnDefs': [{
              orderable: false,
              targets: [8, 9, 10]
          }],
          'ajax': {
              'url': 'ajaxfile_warehouse.php',
              "data" :function(d){
                  d.fecha ='<?php echo $_GET['fecha'] ?>';
                  d.tracking ='<?php echo $_GET['tracking'] ?>';
                  d.supplier_id ='<?php echo $_GET['supplier_id'] ?>';
                  d.consignee_id ='<?php echo $_GET['consignee_id'] ?>';
                  d.agent_id ='<?php echo $_GET['agent_id'] ?>';
                  d.bill_id ='<?php echo $_GET['bill_id'] ?>';
                  d.reference_id ='<?php echo $_GET['reference_id'] ?>';
                  d.invoice ='<?php echo $_GET['invoice'] ?>';
                  d.po ='<?php echo $_GET['po'] ?>';
                  d.delivered_by1 ='<?php echo $_GET['delivered_by1'] ?>';
                  d.branch ='<?php echo $_GET['branch'] ?>';
                  d.pickup_number ='<?php echo $_GET['pickup_number'] ?>';
                  d.location1 ='<?php echo $_GET['location1'] ?>';
                  d.location2 ='<?php echo $_GET['location2'] ?>';
                  d.can ='<?php echo $_GET['can'] ?>';
                  d.destination ='<?php echo $_GET['destination'] ?>';
                  d.instination1 ='<?php echo $_GET['instination1'] ?>';
                  d.instination2 ='<?php echo $_GET['instination2'] ?>';
                  // d.status ='<?php echo $_GET['status'] ?>';
                  d.dangerous_goods ='<?php echo $_GET['dangerous_goods'] ?>';
                  d.seo ='<?php echo $_GET['seo'] ?>';
                  d.insurance ='<?php echo $_GET['insurance'] ?>';
                  d.fragile ='<?php echo $_GET['fragile'] ?>';
                  d.from = Getfrom();
                  d.to = Getto();
              }
          },
        'columns': [{
                data: 'status'
            }, {
                data: 'id'
            },{
                data: 'destination'
            }, {
                data: 'fecha'
            },  {
                data: 'supplier_id'
            }, {
                data: 'consignee_id'
            }, {
                data: 'total_pieces'
            }, {
                data: 'total_weight'
            },
            {
                data: 'total_volume'
            },
            {
                data: 'value'
            },
              {
                data: 'reference_id'
            }],
          "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
            switch(aData['status_ele']){
                case 'received':
                    $('td', nRow).css('background-color', '#4ee27f9e')
                    break;
            }
        }
      });
      function Getfrom(){
            return $("#from").val();
      }
      function Getto(){
          return $("#to").val();
      }
      
      $("#filter").submit(function(e) { 
        e.preventDefault();     
          swal({
          title: "Date Fiter!",
          text: "Data filtered successful!",
          icon: "success",
          });
          table.ajax.reload();
      }); 
    $('a.toggle-vis').on( 'click', function (e) {
        e.preventDefault();
        console.log($( this ).css( "background-color" ));
        if( $(this).css("background-color")=='rgb(0, 141, 76)'){          
          $(this).css("background-color","red");
        }else{
          $(this).css("background-color","rgb(0, 141, 76)");
        }
        
        // Get the column API object
        var column = table.column( $(this).attr('data-column') );
 
        // Toggle the visibility
        column.visible( ! column.visible() );
    } );
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();
    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
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
    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();
  
  });
</script>


</body>
</html>
