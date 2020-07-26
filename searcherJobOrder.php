<?php 
include 'conn.php';
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ./login.php");
    exit;
}
if(isset($_GET['JO']) && !empty($_GET['JO'])){
  $JO= $_GET['JO'];
}else{
  $JO='';
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
    <title>Latim Cargo & Trading | Search USA Order</title>
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
              <li><a class="" href="searchUsaOrder.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
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
    <style>
    .search_title{
      font-size:14px;
    }
    </style>
    <div class="content-wrapper">
      <section class="content-header">
          <h1>
          Job Orders 
            <small>Search</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Search Job Orders</li>
          </ol>
      </section>
      <section class="content">
          <div class="searchPage shadow2" style="background:white; width:90%; margin-left:-45%;">
            <div class="row" style="border-bottom: 1px solid #000; margin-left: 0; margin-right: 0;">
                <div class="col-md-12">                 
                    <div class="col-md-offset-2 col-md-6 text-center">
                        <h3 class="text-center" style="font-weight:bold">Search Job Orders</h3>
                        <?php if($JO){ ?>
                        <span class="search_title text-center">Now Searching: <strong style="color:red">"<?php echo $JO; ?>"</strong></span>
                        <?php } ?>
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
            var from='', to='', jobCheckval, search_val='<?php echo $JO; ?>';
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
                    'url': 'ajaxfile_search.php',
                    "data" :function(d){
                        d.from = Getfrom();
                        d.to = Getto();
                        d.jobCheckval = GetjobCheck(); 
                        d.search_val = Getsearch_val();                      
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
        // $("#empTable_filter input").keyup(function(e){
        //   search_val=e.target.value;
        //   if(search_val){
        //       var text='Now Searching: <strong style="color:red">"'+search_val+'"</strong>';
        //   }else{
        //       var text='';
        //   }
        //   $(".search_title").html(text);
        // });
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

        function Getsearch_val(){
          return search_val;
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
</body>

</html>