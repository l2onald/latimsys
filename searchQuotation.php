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
    <title>Latim Cargo & Trading | Search Quotations</title>
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

        
          <li class="active treeview" style="border-bottom:1px solid gray; padding:5px;">
            <a href="#" style="height:25px; position:relative; top:-10px;">
              <i class="fa fa-files-o"></i> <span style="font-size:11px; ">Quotations</span>
              <span class="pull-right-container" style="top:22px;">
                <i class="fa fa-angle-left pull-right" ></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li><a href="createQuotation.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Create</a></li>
              <li ><a class="active" href="searchQuotation.php" style="font-size:11px;"><i class="fa fa-circle-o"></i>Search</a></li>
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
    <div class="content-wrapper">
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
      <section class="content">
          <div class="searchPage shadow2" >
            <div class="row" style="border-bottom: 1px solid #000; margin-left: 0; margin-right: 0;">
                <div class="col-md-offset-3 col-md-5 text-center">
                    <h3 class="text-center" style="font-weight:bold">Search Quotations</h3>
                </div>
                <div class="col-md-4 text-center" style="margin-bottom:10px;">
                    <p class="text-center">Change Status</p>
                    <form class="form-inline">
                    <div class="form-group">
                        <select name="statusUpdate" id="statusUpdate" class="form-control select2" style="width:150px; font-size:13px;">
                          <option value="PENDING">Pending</option>
                          <option value="READY TO CONTACT">Ready to contact</option>
                          <option value="CHECK NOTES">Check Notes</option>
                          <option value="IN PROCESS">In process</option>
                          <option value="SHIPPED">Shipped</option>
                          <option value="IN WAREHOUSE">In Warehouse</option>
                        </select>
                    </div>
                    <button type="button" id="statusUpdate_btn" class="btn btn-primary">Update</button>
                    </form>
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
                                <th class="text-center">Quotation#</th>
                                <th class="text-center">Client</th>
                                <th class="text-center">Origin</th>
                                <th class="text-center">Destination</th>
                                <th class="text-center">Service</th>
                                <th class="text-center">Agent</th>
                                <th class="text-center">Shorcuts</th>
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
    <div id="editquotation" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg" >
        </div>
    </div>
    <div id="viewNotes" class="modal fade" role="dialog">
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
                    targets: [7, 8]
                }],
                'ajax': {
                    'url': 'ajaxfile_quotation.php',
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
                    data: 'client_name'
                }, {
                    data: 'origin'
                }, {
                    data: 'destination'
                }, {
                    data: 'service'
                }, {
                    data: 'agent_name'
                },
                 {
                    data: 'shortcut'
                }, {
                    data: 'action'
                }, ]
            });
        function editquotation(id) {
            $.get('edit_quotation.php?id='+id,function(response){ 
                    $('#editquotation .modal-dialog').html(response); 
                        $("#edit_quotation").submit(function(e) {
                            event.preventDefault(); //prevent default action 
                            var post_url = $(this).attr("action"); //get form action url
                            var form_data = $(this).serialize(); //Encode form elements for submission
                            
                            $.post( post_url, form_data, function( response ) { 
                                $("#editquotation").modal('hide');
                                table.ajax.reload( null, false );     
                                swal({
                                    title: "Quotations!",
                                    text: "Quotations Updated successful!!",
                                    icon: "success",
                                 });   
                            });
                        });
                        $("#by_boxes_content .btn_plus").on("click", function(e){
                          e.preventDefault();
                          var html='<div class="item">';
                              html+='<div class="form-group row">';
                              html+='<div class="col-md-2 col-item">';
                              html+='<input type="text" name="byBoxes_qtyX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-2 col-item">';
                              html+='<input type="number" name="byBoxes_widthX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-2 col-item">';
                              html+='<input type="number"  name="byBoxes_lenghtX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-2 col-item">';
                              html+='<input type="number"  name="byBoxes_heightX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-2 col-item">';
                              html+='<input type="number"  name="byBoxes_weightX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-1 col-item">';
                              html+='<button  type="button" class="btn btn_minus">-</button>';
                              html+='</div>';
                              html+='</div>';
                              html+='</div>';
                          $("#by_boxes_content").append(html);

                            $('#by_boxes_content .btn_minus').on("click", function (e) {
                              e.preventDefault(); 
                              $(this).parent('div').parent('div').parent('div').remove(); 
                            })
                        });

                        $('#by_boxes_content .btn_minus').on("click", function (e) {
                          e.preventDefault(); 
                          $(this).parent('div').parent('div').parent('div').remove(); 
                        })
                        $("#freight_charges .btn_plus").on("click", function(e){
                          e.preventDefault();
                          var html='<div class="item">';
                              html+='<input type="hidden" name="freightid[]" value="">';
                              html+='<div class="form-group row">';
                              html+='<div class="col-md-4 col-item">';
                              html+='<input type="text" name="freightDescX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-3 col-item">';
                              html+='<input type="number" name="freightChargeX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-3 col-item">';
                              html+='<input type="number" value="1" name="freightChargeQX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-1 col-item">';
                              html+='<button  type="button" class="btn btn_minus">-</button>';
                              html+='</div>';
                              html+='</div>';
                              html+='</div>';
                          $("#freight_charges").append(html);

                            $('#freight_charges .btn_minus').on("click", function (e) {
                              e.preventDefault(); 
                              $(this).parent('div').parent('div').parent('div').remove(); 
                            })
                        });

                        $('#freight_charges .btn_minus').on("click", function (e) {
                          e.preventDefault(); 
                          $(this).parent('div').parent('div').parent('div').remove(); 
                        })
                        $("#origin_charges .btn_plus").on("click", function(e){
                          e.preventDefault();
                          var html='<div class="item">';
                              html+='<input type="hidden" name="originid[]" value="">';
                              html+='<div class="form-group row">';
                              html+='<div class="col-md-4 col-item">';
                              html+='<input type="text" name="originDescX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-3 col-item">';
                              html+='<input type="number" name="originChargeX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-3 col-item">';
                              html+='<input type="number" value="1" name="originChargeQX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-1 col-item">';
                              html+='<button  type="button" class="btn btn_minus">-</button>';
                              html+='</div>';
                              html+='</div>';
                              html+='</div>';
                          $("#origin_charges").append(html);

                            $('#origin_charges .btn_minus').on("click", function (e) {
                              e.preventDefault(); 
                              $(this).parent('div').parent('div').parent('div').remove(); 
                            })
                        });
                        
                        $('#origin_charges .btn_minus').on("click", function (e) {
                          e.preventDefault(); 
                          $(this).parent('div').parent('div').parent('div').remove(); 
                        })
                        $("#destination_charges .btn_plus").on("click", function(e){
                          e.preventDefault();
                          var html='<div class="item">';
                              html+='<input type="hidden" name="destinationtid[]" value="">';
                              html+='<div class="form-group row">';
                              html+='<div class="col-md-4 col-item">';
                              html+='<input type="text" name="destinationDescX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-3 col-item">';
                              html+='<input type="number" name="destinationChargeX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-3 col-item">';
                              html+='<input type="number" value="1" name="destinationChargeQX[]" class="form-control">';
                              html+='</div>';
                              html+='<div class="col-md-1 col-item">';
                              html+='<button  type="button" class="btn btn_minus">-</button>';
                              html+='</div>';
                              html+='</div>';
                              html+='</div>';
                          $("#destination_charges").append(html);

                            $('#destination_charges .btn_minus').on("click", function (e) {
                              e.preventDefault(); 
                              $(this).parent('div').parent('div').parent('div').remove(); 
                            })
                        });
                        
                        $('#destination_charges .btn_minus').on("click", function (e) {
                          e.preventDefault(); 
                          $(this).parent('div').parent('div').parent('div').remove(); 
                        })
                        $("#delete_quotation").submit(function(e) {
                            event.preventDefault(); //prevent default action 
                            var post_url = $(this).attr("action"); //get form action url
                            var form_data = $(this).serialize(); //Encode form elements for submission
                            
                            $.post( post_url, form_data, function( response ) {                                
                                $("#editquotation").modal('hide');
                                table.ajax.reload( null, false );  
                                swal({
                                    title: "Quotations Delete!",
                                    text: "Quotations deleted successful!",
                                    icon: "error",
                                });
                            });
                        });
                });                
            $("#editquotation").modal('show');
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
            $.get('createnote_quo.php?id='+id,function(response){ 
                    $('#viewNotes .modal-dialog').html(response); 
                    $("#create_quotation").submit(function(e) {
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
                    question_Update:'question_Update',
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