<?php 
error_reporting(0);
require_once('conn.php');
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ./login.php");
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
?>
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
 

</head>
<style type="text/css">
  
    

    .content {
      overflow-x: scroll;
    }
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


    


    .content-wrapper {
      background-color: #f0f0f0;
    }

    .shadow2 {
      -webkit-box-shadow: 1px 2px 2px 3px rgba(194, 192, 194, 0.75);
      -moz-box-shadow: 2px 2px 2px 3px rgba(194, 192, 194, 0.75);
      box-shadow: 2px 2px 2px 3px rgba(194, 192, 194, 0.75);

    }
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
      /* The Modal (background) */
      .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 99999;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
      }


        .modal2 {
          display: none;
          /* Hidden by default */
          position: fixed;
          /* Stay in place */
          z-index: 99999;
          /* Sit on top */
          left: 0;
          top: 0;
          width: 100%;
          /* Full width */
          height: 100%;
          /* Full height */
          overflow: auto;
          /* Enable scroll if needed */
          background-color: rgb(0, 0, 0);
          /* Fallback color */
          background-color: rgba(0, 0, 0, 0.4);
          /* Black w/ opacity */
        }

        .modal3 {
          display: none;
          /* Hidden by default */
          position: fixed;
          /* Stay in place */
          z-index: 99999;
          /* Sit on top */
          left: 0;
          top: 0;
          width: 100%;
          /* Full width */
          height: 100%;
          /* Full height */
          overflow: auto;
          /* Enable scroll if needed */
          background-color: rgb(0, 0, 0);
          /* Fallback color */
          background-color: rgba(0, 0, 0, 0.4);
          /* Black w/ opacity */
        }

        /* Modal Content/Box */
        .modal-content {
          background-color: #fefefe;
          margin: 3% auto;
          /* 15% from the top and centered */
          padding: 20px;
          border: 1px solid #888;
          /* width: 80%; */
          /* Could be more or less, depending on screen size */
        }

        /* Modal Content/Box */
        .modal-content2 {
          background-color: #fefefe;
          margin: 3% auto;
          /* 15% from the top and centered */
          padding: 20px;
          border: 1px solid #888;
          width: 80%;
          /* Could be more or less, depending on screen size */
        }

        /* Modal Content/Box */
        .modal-content3 {
          background-color: #fefefe;
          margin: 3% auto;
          /* 15% from the top and centered */
          padding: 20px;
          border: 1px solid #888;
          width: 80%;
          /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
          float: right;
        }

        .close:hover,
        .close:focus {
          text-decoration: none;
          cursor: pointer;
        }

</style>
<script>
    window.addEventListener("load", function(){
      var load_screen = document.getElementById("load_screen");
      document.body.removeChild(load_screen);
    });
</script>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <header class="main-header"> 
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
                <img src="<?php echo $picture; ?>" class="user-image" alt="User Image">
                <span class="hidden-xs"><?php echo $agent_name; ?></span>
              </a>
              <ul class="dropdown-menu shadow2">
                <!-- User image -->
                <li class="user-header">
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
            <a class="active" href="index.php">
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
          <li class="treeview" style="border-bottom:1px solid gray; padding:5px;">
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


          <li class="treeview" style="border-bottom:1px solid gray; padding:5px;">
            <a href="#" style="height:25px; position:relative; top:-10px;">
              <i class="fa fa-files-o"></i> <span style="font-size:11px; ">Quotations</span>
              <span class="pull-right-container" style="top:22px;">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="active"><a href="createQuotation.php" style="font-size:11px;"><i
                    class="fa fa-circle-o"></i>Create</a></li>
              <li><a href="searchQuotation.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
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
          <li class=" treeview" style="border-bottom:1px solid gray; padding:5px;">
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
          Dashboard
          <small></small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        </ol>
      </section>
      <section class="content">
        <div class="searchPage shadow2" style="background:white; width:100%; margin-left:-50%;">

          <div class="row">
            <div class="col-md-12 text-center">
                <h3 style="color: #000; font-weight:800;text-decoration:underline;font-size:20px;margin-bottom:20px;"><span style="color: #B80008;">LATIM </span> Work Tools</h3>
            </div>
          </div>     
          <div class="row">
            <div class="col-md-12 text-center">
            <div class="text-center" style="display:inline-block;">
              <a id="myBtn">
                <div class="img-wrapper input-group img-magnifier-container"
                  style=" margin-top:20px; cursor:pointer; z-index:999; ">
                  <p style="color:black; font-weight:600;">Ocean  Rates</p>
                  <img id="myimage" style="height:150px;" src="images/tarifario.jpeg">
                  <div class="overlay" data-toggle="modal" data-target="#myModal">
                    <div class="text"><span style="font-size:14px;">Click to Full Size</div>
                  </div>
                </div>
              </a>
              <div id="myModal" class="modal">
                <div class="modal-content input-group img-magnifier-container" style="margin-top:20px; width:700px;">
                  <span class="close" data-dismiss="modal" aria-label="Close"
                    style="font-size:20px; opacity:1; position:relative; top:-15px; font-weight:bolder;">&times;</span>
                  <img id="myimage" style="width:700px;" src="images/tarifario.jpeg">
                </div>
              </div>
            </div>
            <div class="text-center" style="display:inline-block;">
              <a id="myBtn2">
                <div class="img-wrapper input-group img-magnifier-container"
                  style="margin-top:20px; cursor:pointer; z-index:999; ">
                  <p
                    style="color:black; font-weight:600; ">Services
                    Rates</p>
                  <img id="myimage2" style="height:150px;" src="images/servicios.jpg">
                  <div class="overlay" data-toggle="modal" data-target="#myModal2">
                    <div class="text"><span style="font-size:14px;">Click to Full Size</div>
                  </div>
                </div>
              </a>
              <div id="myModal2" class="modal2">
                <div class="modal-content2 input-group img-magnifier-container" style="margin-top:20px; width:700px;">
                  <span class="close" data-dismiss="modal" aria-label="Close"
                    style="font-size:20px; position:relative; top:-15px; font-weight:bolder">&times;</span>
                  <img id="myimage2" style="width:700px;" src="images/servicios.jpg">
                </div>
              </div>
            </div>
            <div class="text-center" style="display:inline-block;">
              <a href='download.php?file=brochure.pdf'>
                <div class="img-wrapper input-group img-magnifier-container"
                  style=" margin-top:20px; cursor:pointer; z-index:999; ">
                  <p
                    style="color:black; font-weight:600;">Download
                    Brochure</p>
                  <img id="myimage3" style="height:150px;" src="images/brochure.jpg">
                  <div class="overlay">
                    <div class="text"><span style="font-size:14px;">Click to Download</div>
                  </div>
                </div>
              </a>
              <div id="myModal3" class="modal3">
                <!-- Modal content -->
                <div class="modal-content3 input-group img-magnifier-container" style="margin-top:20px; width:700px;">
                  <span class="close3"
                    style="font-size:60px; position:relative; top:-15px; color:red; font-weight:bolder;">&times;</span>
                  <img id="myimage3" style="width:700px;" src="images/10-1.jpg">
                </div>
              </div>
            </div> 
            </div>
          </div> 
            <div class="row" style="border-bottom: 1px solid #000; margin: 40px 0px;">
                <div class="col-md-12">                 
                    <div class="col-md-offset-2 col-md-6 text-center">
                        <h3 class="text-center" style="font-weight:bold">READY TO CONTACT <span style="font-weight:200">JOB ORDERS</span></h3>
                    </div>
                    <div class="col-md-4 text-center" style="margin-bottom:10px;">
                        <p class="text-center">Change Status</p>
                        <form class="form-inline">
                        <div class="form-group">
                            <select name="statusUpdate" id="statusUpdate" class="form-control select2" style="width:150px; font-size:13px;">
                                <option value="PENDING">Pending</option>
                                <option value="READY TO CONTACT">Ready to contact</option>
                                <option value="IN PROCESS">In process</option>
                                <option value="SHIPPED">Shipped</option>
                                <option value="IN WAREHOUSE">In Warehouse</option>
                                <option value="CANCELED">Canceled</option>
                            </select>
                        </div>
                        <button type="button" id="statusUpdate_btn" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:20px;">
              <form action="#" id="filter">
                  <div class="col-md-2">                        
                      <div class=" input-group">
                          <div class="input-group-addon"><i class="fa fa-calendar input-fa"></i></div>
                          <input type="text" class="form-control" data-provide="datepicker" id="from"
                data-date-format="yyyy-mm-dd" laceholder="To" value=""   placeholder="From">
                      </div>                          
                  </div>
                  <div class="col-md-2">                        
                      <div class=" input-group">
                          <input t type="text" class="form-control" data-provide="datepicker" id="to"
                data-date-format="yyyy-mm-dd" laceholder="To" value=""   placeholder="To">
                      </div>                    
                  </div>
                  <div class="col-md-2">
                      <div class="form-group row">                            
                          <button  type="submit" class="btn btn-success "><i class="fa fa-search"></i>&nbsp;Filter</button>                                
                      </div>
                  </div>
              </form>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table id='empTable' style="width:100%;" class='display dataTable'>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Job#</th>
                                <th>Customer Name</th>
                                <th style="width:200px;">Supplier Company</th>
                                <th>Service</th>
                                <th>Ship To:</th>
                                <th>Agent Name</th>
                                <th>Status</th>
                                <th>Tracking</th>
                                <th>WR #</th>
                                <th>Shortcut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>       
        
      </section>
    </div>

  </div>

  <div id="editJobOrder" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
        </div>
    </div>
    <div id="viewNotes" class="modal fade" role="dialog">
        <div class="modal-dialog">
        </div>
    </div> 
    <div id="addwr" class="modal fade" role="dialog">
        <div class="modal-dialog">
        </div>
    </div>
    <div id="addtracking" class="modal fade" role="dialog">
        <div class="modal-dialog">
        </div>
    </div> 
<script> 
      $("#datemask").inputmask("dd-mm-yyyy", { "placeholder": "dd-mm-yyyy" });
      //Datemask2 mm/dd/yyyy
      $("#datemask2").inputmask("mm-dd-yyyy", { "placeholder": "mm-dd-/yyyy" });
      //Money Euro
      $("[data-mask]").inputmask();

      //Date range picker
      $('#reservation').daterangepicker();
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' });
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
        function ConfirmDelete() {
            return confirm("Are you sure you want to delete?");
        }      
            var from='', to='', jobCheckval;
            $('.select2').select2();
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
                    targets: [8, 9, 10,11]
                }],
                'ajax': {
                    'url': 'ajaxfile_index.php',
                    "data" :function(d){
                        d.from = Getfrom();
                        d.to = Getto();
                        d.jobCheckval = GetjobCheck();                      
                    }
                },
                'columns': [{
                    data: 'fecha'
                }, {
                    data: 'id'
                }, {
                    data: 'customer_name'
                }, {
                    data: 'supplier_company'
                }, {
                    data: 'service'
                }, {
                    data: 'customer_city'
                }, {
                    data: 'agent_name'
                }, {
                    data: 'status'
                },
                {
                    data: 'tracking'
                },
                {
                    data: 'wr'
                },
                 {
                    data: 'shortcut'
                }, {
                    data: 'action'
                }, ]
            });
        function editJobOrder(id) {
            $.get('editorder.php?id='+id,function(response){ 
                    $('#editJobOrder .modal-dialog').html(response); 
                        $("#edit_order").submit(function(e) {
                            event.preventDefault(); //prevent default action 
                            var post_url = $(this).attr("action"); //get form action url
                            var form_data = $(this).serialize(); //Encode form elements for submission
                            
                            $.post( post_url, form_data, function( response ) {                                
                                $("#editJobOrder").modal('hide');
                                table.ajax.reload( null, false );     
                                swal({
                                    title: "JobOrder!",
                                    text: "JobOrder deleted successful!!",
                                    icon: "success",
                                 });   
                            });
                        });
                        $("#delete_order").submit(function(e) {
                            event.preventDefault(); //prevent default action 
                            var post_url = $(this).attr("action"); //get form action url
                            var form_data = $(this).serialize(); //Encode form elements for submission
                            
                            $.post( post_url, form_data, function( response ) {                                
                                $("#editJobOrder").modal('hide');
                                table.ajax.reload( null, false );  
                                swal({
                                    title: "JobOrder Update!",
                                    text: "JobOrder updated successful!",
                                    icon: "error",
                                });
                            });
                        });
                });                
            $("#editJobOrder").modal('show');
        }
        function Getfrom(){
            return $("#from").val();
        }
        function Getto(){
            return $("#to").val();
        }
        function GetjobCheck(){
            return jobCheckval;
        }
        $("#filter").submit(function(e) {      
            swal({
            title: "Date Fiter!",
            text: "Data filtered successful!",
            icon: "success",
            });
            table.ajax.reload();
        });   
        function viewNotes(id) {
            $.get('createnote.php?id='+id,function(response){ 
                    $('#viewNotes .modal-dialog').html(response); 
                    $("#create_order").submit(function(e) {
                        event.preventDefault(); //prevent default action 
                        var post_url = $(this).attr("action"); //get form action url
                        var form_data = $(this).serialize(); //Encode form elements for submission
                        
                        $.post( post_url, form_data, function( response ) {
                           
                            $("#viewNotes").modal('hide');
                            table.ajax.reload( null, false ); 
                            swal({
                                title: "New Notes!",
                                text: "New Notes created successful!",
                                icon: "success",
                                });
                        });
                    });    
                });
            $("#viewNotes").modal('show');
        }
        function addwr(id) {
            $.get('addwr2.php?id='+id,function(response){ 
                    $('#addwr .modal-dialog').html(response); 
                    $("#add_wr").submit(function(e) {
                        event.preventDefault(); //prevent default action 
                        var post_url = $(this).attr("action"); //get form action url
                        var form_data = $(this).serialize(); //Encode form elements for submission
                        
                        $.post( post_url, form_data, function( response ) {
                           
                            $("#addwr").modal('hide');
                            table.ajax.reload( null, false ); 
                            swal({
                                title: "NEW WR!",
                                text: "New WR created successful!",
                                icon: "success",
                                });
                        });
                    });  
                    $("#delete_wr").submit(function(e) {
                            event.preventDefault(); //prevent default action 
                            var post_url = $(this).attr("action"); //get form action url
                            var form_data = $(this).serialize(); //Encode form elements for submission
                            
                            $.post( post_url, form_data, function( response ) {                                
                                $("#addwr").modal('hide');
                                table.ajax.reload( null, false );  
                                swal({
                                    title: "WR!",
                                    text: "WR deleted successful!",
                                    icon: "error",
                                });
                            });
                        });  
                });
            $("#addwr").modal('show');
        }
        function addtracking(id){
            $.get('addtracking.php?id='+id,function(response){ 
                    $('#addtracking .modal-dialog').html(response); 
                    $("#add_tracking").submit(function(e) {
                        event.preventDefault(); //prevent default action 
                        var post_url = $(this).attr("action"); //get form action url
                        var form_data = $(this).serialize(); //Encode form elements for submission
                        
                        $.post( post_url, form_data, function( response ) {                           
                            $("#addtracking").modal('hide');
                            swal({
                                title: "New Tracking!",
                                text: "New Tracking created successful!",
                                icon: "success",
                                });
                            table.ajax.reload( null, false ); 
                            
                        });
                    });
                       
                });
            $("#addtracking").modal('show');
        }
        function tracking_delete(id){
            $.ajax({
                method: 'GET',
                url: "./curd.php",
                data: {
                    delete_tracking:id,
                    }
                })
                .done(function (response) {
                    swal({
                        title: "Tracking!",
                        text: "Tracking deleted successful!",
                        icon: "success",
                    }); 
                    $("#addtracking .tr_"+id).remove(); 
                    table.ajax.reload( null, false );  
                })
        } 
       $("#statusUpdate_btn").on("click", function(e){      
            var  jobCheck=[];
            $("#empTable tbody tr [name='jobCheck[]']:checked").each(function (e,ele) {
                jobCheck.push(ele.value);
            })
            jobCheckval = Object.assign({}, jobCheck);
            if(jobCheck.length>0){
                $.ajax({
                method: 'POST',
                url: "./curd.php",
                data: {
                    jobCheck:jobCheck,
                    status_Update:'statusUpdate',
                    statusUpdate: $("#statusUpdate").val()
                    }
                })
                .done(function (response) {
                    swal({
                        title: "Status!",
                        text: "Status updated successful!",
                        icon: "success",
                    });  
                    table.ajax.reload( null, false ); 
                   
                })
            }else{
                alert("Please check checkbox!!")
            }
             
       });
    </script>






  


  <script type="text/javascript">
    $('#example1 tbody').on('click', document.getElementById('modal'), function () {
      var modalBtns = [...document.querySelectorAll(".button")];
      modalBtns.forEach(function (btn) {
        btn.onclick = function () {
          var modal = btn.getAttribute('data-modal');
          document.getElementById(modal).style.display = "block";
        }
      });

      var closeBtns = [...document.querySelectorAll(".close")];
      closeBtns.forEach(function (btn) {
        btn.onclick = function () {
          var modal = btn.closest('.modal');
          modal.style.display = "none";
        }
      });

      window.onclick = function (event) {
        if (event.target.className === "modal") {
          event.target.style.display = "none";
        }
      }
    });
  </script>
</body>
</html>