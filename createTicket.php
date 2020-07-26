<?php 
error_reporting(0);
require_once('conn.php');

    $message= $_GET['message'];
    $step= $_GET['step'];
    $type= $_GET['type'];
    $job_id_step1= $_GET['job_id_step1'];

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
  <title>System | Create Ticket</title>
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



  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

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
              <?php if($picture){ ?>
            <img src="<?php echo $picture; ?>" class="user-image" alt="User Image">
            <?php }else{ ?>
              <img src="./images/17-1.jpg" class="user-image" alt="User Image">
            <?php }?>
              <span class="hidden-xs"><?php echo $agent_name; ?></span>
            </a>
            <ul class="dropdown-menu shadow2">
              <!-- User image -->
              <li class="user-header" >
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
        <li class=" treeview" style="border-bottom:1px solid gray; padding:5px;">
            <a href="#" style="height:25px; position:relative; top:-10px;">
                <i class="fa fa-home"></i> <span style="font-size:11px; ">Warehouse</span>
                <span class="pull-right-container" style="top:22px;">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
                <li ><a class="" href="createWarehouse.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li><a href="searchWarehouse.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
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
        <li class="active treeview" style="border-bottom:1px solid gray; padding:5px;">
          <a href="#" style="height:25px; position:relative; top:-10px;"> 
            <i class="fa fa-info"></i> <span style="font-size:11px;">Tickets</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a  class="active" href="createTicket.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li><a   href="searchTicket.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
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
        Tickets 
        <small>Create</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create Tickets</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Form -->
<?php if ($step=='') {$step='1';} ?>
<?php if ($step=='1'){ ?>
  <div class="row" style="margin: 0px;"> 
        <div class="col-md-offset-2 col-md-8 shadow2" style="    background: white;margin-top:50px">
          <div class="row">
            <div class="col-md-12 text-center" style="border-bottom:1px solid #555555; padding-bottom:10px;">
              <h3 style="text-align:center; color:black; font-weight:400; font-size:20px; ">Create Ticket</h3>
              <span  style="color:black; font-size:14px; font-weight:400; padding:20px;">Please select one option:</span>
            </div>
          </div>
            <div class="row" style="margin:30px 10px">
              <div class="col-md-6">
                  <div class="form-group ">
                      <div class="text-center" style=" margin-bottom:20px">
                          <span style="font-size:60px; padding:10px;" class="glyphicon glyphicon-exclamation-sign"></span><br>
                      </div>
                  </div>
                  <form action="?" method="get">
                    <input type="hidden"  name="step" value="2">
                    <input type="hidden"  name="type" value="missing">
                    <div class="form-group row">
                        <div class="col-md-12" >
                          <div class=" input-group">
                            <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                            <select data-placeholder="Select Job Order" name="job_id_step1" class="form-control select2"  required="required" >

                              <option selected="selected" value=""></option>
                              <option value="Not Found">Not Found</option>
                              <?php 

                              if ($level=='Seller') { $consulta1 = mysqli_query($connect, "SELECT * FROM joborders WHERE agent_name='$agent_name' ORDER BY id desc ") or die ("Error al traer los datos"); 
                              }else{
                                $consulta1 = mysqli_query($connect, "SELECT * FROM joborders ORDER BY id desc ") or die ("Error al traer los datos");
                              }

                              while ($row = mysqli_fetch_array($consulta1)){ 
                                $customer_name=$row['customer_name'];
                                $customer_company=$row['customer_company'];
                                $job_id=$row['id'];

                                $customer= $customer_name.' / '.$customer_company;

                                ?>       
                              <option value="<?php echo $job_id; ?>"><?php echo $job_id.' | '.$customer; ?></option>
                              <?php }  ?>
                              
                            </select>
                          </div>                  
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 text-center">
                            <button type="submit"  class="btn btn-success" >Missing Cargo Ticket</button>
                        </div>
                    </div>
                  </form>
              </div>
              <div class="col-md-6">
                  <div class="form-group ">
                      <div class="text-center" style=" margin-bottom:20px">
                          <span style="font-size:60px; padding:10px;" class="glyphicon glyphicon-file"></span><br>
                      </div>
                  </div>
                  <form action="?" method="get">
                    <input type="hidden"  name="step" value="2">
                    <input type="hidden"  name="type" value="warehouse">
                    <div class="form-group row">
                        <div class="col-md-12" >
                          <div class=" input-group">
                            <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                            <select data-placeholder="Select Job Order" name="job_id_step1" class="form-control select2"  required="required" >
                              <option selected="selected" value=""></option>
                              <option value="Not Found">Not Found</option>
                              <?php 

                              if ($level=='Seller') { $consulta1 = mysqli_query($connect, "SELECT * FROM joborders WHERE agent_name='$agent_name' ORDER BY id desc ") or die ("Error al traer los datos"); 
                              }else{
                                $consulta1 = mysqli_query($connect, "SELECT * FROM joborders ORDER BY id desc ") or die ("Error al traer los datos");
                              }
                                while ($row = mysqli_fetch_array($consulta1)){ 
                                $customer_name=$row['customer_name'];
                                $customer_company=$row['customer_company'];
                                $job_id=$row['id'];
                                $customer= $customer_name.' / '.$customer_company;
                                ?>       
                              <option value="<?php echo $job_id; ?>"><?php echo $job_id.' | '.$customer; ?></option>
                              <?php }  ?>
                            </select>
                          </div>                  
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 text-center">
                            <button type="submit"  class="btn btn-danger" >Warehouse Ticket</button>
                        </div>
                    </div>
                  </form>
              </div>
            </div>
            
        </div>
      </div>
<?php } ?>

<?php if ($step=='2' && $type=='missing') { ?>
      <div class="row" style="margin: 0px;"> 
        <div class="col-md-offset-3 col-md-6 shadow2" style="    background: white;margin-top:50px">
          <div class="row">
            <div class="col-md-12 " style="border-bottom:1px solid #555555; padding-bottom:10px;padding-top: 10px;">
                <h4><span style="font-size:40px;  margin-right:20px; " class="glyphicon glyphicon-exclamation-sign"></span> &nbsp;New Missing Cargo Ticket</h4>
            </div>
          </div>
          <form action="action/saveTicket.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="missing">
            <input type="hidden" name="step" value="2">
            <?php 

                $consulta2 = mysqli_query($connect, "SELECT * FROM joborders WHERE id='$job_id_step1' ORDER BY id desc ") or die ("Error al traer los datos");

                  while ($row2 = mysqli_fetch_array($consulta2)){ 
                  $agent_name=$row2['agent_name'];
                    $customer_company= $row2['customer_company'];
                    $customer_name= $row2['customer_name']; 
                    $customer_telf= $row2['customer_telf'];
                    $supplier_telf= $row2['supplier_telf'];
                    $branch= $row2['branch'];
                    $supplier_company= $row2['supplier_company'];
                    $service= $row2['service'];


                    $customer_address= $row2['customer_address']; 
                    $supplier_address= $row2['supplier_address']; 

                    $service= $row2['service'];
                    $commodity= $row2['commodity'];
                    $wh_receipt= $row2['wh_receipt'];
                    $remark= $row2['remark'];
                    $customer_if = $row2['customer_name'];
              }
            ?>
            <div class="row" style="margin:30px 10px">
              <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class=" input-group">
                            <div class="input-group-addon"><i class="fa fa-circle input-fa"></i></div>
                            <select data-placeholder="Select Agent" <?php if ($level!='Seller'){ ?>
                              name="agent_name"
                            <?php } ?> class="form-control select2" <?php if ($level=='Seller'){ ?>
                              disabled
                            <?php } ?> >

                              <option value="<?php echo $agent_name; ?>"><?php echo $agent_name; ?></option>
                              

                              <?php 

                              $consultaList = mysqli_query($connect, "SELECT * FROM agents ORDER BY name asc ") or die ("Error al traer los datos");

                                while ($rowList = mysqli_fetch_array($consultaList)){ 

                                $agent_List=$rowList['name']; ?>
                                  

                                  <?php if ($agent_name!=$agent_List){ ?>

                              <option value="<?php echo $agent_List; ?>"><?php echo $agent_List; ?></option> 
                              <?php } }  ?>
                              
                            </select>
                        </div>
                    </div>
                </div>
                <?php if ($level=='Seller'){ ?>
                      <input type="hidden" name="agent_name"  value="<?php echo $agent_name; ?>">
                      
                    <?php } ?>

                <input type="hidden" name="agent_email"  value="<?php echo $email; ?>">
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                          <input type="text" name="name" class="form-control" value="<?php echo $customer_name; ?>" placeholder="Customer or Company Name">
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-briefcase input-fa"></i></div>
                          <input type="text" name="supplier" class="form-control" value="<?php echo $supplier_company; ?>" placeholder="Supplier Name">
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-phone input-fa"></i></div>
                          <input type="text" name="supplier_phone" class="form-control" value="<?php echo $supplier_telf; ?>" placeholder="Supplier Phone">
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-location-arrow input-fa"></i></div>
                          <textarea name="supplier_address" cols="30" rows="2" class="form-control" placeholder="Supplier Address"><?php echo $supplier_address; ?></textarea>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon" style="background: #D85050;color: white;"><i class="fa fa-file-word-o input-fa" style="color:white"></i>&nbsp;WR Number</div>
                          <input type="text" name="warehouse_receipt" class="form-control" value="<?php echo $wr; ?>" placeholder="Warehouse Receipt Number">
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon" style="background:#D85050;"><i class="fa fa-barcode input-fa" style="color:white;"></i></div>
                          <input type="text" name="tracking_number" class="form-control"  placeholder="Tracking Number">
                      </div>
                      <span style="font-size:12px;">* Important to find missing cargos.</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-plane input-fa"></i></div>
                          <select data-placeholder="Select Service" name="service" class="form-control select2"  required="">
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
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <label for="">Tracking Number Photo (1) ↓</label>
                      <input name="image" class="form-control" type="file">
                      <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:25px;right:12px"></span>
                  </div>
                </div>
                <div class="form-group row" style="display:none">
                  <div class="col-md-12">
                      <label for="">Tracking Number Photo (2) ↓</label>
                      <input name="image2" class="form-control" type="file">
                      <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:25px;right:12px"></span>
                  </div>
                </div>
                <div class="form-group row" style="display:none">
                  <div class="col-md-12">
                      <label for="">Tracking Number Photo (3) ↓</label>
                      <input name="image3" class="form-control" type="file">
                      <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:25px;right:12px"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon" style="background:#D85050; color:white">Note</div>
                          <textarea name="notes" cols="30" rows="4" class="form-control" placeholder=""></textarea>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12 text-right">
                      <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
<?php }else if($step=='2' && $type=='warehouse'){ ?>
  <div class="row" style="margin: 0px;"> 
        <div class="col-md-offset-3 col-md-6 shadow2" style="    background: white;margin-top:50px">
          <div class="row">
            <div class="col-md-12 " style="border-bottom:1px solid #555555; padding-bottom:10px;padding-top: 10px;">
                <h4><span style="font-size:40px;  margin-right:20px; " class="glyphicon glyphicon-file"></span> &nbsp;New Warehouse Ticket</h4>
            </div>
          </div>
          <form action="action/saveTicket.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="warehouse">
            <input type="hidden" name="step" value="2">
            <?php
             $consulta2 = mysqli_query($connect, "SELECT * FROM joborders WHERE id='$job_id_step1' ORDER BY id desc ") or die ("Error al traer los datos");

              while ($row2 = mysqli_fetch_array($consulta2)){ 
              $agent_name=$row2['agent_name'];
              $customer_company= $row2['customer_company'];
              $customer_name= $row2['customer_name']; 
              $customer_telf= $row2['customer_telf'];
              $supplier_telf= $row2['supplier_telf'];
              $branch= $row2['branch'];
              $supplier_company= $row2['supplier_company'];


              $customer_address= $row2['customer_address']; 
              $supplier_address= $row2['supplier_address']; 

              $service= $row2['service'];
              $commodity= $row2['commodity'];
              $wh_receipt= $row2['wh_receipt'];
              $remark= $row2['remark'];
              $customer_if = $row2['customer_name'];
              }
              ?>

              <?php $consulta3 = mysqli_query($connect, "SELECT * FROM receipt WHERE jobOrderId='$job_id_step1' ORDER BY id desc ") or die ("Error al traer los datos");
              while ($row3 = mysqli_fetch_array($consulta3)){
              $wr= $row3['wr'];
              }
            ?>
            <div class="row" style="margin:30px 10px">
              <div class="col-md-12">
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class=" input-group">
                            <div class="input-group-addon"><i class="fa fa-circle input-fa"></i></div>
                            <select data-placeholder="Select Agent" <?php if ($level!='Seller'){ ?>
                              name="agent_name"
                            <?php } ?> class="form-control select2" <?php if ($level=='Seller'){ ?>
                              disabled
                            <?php } ?> >

                              <option value="<?php echo $agent_name; ?>"><?php echo $agent_name; ?></option>
                              

                              <?php 

                              $consultaList = mysqli_query($connect, "SELECT * FROM agents ORDER BY name asc ") or die ("Error al traer los datos");

                                while ($rowList = mysqli_fetch_array($consultaList)){ 

                                $agent_List=$rowList['name']; ?>
                                  

                                  <?php if ($agent_name!=$agent_List){ ?>

                              <option value="<?php echo $agent_List; ?>"><?php echo $agent_List; ?></option> 
                              <?php } }  ?>
                              
                            </select>
                        </div>
                    </div>
                </div>
                <?php if ($level=='Seller'){ ?>
                      <input type="hidden" name="agent_name"  value="<?php echo $agent_name; ?>">
                      
                    <?php } ?>

                <input type="hidden" name="agent_email"  value="<?php echo $email; ?>">
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                          <input type="text" name="name" class="form-control" value="<?php echo $customer_name; ?>" placeholder="Customer or Company Name">
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-briefcase input-fa"></i></div>
                          <input type="text" name="supplier" class="form-control" value="<?php echo $supplier_company; ?>" placeholder="Supplier Name">
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-phone input-fa"></i></div>
                          <input type="text" name="supplier_phone" class="form-control" value="<?php echo $supplier_telf; ?>" placeholder="Supplier Phone">
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-location-arrow input-fa"></i></div>
                          <textarea name="supplier_address" cols="30" rows="2" class="form-control" placeholder="Supplier Address"><?php echo $supplier_address; ?></textarea>
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon" style="background: #D85050;color: white;"><i class="fa fa-file-word-o input-fa" style="color:white"></i>&nbsp;WR Number</div>
                          <input type="text" name="warehouse_receipt" class="form-control" value="<?php echo $wr; ?>" placeholder="Warehouse Receipt Number">
                      </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon" style="background:#D85050;"><i class="fa fa-barcode input-fa" style="color:white;"></i></div>
                          <input type="text" name="tracking_number" class="form-control"  placeholder="Tracking Number">
                      </div>
                      <span style="font-size:12px;">* Required to identify the cargos.</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon"><i class="fa fa-plane input-fa"></i></div>
                          <select data-placeholder="Select Service" name="service" class="form-control select2"  required="">
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
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <label for="">Tracking Number Photo (1) ↓</label>
                      <input name="image" class="form-control" type="file">
                      <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:25px;right:12px"></span>
                  </div>
                </div>
                <div class="form-group row" style="display:none">
                  <div class="col-md-12">
                      <label for="">Tracking Number Photo (2) ↓</label>
                      <input name="image2" class="form-control" type="file">
                      <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:25px;right:12px"></span>
                  </div>
                </div>
                <div class="form-group row" style="display:none">
                  <div class="col-md-12">
                      <label for="">Tracking Number Photo (3) ↓</label>
                      <input name="image3" class="form-control" type="file">
                      <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:25px;right:12px"></span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                      <div class="input-group">
                          <div class="input-group-addon" style="background:#D85050; color:white">Note</div>
                          <textarea name="notes" cols="30" rows="4" class="form-control" placeholder=""></textarea>
                          
                      </div>
                      <span style="font-size:12px;">* Important to resolve the inquiry.</span>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12 text-right">
                      <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
<?php } ?>
    </section>
    <!-- /.content -->
  </div>


<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
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
   
  });
</script>


</body>
</html>
