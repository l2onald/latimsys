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
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <link href="https://fonts.googleapis.com/css?family=Be+Vietnam&display=swap" rel="stylesheet">

  <!-- Latim style -->
  <link rel="stylesheet" href="latimstyle.css">


 

  <script type="text/JavaScript" src="js/sha512.js"></script> 
  <script type="text/JavaScript" src="js/forms.js"></script>



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

  <?php if ($message=='TicketSaved'){ ?>
                  <br>
                  <div id="mydiv" style="background-color: rgba(0, 127, 70, 1); padding:20px;color:white; position:absolute; left:50%; width:300px; margin-left:140px; top:80px;">
                    <center>
                      <span style="font-style: oblique; ">Ticket has been created.</span>
                    </center>


</div>
<?php }else{ ?>

<?php } ?>

  <div class="form_1 shadow2" style="width:900px; margin-left:-450px; background:white; height:300px;">
     
 <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">Create Ticket<br>
 <span style="color:black; font-size:14px; font-weight:400; position:relative; top:10px;">Please select one option:</span>
</h3>





<br>


<script type="text/javascript">
    setTimeout(fade_out, 3000);

function fade_out() {
  $("#mydiv").fadeOut().empty();
}
</script>

<div style="width:400px; position:relative; float:left; left:50%; margin-left:-300px; top:90px;">

                    <span style="font-size:60px; position:absolute; top:-85px; left:50px;" class="glyphicon glyphicon-exclamation-sign"></span>
<form action="?" method="get">
<br>
<input type="text" style="display:none;" name="step" value="2">
<input type="text" style="display:none;" name="type" value="missing">

                <div class="input-group" style="position:relative; top:-20px; left:-50px; ">

                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>

                  <select data-placeholder="Select Job Order" name="job_id_step1" class="form-control select2" style="width:200px;" required="required" >

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

                  <input type="submit" class="btn btn-primary btn-lg" style="width:160px;border-radius:2px; top:-10px; position:relative; height:40px; background:#4C7C67; border:none; font-size:13px;" onMouseOver="this.style.background='#007F46'"
   onMouseOut="this.style.background='#4C7C67'" name="" value="Missing Cargo Ticket">


                
              </form>






</div>


<div style="width:400px; position:relative; float:right; left:80px; top:90px;">

  <span style="font-size:60px; position:absolute; top:-80px; left:50px;" class="glyphicon glyphicon-file"></span>

  <form action="?" method="get">
<br>
<input type="text" style="display:none;" name="step" value="2">
<input type="text" style="display:none;" name="type" value="warehouse">

                <div class="input-group" style="position:relative; top:-20px; left:-50px; ">

                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>

                  <select data-placeholder="Select Job Order" name="job_id_step1" class="form-control select2" style="width:200px;" required="required" >

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

                  <input type="submit" class="btn btn-primary btn-lg" style="width:160px;border-radius:2px; top:-10px; position:relative; height:40px; background:#B7565B; border:none; font-size:13px;" onMouseOver="this.style.background='#B80008'"
   onMouseOut="this.style.background='#B7565B'" name="" value="Warehouse Ticket">
                
              </form>

</div>

        </div>
  
<?php }elseif ($step=='2' && $type=='missing') { ?>

  <div class="form_1 shadow2" style="width:600px; margin-left:-300px; background:white; ">

    <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel"><span style="font-size:40px; position:relative; top:10px; margin-right:20px; " class="glyphicon glyphicon-exclamation-sign"></span>New Missing Cargo Ticket</h4>
      </div>
      <div class="modal-body">
        <form action="action/saveTicket.php" method="POST" enctype="multipart/form-data">

          <input type="text" name="type" style="display:none;" value="missing">

                  <div class="input-group">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-circle"></i></span>

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

                    <input type="text" name="agent_email" style="display:none;" value="<?php echo $email; ?>">


                  </div>
                  

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                    <input name="name" type="text" class="form-control" placeholder="Customer or Company Name" required="required" value="<?php echo $customer_name; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-briefcase"></i></span>
                    <input name="supplier" type="text" class="form-control" placeholder="Supplier Name"  value="<?php echo $supplier_company; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="supplier_phone" type="text" class="form-control" placeholder="Supplier Phone" value="<?php echo $supplier_telf; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-location-arrow"></i></span>
                    <textarea name="supplier_address" style="resize:none;" type="text" class="form-control" placeholder="Supplier Address"><?php echo $supplier_address; ?></textarea>
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#D85050; color:white;"><i style="width:87px;" class="fa fa-file-word-o">  WR Number</i></span>
                    <input name="warehouse_receipt" type="text" class="form-control" placeholder="Warehouse Receipt Number"  value="<?php echo $wr; ?>">
                  </div>


                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#D85050;"><i style="width:20px; background:#D85050; color:white;"  class="fa fa-barcode"></i></span>
                    <input name="tracking_number" type="text" class="form-control" placeholder="Tracking Number">

                  </div>
                  <span>* Important to find missing cargos.</span>


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

                  <br><br>

                <div class="form-group has-feedback" style="margin-top:0px;">
                  <label>Tracking Number Photo (1) ↓</label>
                  <input name="image" class="form-control" type="file">
                  <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:22px;"></span>
                </div>

                <div class="form-group has-feedback" style="margin-top:0px; display:none;">
                  <label>Packing List or Invoice File (2) ↓</label>
                  <input name="image2" class="form-control" type="file">
                  <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:22px;"></span>
                </div>

                <div class="form-group has-feedback" style="margin-top:0px; display:none;">
                  <label>Cargos Photos (3) ↓</label>
                  <input name="image3" class="form-control" type="file">
                  <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:22px;"></span>
                </div>


                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon">Notes</span>
                    <textarea name="notes" style="resize:none; height:100px;" type="text" class="form-control" placeholder=""></textarea>
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <input type="submit"value="Save" class="form_1_submit" style="top:0px; left:470px; background:#007F46;">
                  </div>

                  
              </form>

              
      </div>

  </div>

<?php }else{ ?>

  <div class="form_1 shadow2" style="width:600px; margin-left:-300px; background:white; ">

    <div class="modal-header">

        <h4 class="modal-title" id="myModalLabel"><span style="font-size:40px; position:relative; top:10px; margin-right:20px; " class="glyphicon glyphicon-file"></span>New Warehouse Ticket</h4>
      </div>
      <div class="modal-body">
        <form action="action/saveTicket.php" method="POST" enctype="multipart/form-data">   

          <input type="text" name="type" style="display:none;" value="warehouse">
          <input type="text" name="step" style="display:none;" value="2">


          <?php $consulta2 = mysqli_query($connect, "SELECT * FROM joborders WHERE id='$job_id_step1' ORDER BY id desc ") or die ("Error al traer los datos");

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

                    <input type="text" name="agent_email" style="display:none;" value="<?php echo $email; ?>">


                  </div>


                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                    <input name="name" type="text" class="form-control" placeholder="Customer or Company Name" required="required" value="<?php echo $customer_name; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-briefcase"></i></span>
                    <input name="supplier" type="text" class="form-control" placeholder="Supplier Name" value="<?php echo $supplier_company; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-phone"></i></span>
                    <input name="supplier_phone" type="text" class="form-control" placeholder="Supplier Phone" value="<?php echo $supplier_telf; ?>">
                  </div>

                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-location-arrow"></i></span>
                    <textarea name="supplier_address" style="resize:none;" type="text" class="form-control" placeholder="Supplier Address"><?php echo $supplier_address; ?></textarea>
                  </div>





                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#D85050; color:white;"><i style="width:87px;" class="fa fa-file-word-o">  WR Number</i></span>
                    <input name="warehouse_receipt" type="text" class="form-control" placeholder="Warehouse Receipt Number" required="required" value="<?php echo $wr; ?>">
                  </div>
                  <span>* Required to identify the cargos.</span>

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

                  <br><br>

                <div class="form-group has-feedback" style="margin-top:0px;">
                  <label>Photo (1) ↓</label>
                  <input name="image" class="form-control" type="file">
                  <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:22px;"></span>
                </div>


                <div class="form-group has-feedback" style="margin-top:0px; display:none;">
                  <label>Packing List or Invoice File (2) ↓</label>
                  <input name="image2" class="form-control" type="file">
                  <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:22px;"></span>
                </div>

                <div class="form-group has-feedback" style="margin-top:0px; display:none;">
                  <label>Cargos Photos (3) ↓</label>
                  <input name="image3" class="form-control" type="file">
                  <span class="glyphicon glyphicon-picture form-control-feedback" style="position:absolute; top:22px;"></span>
                </div>


                  <div class="input-group" style="margin-top:20px;">
                    <span class="input-group-addon" style="background:#D85050; color:white;">Notes</span>
                    <textarea name="notes" required="required" style="resize:none; height:100px;" type="text" class="form-control" placeholder=""></textarea>
                  </div>
                  <span>* Important to resolve the inquiry.</span>

              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" style="background:#B80008; border:none; height:40px; border-radius:2px; color:white; position:relative; left:-30px; width:100px;" data-dismiss="modal">Cancel</button>
        <input type="submit"value="Save" class="form_1_submit" style="top:0px; background:#007F46;">
              </form>

              
      </div>

  </div>



<?php } ?>
    

              
            
          

              

                 


              </div> 

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
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>


</body>
</html>
