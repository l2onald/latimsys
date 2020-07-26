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
.btn_minus{
    background-color: #DD4B39;
    color: #fff;
    font-weight: bold;
    border-radius: 0px; 
    width:34.19px
}
.file-upload-wrapper {
    border: 1px dotted;
    height: 200px;
    background: rgba(0,0,0,0.03);
    border-radius: 17px;
    box-shadow: 0 2px 1px rgba(0, 0, 0, 0.05);
    cursor: pointer;
}
.file-upload-wrapper:hover{
  border: 2px dotted green;
}
#input-file-now{
    width: 100%;
    height: 100%;
    opacity: 0;
    /* overflow: hidden; */
    position: absolute;
}
.upload-icon{
    font-size: 100px;
      top: calc(50% - 50px);
      position: absolute;
      z-index: 1000;
      left: calc(50% - 50px);
      cursor: pointer;
  }
  .upload-icon:hover{
    font-size: 105px;
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
            <li ><a class="active" href="createWarehouse.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
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
              <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">CREATE WAREHOUSE RECEIPT</h3>
            </div>
          </div>
          <form action="action/savewaresthousestep1.php?step=2" id="step1_form"  method="post">
            <div class="row" style="margin:30px 0px">
              <div class="col-md-6">   
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-calendar input-fa"></i></div>
                            <input type="text" class="form-control" data-provide="datepicker" name="fecha" data-date-format="yyyy-mm-dd" placeholder="Select date" value="<?php echo date('Y-m-d');?>" required >
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Supplier</span>
                        <select name="supplier_id" id="" class="form-control select2" data-placeholder="Select Supplier" style="width:100%" required>
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
                      <span class="input-group-addon add_btn"><button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#myModal1"><i class="fa fa-plus"></i>&nbsp;Add</button></span>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Consignee</span>
                      <select name="consignee_id" id="" class="form-control select2" data-placeholder="Select Consignee" style="width:100%" required>
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
                      <span class="input-group-addon add_btn"><button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#myModal3"><i class="fa fa-plus"></i>&nbsp;Add</button></span>
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
                      <select name="bill_id" id="" class="form-control select2" data-placeholder="Select Bill" style="width:100%" required>
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
                      <span class="input-group-addon add_btn"><button type="button"  class="btn btn-danger" data-toggle="modal" data-target="#myModal2"><i class="fa fa-plus"></i>&nbsp;Add</button></span>
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
                    <div class="col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon span_custom" style="">Invoice</span>
                          <input type="text" name="invoice" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">                    
                      <div class="input-group">
                        <span class="input-group-addon span_custom" style="font-size:12px">Value</span>
                          <input type="text" name="value" class="form-control" placeholder="">
                      </div>
                    </div>
                </div>
                <div class="form-group row">                  
                    <div class="col-md-6">
                      <div class="input-group">
                        <span class="input-group-addon span_custom" style="">PO</span>
                          <input type="text" name="po" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6">                    
                      <div class="input-group">
                        <span class="input-group-addon span_custom" style="font-size:12px">Marks</span>
                          <input type="text" name="marks" class="form-control" placeholder="">
                      </div>
                    </div>
                </div>                 
                <div class="form-group row">                  
                    <div class="col-md-8">
                      <div class="input-group">
                        <span class="input-group-addon span_custom" style="font-size:12px">Delivered By</span>
                          <input type="text" name="delivered_by1" class="form-control" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-4">                    
                          <input type="text" name="delivered_by2" class="form-control" placeholder="">
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
                      <span class="input-group-addon span_custom" style="font-size: 13px;">Description</span>
                        <textarea name="description" id="" cols="30" rows="3" class="form-control"></textarea>
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Comments</span>
                        <textarea name="comments" id="" cols="30" rows="3" class="form-control"></textarea>
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
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Terms</span>
                        <input type="text" name="terms" class="form-control" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon span_custom">Condition</span>
                        <input type="text" name="condition2" class="form-control" placeholder="">
                    </div>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-4" >Status</label>
                    <div class="col-md-8">
                          <label class="control-label radio-inline"><input type="radio" name="status" value="received" checked>Received</label>
                          <label class="control-label radio-inline"><input type="radio" name="status" value="pre-alert">Pre-alert</label>
                    </div>                   
                </div>
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
      <div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add new supplier</h4>
                </div>
                <form action="action/saveSupplierStep1waresthouse.php" method="POST">
                <div class="modal-body">                    

                        <input name="customer" value="<?php echo $customer; ?>" type="hidden">                      

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
      <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add new Bill</h4>
                </div>
                <form action="action/saveClientStep1waresthouse.php" method="POST">
                    <div class="modal-body">                    

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
                            <input type="text" name="agent_name" type="hidden" value="<?php echo $agent_name; ?>">
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
                            <input name="state" type="text" class="form-control" placeholder="State">
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
      <div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add new Consignee</h4>
                </div>
                <form action="action/saveConsigneeStep1waresthouse.php" method="POST">
                      <div class="modal-body">
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
                            <input type="text" name="agent_name" type="hidden" value="<?php echo $agent_name; ?>">
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
                            <input name="state" type="text" class="form-control" placeholder="State">
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
                              <input type="radio" name="type" value="Client" class="flat-red" required="required" checked>
                              <label>Consignee</label>
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
   
      <div class="row" style="margin: 0px;"> 
        <div class="col-md-offset-3 col-md-6 shadow2" style="background: white;margin-top:50px">
          <div class="row">
            <div class="col-md-12">
              <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">CREATE WAREHOUSE RECEIPT</h3>
            </div>
          </div> 
          <form action="action/savewaresthousestep2.php" method="post" enctype="multipart/form-data">
          <input type="hidden" name="warehouse_id" value=<?php echo $warehouse_id; ?>>
          <div class="row">
            <div class="col-md-12">
              <table class="table"> 
                <thead>
                  <tr>
                    <td class="text-center">Pieces</td>
                    <td class="text-center">Gross Weight</td>
                    <td class="text-center">Volume</td>
                    <td class="text-center">Charg.Weight</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th id="total_pieces" class="text-center"></th>
                    <th id="total_weight" class="text-center"></th>
                    <th id="total_volume" class="text-center"></th>
                    <th id="total_charg_weight" class="text-center"></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <style>
          
          </style>
          <div class="row" style="margin-top:20px; margin-bottom:20px">
            <div class="col-md-offset-2 col-md-8">
              <div class="file-upload-wrapper">
              <input type="file" id="input-file-now" name="image_file[]" class="file-upload" required  multiple/>
                <i class="fa fa-cloud-upload upload-icon"></i><br>
                <div style="    width: 100%;
                    height: 100%;
                    align-items: center;
                    text-align: center;
                    align-content: center;
                    margin: auto;
                    justify-content: center;
                    display: grid;
                    margin-top: 30px;">
                  
                  <label for="input-file-now" style="color: #0f3c4b;font-weight: inherit;font-size: 16px;">
                    <strong>Choose a file</strong>
                    <span> or drag it here</span><br>
                    
                  </label>
                </div>
                
              </div>
            </div>
          </div>
          <input type="hidden" name="total_pieces">
          <input type="hidden" name="total_weight">
          <input type="hidden" name="total_volume">
          <input type="hidden" name="total_charg_weight">
          <div class="row">
            <div class="col-md-12">
              <div class="card" id="by_boxes_content">
                  <p><i class="fa fa-cubes"></i>&nbsp;By Boxes</p>
                  <div class="item">
                      <div class="form-group row" style="margin-bottom:0px;">
                         <div class="col-md-2 col-item text-center">
                              <label for="">Pieces</label>
                          </div>  
                          <div class="col-md-2 col-item text-center">
                              <label for="">Lenght</label>
                          </div>
                          <div class="col-md-2 col-item text-center">
                              <label for="">Width</label>
                          </div>
                          <div class="col-md-2 col-item text-center">
                              <label for="">Height</label>
                          </div>  
                          <div class="col-md-2 col-item text-center">
                              <label for="">Weight</label>
                          </div>                       
                      </div>
                  </div>                   
                  <div class="item col">
                      <div class="form-group row">
                          <div class="col-md-2 col-item">
                              <input type="number" name="byBoxes_piecesx[]" value="" required class="form-control">
                          </div>
                          <div class="col-md-2 col-item">
                              <input type="number" name="byBoxes_lenghtX[]" value="" required class="form-control">
                          </div>
                          <div class="col-md-2 col-item">
                              <input type="number" name="byBoxes_widthX[]" value="" required class="form-control">
                          </div>
                          <div class="col-md-2 col-item">
                              <input type="number" name="byBoxes_heightX[]" value="" required class="form-control">
                          </div>
                          <div class="col-md-2 col-item">
                              <input type="number" name="byBoxes_weightX[]" value="" required class="form-control">
                          </div>
                          
                          <div class="col-md-1 col-item">                                         
                              <button  type="button"  class="btn btn_plus">+</button>                                          
                          </div>
                      </div>
                  </div>                 
              </div>
            </div>
          </div>
          <div class="row" style="margin-bottom:30px">
            <div class="col-md-12 text-right">
              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;Save</button>
            </div>
          </div>
          </form>
        </div>
      </div>
    <?php } ?>
  <!-- Form -->
  </section>
</div>

<script>
 
  $(function () {
    //Initialize Select2 Elements
    $(".file-upload-wrapper").click(function() {
        $("input[id='input-file-now']").click();
    });

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
    $("#myModal1 form").submit(function(e){
      event.preventDefault(); 
      var post_url = $(this).attr("action"); //get form action url
      var form_data = $(this).serialize(); //Encode form elements for submission                            
      $.post( post_url, form_data, function( response ) {     
          $("#step1_form select[name='supplier_id']").html(response);
          clear1();                          
          $("#myModal1").modal('hide');
          swal({
              title: "Supplier!",
              text: "New Supplier created successful!",
              icon: "success",
          });
      });
    })
    function clear1(){
      $("#myModal1 input[name='company']").val('');
      $("#myModal1 input[name='name']").val('');
      $("#myModal1 input[name='address_1']").val('');
      $("#myModal1 input[name='address_2']").val('');
      $("#myModal1 input[name='city']").val('');
      $("#myModal1 input[name='state']").val('');
      $("#myModal1 input[name='country']").val('');
      $("#myModal1 input[name='telf1']").val('');
      $("#myModal1 input[name='telf2']").val('');
      $("#myModal1 input[name='qq']").val('');
      $("#myModal1 input[name='wechat']").val('');
      $("#myModal1 input[name='email']").val('');
    }
    $("#myModal2 form").submit(function(e){
      event.preventDefault(); 
      var post_url = $(this).attr("action"); //get form action url
      var form_data = $(this).serialize(); //Encode form elements for submission                            
      $.post( post_url, form_data, function( response ) {     
          $("#step1_form select[name='bill_id']").html(response);                          
          $("#myModal2").modal('hide');
          clear2();      
          swal({
              title: "Client!",
              text: "New Client created successful!",
              icon: "success",
          });
      });
    })
    function clear2(){
      $("#myModal2 input[name='agent_name']").val('');
      $("#myModal2 input[name='company']").val('');
      $("#myModal2 input[name='name']").val('');
      $("#myModal2 input[name='address_1']").val('');
      $("#myModal2 input[name='address_2']").val('');
      $("#myModal2 input[name='city']").val('');
      $("#myModal2 input[name='state']").val('');
      $("#myModal2 input[name='country']").val('');
      $("#myModal2 input[name='telf1']").val('');
      $("#myModal2 input[name='telf2']").val('');
      $("#myModal2 input[name='qq']").val('');
      $("#myModal2 input[name='wechat']").val('');
      $("#myModal2 input[name='email']").val('');
    }
    $("#myModal3 form").submit(function(e){
      event.preventDefault(); 
      var post_url = $(this).attr("action"); //get form action url
      var form_data = $(this).serialize(); //Encode form elements for submission                            
      $.post( post_url, form_data, function( response ) {    
          var data=JSON.parse(response);
          if(data.status){                          
            $("#myModal3").modal('hide');
            clear3();      
            swal({
                title: "Consignee!",
                text: "New Password is "+data.password,
                icon: "success",
            });
            $("#step1_form select[name='consignee_id']").html(data.html);        
            $("#step1_form select[name='bill_id']").html(data.html);     
          }else{
              swal({
              title: "Waring!",
              text: data.html,
              icon: "error",
            });
          }
       
      });
    })
    function clear3(){
      $("#myModal3 input[name='agent_name']").val('');
      $("#myModal3 input[name='company']").val('');
      $("#myModal3 input[name='name']").val('');
      $("#myModal3 input[name='address_1']").val('');
      $("#myModal3 input[name='address_2']").val('');
      $("#myModal3 input[name='city']").val('');
      $("#myModal3 input[name='state']").val('');
      $("#myModal3 input[name='country']").val('');
      $("#myModal3 input[name='telf1']").val('');
      $("#myModal3 input[name='telf2']").val('');
      $("#myModal3 input[name='qq']").val('');
      $("#myModal3 input[name='wechat']").val('');
      $("#myModal3 input[name='email']").val('');
    }
    $("#by_boxes_content .btn_plus").on("click", function(e){
        e.preventDefault();
        var html='<div class="item col">';
            html+='<div class="form-group row">';
            html+='<div class="col-md-2 col-item">';
            html+='<input type="number"  name="byBoxes_piecesx[]" required class="form-control">';
            html+='</div>';
            html+='<div class="col-md-2 col-item">';
            html+='<input type="text" name="byBoxes_lenghtX[]" required class="form-control">';
            html+='</div>';
            html+='<div class="col-md-2 col-item">';
            html+='<input type="number" name="byBoxes_widthX[]" required class="form-control">';
            html+='</div>';
            html+='<div class="col-md-2 col-item">';
            html+='<input type="number"  name="byBoxes_heightX[]" required class="form-control">';
            html+='</div>';
            html+='<div class="col-md-2 col-item">';
            html+='<input type="number"  name="byBoxes_weightX[]" required class="form-control">';
            html+='</div>';            
            html+='<div class="col-md-1 col-item">';
            html+='<button  type="button" class="btn btn_minus">-</button>';
            html+='</div>';
            html+='</div>';
            html+='</div>';
           
        $("#by_boxes_content").append(html);
          $("#by_boxes_content input[name='byBoxes_weightX[]']").keypress(function(e){
              total_calculator();
            })
          $('#by_boxes_content .btn_minus').on("click", function (e) {
            e.preventDefault(); 
            $(this).parent('div').parent('div').parent('div').remove(); 
            total_calculator();
          })
      });

      $('#by_boxes_content .btn_minus').on("click", function (e) {
        e.preventDefault(); 
        $(this).parent('div').parent('div').parent('div').remove(); 
        total_calculator();
      })
    $("#by_boxes_content input[name='byBoxes_weightX[]']").keypress(function(e){
      total_calculator();
    })
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();
   
    function total_calculator(){
      var total_pieces=0,total_weight=0, total_volume=0;
      $("#by_boxes_content .col").each(function(index,ele){
        var pieces=$(this)[0].children[0].children[0].children[0].value;
        var lenght=$(this)[0].children[0].children[1].children[0].value;
        var width=$(this)[0].children[0].children[2].children[0].value;
        var height=$(this)[0].children[0].children[3].children[0].value;
        var weight=$(this)[0].children[0].children[4].children[0].value;
        total_pieces=total_pieces+parseInt(pieces);
        total_volume=total_volume+parseInt(lenght)*parseInt(width)*parseInt(height)/1000000;
        total_weight=total_weight+parseInt(weight);
        
      });
      $("#total_pieces").text(total_pieces);
      $("#total_weight").text(total_weight);
      $("#total_charg_weight").text(total_weight);
      $("#total_volume").text(total_volume.toFixed(5));

      $("input[name='total_pieces']").val(total_pieces);
      $("input[name='total_weight']").val(total_weight);
      $("input[name='total_volume']").val(total_volume.toFixed(5));
      $("input[name='total_charg_weight']").val(total_weight);
    
    }
  
  });
</script>


</body>
</html>
