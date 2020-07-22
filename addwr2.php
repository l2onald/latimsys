<?php 

require_once('conn.php');
session_start();
$id= $_GET['id'];
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
 $consulta2 = mysqli_query($connect, "SELECT * FROM joborders WHERE id='$id' ORDER BY id asc ") or die ("Error al traer los datos222");
                  

 while ($row = mysqli_fetch_array($consulta2)){  

           $jobId = $row['id'];
             $customer_company= $row['customer_company'];
             $customer_name= $row['customer_name']; 
             $customer_telf= $row['customer_telf'];
             $supplier_telf= $row['supplier_telf'];


             $customer_address= $row['customer_address']; 
             $supplier_address= $row['supplier_address']; 

             $service= $row['service'];
             $commodity= $row['commodity'];
             $wh_receipt= $row['wh_receipt'];
             $remark= $row['remark'];
             $customer_if = $row['customer_name'];

            if ($customer_company!='') { $customer_if .= ', '.$customer_company; }                    
            $supplier_company= $row['supplier_company'];
            $supplier_name= $row['supplier_name']; 

            $supplier_if = $row['supplier_name'];

            if ($supplier_company!='') { $supplier_if .= ', '.$supplier_company; }
?>

<!-- Modal content-->
<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Warehouse Receipt</strong> Job Order #<?php echo $id;?> 
        <form method="POST" id="delete_wr" action="./curd.php" style="display: contents;"> 
            <input  type="hidden" name="jobId" value="<?php echo $id;?>">
            <input  type="hidden" name="delete_wr" value="delete">
            <button type="submit" Onclick="return ConfirmDelete()" class="btn btn-danger">Delete</button>
        </form>
        </h4>
    </div>
    <div class="modal-body" style="margin:20px">
        <form id="add_wr" action="./curd.php" method="POST">
            <input type="hidden" name="addwr"  value="addwr">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                                <input type="text" class="form-control" value="<?php echo $customer_if; ?>" disabled placeholder="Company Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-briefcase input-fa"></i></div>
                                <input type="text" class="form-control" value="<?php echo $supplier_if; ?>" disabled placeholder="Company Name">
                            </div>
                        </div>
                    </div>                    
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-cube input-fa"></i></div>
                                <input type="text" class="form-control" value="<?php echo $commodity; ?>" disabled placeholder="Company Name">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" value="<?php echo $jobId; ?>" name="jobOrderId">
                <input type="hidden" value="<?php echo $agent_name; ?>" name="agent_name">
                <div class="col-md-6" style="margin-top:50px">
                    <div class="form-group row">
                        <div class="col-md-12">                            
                                <input name="wr" type="number" class="form-control" value="<?php echo $commodity; ?>"  >
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-12">
                            <button  type="submit" class="btn btn-success btn-block">save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>       
    </div>
</div>
 <?php } ?>
