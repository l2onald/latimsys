<?php 
error_reporting(0);
require_once('conn.php');

    $message= $_GET['message'];
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
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Latim Cargo & Trading | System</title>

  <link rel="icon" href="icoplane.ico" type="image/x-icon"> 
<link rel="shortcut icon" href="icoplane.ico" type="image/x-icon"> 

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->


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

.nav .open>a, .nav .open>a:focus, .nav .open>a:hover{background-color:#910007;}

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

        <li  style="border-bottom:1px solid gray; padding:5px;">
          <a class="active" href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <li class=" treeview" style="border-bottom:1px solid gray; padding:5px;">
          <a href="#">
            <i class="fa fa-users"></i> <span>Accounts</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li ><a href="createAccount.php"><i class="fa fa-circle-o"></i>Create</a></li>
            <li><a href="searchAccount.php"><i class="fa fa-circle-o"></i>Search</a></li>
          </ul>
        </li>

        <li class="treeview" style=" padding:5px;">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Job Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="createJobOrder.php"><i class="fa fa-circle-o"></i>Create</a></li>
            <li ><a href="searchJobOrder.php"><i class="fa fa-circle-o"></i>Search</a></li>
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
        My Profile 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">My Profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="form_1 shadow2" style="width:800px; margin-left:-400px; background:white; height:185px;">
     
 <h3 style="text-align:center; color:black; font-weight:400; padding:20px; font-size:20px; border-bottom:1px solid #555555;">My Profile <br>
 <span style="color:black; font-size:14px; font-weight:400; position:relative; top:10px;"><?php echo $email; ?> | <?php echo $level; ?></span>
</h3>

<?php if ($message=='AgentSaved'){ ?>
                  <br>
                  <div id="mydiv" style="background-color: rgba(0, 127, 70, 1); padding:20px;color:white; position:absolute; left:50%; width:300px; margin-left:140px; top:-80px;">
                    <center>
                      <span style="font-style: oblique; ">New agent has been registered.</span>
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

<a href="reset.php" style="color:white; font-weight:400;"><button type="button" class="btn btn-primary btn-lg"  style="width:185px;border-radius:2px; position:relative;margin-left:50px; height:40px; background:#B7565B; border:none;"  onMouseOver="this.style.background='#B80008'"
   onMouseOut="this.style.background='#B7565B'">
  <span style="position:relative; font-size:14px; top:-5px;">Change your Password</span></a>
</button>

<?php if ($email=='manager@latimcargo.com'){ ?>

<a href="register.php" style="color:white; font-weight:400;"><button type="button" class="btn btn-primary btn-lg"  style="width:160px;border-radius:2px; position:relative;margin-left:50px; height:40px; background:#4C7C67; border:none;" onMouseOver="this.style.background='#007F46'"
   onMouseOut="this.style.background='#4C7C67'">
  <span style="position:relative; font-size:14px; top:-5px;">Register New Agent</span>
</button></a>

<?php } ?>




</div>
   
      
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
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>



</body>
</html>
