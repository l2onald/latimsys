<?php 
error_reporting(0);
session_start();

require_once('conn.php');

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

   
       if(isset($_POST["submitUpdate"]))
          {
           if(!empty($_POST["jobCheck"]))
           {
            foreach($_POST["jobCheck"] as $jobCheck)
            {
              $dt = new DateTime($fecha);
$fecha = $dt->format('Y-m-d H:i:s');
              $statusUpdate = $_POST["statusUpdate"];


            $queryModel = mysqli_query($connect, "UPDATE joborders SET status='$statusUpdate' WHERE id='$jobCheck' ") or die ('error');

            $queryModel = mysqli_query($connect, "INSERT INTO notes(agent_name, jobOrderId, note, fecha) 
                VALUES ('$agent_name', '$jobCheck', 'Updated to:  $statusUpdate.', '$fecha')");

            echo "<script type='text/javascript'>opener.location.reload(); //This will refresh parent window.
window.close(); //Close child window. You may also use self.close();</script>";


            }

          }
          
         }
    
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="icon" type="image/x-icon" href="icoplane.ico" />


  <title>Latim Cargo & Trading | Search LATAM Order</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">

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
input[type=checkbox] {
         position: relative;
         cursor: pointer;
         left:20px;
         top:24px;
    }
    input[type=checkbox]:before {
         content: "";
         display: block;
         position: absolute;
         width: 20px;
         height: 20px;
         top: 0;
         left: 0;
         border: 1px solid #555555;
         border-radius: 3px;
         background-color: white;
}
    input[type=checkbox]:checked:after {
         content: "";
         font-size:20px;
         display: block;
         width: 5px;
         font-size:600;
         height: 15px;
         border: solid black;
         border-width: 0 2px 2px 0;
         -webkit-transform: rotate(45deg);
         -ms-transform: rotate(45deg);
         transform: rotate(45deg);
         position: absolute;
         top: 2.5px;
         left: 8px;
}

.content{overflow-x: scroll;}


                    </style>


  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">

  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->

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

.nav .open>a, .nav .open>a:focus, .nav .open>a:hover{background-color:#910007;}


.pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {background-color:#B80008; border-color:#B80008;}

.pagination>li>a:hover{color:#B80008;}


.content-wrapper{background-color:#f0f0f0;}

.shadow2{
    -webkit-box-shadow: 0px 2px 2px 1px rgba(194,192,194,0.75);
-moz-box-shadow: 0px 2px 2px 1px rgba(194,192,194,0.75);
box-shadow: 0px 2px 2px 1px rgba(194,192,194,0.75);

}

  </style>



  <style>
div#load_screen{
  background: #393939;
  opacity: 0.9;
  position: fixed;
    z-index:10;
  top: 0px;
  width: 100%;
  height: 1600px;
}
div#load_screen > div#loading{
  color:#FFF;
  width:120px;
  height:24px;
  margin: 300px auto;
}
</style>
<script>
window.addEventListener("load", function(){
  var load_screen = document.getElementById("load_screen");
  document.body.removeChild(load_screen);
});
</script>


</head>
<body class="hold-transition sidebar-mini">

  <div id="load_screen"><div id="loading"><img src="./img/logo.png" style="width:180px; padding:5px;"><br><span style="font-size:26px; color:yellow; position:relative; left:18px;">LOADING...</span></div></div>
<!-- Your normal document content lives here -->


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

        
        <li class=" treeview" style="border-bottom:1px solid gray; padding:5px; margin-top:0px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-files-o"></i> <span style="font-size:11px;">USA Orders</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a  href="createUsaOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li><a  href="searchUsaOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>

        
        <li class="active treeview" style="border-bottom:1px solid gray; padding:5px; margin-top:0px;">
          <a href="#" style="height:25px; position:relative; top:-10px;">
            <i class="fa fa-files-o"></i> <span style="font-size:11px;">LATAM Orders</span>
            <span class="pull-right-container" style="top:22px;">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="createLATAMOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
            <li ><a class="active"href="searchLATAMOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
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
        LATAM Orders 
        <small>Search</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Search LATAM Order</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      
      <!-- Search -->
      <div class="searchPage shadow2" style="background:white; width:90%; margin-left:-45%;">

        <h3 style="text-align:center; color:black; font-weight:400; font-size:20px; padding:30px; margin-top:-30px; border-bottom:1px solid black;">Search LATAM Order

        <?php if ($from!='' && $to!=''){ ?>
          
        
        <br><br>
        <span style="font-size:14px; margin-top:-20px;">Now Searching
        <br>
        [From: <?php echo $from; ?> to <?php echo $to; ?>].
        </span><br>
        <a href="searchJobOrder.php" style="color:black; font-weight:300; font-size:13px;"><button style="position:relative; top:10px; font-size:13 px;">Go Back</button></a>
      <?php }else{} ?>
         </h3>
        <!-- /.box-header -->

        <div class="input-group" style=" position:relative; margin-top:20px; display:inline-block;">
          Date Filter: 
                  <div class="input-group date"  style="">
                  <div class="input-group-addon" style="width:45px;">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <form action="?" method="get">
                  <input type="text"  class="form-control pull-right" data-provide="datepicker" name="to" data-date-format="yyyy-mm-dd" placeholder="To" value="" required style="width:166px; position:relative; left:30px;">

                  <input type="text"  class="form-control pull-right" data-provide="datepicker" name="from" data-date-format="yyyy-mm-dd" placeholder="From" value="<?php echo $fecha_vista; ?>" required style="width:168px; position:relative; left:-1px;">

                </div>
                

              </div>
            <div style="display: inline-block; position:relative; top:25px; left:40px;"><input style="font-size:13px;" type="submit" value="Filter"></div>
            </form>

        <?php if ($message=='noteCreated'){ ?>
                  <br>
                  <div id="mydiv" style="background-color: rgba(0, 127, 70, 1); padding:20px;color:white; position:absolute; left:50%; width:300px; margin-left:-440px; top:15px;">
                    <center>
                      <span style="font-style: oblique; ">Your note has been created.</span>
                    </center>
                  </div>
                <?php }else{} ?>

        <?php if ($message=='StatusUpdated'){ ?>
                  <br>
                  <div id="mydiv" style="background-color: rgba(0, 127, 70, 1); padding:20px;color:white; position:absolute; left:50%; width:300px; margin-left:-440px; top:15px;">
                    <center>
                      <span style="font-style: oblique; ">Status has been updated.</span>
                    </center>
                  </div>
                <?php }else{} ?>


        <script type="text/javascript">
    setTimeout(fade_out, 3000);

function fade_out() {
  $("#mydiv").fadeOut().empty();
}
</script>

            <div class="box-body">
              <form method="POST"> <!-- UPDATE STATUS FORM -->
              <table id="example1" class="table table-bordered table-striped">
                <thead>

<style type="text/css">
  #example1 tr th{background:#B80008; color:white; font-weight:400; text-align:center;}
</style>
                <tr>
                  <th>Date</th>
                  <th>Job#</th>
                  <th style="width:300px;">Client</th>
                  <th style="width:300px;">Supplier</th>
                  <th style="width:100px;">Service</th>
                  <th>Agent</th>
                  <th>Status</th>
                  <th>Tracking</th>
                  <th>WR #</th>
                  <th>Shorcuts</th>
                  <th>Action</th>

                </tr>
                </thead>
                <tbody>

                  

                  <?php 

 if ($level=='Seller') { 

                      if ($to!='' && $from!='') {

                      $consulta = mysqli_query($connect, "SELECT * FROM joborders WHERE agent_email='$email' AND branch='LATAM' AND fecha >= '$from' AND fecha < '$to'    ORDER BY id asc ") or die ("Error al traer los datos"); 
                    }else{

                      $consulta = mysqli_query($connect, "SELECT * FROM joborders WHERE agent_email='$email' AND branch='LATAM' ORDER BY id asc ") or die ("Error al traer los datos"); 

                    }



                    }elseif($level!='Seller'){

                      if ($to!='' && $from!='') {

                    $consulta = mysqli_query($connect, "SELECT * FROM joborders WHERE branch='LATAM' AND fecha >= '$from' AND fecha < '$to'  ORDER BY id asc ") or die ("Error al traer los datos");
                      }else{
                      $consulta = mysqli_query($connect, "SELECT * FROM joborders WHERE branch='LATAM' ORDER BY id asc ") or die ("Error al traer los datos");
                      }


                    }

 

                     

    while ($row = mysqli_fetch_array($consulta)){  


    

              $jobId = $row['id'];



                $customer_company= $row['customer_company'];
                $customer_name= $row['customer_name']; 
                $customer_telf= $row['customer_telf'];
                $supplier_telf= $row['supplier_telf'];


                $customer_address= $row['customer_address']; 
                $supplier_address= $row['supplier_address']; 

                $agent_name= $row['agent_name'];
                $service= $row['service'];
                $trackingJob= $row['tracking'];
                $commodity= $row['commodity'];
                $remark= $row['remark'];
                $customer_if = $row['customer_name'];



                          if ($customer_company!='') { $customer_if .= ', '.$customer_company; }else{}


                         ?>
                <?php $supplier_company= $row['supplier_company'];
                $supplier_name= $row['supplier_name']; 

                $supplier_if = $row['supplier_name'];

                          if ($supplier_company!='') { $supplier_if .= ', '.$supplier_company; }else{}?>

<style type="text/css">
  /* Popup Box */

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 8888; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0,0.7); /* Fallback color */
    background-color: rgba(0,0,0,0.7); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 10vh auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 90%; /* Could be more or less, depending on screen size */
}
@media (min-width: 1366px) {
  .modal-content {
    background-color: #fefefe;
    margin: 10vh auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 30%; /* Could be more or less, depending on screen size */
  }
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

button.button {
  background:none;
  border-top:none;
  border-right:none;
  border-left:none;
  border-bottom:#02274a 1px solid;
  padding:0 0 3px 0;
  font-size:16px;
}

button.button:hover {
  border-bottom:#a99567 1px solid;
  color:#a99567;
}
</style>


      <?php $t = strtotime($row['fecha']);
   date('d/m/y',$t); ?>
                <tr>

                  <td style="width:100px;">
                    <a href="#" style=" text-align:center; position:relative;  top:16px; color:black; font-weight:500;">
                      <p style="font-size:12px; font-weight:500;"><?php echo date('Y-m-d <br>H:i:s',$t); ?></p></a>
                  </td>

                  <td>
                    <a href="#" style=" text-align:center; position:relative;  top:16px; color:black; font-weight:500;">
                      <p style="font-size:12px;"><?php echo $row['id']; ?></p></a>
                  </td>

                  <td><p style=" text-align:center; position:relative; font-size:12px; top:6px; color:black; font-weight:500;"><?php echo $customer_if; ?></p></td>


                  <td style="width:40px;"><span style=" margin-left:15px; text-align:justify; position:relative; font-size:12px; top:6px; color:black; font-weight:500;"><?php echo $supplier_if; ?></span></td>

                  
                  <td>

                    

                    <p style=" text-align:center; font-size:10px; position:relative; top:16px; color:black; font-weight:500;">
                      <i style="font-size:25px;" class="icon fa <?php if ($row['service']=='Air door to door' OR 'Air Service'){ ?>fa-plane<?php } ?> <?php if ($row['service']=='Ocean door to door' OR 'Ocean Service'){ ?>fa-ship<?php } ?> <?php if ($row['service']=='Pending'){ ?>fa-hourglass-2<?php } ?> "></i><br>
                      <?php echo $row['service']; ?>
                    </p>

                  </td>

                  <td>

                    <p style="text-align:center; font-size:10px; position:relative; top:16px; color:black; font-weight:500;">
                      <i style="font-size:25px;" class="icon fa fa-user"></i><br>
                      <?php echo $row['agent_name']; ?>
                    </p>

                  </td>

                    <td>

                      <div class="callout <?php if ($row['status']=='READY TO CONTACT'){ ?> callout-info <?php }elseif($row['status']=='PENDING' OR $row['status']=='CANCELED' OR $row['status']=='CHECK NOTES'){ ?> callout-danger <?php }elseif($row['status']=='IN PROCESS'){ ?> callout-warning <?php }elseif($row['status']=='SHIPPED'){ ?> callout-warning <?php }elseif($row['status']=='IN WAREHOUSE'){ ?> callout-success <?php }else{} ?> " style="width:90px; padding:3px; position:relative; top:15px; max-height:35px; <?php if($row['status']=='SHIPPED'){ ?>background-color:#1E93A0 !important; border-color:#14626B !important;<?php } ?> <?php if($row['status']=='CHECK NOTES'){ ?>background-color:#A71ED9 !important; border-color:#A71ED9 !important;<?php } ?> <?php if($row['status']=='CARGO SENT'){ ?>background-color:#002D88 !important; border-color:#00153F !important; color:white;<?php } ?>  <?php if($row['status']=='IN PROCESS'){ ?> max-height:22px; <?php } ?>  <?php if($row['status']=='SHIPPED'){ ?> max-height:22px; <?php } ?> <?php if($row['status']=='PENDING' OR $row['status']=='CANCELED'){ ?> max-height:22px; <?php } ?>  <?php if($row['status']=='CARGO SENT'){ ?>  <?php } ?>">

                <h5 style="position:relative; top:-4px; margin-top:5px; font-size:12px;"><i class="icon fa <?php if ($row['status']=='READY TO CONTACT'){ ?> fa-info <?php }elseif($row['status']=='PENDING' OR $row['status'] OR $row['CHECK NOTES']=='CANCELED'){ ?> fa-warning <?php }elseif($row['status']=='IN PROCESS'){ ?> fa-info <?php }elseif($row['status']=='SHIPPED'){ ?> fa-info  <?php }elseif($row['status']=='IN WAREHOUSE'){ ?> fa-check <?php }elseif($row['status']=='CARGO SENT'){ ?> fa-check <?php }else{} ?>"></i> -<?php echo $row['status']; ?></h5>
              </div>

                   </td>


                   <td>

                    <span style="font-size:10px;">

                      <?php if ($trackingJob!=''){ ?>
                        Tracking J.O:
                      <?php }else{} ?> <?php echo $trackingJob; ?><br>
                    
                      <?php $consultatrackings = mysqli_query($connect, "SELECT * FROM trackings WHERE jobOrderId='$jobId' ORDER BY id DESC ") or die ("Error al traer los datos");

    while ($rowtrackings = mysqli_fetch_array($consultatrackings)){  

              $tracking= $rowtrackings['tracking'];
              $carrier= $rowtrackings['carrier'];  

              echo $carrier.': '.$tracking.'.<br>';

            } ?>

                    </span>
                    <center>
                     <a href="viewTrackings.php?id=<?php echo $jobId; ?>" name="submitViewWR" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=900,height=550,toolbar=1,resizable=0'); return false;">

<button style="font-size:11px; background:#E2E2E2; width:60px; padding:10px; position:relative; left:8px; color:black; border-radius:3px; border:none; height:18px; position:relative; top:13px;"><span style="position:relative; top:-8px; left:-6px;">+Tracking</span></button>
</a></center>
<br><br>
                   </td>

                   <td>

      <?php 

$consultaWR = mysqli_query($connect, "SELECT * FROM receipt WHERE jobOrderId='$jobId' order by id desc limit 1 ")
    or die ("Error al traer los Agent");


     while ($rowWR = mysqli_fetch_assoc($consultaWR)){

        $WHReceipt=$rowWR['wr'];

 ?>
<div style="position:relative; margin-top:-30px;">
                     <a href="https://latim.cargotrack.net/appl2.0/warehouse/detail.asp?id=<?php echo $WHReceipt; ?>&redir=../accounts/warehouse.asp?id=&redir_id=738" name="submitViewWR" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=900,height=400,toolbar=1,resizable=0'); return false;">
<i class="fa fa-barcode" style="color:black; font-size:24px; position:relative; top:27px; left:25px;"></i>

<button style="font-size:12px; background:none; width:80px; color:black; border:none; height:25px; position:relative; top:17px;">WR #<?php echo $WHReceipt; ?></button></a>
</div>
<?php } ?>

<a href="addWR.php?id=<?php echo $jobId; ?>" name="submitViewWR" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=900,height=400,toolbar=1,resizable=0'); return false;">

<button style="font-size:11px; background:#E2E2E2; width:60px; position:relative; left:8px; color:black; border-radius:3px; border:none; height:18px; position:relative; top:13px;">ADD WR</button></a>
                   </td>

                   <td>

                    <?php $editJobOrder='editJobOrder.php'; ?>

                    <a href="<?php echo $editJobOrder; ?>?id=<?php echo $jobId; ?>" name="submitEditJobOrder" onclick="window.open(this.href, 'mywin',
'left=150,top=20,width=1250,height=750,toolbar=1,resizable=0'); return false;"><button style="margin-left:10px; margin-top:2px; background-color:rgb(0,0,0,0); color:#B80008; font-size:16px; border:none;"><i class="fa fa-edit"></i></button></a>



                    <?php 


$result = $connect->query("SELECT COUNT(*) AS total FROM notes WHERE jobOrderId='$jobId' ")->fetch_array(); ?> 
          
          
            
                    <?php $viewNotes='viewNotes.php'; ?>

                    <a href="<?php echo $viewNotes; ?>?id=<?php echo $jobId; ?>" name="submitViewNotes" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=900,height=700,toolbar=1,resizable=0'); return false;" style="cursor:pointer; background-color:rgb(0,0,0,0); position:relative; left:5px; color:#B80008; font-size:16px; border:none;">

                      <i class="fa fa-sticky-note-o"></i>
                      <?php if ($result[0]!='0'){ ?>
                      <span style="position:relative; left:-10px; top:-10px; font-size:8px;" class="label label-success">
                      
                      <?php echo $result[0]; ?>
                       </span>

                       <?php } ?>

                    </a>

                    <?php $webPDF='downloadPDF.php'; if ($row['agent_name']=='Saspy Express'){ $webPDF='downloadPDFsaspy.php'; } ?>

                    <a href="<?php echo $webPDF; ?>?id=<?php echo $jobId; ?>" name="submitPDF" onclick="window.open(this.href, 'mywin',
'left=20,top=20,width=900,height=700,toolbar=1,resizable=0'); return false;">

                      <button style="margin-left:10px; margin-top:2px; background-color:rgb(0,0,0,0); color:#B80008; font-size:16px; border:none;"><i class="fa fa-file-pdf-o"></i></button>
                    </a>


                    </td>


                  <td>
                    <input type="checkbox" name="jobCheck[]" value="<?php echo $row['id']; ?>">
                  </td>
                </tr>
<?php }  ?>

                </tbody>

              </table>


            <div style="position:absolute; top:15px; right:130px;" class="input-group">
              <p style="font-weight:400; position:relative; left:85px; font-size:13px; color:black;">Change Status</p>
                  <select name="statusUpdate" class="form-control select2" style="width:150px; font-size:13px;">
                      <option value="PENDING">Pending</option>
                      <option value="READY TO CONTACT">Ready to contact</option>
                      <option value="CHECK NOTES">Check Notes</option>
                      <option value="IN PROCESS">In process</option>
                      <option value="SHIPPED">Shipped</option>
                      <option value="IN WAREHOUSE">In Warehouse</option>
                      <option value="CANCELED">Canceled</option>
                  </select>
            </div>

            <input style="position:absolute; top:50px; right:50px; font-size:13px;" type="submit" name="submitUpdate" value="Update">
</form>

            </div>
            <!-- /.box-body -->
      </div>
      <!-- / Search -->


          
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


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


   <?php
    if(isset($_POST["submitNote"]))
          {
              $jobOrderId= $_POST['jobOrderId'];
              $note= $_POST['note'];
              $noteBy= $_POST['noteBy'];
              $agent_name= $_POST['agent_name'];

              $dt = new DateTime($fecha);

$fecha = $dt->format('Y-m-d H:i:s');

    $queryModel = mysqli_query($connect, "INSERT INTO notes(agent_name, jobOrderId, note, fecha) 
                VALUES ('$noteBy', '$jobOrderId', '$note', '$fecha')");


   

    echo "<meta http-equiv=\"refresh\" content=\"0;URL= searchJobOrder.php?message=noteCreated\">";

         }
?>


<?php
    if(isset($_POST["submitStatus"]))
          {
              $jobOrderId= $_POST['jobOrderId'];
              $note= $_POST['note'];
              $noteBy= $_POST['noteBy'];
              $agent_name= $_POST['agent_name'];

              $dt = new DateTime($fecha);

$fecha = $dt->format('Y-m-d H:i:s');

    $queryModel = mysqli_query($connect, "INSERT INTO notes(agent_name, jobOrderId, note, fecha) 
                VALUES ('$noteBy', '$jobOrderId', '$note', '$fecha')");


   

    echo "<meta http-equiv=\"refresh\" content=\"0;URL= searchJobOrder.php?message=noteCreated\">";

         }
?>



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
