<?php 
error_reporting(0);
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

        $noteBy=$rowAgent['name'];
     }  

    $message= $_GET['message'];

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

            echo "<meta http-equiv=\"refresh\" content=\"0;URL= searchJobOrder.php?message=StatusUpdated\">";


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


    <title>Latim Cargo & Trading | Search Quotations</title>
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
            left: 20px;
            top: 24px;
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
            font-size: 20px;
            display: block;
            width: 5px;
            font-size: 600;
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
        
        .content {
            overflow-x: scroll;
        }
    </style>

    <style>
        .containerFreight<?php echo $quotationID;
        ?>input[type=text] {
            padding: 5px 0px;
            margin: 0px 0px 0px 0px;
            height: 30px;
        }
        
        .containerOrigin<?php echo $quotationID;
        ?>input[type=text] {
            padding: 5px 0px;
            margin: 0px 0px 0px 0px;
            height: 30px;
        }
        
        .containerDestination<?php echo $quotationID;
        ?>input[type=text] {
            padding: 5px 0px;
            margin: 0px 0px 0px 0px;
            height: 30px;
        }
        
        .containerBoxes<?php echo $quotationID;
        ?>input[type=text] {
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
        
        .add_form_fieldOrigin<?php echo $quotationID;
        ?> {
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
        
        .add_form_fieldDestination<?php echo $quotationID;
        ?> {
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
        
        .add_form_fieldBoxes<?php echo $quotationID;
        ?> {
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
        a {
            color: #e0e0e0;
        }
        
        .nav>li>a:hover,
        .nav>li>a:active,
        .nav>li>a:focus {
            color: #444;
            background: #910007;
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
        
        .nav .open>a,
        .nav .open>a:focus,
        .nav .open>a:hover {
            background-color: #910007;
        }
        
        .pagination>.active>a,
        .pagination>.active>a:focus,
        .pagination>.active>a:hover,
        .pagination>.active>span,
        .pagination>.active>span:focus,
        .pagination>.active>span:hover {
            background-color: #B80008;
            border-color: #B80008;
        }
        
        .pagination>li>a:hover {
            color: #B80008;
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
</head>

<body class="hold-transition sidebar-mini">


    <div class="wrapper">

        <header class="main-header">

            <!-- Logo -->
            <a href="index.php" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="./img/logo.png" style="width:55px; padding:5px;"></span>
                <!-- logo for regular Commodity and mobile devices -->
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
                                <li class="user-header">
                                    <img src="<?php echo $picture; ?>" class="img-circle" alt="User Image">

                                    <p style="color:black;">
                                        <?php echo $agent_name; ?> |
                                        <?php echo $level; ?>
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
                        <p style="color:#e0e0e0;">
                            <?php echo $agent_name; ?>
                        </p>
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
                            <input name="JO" value="<?php echo $JO; ?>" placeholder="J.O# / CLIENT or SUPPLIER NAME" style="width:100%; font-size:12px; text-align:center; border:1px solid gray; padding:15px;">
                            <br><br>
                        </form>
                    </li>

                    <center>
                        <div style="width:100%; height:20px; position:relative; top:0px; background:#CECAC6; color:#630000; font-weight:600; font-size:14px;">
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
                            <li><a href="createQuotation.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
                            <li><a class="active" href="searchQuotation.php" style="font-size:11px;"><i
                    class="fa fa-circle-o"></i>Search</a></li>
                        </ul>
                    </li>


                    <center>
                        <div style="width:100%; height:20px; position:relative; top:0px; background:#CECAC6; color:#630000; font-weight:600; font-size:14px;">
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
                        <div style="width:100%; height:20px; position:relative; top:0px; background:#CECAC6; color:#630000; font-weight:600; font-size:14px;">
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
                    <small>Search</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Search Quotations</li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Search -->
                <div class="searchPage shadow2" style="background:white; width:90%; margin-left:-45%;">

                    <h3 style="text-align:center; color:black; font-weight:400; font-size:20px; padding:30px; margin-top:-30px; border-bottom:1px solid black;">
                        Search Quotations

                        <?php if ($from!='' && $to!=''){ ?>


                        <br><br>
                        <span style="font-size:14px; margin-top:-20px;">Now Searching
              <br>
              [From: <?php echo $from; ?> to <?php echo $to; ?>].
            </span><br>
                        <a href="searchJobOrder.php" style="color:black; font-weight:300; font-size:13px;"><button
                style="position:relative; top:10px; font-size:13 px;">Go Back</button></a>
                        <?php }else{} ?>
                    </h3>
                    <!-- /.box-header -->

                    <div class="input-group" style=" position:relative; margin-top:20px; display:inline-block;">
                        Date Filter:
                        <div class="input-group date" style="">
                            <div class="input-group-addon" style="width:45px;">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <form action="?" method="get">
                                <input type="text" class="form-control pull-right" data-provide="datepicker" name="to" data-date-format="dd-mm-yyyy" placeholder="To" value="" style="width:166px; position:relative; left:30px;">

                                <input type="text" class="form-control pull-right" data-provide="datepicker" name="from" data-date-format="dd-mm-yyyy" placeholder="From" value="<?php echo $fecha_vista; ?>" required style="width:168px; position:relative; left:-1px;">

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
                    <?php if ($message=='QuotationEdited'){ ?>
                    <br>
                    <div id="mydiv" style="background-color: rgba(0, 127, 70, 1); padding:20px;color:white; position:absolute; left:50%; width:300px; margin-left:-440px; top:15px;">
                        <center>
                            <span style="font-style: oblique; ">Quotation has been edited.</span>
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
                        <form method="POST">
                            <!-- UPDATE STATUS FORM -->
                            <table id="example1" style="width:70%; position:relative; left:50%; margin-left:-45%;" class="table table-bordered table-striped">
                                <thead>

                                    <style type="text/css">
                                        #example1 tr th {
                                            background: #B80008;
                                            color: white;
                                            font-weight: 400;
                                            text-align: center;
                                        }
                                    </style>
                                    <tr>
                                        <th>Date</th>
                                        <th style="width:50px;">Quotation#</th>
                                        <th style="width:240px;">Client</th>
                                        <th style="width:300px;">Origin</th>
                                        <th style="width:100px;">Destination</th>
                                        <th>Service</th>
                                        <th>Agent</th>
                                        <th>Shorcuts</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>



                                    <?php 


                  if ($level=='Seller') { 

                    if ($to!='' && $from!='') {

                    $consulta = mysqli_query($connect, "SELECT * FROM quotations WHERE agent_name='$agent_name' AND fecha >= '$from' AND fecha < '$to'    ORDER BY id asc ") or die ("Error al traer los datos"); 
                  }else{

                    $consulta = mysqli_query($connect, "SELECT * FROM quotations WHERE agent_name='$agent_name' ORDER BY id asc ") or die ("Error al traer los datos"); 

                  }



                  }elseif($level!='Seller'){

                    if ($to!='' && $from!='') {

                  $consulta = mysqli_query($connect, "SELECT * FROM quotations WHERE fecha >= '$from' AND fecha < '$to'  ORDER BY id asc ") or die ("Error al traer los datos");
                    }else{
                    $consulta = mysqli_query($connect, "SELECT * FROM quotations ORDER BY id asc ") or die ("Error al traer los datos");
                    }


                  }

                  

    while ($row = mysqli_fetch_array($consulta)){  

                $jobId = $row['id'];
                $customer_company= $row['customer_company'];
                $client_name= $row['client_name']; 
                $customer_telf= $row['customer_telf'];
                $supplier_telf= $row['supplier_telf'];


                $customer_address= $row['customer_address']; 
                $supplier_address= $row['supplier_address'];

                $initial_date= $row['initial_date']; 
                $expiration_date= $row['expiration_date']; 

                $dt = new DateTime($initial_date);

                $initial_date = $dt->format('Y-m-d');

                $dt2 = new DateTime($expiration_date);

                $expiration_date = $dt2->format('Y-m-d');


                date_default_timezone_set('America/La_Paz');

                $origin= $row['origin']; 
                $fecha= $row['fecha']; 
                $destination= $row['destination']; 

                $agent_name= $row['agent_name'];
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

                          if ($supplier_company!='') { $supplier_if .= ', '.$supplier_company; }else{}?>

                                    <style type="text/css">
                                        /* Popup Box */
                                        /* The Modal (background) */
                                        
                                        .modal {
                                            display: none;
                                            /* Hidden by default */
                                            position: fixed;
                                            /* Stay in place */
                                            z-index: 8888;
                                            /* Sit on top */
                                            left: 0;
                                            top: 0;
                                            width: 100%;
                                            /* Full width */
                                            height: 100%;
                                            /* Full height */
                                            overflow: auto;
                                            /* Enable scroll if needed */
                                            background-color: rgb(0, 0, 0, 0.7);
                                            /* Fallback color */
                                            background-color: rgba(0, 0, 0, 0.7);
                                            /* Black w/ opacity */
                                        }
                                        /* Modal Content/Box */
                                        
                                        .modal-content {
                                            background-color: #fefefe;
                                            margin: 10vh auto;
                                            /* 15% from the top and centered */
                                            padding: 20px;
                                            border: 1px solid #888;
                                            width: 90%;
                                            /* Could be more or less, depending on screen size */
                                        }
                                        
                                        @media (min-width: 1366px) {
                                            .modal-content {
                                                background-color: #fefefe;
                                                margin: 10vh auto;
                                                /* 15% from the top and centered */
                                                padding: 20px;
                                                border: 1px solid #888;
                                                width: 30%;
                                                /* Could be more or less, depending on screen size */
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
                                            background: none;
                                            border-top: none;
                                            border-right: none;
                                            border-left: none;
                                            border-bottom: #02274a 1px solid;
                                            padding: 0 0 3px 0;
                                            font-size: 16px;
                                        }
                                        
                                        button.button:hover {
                                            border-bottom: #a99567 1px solid;
                                            color: #a99567;
                                        }
                                    </style>



                                    <script>
                                        function ConfirmDelete() {
                                            return confirm("Are you sure you want to delete?");
                                        }
                                    </script>

                                    <!-- Modal Edit-->
                                    <div class="modal fade" id="modalEdit<?php echo $row['id'];?>" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content -->
                                            <div class="modal-content" style="width:1200px; position:relative; left:50%; margin-left:-600px;">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title" style="font-size:18px;"><span style="font-weight:600;">Edit</span> Quotation #
                                                        <?php echo $row['id'];?> </h4>

                                                    <form method="post">

                                                        <input style="display:none;" type="text" name="quotationID" value="<?php echo $row['id'];?>">

                                                        <input Onclick="return ConfirmDelete()" type="submit" value="Delete" name="submitDeleteJobOrder" class="deleteAccountBtn" style="position:absolute; left:190px; top:15px;">
                                                    </form>
                                                    <?php
  
                                                          $quotationID=$row['id'];

                                                            if(isset($_POST["submitDeleteJobOrder"]))
                                                                  {
                                                                      $quotationID= $_POST['quotationID'];
                                                          
                                                          $modifica= "DELETE FROM quotations WHERE id='$quotationID'";

                                                          $resultado = mysqli_query($connect, $modifica)
                                                          or die ("Error al insertar los registros");

                                                          mysqli_close($connect);
                                                          echo "<meta http-equiv=\"refresh\" content=\"0;URL= searchQuotation.php?message=AccountDeleted\">"; 

                                                                }
                                                        ?>

                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST">

                                                        <input style="display:none;" type="text" name="quotationID" value="<?php echo $quotationID; ?>">
                                                        <div class="form_1" style="width:1000px; margin-left:-500px; background:white; min-height:700px; margin-top:-10px;">
                                                            <br><br>

                                                            <div style="width:45%; padding:20px; margin-left:10px; margin-top:-40px; top:108px; position:absolute; display:inline-block; ">






                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i style="width:20px;"
                                                                          class="fa fa-circle"></i></span>
                                                                                                        <select data-placeholder="Select Agent" <?php if ($level!='Seller' ){ ?>
                                                                        name="agent_name" <?php } ?> class="form-control select2"
                                                                        <?php if ($level=='Seller'){ ?> disabled <?php } ?> style="width:100%;">

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

                                                                <?php if ($level=='Seller'){ ?>
                                                                <input style="display:none;" name="agent_name" value="<?php echo $agent_name; ?>">
                                                                <?php } ?>

                                                                <input style="display:none;" name="agent_email" value="<?php echo $email; ?>">



                                                                <div class="input-group" style="margin-top:20px;">
                                                                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-user"></i></span>
                                                                    <select data-placeholder="Select Client" name="client_name" class="form-control select2" style="width:364px; ">

                                                                      <option selected="selected" value="<?php echo $client_name; ?>">
                                                                        <?php echo $client_name; ?></option>

                                                                    </select>
                                                                </div>



                                                                <div class="input-group" style=" position:relative; margin-top:20px;">
                                                                    <div class="input-group date">
                                                                        <div class="input-group-addon" style="width:45px;">
                                                                            <i class="fa fa-calendar"></i>
                                                                        </div>

                                                                        <input type="text" class="form-control pull-right" data-provide="datepicker" name="expiration_date" data-date-format="yyyy-mm-dd" placeholder="Expiration Date" value="<?php echo $expiration_date; ?>" style="width:166px; position:relative; left:30px;">

                                                                        <input type="text" class="form-control pull-right" data-provide="datepicker" name="initial_date" data-date-format="yyyy-mm-dd" placeholder="Initial Date" value="<?php echo $initial_date; ?>" style="width:168px; position:relative; left:-1px;">
                                                                    </div>
                                                                </div>


                                                                <div class="input-group" style="margin-top:20px;">


                                                                    <span class="input-group-addon" style="display:inline-block; height:34px; width:45px; z-index:999;"><i
                                                                          style="width:20px;" class="fa fa-map-marker"></i></span>

                                                                                                        <div style=" display:inline-block; position:relative; margin-left:0px;">

                                                                                                            <select id="origin<?php echo $quotationID; ?>" class="js-example-basic-single" name="origin" data-placeholder="Origin" type="text" style="width:165px; position:relative; top:2.5px; height:33.5px;">
                                                                          <option value="<?php echo $origin; ?>"><?php echo $origin; ?></option>

                                                                        </select>

                                                                    </div>



                                                                    <div style="position: relative; left:30px; display:inline-block;">

                                                                        <select id="destination<?php echo $quotationID; ?>" class="js-example-basic-single" name="destination" data-placeholder="Destination" type="text" style="width:165px;">

                                                                          <option value="<?php echo $destination; ?>"><?php echo $destination; ?></option>

                                                                          <?php $consulta222 = mysqli_query($connect, "SELECT DISTINCT destination FROM quotations WHERE id='$quotationID'  ") or die ("Error al traer los datos");

                                                                              while ($row2 = mysqli_fetch_array($consulta222)){ 
                                                                              $destination=$row2['destination'];
                                                                              ?>

                                                                          <option value="<?php echo $destination; ?>"><?php echo $destination; ?></option>
                                                                          <?php } ?>

                                                                        </select>

                                                                    </div>

                                                                </div>

                                                                <div class="input-group" style="margin-top:20px;">
                                                                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-ship"></i></span>
                                                                    <select data-placeholder="Select Service" name="service" class="form-control select2" style="width:100%;">
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





                                                                <div class="input-group" style="margin-top:20px;">
                                                                    <span class="input-group-addon"><i style="width:20px;" class="fa fa-cube"></i></span>
                                                                    <select id="Commodity" class="js-example-basic-single" name="commodity" data-placeholder="Commodity" type="text" style="width:100%; height:30px;">
                                                                      <option value="<?php echo $commodity; ?>"><?php echo $commodity; ?></option>
                                                                    </select>


                                                                </div>


                                                            </div>

                                                            <div style="width:45%; padding:20px; margin-top:20px; left:500px; top:15px; position:relative;  display:inline-block; ">

                                                                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
                                                                <script>
                                                                    $(document).ready(function() {
                                                                        var max_fields = 10;
                                                                        var wrapper = $(".containerFreight<?php echo $quotationID; ?>");
                                                                        var add_button = $(".add_form_fieldFreight<?php echo $quotationID; ?>");

                                                                        var x = 1;
                                                                        $(add_button).click(function(e) {
                                                                            e.preventDefault();
                                                                            if (x < max_fields) {
                                                                                x++;
                                                                                $(wrapper).append('<div class="input-group" style="margin-top:5px;"><input name="freightChargeX[]" class="form-control"  type="number" style="width:100px;"> <input name="freightDescX[]" type="text" class="form-control" style="margin-top:15px; padding:5px; width:220px; position:relative; top:-15px; left:10px;"><a style="margin-top:5px;" href="#" class="delete"><span style="font-size:16px; font-weight:bold; ">-</span></a></div>'); //add input box
                                                                            } else {
                                                                                alert('You Reached the limits')
                                                                            }
                                                                        });

                                                                        $(wrapper).on("click", ".delete", function(e) {
                                                                            e.preventDefault();
                                                                            $(this).parent('div').remove();
                                                                            x--;
                                                                        })
                                                                    });
                                                                </script>

                                                                <script>
                                                                    $(document).ready(function() {
                                                                        var max_fields = 10;
                                                                        var wrapper = $(".containerOrigin<?php echo $quotationID; ?>");
                                                                        var add_button = $(".add_form_fieldOrigin<?php echo $quotationID; ?>");

                                                                        var x = 1;
                                                                        $(add_button).click(function(e) {
                                                                            e.preventDefault();
                                                                            if (x < max_fields) {
                                                                                x++;
                                                                                $(wrapper).append('<div class="input-group" style="margin-top:5px;"><input class="form-control" type="number" name="originChargeX[]" style="width:100px;"> <input type="text" class="form-control" style="margin-top:15px; padding:5px; width:220px; position:relative; top:-15px; left:10px;" name="originDescX[]"><a style="margin-top:5px;" href="#" class="delete"><span style="font-size:16px; font-weight:bold; ">-</span></a></div>'); //add input box
                                                                            } else {
                                                                                alert('You Reached the limits')
                                                                            }
                                                                        });

                                                                        $(wrapper).on("click", ".delete", function(e) {
                                                                            e.preventDefault();
                                                                            $(this).parent('div').remove();
                                                                            x--;
                                                                        })
                                                                    });
                                                                </script>

                                                                <script>
                                                                    $(document).ready(function() {
                                                                        var max_fields = 10;
                                                                        var wrapper = $(".containerDestination<?php echo $quotationID; ?>");
                                                                        var add_button = $(".add_form_fieldDestination<?php echo $quotationID; ?>");

                                                                        var x = 1;
                                                                        $(add_button).click(function(e) {
                                                                            e.preventDefault();
                                                                            if (x < max_fields) {
                                                                                x++;
                                                                                $(wrapper).append('<div class="input-group" style="margin-top:5px;"><input class="form-control" name="destinationChargeX[]" type="number" style="width:100px;"> <input type="text" class="form-control" style="margin-top:15px; padding:5px; width:220px; position:relative; top:-15px; left:10px;" name="destinationDescX[]"><a style="margin-top:5px;" href="#" class="delete"><span style="font-size:16px; font-weight:bold; ">-</span></a></div>'); //add input box
                                                                            } else {
                                                                                alert('You Reached the limits')
                                                                            }
                                                                        });

                                                                        $(wrapper).on("click", ".delete", function(e) {
                                                                            e.preventDefault();
                                                                            $(this).parent('div').remove();
                                                                            x--;
                                                                        })
                                                                    });
                                                                </script>

                                                                <script>
                                                                    $(document).ready(function() {
                                                                        var max_fields = 10;
                                                                        var wrapper = $(".prueba");
                                                                        var add_button = $(".add_form_fieldBoxes<?php echo $quotationID; ?>");

                                                                        var x = 1;
                                                                        $(add_button).click(function(e) {
                                                                            e.preventDefault();
                                                                            if (x < max_fields) {
                                                                                x++;
                                                                                $(wrapper).append('<div class="input-group"><input class="form-control" type="number" placeholder="Qty" name="byBoxes_qtyX[]" style="border-left:1px solid black; width:70px;  height:30px; position:relative; top:1px;"><input class="form-control" type="text" placeholder="Width" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:55px; position:relative; top:-14px; left:10px;" name="byBoxes_widthX[]"><input class="form-control" type="text" placeholder="Lenght" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:25px;" name="byBoxes_lenghtX[]"><input class="form-control" type="text" placeholder="Height" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:40px;" name="byBoxes_heightX[]"><input class="form-control" type="text" placeholder="Weight" style="border-left:1px solid black; background:#EFEFEF; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:50px;" name="byBoxes_weightX[]"><a style="margin-top:5px; position:absolute; left:357px; top:-2px; width:25px; height:25px;" href="#" class="delete">&nbsp;<span style="font-size:16px; font-weight:bold; position:relative; left:-7px; top:-4px;">-</span></a></div>'); //add input box
                                                                            } else {
                                                                                alert('You Reached the limits')
                                                                            }
                                                                        });

                                                                        $(wrapper).on("click", ".delete", function(e) {
                                                                            e.preventDefault();
                                                                            $(this).parent('div').remove();
                                                                            x--;
                                                                        })
                                                                    });
                                                                </script>




                                                                <div class="input-group containerFreight<?php echo $quotationID; ?>" style="margin-top:-40px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                                                                    <p style="margin-top:-10px;">Freight Charges</p>
                                                                    <div style="margin-top:-5px;">


                                                                        <?php 
                                                                          $consultaQuotations = mysqli_query($connect, "SELECT * FROM quotationcharges WHERE quotationID='$quotationID' AND type='Freight Charges' ")
                                                                              or die ("Error al traer los Quotations");
                                                                            while ($rowQuotations = mysqli_fetch_array($consultaQuotations)){

                                                                              $description = $rowQuotations['description'];
                                                                              $charge = $rowQuotations['charge'];
                                                                          ?>
                                                                        <?php if ($charge!=''){ ?>

                                                                        <input class="form-control" type="number" value="<?php echo $charge; ?>" name="freightChargeX[]" style="width:100px; height:30px; position:relative; top:1px;">

                                                                        <input class="form-control" type="text" value="<?php echo $description; ?>" style="margin-top:15px; padding:5px; width:220px; position:relative; top:-14px; left:10px;" name="freightDescX[]">
                                                                        <?php } } ?>


                                                                        <?php if ($charge!=''){ ?>
                                                                        <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                                        <input class="form-control" type="number" name="freightChargeX[]" style="width:100px; height:30px; position:relative; top:1px;">

                                                                        <input class="form-control" type="text" style="margin-top:15px; padding:5px; width:220px; position:relative; top:-14px; left:10px;" name="freightDescX[]">

                                                                        <?php } } ?>



                                                                    </div>
                                                                </div>



                                                                <div class="input-group containerOrigin<?php echo $quotationID; ?>" style="margin-top:18px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                                                                    <p style="margin-top:-10px;">Origin Charges</p>
                                                                    <div style="margin-top:-5px;">

                                                                        <?php 
                                                                            $consultaQuotations = mysqli_query($connect, "SELECT * FROM quotationcharges WHERE quotationID='$quotationID' AND type='Origin Charges' ")
                                                                                or die ("Error al traer los Quotations");
                                                                              while ($rowQuotations = mysqli_fetch_array($consultaQuotations)){

                                                                                $description = $rowQuotations['description'];
                                                                                $charge = $rowQuotations['charge'];
                                                                            ?>
                                                                        <?php if ($charge!=''){ ?>

                                                                        <input class="form-control" type="number" value="<?php echo $charge; ?>" name="originChargeX[]" style="width:100px; height:30px; position:relative; top:1px;">

                                                                        <input class="form-control" type="text" value="<?php echo $description; ?>" style="margin-top:15px; padding:5px; width:220px; position:relative; top:-14px; left:10px;" name="originDescX[]">
                                                                        <?php } } ?>


                                                                        <?php if ($charge!=''){ ?>


                                                                        <?php for ($i = 1; $i <= 3; $i++) { ?>

                                                                        <input class="form-control" type="number" name="originChargeX[]" style="width:100px; height:30px; position:relative; top:1px;">

                                                                        <input class="form-control" type="text" style="margin-top:15px; padding:5px; width:220px; position:relative; top:-14px; left:10px;" name="originDescX[]">

                                                                        <?php }}  ?>
                                                                    </div>
                                                                </div>




                                                                <div class="input-group containerDestination<?php echo $quotationID; ?>" style="margin-top:18px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                                                                    <p style="margin-top:-10px;">Destination Charges</p>
                                                                    <div style="margin-top:-5px;">

                                                                        <?php 
                                                                        $consultaQuotations = mysqli_query($connect, "SELECT * FROM quotationcharges WHERE quotationID='$quotationID' AND type='Destination Charges' ")
                                                                            or die ("Error al traer los Quotations");
                                                                          while ($rowQuotations = mysqli_fetch_array($consultaQuotations)){

                                                                            $description = $rowQuotations['description'];
                                                                            $charge = $rowQuotations['charge'];
                                                                        ?>
                                                                        <?php if ($charge!=''){ ?>

                                                                        <input class="form-control" type="number" value="<?php echo $charge; ?>" name="destinationChargeX[]" style="width:100px; height:30px; position:relative; top:1px;">

                                                                        <input class="form-control" type="text" value="<?php echo $description; ?>" style="margin-top:15px; padding:5px; width:220px; position:relative; top:-14px; left:10px;" name="destinationDescX[]">
                                                                        <?php } } ?>


                                                                        <?php if ($charge!=''){ ?>

                                                                        <?php for ($i = 1; $i <= 3; $i++) { ?>

                                                                        <input class="form-control" type="number" name="destinationChargeX[]" style="width:100px; height:30px; position:relative; top:1px;">

                                                                        <input class="form-control" type="text" style="margin-top:15px; padding:5px; width:220px; position:relative; top:-14px; left:10px;" name="destinationDescX[]">

                                                                        <?php } } ?>

                                                                    </div>
                                                                </div>


                                                            </div>

                                                            <?php if ($service=='Ocean door to door' OR $service=='Air door to door'){ ?>


                                                            <div class="input-group" style="position:absolute; top:370px; margin-top:40px; left:30px; border:1px solid #D2D6DE; padding:15px; width:410px;">


                                                                <div style="margin-top:-5px;">

                                                                    <div style="width:200px; margin-bottom:7px; margin-left:27px;"><span style="font-size:13px; font-weight:bolder;"><span
                                                                                                        style="font-size:18px; position:absolute; top:13px; left:18px;"
                                                                                                        class="fa fa-cube"></span>By Weight and Volume</span>
                                                                                                                                    </div>

                                                                                                                                    <?php 
                                                                      $consultaQuotations2 = mysqli_query($connect, "SELECT * FROM quotationcontents WHERE quotationID='$quotationID' ")
                                                                    or die ("Error al traer los Quotations");

                                                                          while ($rowQuotations2 = mysqli_fetch_array($consultaQuotations2)){

                                                                          $byBoxes_qty = $rowQuotations2['byBoxes_qty'];
                                                                          $byVolume_qty = $rowQuotations2['byVolume_qty'];
                                                                          $byVolume_volume = $rowQuotations2['byVolume_volume'];
                                                                          $byVolume_weight = $rowQuotations2['byVolume_weight'];
                                                                        }

                                                                      ?>

                                                                    <input class="form-control" type="number" placeholder="Qty" value="<?php echo $byVolume_qty; ?>" name="byVolume_qty" style="border-left:1px solid black; width:100px; height:30px; position:relative; top:3px;">
                                                                    <span style="font-size:12px; position:absolute; top:70px; left:30px;">Cartons
                                    Qty</span>

                                                                    <input class="form-control" type="number" placeholder="Volume" value="<?php echo $byVolume_volume; ?>" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:135px; position:relative; top:-14px; left:10px;" name="byVolume_volume">
                                                                    <span style="font-size:12px; position:absolute; top:70px; left:150px;">Volume
                                    (CBM)</span>

                                                                    <input class="form-control" type="number" placeholder="Weight" value="<?php echo $byVolume_weight; ?>" style="border-left:1px solid black; background:#EFEFEF; display:inline-block; margin-top:15px; padding:5px; width:120px; position:relative; top:-14px; left:20px;"
                                                                        name="byVolume_weight">
                                                                    <span style="font-size:12px; position:absolute; top:70px; left:290px;">Weight
                                    (KG)</span>

                                                                </div>


                                                            </div>



                                                            <br><br>


                                                            <div class="input-group containerBoxes<?php echo $quotationID; ?>" style="position:absolute; top:530px; left:30px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                                                                <div style="margin-top:5px;">


                                                                    <span style="font-size:13px; font-weight:bolder; position:relative; top:-3px; margin-left:30px; "><span
                                                                            style="margin-left:0px; font-size:18px; position:absolute; top:2px; left:-28px;"
                                                                            class="fa fa-cubes"></span>By Boxes</span> <br>


                                                                    <?php if ($byBoxes_qty != '0') { ?>
                                                                    <?php $consultaQuotations = mysqli_query($connect, "SELECT * FROM quotationcontents WHERE quotationID='$quotationID' ")
                                                                    or die ("Error al traer los Quotations");
                                                                    ?>
                                                                                                                                    <?php while ($rowQuotations = mysqli_fetch_array($consultaQuotations)){

                                                                        $byBoxes_qty = $rowQuotations['byBoxes_qty'];
                                                                        $byBoxes_width = $rowQuotations['byBoxes_width'];
                                                                        $byBoxes_lenght = $rowQuotations['byBoxes_lenght'];
                                                                        $byBoxes_height = $rowQuotations['byBoxes_height'];
                                                                        $byBoxes_weight = $rowQuotations['byBoxes_weight'];
                                                                        $volumeBox = ($byBoxes_width * $byBoxes_lenght * $byBoxes_height)/1000000;
                                                                        $volumeWeightBox = ($byBoxes_width * $byBoxes_lenght * $byBoxes_height)/166; 
                                                                            ?>
                                                                    <span style="font-size:12px; position:absolute; top:75px; left:13px;">Cartons
                                                                          Qty</span>
                                                                    <span style="font-size:12px; position:absolute; top:75px; left:103px;">Width</span>
                                                                    <span style="font-size:12px; position:absolute; top:75px; left:173px;">Lenght</span>
                                                                    <span style="font-size:12px; position:absolute; top:75px; left:248px;">Height</span>
                                                                    <span style="font-size:12px; position:absolute; top:75px; left:318px;">Weight</span>

                                                                    <?php if ($rowQuotations['byBoxes_qty']!=0){ ?>
                                                                    <input class="form-control" type="number" placeholder="Qty" value="<?php echo $byBoxes_qty; ?>" name="byBoxes_qtyX[]" style="border-left:1px solid black; width:70px;  height:30px; position:relative; top:1px;">

                                                                    <input class="form-control" type="text" placeholder="Width" value="<?php echo $byBoxes_width; ?>" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:55px; position:relative; top:-14px; left:10px;" name="byBoxes_widthX[]">
                                                                    <input class="form-control" type="text" placeholder="Lenght" value="<?php echo $byBoxes_lenght; ?>" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:25px;" name="byBoxes_lenghtX[]">
                                                                    <input class="form-control" type="text" placeholder="Height" value="<?php echo $byBoxes_height; ?>" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:40px;" name="byBoxes_heightX[]">

                                                                    <input class="form-control" type="text" placeholder="Weight" value="<?php echo $byBoxes_weight; ?>" style="border-left:1px solid black; background:#EFEFEF; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:50px;"
                                                                        name="byBoxes_weightX[]">

                                                                    <?php } ?>

                                                                    <?php }} ?>


                                                                    <?php if ($byBoxes_qty == '' OR $byBoxes_qty == '0' ) { ?>
                                                                    <span style="font-size:12px; position:absolute; top:75px; left:13px;">Cartons
                                                                         Qty</span>
                                                                    <span style="font-size:12px; position:absolute; top:75px; left:103px;">Width</span>
                                                                    <span style="font-size:12px; position:absolute; top:75px; left:173px;">Lenght</span>
                                                                    <span style="font-size:12px; position:absolute; top:75px; left:248px;">Height</span>
                                                                    <span style="font-size:12px; position:absolute; top:75px; left:318px;">Weight</span>


                                                                    <?php } ?>

                                                                    <?php for ($i = 1; $i <= 3; $i++) { ?>
                                                                    <div class="prueba">
                                                                        <input class="form-control" type="number" placeholder="Qty" name="byBoxes_qtyX[]" style="border-left:1px solid black; width:70px;  height:30px; position:relative; top:1px;">

                                                                        <input class="form-control" type="text" placeholder="Width" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:55px; position:relative; top:-14px; left:10px;" name="byBoxes_widthX[]">
                                                                        <input class="form-control" type="text" placeholder="Lenght" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:25px;" name="byBoxes_lenghtX[]">
                                                                        <input class="form-control" type="text" placeholder="Height" style="border-left:1px solid black; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:40px;" name="byBoxes_heightX[]">

                                                                        <input class="form-control" type="text" placeholder="Weight" style="border-left:1px solid black; background:#EFEFEF; display:inline-block; margin-top:15px; padding:5px; width:60px; position:relative; top:-14px; left:50px;" name="byBoxes_weightX[]">
                                                                    </div>
                                                                    <?php } ?>

                                                                </div>

                                                            </div>
                                                            <?php } ?>

                                                            <div class="input-group" style="margin-top:50px; top:-55px;  position:relative; left:520px; border:1px solid #D2D6DE; padding:15px; width:405px;">

                                                                <input type="number" name="containerQuantity" style="display:none;" value="1" class="form-control">

                                                                <p style="margin-top:-10px;">Remarks</p>
                                                                <div style="margin-top:-5px;">

                                                                    <textarea name="remarks" style="width:100%; resize:none; min-height:200px; border-color:#D2D6DE; ">
1. COTIZACION ES BASADA EN TERMINO EXW DESDE BODEGA.
2. NO INCLUYE SEGURO DE CARGA, NO INCLUYE AGENCIAMEINTO ADUANAL EN PARAGUAY Y ENTREGA PUERTA A PUERTA.
3.LOS CARGOS EN DESTINOS SON APROXIMADOS, Y DEBERAN SER CANCELADOS AL AGENTE DESCONSOLIDADOR AL MOMENTO DEL ARRIBO.</textarea>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <script type="text/javascript">
                                                            $(document).ready(function() {
                                                                $("#origin<?php echo $quotationID; ?>").select2({
                                                                    tags: true
                                                                });

                                                                $("#btn-add-origin<?php echo $quotationID; ?>").on("click", function() {
                                                                    var newStat <?php echo $quotationID; ?>
                                                                    Val = $("#new-stat<?php echo $quotationID; ?>").val();
                                                                    // Set the value, creating a new option if necessary
                                                                    if ($("#origin<?php echo $quotationID; ?>").find("option[value='" + neworigin <?php echo $quotationID; ?>
                                                                            Val + "']").length) {
                                                                        $("#origin<?php echo $quotationID; ?>").val(neworigin <?php echo $quotationID; ?>
                                                                            Val).trigger("change");
                                                                    } else {
                                                                        // Create the DOM option that is pre-selected by default
                                                                        var newStat <?php echo $quotationID; ?> = new Option(neworigin <?php echo $quotationID; ?>
                                                                            Val, neworigin <?php echo $quotationID; ?>
                                                                            Val, true, true);
                                                                        // Append it to the select
                                                                        $("#origin<?php echo $quotationID; ?>").append(newStat <?php echo $quotationID; ?>).trigger('change');
                                                                    }
                                                                });
                                                            });


                                                            $(document).ready(function() {
                                                                $("#destination<?php echo $quotationID; ?>").select2({
                                                                    tags: true
                                                                });

                                                                $("#btn-add-destination<?php echo $quotationID; ?>").on("click", function() {
                                                                    var newStat <?php echo $quotationID; ?>
                                                                    Val = $("#new-stat<?php echo $quotationID; ?>").val();
                                                                    // Set the value, creating a new option if necessary
                                                                    if ($("#destination<?php echo $quotationID; ?>").find("option[value='" + newdestination <?php echo $quotationID; ?>
                                                                            Val + "']").length) {
                                                                        $("#destination<?php echo $quotationID; ?>").val(newdestination <?php echo $quotationID; ?>
                                                                            Val).trigger("change");
                                                                    } else {
                                                                        // Create the DOM option that is pre-selected by default
                                                                        var newStat <?php echo $quotationID; ?> = new Option(newdestination <?php echo $quotationID; ?>
                                                                            Val, newdestination <?php echo $quotationID; ?>
                                                                            Val, true, true);
                                                                        // Append it to the select
                                                                        $("#destination<?php echo $quotationID; ?>").append(newStat <?php echo $quotationID; ?>).trigger('change');
                                                                    }
                                                                });
                                                            });


                                                            $(document).ready(function() {
                                                                $("#Commodity").select2({
                                                                    tags: true
                                                                });

                                                                $("#btn-add-Commodity").on("click", function() {
                                                                    var newCommodityVal = $("#new-Commodity").val();
                                                                    // Set the value, creating a new option if necessary
                                                                    if ($("#Commodity").find("option[value='" + newCommodityVal + "']").length) {
                                                                        $("#Commodity").val(newCommodityVal).trigger("change");
                                                                    } else {
                                                                        // Create the DOM option that is pre-selected by default
                                                                        var newCommodity = new Option(newCommodityVal, newCommodityVal, true, true);
                                                                        // Append it to the select
                                                                        $("#Commodity").append(newCommodity).trigger('change');
                                                                    }
                                                                });
                                                            });
                                                        </script>



                                                        <input type="submit" value="Edit" name="submitEdit" class="form_1_submit" style="top:-45px; left:-175px; background:#007F46;">


                                                        <div class="modal-footer" style="margin-top:-20px;">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                </div>
                                                <!-- End Modal Edit-->
                                                </form>
                                                <?php
    if(isset($_POST["submitEdit"]))
          {
              $quotationIDerase= $_POST['quotationID'];

  $modifica= "DELETE FROM quotations WHERE id='$quotationIDerase'";
  $resultado = mysqli_query($connect, $modifica)
  or die ("Error al insertar los registros");


  $modifica= "DELETE FROM quotationcharges WHERE quotationID='$quotationIDerase'";
  $resultado = mysqli_query($connect, $modifica)
  or die ("Error al insertar los registros");

  $modifica= "DELETE FROM quotationcontents WHERE quotationID='$quotationIDerase'";
  $resultado = mysqli_query($connect, $modifica)
  or die ("Error al insertar los registros");

  $agent_name= $_POST['agent_name'];
  $client_name= $_POST['client_name'];
  $agent_email= $_POST['agent_email'];


  $initial_date= $_POST['initial_date'];
  $expiration_date= $_POST['expiration_date'];


  $origin= $_POST['origin'];
  $destination= $_POST['destination'];
  $service= $_POST['service'];
  $commodity= $_POST['commodity'];
  $remarks= $_POST['remarks'];
  $containerQuantity= $_POST['containerQuantity'];


  if ($containerQuantity=='') {$containerQuantity=1;}

  $dt = new DateTime($initial_date);

$initial_date = $dt->format('Y-m-d');

$dt2 = new DateTime($expiration_date);

$expiration_date = $dt2->format('Y-m-d');



  

   $consultaQuotations = mysqli_query($connect, "SELECT * FROM quotations ORDER BY id DESC LIMIT 1 ")
    or die ("Error al traer los Quotations");


     while ($rowQuotations = mysqli_fetch_array($consultaQuotations)){

        $quotationID=$rowQuotations['id'];
}

$queryQuotation = mysqli_query($connect, "INSERT INTO quotations(id, agent_name, client_name, initial_date, expiration_date, origin, destination, service, commodity, containerQuantity, remarks, agent_email) VALUES ('$quotationIDerase', '$agent_name', '$client_name', '$initial_date', '$expiration_date', '$origin', '$destination', '$service', '$commodity', '$containerQuantity', '".nl2br($remarks)."', '$agent_email' )")or die ("Error");


$quotationID++;

  $byVolume_qty= $_POST['byVolume_qty'];
  $byVolume_volume= $_POST['byVolume_volume'];
  $byVolume_weight= $_POST['byVolume_weight'];
    

    if ($byVolume_qty!='') {

    $queryQuotationByVolume = mysqli_query($connect, "INSERT INTO quotationcontents(quotationID, byVolume_qty, byVolume_volume, byVolume_weight) 
                VALUES ('$quotationIDerase', '$byVolume_qty', '$byVolume_volume', '$byVolume_weight' )");

  }


  $byBoxes_qtyX= $_POST['byBoxes_qtyX'];
  $byBoxes_widthX= $_POST['byBoxes_widthX'];
  $byBoxes_lenghtX= $_POST['byBoxes_lenghtX'];
  $byBoxes_heightX= $_POST['byBoxes_heightX'];
  $byBoxes_weightX= $_POST['byBoxes_weightX'];
  $countBoxes=-1;

  foreach ($byBoxes_qtyX as $byBoxes_qtyX => $byBoxes_qty) {

    $countBoxes++;

    

    if ($byBoxes_qty!='') {

      echo $byBoxes_qty.' ['.$byBoxes_widthX[$countBoxes].'] <br>';

    $queryQuotationContents = mysqli_query($connect, "INSERT INTO quotationcontents(quotationID, byBoxes_qty, byBoxes_width, byBoxes_lenght, byBoxes_height, byBoxes_weight) 
                VALUES ('$quotationIDerase', '$byBoxes_qty', '$byBoxes_widthX[$countBoxes]', '$byBoxes_lenghtX[$countBoxes]', '$byBoxes_heightX[$countBoxes]', $byBoxes_weightX[$countBoxes] )");

  }
}




  


  $freightChargeX= $_POST['freightChargeX'];
  $freightDescX= $_POST['freightDescX'];
  $countFreight=-1;

  

  foreach ($freightChargeX as $freightChargeX => $freightCharge) {

    $countFreight++;

    

    if ($freightCharge!='') {

      echo $freightCharge.' ['.$freightDescX[$countFreight].'] <br>';

    $queryQuotationChargesx = mysqli_query($connect, "INSERT INTO quotationcharges(quotationID, quantity, charge, description, type) 
                VALUES ('$quotationIDerase', '1', '$freightCharge', '$freightDescX[$countFreight]', 'Freight Charges' )");

  }
}



  $originChargeX= $_POST['originChargeX'];
  $originDescX= $_POST['originDescX'];
  $countOrigin=-1;

  

  foreach ($originChargeX as $originChargeX => $originCharge) {

    $countOrigin++;

    if ($originCharge!='') {

      echo $originCharge.' ['.$originDescX[$countOrigin].'] <br>';

    $queryQuotationChargesx = mysqli_query($connect, "INSERT INTO quotationcharges(quotationID, quantity, charge, description, type) 
                VALUES ('$quotationIDerase', '1', '$originCharge', '$originDescX[$countOrigin]', 'Origin Charges')");

  }
}


  $destinationChargeX= $_POST['destinationChargeX'];
  $destinationDescX= $_POST['destinationDescX'];
  $countDestination=-1;


  

  foreach ($destinationChargeX as $destinationChargeX => $destinationCharge) {

    $countDestination++;

    if ($destinationCharge!='') {

      echo $destinationCharge.' ['.$destinationDescX[$countDestination].'] <br>';

    $queryQuotationChargesx = mysqli_query($connect, "INSERT INTO quotationcharges(quotationID, quantity, charge, description, type) 
                VALUES ('$quotationIDerase', '1', '$destinationCharge', '$destinationDescX[$countDestination]', 'Destination Charges')");

  }
}

echo "<meta http-equiv=\"refresh\" content=\"0;URL= searchQuotation.php??message=QuotationEdited\">";


         }
?>







                                                    <tr>

                                                        <td>
                                                            <a href="#" style=" text-align:center; position:relative; width:100px; top:16px; color:black; font-weight:500;">
                                                                <p style="font-size:12px; font-weight:600; width:100px;">
                                                                    <?php echo $fecha; ?>
                                                                </p>
                                                            </a>
                                                        </td>

                                                        <td style="width:50px; padding:0px; margin:0px;">
                                                            <a href="#" style=" text-align:center;  position:relative;  top:30px; color:black; font-weight:600;">
                                                                <p style="font-size:12px;">
                                                                    <?php echo $row['id']; ?>
                                                                </p>
                                                            </a>
                                                        </td>

                                                        <td>
                                                            <p style=" text-align:center; position:relative; width:200px; font-size:12px; top:6px; color:black; font-weight:600;">
                                                                <?php echo $row['client_name']; ?>
                                                            </p>
                                                        </td>


                                                        <td style="width:150px;"><span style=" margin-left:15px; text-align:justify; position:relative; font-size:12px; top:10px; color:black; font-weight:600;"><?php echo $row['origin']; ?></span>
                                                        </td>

                                                        <td style="width:40px;"><span style=" margin-left:15px; text-align:justify; position:relative; font-size:12px; top:10px; color:black; font-weight:600;"><?php echo $row['destination']; ?></span>
                                                        </td>

                                                        <td>





                                                            <p style=" text-align:center; font-size:10px; position:relative; top:16px; color:black; font-weight:600;">
                                                                <i style="font-size:25px;" class="icon fa <?php if ($row['service']=='Air door to door'){ ?>fa-plane<?php } ?> <?php if ($row['service']=='Ocean door to door' OR $row['service']=='FCL 20' OR $row['service']=='FCL 40 HC'){ ?>fa-ship<?php } ?> <?php if ($row['service']=='Pending'){ ?>fa-hourglass-2<?php } ?> "></i><br>
                                                                <?php echo $row['service']; ?>
                                                            </p>

                                                        </td>

                                                        <td>

                                                            <p style="text-align:center; font-size:10px; position:relative; top:16px; color:black; font-weight:600;">
                                                                <i style="font-size:25px;" class="icon fa fa-user"></i><br>
                                                                <?php echo $row['agent_name']; ?>
                                                            </p>

                                                        </td>



                                                        <td>

                                                            <a href="#modalEdit<?php echo $row['id'];?>" class="remarksBtn" data-toggle="modal"><button
                                                                style="margin-left:10px; margin-top:2px; background-color:rgb(0,0,0,0); color:#B80008; font-size:16px; border:none;"><i
                                                                  class="fa fa-edit"></i></button></a>


                                                            <?php 
                                                              $result = $connect->query("SELECT COUNT(*) AS total FROM notes WHERE jobOrderId='$jobId' ")->fetch_array(); ?>
                                                            <a class="button" data-modal="modal<?php echo $row['id'];?>" style="cursor:pointer; background-color:rgb(0,0,0,0); position:relative; left:5px; color:#B80008; font-size:16px; border:none;">

                                                                <i class="fa fa-sticky-note-o"></i>
                                                                <?php if ($result[0]!='0'){ ?>
                                                                <span style="position:relative; left:-10px; top:-10px; font-size:8px;" class="label label-success">

                                                                  <?php echo $result[0]; ?>
                                                                </span>
                                                                <?php } ?>
                                                            </a>

                                                            <br>

                                                            <div id="modal<?php echo $row['id'];?>" class="modal" style="background-color: rgb(0,0,0,0.7); ">

                                                                <div class="modal-content" style="width:700px; position:relative; height:650px; overflow-y: scroll;  left:50%; margin-left:-350px; top:50px; padding:50px;">
                                                                    <div class="contact-form">
                                                                        <a class="close">&times;</a>
                                                                        <h4 class="modal-title" style="font-size:18px; border-bottom:1px solid black; width:97%;"><span style="font-weight:600;"> Create <?php echo $item; ?></span> Job Order #
                                                                            <?php echo $row['id'];?> </h4><br>

                                                                        <!-- /.box-header -->
                                                                        <div class="box-body table-responsive no-padding">

                                                                            <div style="width:100%; text-align:center;">
                                                                                <form method="POST">

                                                                                    <input style="display:none;" type="text" name="quotationID" value="<?php echo $quotationID; ?>">


                                                                                    <div style="display:inline-block; float:left; width:30%;">
                                                                                        <div class="input-group" style="margin-top:0px; ">
                                                                                            <span class="input-group-addon"><i style="width:20px;" class="fa fa-circle"></i></span>
                                                                                            <select data-placeholder="Select Agent" class="form-control select2" disabled style="width:100%;">

                                                                                              <option value="<?php echo $agent_name; ?>"><?php echo $agent_name; ?></option>

                                                                                            </select>

                                                                                        </div>
                                                                                        <br><br>

                                                                                        <div class="input-group" style="">
                                                                                            <span class="input-group-addon"><i style="width:20px;"
                                                                                                 class="fa fa-briefcase"></i></span>
                                                                                            <input name="" style="width:180px;" type="text" class="form-control" placeholder="Company Name" disabled value="<?php echo $customer_if; ?>">
                                                                                            <input style="display:none;" value="<?php echo $customer_if; ?>" name="">
                                                                                        </div>
                                                                                        <br><br>

                                                                                        <div class="input-group" style="">
                                                                                            <span class="input-group-addon"><i style="width:20px;" class="fa fa-plane"></i></span>
                                                                                            <input name="" style="width:180px;" type="text" class="form-control" placeholder="Company Name" disabled value="<?php echo $service; ?>">
                                                                                            <input style="display:none;" value="<?php echo $service; ?>" name="">
                                                                                        </div>
                                                                                        <br><br>

                                                                                        <div class="input-group" style="">
                                                                                            <span class="input-group-addon"><i style="width:20px;" class="fa fa-cube"></i></span>
                                                                                            <select id="state" class="js-example-basic-single" name="commodity" data-placeholder="Commodity" type="text" style="width:100%;">
                                                                                                <option> </option>


                                                                                                  <?php $consulta223 = mysqli_query($connect, "SELECT DISTINCT commodity FROM joborders  ") or die ("Error al traer los datos");

                                                                                                            while ($row223 = mysqli_fetch_array($consulta223)){ 
                                                                                                            $commodity=$row223['commodity'];
                                                                                                            ?>

                                                                                                  <option value="<?php echo $commodity; ?>"><?php echo $commodity; ?></option>
                                                                                                  <?php }  ?>
                                                                                                </select>
                                                                                        </div>



                                                                                    </div>



                                                                                    <br><br>
                                                                                    <!-- /.box-header -->
                                                                                    <div style="display:inline-block; width:40%; margin-top:-50px; position: relative; left:0px;">
                                                                                        <div class="box-body pad" style="">

                                                                                            <textarea name="note" placeholder="Write your note here..." rows="10" cols="80" style="width:300px; position:relative; left:50%; margin-left:-150px; resize:none; height:200px;"></textarea>
                                                                                        </div>
                                                                                        <input style="display:none;" value="<?php echo $jobId; ?>" name="jobOrderId">
                                                                                        <input style="display:none;" value="<?php echo $noteBy; ?>" name="noteBy">
                                                                                        <input type="submit" value="Save" name="submitNote" class="form_1_submit" style="background:#007F46; width:300px; position:relative; left:65px; top:0px; z-index:9999;">

                                                                                </form>

                                                                                </div>
                                                                                <br>
                                                                            </div>

                                                                            <table class="table table-hover">
                                                                                <tr>

                                                                                    <th>Date</th>
                                                                                    <th>By</th>
                                                                                    <th>Note</th>
                                                                                </tr>

                                                                                <?php $consultaNotes = mysqli_query($connect, "SELECT * FROM notes WHERE jobOrderId='$jobId' ORDER BY id DESC ") or die ("Error al traer los datos");

                                                                          while ($rowNotes = mysqli_fetch_array($consultaNotes)){  

                                                                                    $agent_name_notes = $rowNotes['agent_name'];
                                                                                    $note= $rowNotes['note'];
                                                                                    $fecha_note= $rowNotes['fecha']; ?>

                                                                                <tr>

                                                                                    <td style="color:black; text-align:center;">
                                                                                        <?php echo $fecha_note; ?>
                                                                                    </td>
                                                                                    <td style="color:black; text-align:center;">
                                                                                        <?php echo $agent_name_notes; ?>
                                                                                    </td>
                                                                                    <td style="color:black; text-align:center;">
                                                                                        <?php echo $note; ?>
                                                                                    </td>
                                                                                </tr>

                                                                                <?php } ?>
                                                                            </table>
                                                                        </div>
                                                                        <!-- /.box-body -->


                                                                    </div>
                                                                </div>

                                                            </div>



                                                            <a onclick="myFunction<?php echo $jobId; ?>()" href="" name="submitPDF">
                                                                <button style="margin-left:10px; margin-top:2px; background-color:rgb(0,0,0,0); color:#B80008; font-size:16px; border:none;"><i
                class="fa fa-file-pdf-o"></i></button>
                                                            </a>
                                                            <script>
                                                                function myFunction <?php echo $jobId; $webPDF = 'quotationPDF.php'; if ($row['agent_name'] == 'Saspy Express') { $webPDF = 'quotationPDFsaspy.php'; }  ?> () {
                                                                    window.open("<?php echo $webPDF; ?>?id=<?php echo $jobId; ?>");
                                                                }
                                                            </script>


                                                            <button style="background-color:rgb(0,0,0,0); color:#B80008; font-size:16px; border:none;"><i
              class="fa fa-circle"></i></button></td>


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
                $(function() {
                    //Initialize Select2 Elements
                    $(".select2").select2();

                    //Datemask dd/mm/yyyy
                    $("#datemask").inputmask("dd-mm-yyyy", {
                        "placeholder": "dd-mm-yyyy"
                    });
                    //Datemask2 mm/dd/yyyy
                    $("#datemask2").inputmask("mm-dd-yyyy", {
                        "placeholder": "dd-mm-yyyy"
                    });
                    //Money Euro
                    $("[data-mask]").inputmask();

                    //Date range picker
                    $('#reservation').daterangepicker();
                    //Date range picker with time picker
                    $('#reservationtime').daterangepicker({
                        timePicker: true,
                        timePickerIncrement: 30,
                        format: 'MM/DD/YYYY h:mm A'
                    });
                    //Date range as a button
                    $('#daterange-btn').daterangepicker({
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
                        function(start, end) {
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


                //Initialize Select2 Elements
                $(".select2").select2();


                jQuery(function($) {
                    $('form').bind('submit', function() {
                        $(this).find(':input').prop('disabled', false);
                    });
                });
            </script>

            <!-- DataTables -->
            <script src="plugins/datatables/jquery.dataTables.min.js"></script>
            <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
            <script>
                $(function() {
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


                $('#example1').DataTable({
                    "aaSorting": [
                        [0, "desc"]
                    ],
                    "columnDefs": [{
                        "orderable": false,
                        "targets": [7, 8]
                    }]
                });
            </script>

            <script type="text/javascript">
                $(document).ready(function() {
                    var table =
                });
            </script>

            <script type="text/javascript">
            </script>
            <!-- CK Editor -->
            <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
            <!-- Bootstrap WYSIHTML5 -->
            <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
            <script>
                $(function() {
                    // Replace the <textarea id="editor1"> with a CKEditor
                    // instance, using default configuration.
                    CKEDITOR.replace('editor1');
                    //bootstrap WYSIHTML5 - text editor
                    $(".textarea").wysihtml5();
                    CKEDITOR.disableAutoInline = true;
                    CKEDITOR.inline('editor1');
                });
            </script>


            <?php
    if(isset($_POST["submitNote"]))
          {
              $jobOrderId= $_POST['jobOrderId'];
              $note= $_POST['note'];
              $noteBy= $_POST['noteBy'];
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
                        $('#example1 tbody').on('click', document.getElementById('modal'), function() {
                            var modalBtns = [...document.querySelectorAll(".button")];
                            modalBtns.forEach(function(btn) {
                                btn.onclick = function() {
                                    var modal = btn.getAttribute('data-modal');
                                    document.getElementById(modal).style.display = "block";
                                }
                            });

                            var closeBtns = [...document.querySelectorAll(".close")];
                            closeBtns.forEach(function(btn) {
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
                        $('#example1 tbody').on('click', document.getElementById('modal'), function() {

                        });
                    </script>



</body>

</html>