<?php 
error_reporting(0);
require_once('conn.php');
    $client_name= $_GET['client_name'];
    $message= $_GET['message'];
    $option= $_GET['option'];
    $step= $_GET['step'];

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

<?php date_default_timezone_set('America/La_Paz');
    $fecha_db= date('Y-m-d H:i:s');
    $fecha_vista= date('d-m-Y'); ?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Latim Cargo & Trading | System</title>
  <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">
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

  <style>
    .container1 input[type=text] {
      padding: 5px 0px;
      margin: 0px 0px 0px 0px;
      height: 30px;
    }

    .container2 input[type=text] {
      padding: 5px 0px;
      margin: 0px 0px 0px 0px;
      height: 30px;
    }

    .container3 input[type=text] {
      padding: 5px 0px;
      margin: 0px 0px 0px 0px;
      height: 30px;
    }

    .container4 input[type=text] {
      padding: 5px 0px;
      margin: 0px 0px 0px 0px;
      height: 30px;
    }


    .add_form_field {
      background-color: #007F46;
      border: none;
      color: white;
      padding: 2px 2px;
      text-align: center;
      text-decoration: none;
      font-size: 10px;
      margin: 4px 2px;
      cursor: pointer;
      width: 82px;
      position: relative;
      left: 50%;
      margin-left: -60px;
      margin-top: 10px;
      border: 1px solid #007F46;

    }

    .add_form_field2 {
      background-color: #007F46;
      border: none;
      color: white;
      padding: 2px 2px;
      text-align: center;
      text-decoration: none;
      font-size: 10px;
      margin: 4px 2px;
      cursor: pointer;
      width: 82px;
      position: relative;
      left: 50%;
      margin-left: -60px;
      margin-top: 10px;
      border: 1px solid #007F46;

    }

    .add_form_field3 {
      background-color: #007F46;
      border: none;
      color: white;
      padding: 2px 2px;
      text-align: center;
      text-decoration: none;
      font-size: 10px;
      margin: 4px 2px;
      cursor: pointer;
      width: 82px;
      position: relative;
      left: 50%;
      margin-left: -60px;
      margin-top: 10px;
      border: 1px solid #007F46;

    }

    .add_form_field4 {
      background-color: #007F46;
      border: none;
      color: white;
      padding: 2px 2px;
      text-align: center;
      text-decoration: none;
      font-size: 10px;
      margin: 4px 2px;
      cursor: pointer;
      width: 82px;
      position: relative;
      left: 50%;
      margin-left: -60px;
      margin-top: 10px;
      border: 1px solid #007F46;

    }

    input {
      border: 1px solid #B80008;
      width: 200px;
      height: 30px;
      margin-bottom: 14px;
    }

    .delete {
      background-color: #DD4B39;
      border: none;
      color: white;
      padding: 5px 12px;
      text-align: center;
      text-decoration: none;
      font-size: 13px;
      width: 80px;
      position: relative;
      left: 15px;
      top: 4px;
      color: white;
      height: 30px;
      margin: 4px 2px;
      cursor: pointer;
    }

    .delete:hover {
      color: white;
      font-weight: 400;
    }
  </style>

  <style type="text/css">
    a {
      color: #e0e0e0;
    }

    .nav>li>a:hover,
    .nav>li>a:active,
    .nav>li>a:focus {
      color: #444;
      background: #910007;
    }

    .nav .open>a,
    .nav .open>a:focus,
    .nav .open>a:hover {
      background-color: #910007;
    }

    a:hover,
    a:active,
    a:focus,
    .active {
      color: #FBFFA3;
      font-weight: 800;
    }

    .active {
      color: yellow;
      font-weight: 800;
    }

    .content-wrapper {
      background-color: #f0f0f0;
    }

    .shadow2 {
      -webkit-box-shadow: 0px 2px 2px 1px rgba(194, 192, 194, 0.75);
      -moz-box-shadow: 0px 2px 2px 1px rgba(194, 192, 194, 0.75);
      box-shadow: 0px 2px 2px 1px rgba(194, 192, 194, 0.75);

    }
  </style>



  <!-- Latim style -->
</head>

<body class="hold-transition sidebar-mini">


  <style type="text/css">
    #logoLatim {
      width: 100px;
      padding: 5px;
      position: relative;
      left: 0px;
    }

    @media (max-width:560px) {
      #logoLatim {
        width: 100px;
        padding: 5px;
        position: relative;
        left: -90px;
      }
    }
  </style>

  <div class="wrapper">

    <header class="main-header">

      <!-- Logo -->
      <a href="index.php" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"></span>
        <!-- logo for regular state and mobile devices -->
        <img id="logoLatim" src="./img/logo.png" style="">
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
                <?php if($picture){ ?>
            <img src="<?php echo $picture; ?>" class="user-image" alt="User Image">
            <?php }else{ ?>
              <img src="./images/17-1.jpg" class="user-image" alt="User Image">
            <?php }?>
                <span class="hidden-xs"><?php echo $agent_name; ?></span>
              </a>
              <ul class="dropdown-menu shadow2">
                <!-- User image -->
                <li class="user-header">
                  <?php if($picture){ ?>
            <img src="<?php echo $picture; ?>" class="img-circle" alt="User Image">
            <?php }else{ ?>
              <img src="./images/17-1.jpg" class="img-circle" alt="User Image">
            <?php }?>

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
            <?php if($picture){ ?>
            <img src="<?php echo $picture; ?>" class="img-circle" alt="User Image">
            <?php }else{ ?>
              <img src="./images/17-1.jpg" class="img-circle" alt="User Image">
            <?php }?>
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
            <span class="" style="text-align:center; color:white; ">Quick Searcher <img src="./img/chinaFlag.png"
                style="width:30px; position:relative; top:-3px; left:10px;"> </span>
            <form method="get" action="searcherJobOrder.php?">
              <input name="JO" value="<?php echo $JO; ?>" placeholder="J.O# / CLIENT or SUPPLIER NAME"
                style="width:100%; font-size:12px; text-align:center; border:1px solid gray; padding:15px;">
              <br><br>
            </form>
          </li>

          <center>
            <div
              style="width:100%; height:20px; position:relative; top:0px; background:#CECAC6; color:#630000; font-weight:600; font-size:14px;">
              CARGOS</div>
          </center>
          <li class=" treeview" style="border-bottom:1px solid gray; padding:5px;">
            <a href="#" style="height:25px; position:relative; top:-10px;">
              <i class="fa fa-users"></i> <span style="font-size:11px; ">Accounts</span>
              <span class="pull-right-container" style="top:22px;">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="createAccount.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
              <li><a href="searchAccount.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
            </ul>
          </li>


          <li class="active treeview" style="border-bottom:1px solid gray; padding:5px;">
            <a href="#" style="height:25px; position:relative; top:-10px;">
              <i class="fa fa-files-o"></i> <span style="font-size:11px; ">Quotations</span>
              <span class="pull-right-container" style="top:22px;">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a class="active" href="createQuotation.php" style="font-size:11px;"><i
                    class="fa fa-circle-o"></i>Create</a></li>
              <li><a href="searchQuotation.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
            </ul>
          </li>


          <center>
            <div
              style="width:100%; height:20px; position:relative; top:0px; background:#CECAC6; color:#630000; font-weight:600; font-size:14px;">
              JOB ORDERS</div>
          </center>

          <li class=" treeview" style="border-bottom:1px solid gray; padding:5px;">
            <a href="#" style="height:25px; position:relative; top:-10px;">
              <i class="fa fa-files-o"></i> <span style="font-size:11px;">CHINA Orders</span>
              <span class="pull-right-container" style="top:22px;">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class=""><a href="createJobOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a>
              </li>
              <li><a class="" href="searchJobOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a>
              </li>
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
              <li><a class="" href="createUsaOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a>
              </li>
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
              <li><a href="searchLATAMOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
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
              <li><a class="" href="createTAIWANOrder.php" style="font-size:11px;"><i
                    class="fa fa-circle-o"></i>Create</a></li>
              <li><a href="searchTAIWANOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
            </ul>
          </li>

          <center>
            <div
              style="width:100%; height:20px; position:relative; top:0px; background:#CECAC6; color:#630000; font-weight:600; font-size:14px;">
              SUPPORT AREA</div>
          </center>
          <li class="treeview" style="border-bottom:1px solid gray; padding:5px;">
            <a href="#" style="height:25px; position:relative; top:-10px;">
              <i class="fa fa-info"></i> <span style="font-size:11px;">Tickets</span>
              <span class="pull-right-container" style="top:22px;">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="createTicket.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
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
          Quotations
          <small>create</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Create Quotations</li>
        </ol>
      </section>

      <!-- Main content -->
      <section class="content">
      <?php if ($option==''){ ?>
        <div class="row" style="    margin: 0px;"> 
          <div class="col-md-offset-3 col-md-6 form_1 shadow2">
            <div class="row">
              <div class="col-md-12">
                <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">Create Quotation<br>
                <span style="color:black; font-size:14px; font-weight:400; position:relative; top:10px;">Please select one option:</span>
                </h3>

                <?php if ($message=='AccountSaved'){ ?>
                <br>
                <div id="mydiv"
                  style="background-color: rgba(0, 127, 70, 1); padding:20px;color:white; position:absolute; left:50%; width:300px; margin-left:140px; top:-80px;">
                  <center>
                    <span style="font-style: oblique; ">Account has been created.</span>
                  </center>
                </div>
                <?php } ?>
                <?php if ($message=='QuotationCreated'){ ?>
                <br>
                <div id="mydiv"
                  style="background-color: rgba(0, 127, 70, 1); padding:20px;color:white; position:absolute; left:50%; width:300px; margin-left:140px; top:-80px;">
                  <center>
                    <span style="font-style: oblique; ">Quotation has been created.</span>
                  </center>
                </div>
                <?php } ?>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 text-center" style="padding:30px">
                  <span style="font-size:60px;" class="fa fa-ship"></span>
                  <div class="form-group" style="margin-top:15px">
                    <a href="?step=2&option=FCL" class="btn btn-success btn-block">FCL Shipment</a>
                  </div>
              </div>
              <div class="col-md-6 text-center" style="padding:30px">
                  <span style="font-size:60px;" class="fa fa-cubes"></span>
                  <div class="form-group" style="margin-top:15px">
                    <a href="?step=2&option=Pieces" class="btn btn-danger btn-block">By Pieces</a>                   
                  </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
       <!--end step1 -->
      <!-- start step2 -->
        <?php if ($step=='2'){ ?>
          <div class="row" style="margin: 0px;"> 
            <div class="col-md-offset-3 col-md-6 form_1 shadow2">
              <div class="row">
                <div class="col-md-12">
                  <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">Create Quotation<br>
                  <span style="color:black; font-size:14px; font-weight:400; position:relative; top:10px;">Please select one option:</span>
                  </h3>
                </div>
              </div>
              <div class="row">
                <div class="col-md-offset-3 col-md-6 text-center" style="border-bottom:1px solid #555555; margin-bottom:20px">
                  <span style="font-size:35px; padding:10px;" class="glyphicon glyphicon-user"></span><br>
                  <span style="padding-top:15px;font-size:16px;">Select Client Account</span>
                </div>
              </div>
              <form action="?" method="get">
              <div class="row">
                <div class="col-md-offset-3 col-md-6 text-center" style="margin-bottom:20px">
                      <div class=" input-group">
                          <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                          <select name="client_name" data-placeholder="Select Client" id="" class="form-control select2" required style="width:100%">
                          <option selected="selected" value="<?php echo $client_name; ?>"><?php echo $client_name; ?></option>
                      <?php 
                          if ($level=='Seller') {
                            $consulta = mysqli_query($connect, "SELECT * FROM accounts WHERE agent='$agent_name' AND type='Client' ORDER BY name asc ") or die ("Error al traer los datos"); 
                          }else{
                            $consulta = mysqli_query($connect, "SELECT * FROM accounts WHERE type='Client' ORDER BY name asc ") or die ("Error al traer los datos");
                          }
                            


                            while ($row = mysqli_fetch_array($consulta)){ 
                            $company=$row['company'];
                            $name=$row['name'];

                            $customer_if= $name;
                              if ($company!='') { $customer_if .= ' | '.$company; }

                            ?>
                        <?php if ($customer!=$customer_if){ ?>
                          <option value="<?php echo $customer_if; ?>"><?php echo $customer_if; ?></option>
                        <?php }?>
                      <?php }  ?>
                          </select>
                      </div>
                  </div>                  
              </div>
              <div class="row">
                <div class="col-md-offset-3 col-md-6 text-center" style="margin-bottom:20px">
                    <button  type="button" data-toggle="modal" data-target="#myModal1" class="btn btn-danger btn-sm">Add New Client</button>                  
                </div> 
                <div class="col-md-3 text-center" style="margin-bottom:20px">
                    <input type="hidden" name="option" value="<?php echo $option; ?>">
                    <input type="hidden" name="step"  value="3">
                    <button  type="submit" class="btn btn-success btn-block btn-sm">Next</button>   
                </div>               
              </div>
              </form>
            </div>
          </div>
          <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add new client</h4>
                  </div>
                  <div class="modal-body">
                    <form action="action/saveAccountQuotation.php" method="POST">
                      <input name="supplier" value="<?php echo $supplier; ?>" style="display:none;">
                      <input name="option" value="<?php echo $option; ?>" style="display:none;">

                      <div class="input-group">
                        <span class="input-group-addon"><i style="width:20px;" class="fa fa-circle"></i></span>
                        <select data-placeholder="Select Agent" <?php if ($level!='Seller'){ ?> name="agent_name"
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
                    <button type="button" class="btn btn-default"
                      style="background:#B80008; border:none; height:40px; border-radius:2px; color:white; position:relative; left:-30px; width:100px;"
                      data-dismiss="modal">Cancel</button>
                    <input type="submit" value="Save" class="form_1_submit" style="top:0px; background:#007F46;">
                    </form>
                  </div>
                </div>
              </div>
            </div>
        <?php } ?>
        <!--end step2 -->
        <!--start step3 fcl -->
        <?php if ($option=='FCL' && $step=='3'){ ?>
          <div class="row searchPage shadow2"> 
            <div class="col-md-12 ">             
                  <h3 style="text-align:center; color:black; font-weight:400; padding-bottom:20px;font-size:20px; border-bottom:1px solid #555555;">FCL Quotation<br>
                  </h3>
            </div>
            <form action="quotation.php" method="POST" style="padding: 100px 40px 20px 40px;">
              <div class="row">            
                <div class="col-md-6">
                  <div class="form-group row">
                    <div class="col-md-12">
                        <div class=" input-group">
                            <div class="input-group-addon"><i class="fa fa-circle input-fa"></i></div>
                                <select  id="" <?php if ($level!='Seller' ){ ?>    name="agent_name" <?php } ?> class="form-control select2"  <?php if ($level=='Seller'){ ?> disabled <?php } ?>  placeholder="Select Agent" style="width:100%">
                                    
                                    <?php 
                                        $consultaList = mysqli_query($connect, "SELECT * FROM agents ORDER BY name asc ") or die ("Error al traer los datos");
                                        while ($rowList = mysqli_fetch_array($consultaList)){ 
                                        $agent_List=$rowList['name']; ?>
                                    <option <?php if($agent_name==$rowList['name']){echo "selected";} ?> value="<?php echo $agent_List; ?>"><?php echo $agent_List; ?></option>
                                        <?php }  ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <?php if ($level=='Seller'){ ?>
                    <input type="hidden" name="agent_name" value="<?php echo $agent_name; ?>">
                    <?php } ?>

                    <input type="hidden" name="agent_email" value="<?php echo $email; ?>">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                                <input type="text" name="client_name" class="form-control" value="<?php echo $client_name; ?>" placeholder="Company Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-calendar input-fa"></i></div>
                                <input type="text" class="form-control" name="expiration_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" laceholder="To"  value="<?php echo $expiration_date; ?>"    placeholder="Expiration Date">
                            </div>
                        </div>
                        <div class="col-md-5">
                                <input type="text" class="form-control"  name="initial_date" data-provide="datepicker" data-date-format="yyyy-mm-dd" laceholder="To" value="<?php echo $initial_date; ?>"    placeholder="Initial Date">
                        </div>
                    </div>                    
                    <div class="form-group row">
                        <div class="col-md-7">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-map-marker input-fa"></i></div>
                                <input type="text" class="form-control" name="origin" value="<?php echo $origin; ?>"  placeholder="Origin">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control"  name="destination" value="<?php echo $destination; ?>"   placeholder="Destination">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-ship input-fa"></i></div>
                                <select placeholder="Select Service" name="service" class="form-control select2" style="width:100%">
                                    <option value="<?php echo $service; ?>"><?php echo $service; ?></option>

                                    <?php if ($service!='Pending'){ ?>
                                    <option value="Pending">Pending</option>
                                    <?php } ?>

                                    <?php if ($service!='Air door to door'){ ?>
                                    <option value="Air door to door">Air door to door</option>
                                    <?php } ?>

                                    <?php if ($service!='Ocean door to door'){ ?>
                                    <option value="Ocean door to door">Ocean door to door</option>
                                    <?php } ?>

                                    <?php if ($service!='LCL'){ ?>
                                    <option value="LCL">LCL</option>
                                    <?php } ?>

                                    <?php if ($service!='Air'){ ?>
                                    <option value="Air">Air</option>
                                    <?php } ?>

                                    <?php if ($service!='FCL 20\"'){ ?>
                                    <option value='FCL 20\"'>FCL 20"</option>
                                    <?php } ?>

                                    <?php if ($service!='FCL 40\"'){ ?>
                                    <option value='FCL 40\"'>FCL 40"</option>
                                    <?php } ?>

                                    <?php if ($service!='FCL 40\" HC'){ ?>
                                    <option value='FCL 40\" HC'>FCL 40" HC</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class=" input-group">
                                    <div class="input-group-addon"><i class="fa fa-star input-fa"></i></div>
                                    <input type="number" name="containerQuantity" class="form-control" value="<?php echo $containerQuantity; ?>"  placeholder="container Quantity">
                                </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-cube input-fa"></i></div>
                                <input type="text" name="commodity" class="form-control" value="<?php echo $commodity; ?>" disabled placeholder="Commodity">
                            </div>
                        </div>
                    </div>
                </div>  
              </div>
            </form>
          </div>

        <?php } ?>
        <!--end step3 fcl -->
            <?php if ($option=='FCL' && $step=='3'){ ?>



            <form action="quotation.php" method="POST">


              <div class="form_1 shadow2"
                style="width:1000px; margin-left:-500px; background:white; min-height:460px; margin-top:50px;">
                <h3
                  style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">
                  FCL Quotation<br>
                </h3>
                <?php if ($message=='AccountSaved'){ ?>
                <br>
                <div id="mydiv"
                  style="background-color: rgba(0, 127, 70, 1); padding:20px;color:white; position:absolute; left:50%; width:300px; margin-left:140px; top:-80px;">
                  <center>
                    <span style="font-style: oblique; ">Account has been created.</span>
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

                <div style="width:45%; padding:20px; margin-left:10px; margin-top:-40px; top:108px; position:absolute; display:inline-block; ">
                  <div class="input-group">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-circle"></i></span>
                    <select data-placeholder="Select Agent" <?php if ($level!='Seller'){ ?> name="agent_name" <?php } ?>
                      class="form-control select2" <?php if ($level=='Seller'){ ?> disabled <?php } ?>
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

                  <input style="display:none;" name="agent_email" value="<?php echo $email; ?>">



                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                    <select data-placeholder="Select Client" name="client_name" class="form-control select2"
                      style="width:364px; ">

                      <option selected="selected" value="<?php echo $client_name; ?>"><?php echo $client_name; ?>
                      </option>
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



                  <div class="input-group" style=" position:relative; margin-top:20px;">
                    <div class="input-group date">
                      <div class="input-group-addon" style="width:45px;">
                        <i class="fa fa-calendar"></i>
                      </div>

                      <input type="text" class="form-control pull-right" data-provide="datepicker"
                        name="expiration_date" data-date-format="dd-mm-yyyy" placeholder="Expiration Date"
                        required="required" value="" style="width:166px; position:relative; left:30px;">

                      <input type="text" class="form-control pull-right" data-provide="datepicker" name="initial_date"
                        data-date-format="dd-mm-yyyy" placeholder="Initial Date" value="<?php echo $fecha_vista; ?>"
                        style="width:168px; position:relative; left:-1px;">
                    </div>
                  </div>


                  <div class="input-group" style="margin-top:20px;">


                    <span class="input-group-addon"
                      style="display:inline-block; height:34px; width:45px; z-index:999;"><i style="width:20px;"
                        class="fa fa-map-marker"></i></span>

                    <div style=" display:inline-block; position:relative; margin-left:0px;">

                      <select id="state2" class="js-example-basic-single" name="origin" required="required"
                        data-placeholder="Origin" type="text" style="width:165px;">
                        <option></option>

                        <?php $consulta22 = mysqli_query($connect, "SELECT DISTINCT origin FROM quotations  ") or die ("Error al traer los datos");

                        while ($row = mysqli_fetch_array($consulta22)){ 
                        $origin=$row['origin'];
                         ?>
                        <option value="<?php echo $origin; ?>"><?php echo $origin; ?></option>

                        <?php } ?>

                      </select>

                    </div>



                    <div style="position: relative; left:30px; display:inline-block;">

                      <select id="state3" class="js-example-basic-single" name="destination" required="required"
                        data-placeholder="Destination" type="text" style="width:165px;">
                        <option></option>

                        <?php $consulta22 = mysqli_query($connect, "SELECT DISTINCT destination FROM quotations  ") or die ("Error al traer los datos");

                        while ($row = mysqli_fetch_array($consulta22)){ 
                        $destination=$row['destination'];
                         ?>
                        <option value="<?php echo $destination; ?>"><?php echo $destination; ?></option>

                        <?php } ?>

                      </select>

                    </div>

                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-ship"></i></span>
                    <select data-placeholder="Select Service" required="required" name="service"
                      class="form-control select2" style="width:100%;">
                      <option></option>
                      <option value='FCL 20"'>FCL 20"</option>
                      <option value='FCL 40"'>FCL 40"</option>
                      <option value='FCL 40" HC'>FCL 40" HC</option>
                    </select>
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class=""></i>Container Quantity</span>
                    <input type="number" name="containerQuantity" value="1" class="form-control">
                  </div>





                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-cube"></i></span>
                    <select id="state" class="js-example-basic-single" name="commodity" data-placeholder="Commodity"
                      type="text" style="width:100%;">
                      <option> </option>


                      <?php $consulta22 = mysqli_query($connect, "SELECT DISTINCT commodity FROM joborders  ") or die ("Error al traer los datos");

                        while ($row = mysqli_fetch_array($consulta22)){ 
                        $commodity=$row['commodity'];
                         ?>

                      <option value="<?php echo $commodity; ?>"><?php echo $commodity; ?></option>
                      <?php }  ?>
                    </select>


                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="width:46px;"><i style="width:30px;" class=""></i><span
                        style="font-weight:bolder; width:50px;">  $  </span></span>
                    <input type="number" style="width:363px;" name="value" placeholder="Value" class="form-control">
                  </div>





                </div>

                <div
                  style="width:45%; padding:20px; margin-top:0px; left:500px; top:15px; position:relative;  display:inline-block; ">

                  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                  <script>
                    $(document).ready(function () {
                      var max_fields = 10;
                      var wrapper = $(".container1");
                      var add_button = $(".add_form_field");

                      var x = 1;
                      $(add_button).click(function (e) {
                        e.preventDefault();
                        if (x < max_fields) {
                          x++;
                          $(wrapper).append('<div class="input-group" style="margin-top:-5px;"><input class="form-control" type="text" style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;" name="freightDescX[]"><input class="form-control" type="number" step="any" name="freightChargeX[]" style="width:80px; height:30px; left:10px; position:relative; top:1px;"><input class="form-control" type="number" name="freightChargeQX[]"  step="any" value="1" style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;"><a style="margin-top:5px; position:relative; left:25px;" href="#" class="delete"><span style="font-size:16px; font-weight:bold; ">-</span></a></div>'); //add input box
                        }
                        else {
                          alert('You Reached the limits')
                        }
                      });

                      $(wrapper).on("click", ".delete", function (e) {
                        e.preventDefault(); $(this).parent('div').remove(); x--;
                      })
                    });
                  </script>

                  <script>
                    $(document).ready(function () {
                      var max_fields = 10;
                      var wrapper = $(".container2");
                      var add_button = $(".add_form_field2");

                      var x = 1;
                      $(add_button).click(function (e) {
                        e.preventDefault();
                        if (x < max_fields) {
                          x++;
                          $(wrapper).append('<div class="input-group" style="margin-top:-5px;"><input class="form-control" type="text" style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;" name="originDescX[]"><input class="form-control" type="number" step="any" name="originChargeX[]" style="width:80px; height:30px; left:10px; position:relative; top:1px;"><input class="form-control" type="number" name="originChargeQX[]"  step="any" value="1" style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;"><a style="margin-top:5px; position:relative; left:25px;" href="#" class="delete"><span style="font-size:16px; font-weight:bold; ">-</span></a></div>'); //add input box
                        }
                        else {
                          alert('You Reached the limits')
                        }
                      });

                      $(wrapper).on("click", ".delete", function (e) {
                        e.preventDefault(); $(this).parent('div').remove(); x--;
                      })
                    });
                  </script>

                  <script>
                    $(document).ready(function () {
                      var max_fields = 10;
                      var wrapper = $(".container3");
                      var add_button = $(".add_form_field3");

                      var x = 1;
                      $(add_button).click(function (e) {
                        e.preventDefault();
                        if (x < max_fields) {
                          x++;
                          $(wrapper).append('<div class="input-group" style="margin-top:-5px;"><input class="form-control" type="text" style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;" name="destinationDescX[]"><input class="form-control" type="number" step="any" name="destinationChargeX[]" style="width:80px; height:30px; left:10px; position:relative; top:1px;"><input class="form-control" type="number" name="destinationChargeQX[]"  step="any" value="1" style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;"><a style="margin-top:5px; position:relative; left:25px;" href="#" class="delete"><span style="font-size:16px; font-weight:bold; ">-</span></a></div>'); //add input box
                        }
                        else {
                          alert('You Reached the limits')
                        }
                      });

                      $(wrapper).on("click", ".delete", function (e) {
                        e.preventDefault(); $(this).parent('div').remove(); x--;
                      })
                    });
                  </script>




                  <div class="input-group container1"
                    style="margin-top:-40px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                    <p style="margin-top:-10px;">Freight Charges</p>
                    <br>

                    <div style="margin-top:-5px;">

                      <button class="add_form_field"
                        style="margin-bottom:0px; width:30px; position:relative; left:90px; top:-9px; font-size:13px;">
                        <span style="font-size:16px; font-weight:bold; ">+</span>
                      </button>

                      <span
                        style="position:absolute; font-size:11px; font-weight:bolder; left:60px; top:30px;">Description</span>
                      <input class="form-control" type="text"
                        style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;"
                        name="freightDescX[]">

                      <span
                        style="position:absolute; font-size:11px; font-weight:bolder; left:200px; top:30px;">Price</span>
                      <input class="form-control" type="number" name="freightChargeX[]" step="any"
                        style="width:80px; height:30px; left:10px; position:relative; top:1px;">

                      <span
                        style="position:absolute; font-size:11px; font-weight:bolder; left:280px; top:30px; ">Quantity</span>
                      <input class="form-control" type="number" value="1" step="any" name="freightChargeQX[]"
                        style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;">

                    </div>
                    <br>
                    <div style="margin-top:-12px;"></div>

                  </div>



                  <div class="input-group container2"
                    style="margin-top:18px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                    <p style="margin-top:-10px;">Origin Charges</p>
                    <br>
                    <div style="margin-top:-5px;">

                      <button class="add_form_field2"
                        style="margin-bottom:0px; width:30px; position:relative; left:90px; top:-9px; font-size:13px;">
                        <span style="font-size:16px; font-weight:bold; ">+</span>
                      </button>

                      <span
                        style="position:absolute; font-size:11px; font-weight:bolder; left:60px; top:30px;">Description</span>
                      <input class="form-control" type="text"
                        style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;"
                        name="originDescX[]">

                      <span
                        style="position:absolute; font-size:11px; font-weight:bolder; left:200px; top:30px;">Price</span>
                      <input class="form-control" type="number" step="any" name="originChargeX[]"
                        style="width:80px; height:30px; left:10px; position:relative; top:1px;">

                      <span
                        style="position:absolute; font-size:11px; font-weight:bolder; left:280px; top:30px; ">Quantity</span>
                      <input class="form-control" type="number" value="1" step="any" name="originChargeQX[]"
                        style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;">

                    </div>
                    <br>
                    <div style="margin-top:-12px;"></div>
                  </div>



                  <div class="input-group container3"
                    style="margin-top:18px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                    <p style="margin-top:-10px;">Destination Charges</p>
                    <br>
                    <div style="margin-top:-5px;">

                      <button class="add_form_field3"
                        style="margin-bottom:0px; width:30px; position:relative; left:90px; top:-9px; font-size:13px;">
                        <span style="font-size:16px; font-weight:bold; ">+</span>
                      </button>

                      <span
                        style="position:absolute; font-size:11px; font-weight:bolder; left:60px; top:30px;">Description</span>
                      <input class="form-control" type="text"
                        style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;"
                        name="destinationDescX[]">

                      <span
                        style="position:absolute; font-size:11px; font-weight:bolder; left:200px; top:30px;">Price</span>
                      <input class="form-control" type="number" step="any" name="destinationChargeX[]"
                        style="width:80px; height:30px; left:10px; position:relative; top:1px;">

                      <span
                        style="position:absolute; font-size:11px; font-weight:bolder; left:280px; top:30px; ">Quantity</span>
                      <input class="form-control" type="number" value="1" step="any" name="destinationChargeQX[]"
                        style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;">

                    </div>
                    <br>
                    <div style="margin-top:-12px;"></div>
                  </div>

                </div>

                <div class="input-group"
                  style="margin-top:10px;  position:relative; left:520px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                  <p style="margin-top:-10px;">Remarks</p>
                  <div style="margin-top:-5px;">

                    <textarea name="remarks" style="width:100%; resize:none; min-height:200px; border-color:#D2D6DE; ">
A. COTIZACION ES BASADA EN TERMINO FOB DESDE BODEGA GUANGZHOU.
B. TRANSITO APROX:  X Dias 
C. NO INCLUYE SEGURO DE CARGA, NO INCLUYE AGENCIAMIENTO ADUANAL.</textarea>
                  </div>
                </div>

                <input type="submit" value="Save" class="form_1_submit"
                  style="background:#007F46; width:100px; position:relative; left:-75px; top:20px; z-index:9999;">


                <br><br><br><br>

              </div>


          </div>



          </form>


          <?php }elseif($option=='Pieces' && $step=='3'){ ?>


          <form action="quotation.php" method="POST">


            <div class="form_1 shadow2"
              style="width:1000px; margin-left:-500px; background:white; min-height:700px; margin-top:50px;">

              <h3
                style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">
                By Pieces Quotation<br>
              </h3>




              <script type="text/javascript">
                setTimeout(fade_out, 3000);

                function fade_out() {
                  $("#mydiv").fadeOut().empty();
                }
              </script>

              <div
                style="width:45%; padding:20px; margin-left:10px; margin-top:-40px; top:108px; position:absolute; display:inline-block; ">






                <div class="input-group">
                  <span class="input-group-addon"><i style="width:20px;" class="fa fa-circle"></i></span>
                  <select data-placeholder="Select Agent" <?php if ($level!='Seller'){ ?> name="agent_name" <?php } ?>
                    class="form-control select2" <?php if ($level=='Seller'){ ?> disabled <?php } ?>
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

                <input style="display:none;" name="agent_email" value="<?php echo $email; ?>">



                <div class="input-group" style="margin-top:20px;">
                  <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                  <select data-placeholder="Select Client" name="client_name" class="form-control select2"
                    style="width:364px; ">

                    <option selected="selected" value="<?php echo $client_name; ?>"><?php echo $client_name; ?></option>
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





                <div class="input-group" style=" position:relative; margin-top:20px;">
                  <div class="input-group date">
                    <div class="input-group-addon" style="width:45px;">
                      <i class="fa fa-calendar"></i>
                    </div>

                    <input type="text" class="form-control pull-right" data-provide="datepicker" name="expiration_date"
                      data-date-format="dd-mm-yyyy" placeholder="Expiration Date" required="required" value=""
                      style="width:166px; position:relative; left:30px;">

                    <input type="text" class="form-control pull-right" data-provide="datepicker" name="initial_date"
                      data-date-format="dd-mm-yyyy" placeholder="Initial Date" value="<?php echo $fecha_vista; ?>"
                      style="width:168px; position:relative; left:-1px;">
                  </div>
                </div>


                <div class="input-group" style="margin-top:20px;">


                  <span class="input-group-addon" style="display:inline-block; height:34px; width:45px; z-index:999;"><i
                      style="width:20px;" class="fa fa-map-marker"></i></span>

                  <div style=" display:inline-block; position:relative; margin-left:0px;">

                    <select id="state2" class="js-example-basic-single" name="origin" required="required"
                      data-placeholder="Origin" type="text" style="width:165px;">
                      <option></option>

                      <?php $consulta22 = mysqli_query($connect, "SELECT DISTINCT origin FROM quotations  ") or die ("Error al traer los datos");

                        while ($row = mysqli_fetch_array($consulta22)){ 
                        $origin=$row['origin'];
                         ?>
                      <option value="<?php echo $origin; ?>"><?php echo $origin; ?></option>

                      <?php } ?>

                    </select>

                  </div>



                  <div style="position: relative; left:30px; display:inline-block;">

                    <select id="state3" class="js-example-basic-single" name="destination" required="required"
                      data-placeholder="Destination" type="text" style="width:165px;">
                      <option></option>

                      <?php $consulta22 = mysqli_query($connect, "SELECT DISTINCT destination FROM quotations  ") or die ("Error al traer los datos");

                        while ($row = mysqli_fetch_array($consulta22)){ 
                        $destination=$row['destination'];
                         ?>
                      <option value="<?php echo $destination; ?>"><?php echo $destination; ?></option>

                      <?php } ?>

                    </select>

                  </div>

                </div>

                <div class="input-group" style="margin-top:20px;">
                  <span class="input-group-addon"><i style="width:20px;" class="fa fa-ship"></i></span>
                  <select data-placeholder="Select Service" required="required" name="service"
                    class="form-control select2" style="width:100%;"="">

                    <option></option>

                    <option value="Air Service">Air Service</option>

                    <option value="Ocean Service">Ocean Service</option>

                    <option value="LCL">LCL</option>
                  </select>
                </div>





                <div class="input-group" style="margin-top:20px;">
                  <span class="input-group-addon"><i style="width:20px;" class="fa fa-cube"></i></span>
                  <select id="state" class="js-example-basic-single" name="commodity" data-placeholder="Commodity"
                    type="text" style="width:100%;">
                    <option> </option>


                    <?php $consulta22 = mysqli_query($connect, "SELECT DISTINCT commodity FROM joborders  ") or die ("Error al traer los datos");

                        while ($row = mysqli_fetch_array($consulta22)){ 
                        $commodity=$row['commodity'];
                         ?>

                    <option value="<?php echo $commodity; ?>"><?php echo $commodity; ?></option>
                    <?php }  ?>
                  </select>


                </div>

                <div class="input-group" style="margin-top:20px;">
                  <span class="input-group-addon" style="width:46px;"><i style="width:30px;" class=""></i><span
                      style="font-weight:bolder; width:50px;">  $  </span></span>
                  <input type="number" style="width:363px;" name="value" placeholder="Value" class="form-control">
                </div>
                3


              </div>



              <div
                style="width:45%; padding:20px; margin-top:0px; left:500px; top:15px; position:relative;  display:inline-block; ">

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                <script>
                  $(document).ready(function () {
                    var max_fields = 10;
                    var wrapper = $(".container1");
                    var add_button = $(".add_form_field");

                    var x = 1;
                    $(add_button).click(function (e) {
                      e.preventDefault();
                      if (x < max_fields) {
                        x++;
                        $(wrapper).append('<div class="input-group" style="margin-top:-5px;"><input class="form-control" type="text" style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;" name="freightDescX[]"><input class="form-control" type="number" step="any" name="freightChargeX[]" style="width:80px; height:30px; left:10px; position:relative; top:1px;"><input class="form-control" type="number" name="freightChargeQX[]"  step="any" value="1" style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;"><a style="margin-top:5px; position:relative; left:25px;" href="#" class="delete"><span style="font-size:16px; font-weight:bold; ">-</span></a></div>'); //add input box
                      }
                      else {
                        alert('You Reached the limits')
                      }
                    });

                    $(wrapper).on("click", ".delete", function (e) {
                      e.preventDefault(); $(this).parent('div').remove(); x--;
                    })
                  });
                </script>

                <script>
                  $(document).ready(function () {
                    var max_fields = 10;
                    var wrapper = $(".container2");
                    var add_button = $(".add_form_field2");

                    var x = 1;
                    $(add_button).click(function (e) {
                      e.preventDefault();
                      if (x < max_fields) {
                        x++;
                        $(wrapper).append('<div class="input-group" style="margin-top:-5px;"><input class="form-control" type="text" style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;" name="originDescX[]"><input class="form-control" type="number" step="any" name="originChargeX[]" style="width:80px; height:30px; left:10px; position:relative; top:1px;"><input class="form-control" type="number" name="originChargeQX[]"  step="any" value="1" style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;"><a style="margin-top:5px; position:relative; left:25px;" href="#" class="delete"><span style="font-size:16px; font-weight:bold; ">-</span></a></div>'); //add input box
                      }
                      else {
                        alert('You Reached the limits')
                      }
                    });

                    $(wrapper).on("click", ".delete", function (e) {
                      e.preventDefault(); 
                      $(this).parent('div').remove(); x--;
                    })
                  });
                </script>

                <script>
                  $(document).ready(function () {
                    var max_fields = 10;
                    var wrapper = $(".container3");
                    var add_button = $(".add_form_field3");

                    var x = 1;
                    $(add_button).click(function (e) {
                      e.preventDefault();
                      if (x < max_fields) {
                        x++;
                        $(wrapper).append('<div class="input-group" style="margin-top:-5px;"><input class="form-control" type="text" style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;" name="destinationDescX[]"><input class="form-control" type="number" step="any" name="destinationChargeX[]" style="width:80px; height:30px; left:10px; position:relative; top:1px;"><input class="form-control" type="number" name="destinationChargeQX[]"  step="any" value="1" style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;"><a style="margin-top:5px; position:relative; left:25px;" href="#" class="delete"><span style="font-size:16px; font-weight:bold; ">-</span></a></div>'); //add input box
                      }
                      else {
                        alert('You Reached the limits')
                      }
                    });

                    $(wrapper).on("click", ".delete", function (e) {
                      e.preventDefault(); $(this).parent('div').remove(); x--;
                    })
                  });
                </script>

                <script>
                  $(document).ready(function () {
                    var max_fields = 10;
                    var wrapper = $(".container4");
                    var add_button = $(".add_form_field4");

                    var x = 1;
                    $(add_button).click(function (e) {
                      e.preventDefault();
                      if (x < max_fields) {
                        x++;
                        $(wrapper).append('<div class="input-group" style="margin-top:5px;"><input class="form-control" type="number" placeholder="" name="byBoxes_qtyX[]" style="border-left:1px solid black; width:70px;  height:30px; position:relative; top:1px;"> <input class="form-control" type="text" placeholder="" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:55px; position:relative; top:-14px; left:10px;" name="byBoxes_widthX[]"><input class="form-control" type="text" placeholder="" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:25px;" name="byBoxes_lenghtX[]"><input class="form-control" type="text" placeholder="" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:40px;" name="byBoxes_heightX[]"><input class="form-control" type="text" placeholder="" style="border-left:1px solid black; background:#EFEFEF; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:50px;" name="byBoxes_weightX[]"><a style="margin-top:5px; position:absolute; left:357px; top:-2px; width:25px; height:25px;" href="#" class="delete">&nbsp;<span style="font-size:16px; font-weight:bold; position:relative; left:-7px; top:-4px;">-</span></a></div>'); //add input box
                      }
                      else {
                        alert('You Reached the limits')
                      }
                    });

                    $(wrapper).on("click", ".delete", function (e) {
                      e.preventDefault(); $(this).parent('div').remove(); x--;
                    })
                  });
                </script>




                <div class="input-group container1"
                  style="margin-top:-40px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                  <p style="margin-top:-10px;">Freight Charges</p>
                  <br>

                  <div style="margin-top:-5px;">

                    <button class="add_form_field"
                      style="margin-bottom:0px; width:30px; position:relative; left:90px; top:-9px; font-size:13px;">
                      <span style="font-size:16px; font-weight:bold; ">+</span>
                    </button>

                    <span
                      style="position:absolute; font-size:11px; font-weight:bolder; left:60px; top:30px;">Description</span>
                    <input class="form-control" type="text"
                      style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;"
                      name="freightDescX[]">

                    <span
                      style="position:absolute; font-size:11px; font-weight:bolder; left:200px; top:30px;">Price</span>
                    <input class="form-control" type="number" step="any" name="freightChargeX[]"
                      style="width:80px; height:30px; left:10px; position:relative; top:1px;">

                    <span
                      style="position:absolute; font-size:11px; font-weight:bolder; left:280px; top:30px; ">Quantity</span>
                    <input class="form-control" type="number" step="any" value="1" name="freightChargeQX[]"
                      style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;">

                  </div>
                  <br>
                  <div style="margin-top:-12px;"></div>

                </div>



                <div class="input-group container2"
                  style="margin-top:18px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                  <p style="margin-top:-10px;">Origin Charges</p>
                  <br>
                  <div style="margin-top:-5px;">

                    <button class="add_form_field2"
                      style="margin-bottom:0px; width:30px; position:relative; left:90px; top:-9px; font-size:13px;">
                      <span style="font-size:16px; font-weight:bold; ">+</span>
                    </button>

                    <span
                      style="position:absolute; font-size:11px; font-weight:bolder; left:60px; top:30px;">Description</span>
                    <input class="form-control" type="text"
                      style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;"
                      name="originDescX[]">

                    <span
                      style="position:absolute; font-size:11px; font-weight:bolder; left:200px; top:30px;">Price</span>
                    <input class="form-control" type="number" step="any" name="originChargeX[]"
                      style="width:80px; height:30px; left:10px; position:relative; top:1px;">

                    <span
                      style="position:absolute; font-size:11px; font-weight:bolder; left:280px; top:30px; ">Quantity</span>
                    <input class="form-control" type="number" step="any" value="1" name="originChargeQX[]"
                      style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;">

                  </div>
                  <br>
                  <div style="margin-top:-12px;"></div>
                </div>




                <div class="input-group container3"
                  style="margin-top:18px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                  <p style="margin-top:-10px;">Destination Charges</p>
                  <br>
                  <div style="margin-top:-5px;">

                    <button class="add_form_field3"
                      style="margin-bottom:0px; width:30px; position:relative; left:90px; top:-9px; font-size:13px;">
                      <span style="font-size:16px; font-weight:bold; ">+</span>
                    </button>

                    <span
                      style="position:absolute; font-size:11px; font-weight:bolder; left:60px; top:30px;">Description</span>
                    <input class="form-control" type="text"
                      style="margin-top:15px; padding:5px; width:150px; position:relative; top:-14px; left:0px;"
                      name="destinationDescX[]">

                    <span
                      style="position:absolute; font-size:11px; font-weight:bolder; left:200px; top:30px;">Price</span>
                    <input class="form-control" type="number" step="any" name="destinationChargeX[]"
                      style="width:80px; height:30px; left:10px; position:relative; top:1px;">

                    <span
                      style="position:absolute; font-size:11px; font-weight:bolder; left:280px; top:30px; ">Quantity</span>
                    <input class="form-control" type="number" step="any" value="1" name="destinationChargeQX[]"
                      style="width:80px; text-align:center; height:30px; left:20px; position:relative; top:1px;">

                  </div>
                  <br>
                  <div style="margin-top:-12px;"></div>
                </div>


              </div>
              <div class="input-group"
                style=" margin-top:10px; left:30px; border:1px solid #D2D6DE; padding:15px; width:405px;">


                <div style="margin-top:-5px;">

                  <div style="width:200px; margin-bottom:7px; margin-left:27px;"><span
                      style="font-size:13px; font-weight:bolder;"><span
                        style="font-size:18px; position:absolute; top:13px; left:18px;" class="fa fa-cube"></span>By
                      Weight and Volume</span></div>
                  <br>

                  <span
                    style="position:absolute; font-weight:bolder; font-size:11px; top:38px; left:40px;">Quantity</span>
                  <input class="form-control" type="number" step="any" placeholder="" name="byVolume_qty"
                    style="border-left:1px solid black; width:100px; height:30px; position:relative; top:3px;">
                  <span
                    style="position:absolute; font-weight:bolder; font-size:11px; top:38px; left:165px;">Volume</span>
                  <input class="form-control" type="number" step="any" placeholder=""
                    style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:135px; position:relative; top:-14px; left:10px;"
                    name="byVolume_volume">

                  <span
                    style="position:absolute; font-weight:bolder; font-size:11px; top:38px; left:315px;">Weight</span>
                  <input class="form-control" type="number" step="any" placeholder=""
                    style="border-left:1px solid black; background:#EFEFEF; display:inline-block; margin-top:15px; padding:5px; width:120px; position:relative; top:-14px; left:20px;"
                    name="byVolume_weight">
                </div>
              </div>
              <br><br>

              <div class="input-group"
                style="margin-top:-140px;  position:relative; left:520px; border:1px solid #D2D6DE; padding:15px; width:405px;">
                <input type="number" name="containerQuantity" style="display:none;" value="1" class="form-control">
                <p style="margin-top:-10px;">Remarks</p>
                <div style="margin-top:-5px;">
                  <textarea name="remarks" style="width:100%; resize:none; min-height:200px; border-color:#D2D6DE; ">
                    A. COTIZACION ES BASADA EN TERMINO FOB DESDE BODEGA GUANGZHOU.
                    B. TRANSITO APROX:  X Dias 
                    C. NO INCLUYE SEGURO DE CARGA, NO INCLUYE AGENCIAMIENTO ADUANAL.</textarea>
                </div>
              </div>
              <input type="submit" value="Save" class="form_1_submit"
                style="background:#007F46; width:100px; position:relative; left:-73px; top:20px; z-index:9999;">


              <div class="input-group container4"
                style="margin-top:-125px; left:30px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                <div style="margin-top:-14px; ">

                  <button class="add_form_field4"
                    style="margin-bottom:0px; position:relative; left:330px; top:-5px; font-size:13px; height:25px;"><span
                      style="position:relative; top:-3px;">Add</span> &nbsp; <span
                      style="font-size:16px; position:relative; top:-2px; font-weight:bold; ">+</span></button>

                  <span style="font-size:13px; font-weight:bolder; position:relative; top:-3px;"><span
                      style="font-size:18px; position:absolute; top:2px; left:-28px;" class="fa fa-cubes"></span>By
                    Boxes</span> <br><br>

                  <span
                    style="position:absolute; font-weight:bolder; font-size:11px; top:38px; left:28px;">Quantity</span>
                  <input class="form-control" type="number" step="any" placeholder="" name="byBoxes_qtyX[]"
                    style="border-left:1px solid black; width:70px;  height:30px; position:relative; top:1px;">

                  <span
                    style="position:absolute; font-weight:bolder; font-size:11px; top:38px; left:107px;">Width</span>
                  <input class="form-control" type="number" step="any" placeholder=""
                    style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:55px; position:relative; top:-14px; left:10px;"
                    name="byBoxes_widthX[]">

                  <span
                    style="position:absolute; font-weight:bolder; font-size:11px; top:38px; left:177px;">Lenght</span>
                  <input class="form-control" type="number" step="any" placeholder=""
                    style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:25px;"
                    name="byBoxes_lenghtX[]">

                  <span
                    style="position:absolute; font-weight:bolder; font-size:11px; top:38px; left:253px;">Height</span>
                  <input class="form-control" type="number" step="any" placeholder=""
                    style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:40px;"
                    name="byBoxes_heightX[]">

                  <span
                    style="position:absolute; font-weight:bolder; font-size:11px; top:38px; left:320px;">Weight</span>
                  <input class="form-control" type="number" step="any" placeholder=""
                    style="border-left:1px solid black; background:#EFEFEF; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:50px;"
                    name="byBoxes_weightX[]">



                </div>


              </div>

              <br><br><br><br><br><br>



            </div>



          </form>

          <?php } ?>



      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- ./wrapper -->


  <!-- Page script -->
  <script>
    $(function () {


      //Datemask dd/mm/yyyy
      $("#datemask").inputmask("dd-mm-yyyy", { "placeholder": "dd-mm-yyyy" });
      //Datemask2 mm-dd-yyyy
      $("#datemask2").inputmask("mm-dd-yyyy", { "placeholder": "mm-dd-yyyy" });
      //Money Euro
      $("[data-mask]").inputmask();

      //Date range picker
      $('#reservation').daterangepicker();
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM-DD-YYYY h:mm A' });
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


    $(document).ready(function () {
      $("#state").select2({
        tags: true
      });

      $("#btn-add-state").on("click", function () {
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


    $(document).ready(function () {
      $("#state2").select2({
        tags: true
      });

      $("#btn-add-state2").on("click", function () {
        var newState2Val = $("#new-state2").val();
        // Set the value, creating a new option if necessary
        if ($("#state2").find("option[value='" + newState2Val + "']").length) {
          $("#state2").val(newState2Val).trigger("change");
        } else {
          // Create the DOM option that is pre-selected by default
          var newState2 = new Option(newState2Val, newState2Val, true, true);
          // Append it to the select
          $("#state2").append(newState2).trigger('change');
        }
      });
    });

    $(document).ready(function () {
      $("#state3").select2({
        tags: true
      });

      $("#btn-add-state3").on("click", function () {
        var newState3Val = $("#new-state3").val();
        // Set the value, creating a new option if necessary
        if ($("#state3").find("option[value='" + newState3Val + "']").length) {
          $("#state3").val(newState3Val).trigger("change");
        } else {
          // Create the DOM option that is pre-selected by default
          var newState3 = new Option(newState3Val, newState3Val, true, true);
          // Append it to the select
          $("#state3").append(newState3).trigger('change');
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