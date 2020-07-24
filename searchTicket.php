<?php 
include 'conn.php';
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
<!doctype html>
<html style="height: auto;">
<head >
  <meta name="viewport" content="width=device-width, initial-scale=0.86, maximum-scale=3.0, minimum-scale=0.86">
    <title>Latim Cargo & Trading | Search Tickets</title>
    <!-- Datatable CSS -->
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
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>    
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
    <!-- <script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script> -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="plugins/fastclick/fastclick.js"></script>
    <script src="dist/js/app.min.js"></script>
    <script src="dist/js/demo.js"></script>  
     
   

    <script>
    window.addEventListener("load", function(){
      var load_screen = document.getElementById("load_screen");
      document.body.removeChild(load_screen);
    });
</script>
</head>

<body class="hold-transition sidebar-mini">
  <div id="load_screen"><div id="loading"><img src="./img/logo.png" style="width:180px; padding:5px;"><br><span style="font-size:26px; color:yellow; position:relative; left:18px;">LOADING...</span></div></div>
  <div class="wrapper" style="height:auto">
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
              <input name="JO"  placeholder="J.O# / CLIENT or SUPPLIER NAME" style="width:100%; font-size:12px; text-align:center; border:1px solid gray; padding:15px;">
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
              <li ><a  href="createTicket.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
              <li><a  class="active" href="searchTicket.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
            </ul>
          </li>

      </section>
      <!-- /.sidebar -->
    </aside>
    <div class="content-wrapper">
      <section class="content-header">
          <h1>
            Tickets 
            <small>Search</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Search Tickets</li>
          </ol>
      </section>
      <section class="content">
          <div class="searchPage shadow2" style="background:white; width:90%; margin-left:-45%;">
            <div class="row" style="border-bottom: 1px solid #000; margin-left: 0; margin-right: 0;">
                <div class="col-md-12">                  
                    <div class="col-md-offset-3 col-md-5 text-center">
                      <div class="form-group">
                        <h3 class="text-center" style="font-weight:bold">SEARCH TICKETS</h3>
                      </div>
                        <div class="form-group" style="background: #B80008;  padding-top: 10px; padding-bottom: 10px;">
                          <button class="btn pending_ticket">View Pending Tickets Only</button>
                          <button class="btn all_ticket">View All Tickets</button>
                        </div>
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
                                  <th class="text-center">Date</th>
                                  <th class="text-center">Tickets#</th>
                                  <th class="text-center">Client</th>
                                  <th class="text-center" style="width:200px;">Supplier</th>
                                  <th class="text-center">Type</th>
                                  <th class="text-center">Service</th>
                                  <th class="text-center">Agent</th>
                                  <th class="text-center">Status</th>
                                  <th class="text-center">Shortcut</th>
                                  <th class="text-center">Action</th>
                              </tr>
                          </thead>
                      </table>
                    </div>
                </div>
            </div>
          </div>       
      </section>
    </div>
  </div>
  
    <div id="editticket" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" >
          <style>
          .title_span{
              font-size:12px; 
              color:red; 
              font-weight:600;
          }
          .icon {
              font-size: 57px !important;
              color: black !important;
          }
          </style>
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <div class="row">
                      <div class="col-md-4">
                          <h4 class="modal-title"><strong>Inquiry</strong> Ticket # <span id="ticket_num"></span>
                          <form method="POST" id="delete_ticket" action="./action/curd.php" style="display: contents;"> 
                          <input  type="hidden" name="jobId" value="">
                          <input  type="hidden" name="order_ticket" value="delete">
                          <button type="submit" Onclick="return ConfirmDelete()" class="btn btn-danger">Delete</button>
                          </form>
                          </h4>   
                      </div>
                      <div class="col-md-4 text-center" id="title">
                          <h4 class="modal-title"><strong>Inquiry</strong> Missing Cargos <br><span class="title_span">[Find Warehouse Receipt Number]</span></h4>
                      </div>
                      <div class="col-md-3" style="text-align: center;background: #B80008;padding: 5px;color: #fff;">
                          <div class="checkbox_content">
                              <label for="">Change Ticket</label><br>
                              <div class="">
                                  <label class="radio-inline"><input type="radio" name="ticket_status" value="1">Missing Cargo</label>
                                  <label class="radio-inline"><input type="radio" name="ticket_status" value="2">Warehouse Inquiry</label>                
                              </div>           
                          </div>
                      </div>
                  </div>
              </div>
                  <div class="modal-body">
                      <div class="row" style="margin:30px">
                          <div class="col-md-4">
                              <div class="form-group row text-center">
                                  <div class="col-md-12">
                                      <i class="fa fa-paperclip icon"></i>
                                      <h4 class="title change_tracking_text">Tracking</h4>
                                  </div>
                              </div>  
                              <div  id="tracking_photo" >
                                  <input  type="hidden" name="jobId" value="">
                                  <input  type="hidden" name="tracking_photo" value="edit">              
                                  <div class="form-group row" id="tracking_number">
                                      <div class="col-md-12">
                                          <div class=" input-group">
                                              <div class="input-group-addon"><i class="fa fa-barcode input-fa"></i></div>
                                              <input type="text" name="tracking_number"  class="form-control" value=""  placeholder="Tracking Number">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class=" input-group">
                                              <label>Change File/Photo ↓</label>
                                              <input type="file" class="form-control" name="tracking_img" style="padding-right: 30px;">
                                              <i class="fa fa-file-image-o" style="position: absolute;right: 10px;top: 36px;z-index: 1000;"></i>                               
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <button type="button" class="btn btn-success btn-block">Save</button>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12 img-wrapper">
                                          <img src="" id="photo_img" alt="" class="img-responsive" style="padding: 30px;" >                                
                                          <div class="overlay" data-toggle="modal" data-target="#imgModal">
                                            <div class="text"><span style="font-size:18px;">Click to Full Size</div>
                                          </div>
                                        </div>
                                  </div>   
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group row text-center">
                                  <div class="col-md-offset-3 col-md-6" style="text-align: center;background: #B80008;padding: 5px;color: #fff;">
                                      <label for="">Inquiry solved?</label><br>
                                      <div class="">
                                          <label class="radio-inline"><input type="radio" name="inquiry_status" value="1">No</label>
                                          <label class="radio-inline"><input type="radio" name="inquiry_status" value="2">Yes</label>                
                                      </div> 
                                  </div>
                                  <dvi class="col-md-12">
                                      <h4 class="title">Inquiry Information</h4>
                                  </dvi>
                              </div>
                              <form action="./action/curd.php" id="inquiry_informtion" method="post" >
                                  <input  type="hidden" name="jobId" value="">
                                  <input  type="hidden" name="inquiry_informtion" value="edit">
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class=" input-group">
                                              <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                                              <input type="text" class="form-control" name="client"  value="" placeholder="Client">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class=" input-group">
                                              <div class="input-group-addon"><i class="fa fa-briefcase input-fa"></i></div>
                                              <input type="text" name="job_order" class="form-control" value="" placeholder="Job Order">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-plane input-fa"></i></div>
                                              <select name="service" id="" class="form-control select2" style="width:100%">
                                                  
                                              </select>                   
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class=" input-group">
                                              <div class="input-group-addon"><i class="fa fa-location-arrow input-fa"></i></div>
                                              <textarea name="notes" id="" cols="30" rows="4" class="form-control"></textarea>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class=" input-group">
                                              <div class="input-group-addon"><i class="fa fa-cube input-fa"></i></div>
                                              <input type="text" name="warehouse_receipt" class="form-control" value="" placeholder="Warehouse ">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <button  type="submit" class="btn btn-success btn-block">Save</button>
                                      </div>
                                  </div>
                                  <div class="form-group row" style="text-align: center;">
                                      <div class="col-md-12">
                                          <h4 class="title">Supplier Information</h4>
                                      </div>
                                  </div>                    
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class=" input-group">
                                              <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                                              <input type="text" name="supplier" class="form-control" value="" disabled placeholder="Contact Person">
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class="input-group">
                                              <div class="input-group-addon"><i class="fa fa-phone input-fa"></i></div>
                                              <input type="text" name="supplier_phone" class="form-control" value="" placeholder="Telephone">                           
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class=" input-group">
                                              <div class="input-group-addon"><i class="fa fa-location-arrow input-fa"></i></div>
                                              <textarea name="supplier_address" id="" cols="30" rows="4" class="form-control"></textarea>
                                          </div>
                                      </div>
                                  </div>
                              </form>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group row text-center">
                                  <div class="col-md-12">
                                      <i class="fa fa-comment icon"></i>
                                      <h4 class="title">Service Data</h4>
                                  </div>
                              </div>
                              <div id="notes_content" >
                              <div class="form-group row">
                                  <div class="col-md-12">
                                      <div class="input-group">
                                          <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                                          <select  placeholder="Select Agent"  name="agent_name" class="form-control select2"  style="width:100%;">
                                                  
                                          </select>       
                                      </div>
                                  </div>
                              </div>  
                              
                                  <input  type="hidden" name="jobId" value="">
                                  <input  type="hidden" name="create_note" value="edit">
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class=" input-group">
                                              <label>File/Photo ↓</label>
                                              <input type="file" class="form-control" name="image" style="padding-right: 30px;">
                                              <i class="fa fa-file-image-o" style="position: absolute;right: 10px;top: 36px;z-index: 1000;"></i>                               
                                          </div>
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <div class=" input-group">
                                              <div class="input-group-addon"><i class="fa fa-location-arrow input-fa"></i></div>
                                              <textarea name="notess" id="notess" cols="30" rows="4" class="form-control"></textarea>
                                          </div>
                                      </div>
                                  </div> 
                                  <div class="form-group row">
                                      <div class="col-md-12">
                                          <button type="button" class="btn btn-success btn-block">Save</button>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group row">
                                  <div class="col-md-12">
                                      <p>Notes History ↓</p>
                                  </div>
                                  <div class="col-md-12" style="max-height: 350px;overflow-y: auto;">
                                      <table class="table" width="100%" id="note_list">
                                          <thead>
                                              <tr>
                                                  <th class="text-center"></th>
                                                  <th class="text-center">Date</th>
                                                  <th class="text-center">By</th>
                                                  <th class="text-center">Note</th>
                                                  <th class="text-center">File</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                          
                                          </tbody>
                                      </table>
                                  </div>
                              
                              </div>                
                          </div>
                      </div>
                  </div>        
              </form>
          </div>
        </div>
    </div>  
    <div id="imgModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">          
          <div class="modal-body">
            <img src="" id="modal_img" alt="" class="img-responsive">
          </div>        
        </div>
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
            var from='', to='', jobCheckval, type="PENDING";
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
                    targets: [8,9]
                }],
                'ajax': {
                    'url': 'ajaxfile_ticket.php',
                    "data" :function(d){
                        d.from = Getfrom();
                        d.to = Getto();
                        d.jobCheckval = GetjobCheck();            
                        d.type = Gettype();           
                    }
                },
                'columns': [{
                    data: 'fecha'
                }, {
                    data: 'id'
                }, {
                    data: 'name'
                }, {
                    data: 'supplier'
                }, {
                    data: 'type'
                }, {
                    data: 'service'
                }, {
                    data: 'agent_name'
                }, {
                    data: 'status'
                },                      
                 {
                    data: 'shortcut'
                }, {
                    data: 'action'
                }, ]
            });
        function Gettype(){
          return type;
        }
        $(".pending_ticket").on("click", function(e){
          type="PENDING"
          table.ajax.reload( null, false );     
        });
        $(".all_ticket").on("click", function(e){
          type="All"
          table.ajax.reload( null, false );     
        });
        $("input[name='ticket_status']").on("change", function(e){
          if(e.target.value==1){
            $.post("./action/curd.php",
            {
              id:$("input[name='jobId']").val(),
              ticket_status:'ticket_status',
              type:"missing",
            },
            function(data, status){  
                table.ajax.reload( null, false );  
                swal({
                    title: "Ticket!",
                    text: "Ticket updated successful!",
                    icon: "success",
                });       
            });    
            var title='<h4 class="modal-title"><strong>Inquiry:</strong> Missing Cargos <br><span class="title_span">[Find Warehouse Receipt Number]</span></h4>';
            $("#tracking_number").css("display","block");
            $(".change_tracking_text").text("Tracking");
          }else if(e.target.value==2){
            var title='<h4 class="modal-title"><strong>Inquiry:</strong> Warehouse Receipt Inquiry <br><span class="title_span">[Resolve the problem using notes in the right area]</span></h4>';
            $("#tracking_number").css("display","none");
            $(".change_tracking_text").text("Photos");
            $.post("./action/curd.php",
            {
              id:$("input[name='jobId']").val(),
              ticket_status:'ticket_status',
              type:"warehouse",
            },
            function(data, status){  
                table.ajax.reload( null, false );  
                swal({
                    title: "Ticket!",
                    text: "Ticket updated successful!",
                    icon: "success",
                });       
            });    
          };
          $("#title").html(title);
        });
        $("input[name='inquiry_status']").on("change", function(e){
          if(e.target.value==2){
            $.post("./action/curd.php",
            {
              id:$("input[name='jobId']").val(),
              inquiry_save:'inquiry_save',
              status:"SOLVED",
            },
            function(data, status){  
              $("#editticket").modal('hide');
                table.ajax.reload( null, false );  
                swal({
                    title: "Ticket!",
                    text: "Ticket updated successful!",
                    icon: "success",
                });       
            });    
          }else if(e.target.value==1){
            $.post("./action/curd.php",
            {
              id:$("input[name='jobId']").val(),
              inquiry_save:'inquiry_save',
              status:"PENDING",
            },
            function(data, status){  
              $("#editticket").modal('hide');
                table.ajax.reload( null, false );  
                swal({
                    title: "Ticket!",
                    text: "Ticket updated successful!",
                    icon: "success",
                });       
            }); 
          }
        });
        function editticket(id) {
          $.get('./action/curd.php?ticket='+id,function(response){
            var rep=JSON.parse(response);
            $("input[name='jobId']").val(rep.ticket.jobId);
            $("#ticket_num").text(rep.ticket.jobId);
            $("input[name='tracking_number']").val(rep.ticket.tracking_number);
            $("input[name='tracking_img']").val('');
            $("input[name='image']").val('');
            $("textarea[name='notess']").val('');
            if(rep.ticket.imagen1){
              $("#photo_img").attr("src",rep.ticket.imagen1.split("../")[1]);
              $("#modal_img").attr("src",rep.ticket.imagen1.split("../")[1]);
            }else{
              $("#photo_img").attr("src",'');
            }
            $("input[name='ticket_status']").prop('checked',false);
            if(rep.ticket.type=='missing'){              
              $("input[name=ticket_status][value=1]").prop('checked', true);
              $("input[name=ticket_status][value=2]").prop('checked', false);
              var title='<h4 class="modal-title"><strong>Inquiry:</strong> Missing Cargos <br><span class="title_span">[Find Warehouse Receipt Number]</span></h4>';
              $("#tracking_number").css("display","block");
              $(".change_tracking_text").text("Tracking");
            }else{
              $("input[name=ticket_status][value=1]").prop('checked', false);
              $("input[name=ticket_status][value=2]").prop('checked', true);
              var title='<h4 class="modal-title"><strong>Inquiry:</strong> Warehouse Receipt Inquiry <br><span class="title_span">[Resolve the problem using notes in the right area]</span></h4>';
              $("#tracking_number").css("display","none");
              $(".change_tracking_text").text("Photos");
            }
            $("#title").html(title);
            $("input[name='inquiry_status']").prop('checked',false);
            if(rep.ticket.status=="PENDING"){              
              $("input[name=inquiry_status][value=1]").prop('checked', true);
              $("input[name=inquiry_status][value=2]").prop('checked', false);              
            }else if(rep.ticket.status=="SOLVED"){
              $("input[name=inquiry_status][value=1]").prop('checked', false);
              $("input[name=inquiry_status][value=2]").prop('checked', true);
            }
           
            $("input[name='client']").val(rep.ticket.client);
            $("input[name='job_order']").val(rep.ticket.job_order);
            $("select[name='service']").html(rep.service_select);
            $("textarea[name='notes']").val(rep.ticket.notes);
            $("textarea[name='notes']").text(rep.ticket.notes);
            $("input[name='warehouse_receipt']").val(rep.ticket.warehouse_receipt);
            $("input[name='supplier']").val(rep.ticket.supplier);
            $("input[name='supplier_phone']").val(rep.ticket.supplier_phone);            
            $("select[name='agent_name']").html(rep.agent_select);
            $("textarea[name='supplier_address']").val(rep.ticket.supplier_address);
            $("textarea[name='supplier_address']").text(rep.ticket.supplier_address);
            $("#note_list tbody").html(rep.tbody);
          });         
                         
            $("#editticket").modal('show');
            
        }
        $("#delete_ticket").submit(function(e) {
            event.preventDefault(); //prevent default action 
            var post_url = $(this).attr("action"); //get form action url
            var form_data = $(this).serialize(); //Encode form elements for submission                            
            $.post( post_url, form_data, function( response ) {                                
                $("#editticket").modal('hide');
                table.ajax.reload( null, false );  
                swal({
                    title: "Ticket!",
                    text: "Ticket deleted successful!",
                    icon: "error",
                });
            });
        });
        $("#tracking_photo .btn").on('click', function() {
         
         var fd = new FormData();
         fd.append( 'tracking_img', $("input[name='tracking_img']").prop('files')[0]);
         fd.append( 'jobId', $("input[name='jobId']").val());
         fd.append( 'tracking_photo', 'edit');
         fd.append( 'tracking_number', $("input[name='tracking_number']").val());
         $.ajax({
           url: './action/curd.php',
           data: fd,
           processData: false,
           cache: false,
           contentType: false,
           type: 'POST',
           success: function(data){
            if(data!=''){
              $("#photo_img").attr("src",data.split("../")[1]);
              $("#modal_img").attr("src",data.split("../")[1]);
              $("input[name='tracking_img']").val('');
              
            }    
            // $("#photo_img").load(location.href,"");  
            // $("#photo_img").loading();      
           }
         });
       
     });
     $("#notes_content .btn").on('click', function() {
         var fd = new FormData();
         fd.append( 'image', $("input[name='image']").prop('files')[0]);
         fd.append( 'jobId', $("input[name='jobId']").val());
         fd.append( 'create_note', 'edit');
         fd.append( 'notess', $("textarea[name='notess']").val());
         fd.append( 'agent_name', $("select[name='agent_name']").val());
         $.ajax({
           url: './action/curd.php',
           data: fd,
           processData: false,
           cache: false,
           contentType: false,
           type: 'POST',
           success: function(data){
              var rep=JSON.parse(data);
              if(rep.imagen){
                    var file="<td><a href='images/Tickets/notes/"+rep.imagen.split("/")[4]+"' style='color:#3c8dbc;font-weight: 100;' target='blank'>"+rep.imagen.split("/")[4]+"</a></td>" ;
                }else{
                   var file="<td></td>";
              }
              var html="";
               html+="<tr id='tr_"+rep.id+"' class='text-center'>"; 
               html+="<td><a href='#' onclick='note_delete("+rep.id+")' ><i class='fa fa-close' style='background: red; padding: 3px 4px;border-radius: 50%;'></i></a></td>";  
               html+="<td>"+rep.fecha+"</td>";  
               html+="<td>"+rep.agent_name+"</td>";  
               html+="<td>"+rep.notes+"</td>";  
               html+=file; 
               html+="</tr>";
               $("#note_list tbody").prepend(html);
               $("input[name='image']").val('');
               $("textarea[name='notess']").val('');
           }
         });
       
     });
     $("#inquiry_informtion").submit(function(e) {
          event.preventDefault(); //prevent default action 
          var post_url = $(this).attr("action"); //get form action url
          var form_data = $(this).serialize(); //Encode form elements for submission
          $.post( post_url, form_data, function( response ) {                                
              table.ajax.reload( null, false );     
              swal({
                  title: "Ticket!",
                  text: "Ticket Updated successful!!",
                  icon: "success",
                });   
          });
      });
      function note_delete(id){
        $.post("./action/curd.php",
            {
              id:id,
              note_delete:'delete'
            },
            function(data, status){  
              $("#tr_"+id).remove();             
            });        
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
       $("#statusUpdate_btn").on("click", function(e){      
            var  jobCheck=[];
            $("#empTable tbody tr [name='jobCheck[]']:checked").each(function (e,ele) {
                jobCheck.push(ele.value);
            })
            jobCheckval = Object.assign({}, jobCheck);
            if(jobCheck.length>0){
                $.ajax({
                method: 'POST',
                url: "./action/curd.php",
                data: {
                    jobCheck:jobCheck,
                    ticket_Update:'ticket_Update',
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
</body>

</html>