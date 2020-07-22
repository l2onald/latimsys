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
        <h4 class="modal-title"><strong> Create tracking for </strong> Job Order #<?php echo $id;?> </h4>
    </div>
    <div class="modal-body" style="margin:20px">
        <form id="add_tracking" action="./curd.php" method="POST">
            <input type="hidden" name="addtracking"  value="edit">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-circle input-fa"></i></div>
                                <input type="text" class="form-control" value="<?php echo $agent_name; ?>" disabled placeholder="Select Agent">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-briefcase input-fa"></i></div>
                                <input type="text" class="form-control" value="<?php echo $customer_if; ?>" disabled placeholder="Company Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-plane input-fa"></i></div>
                                <input type="text" class="form-control" value="<?php echo $service; ?>" disabled placeholder="Ocean door to door">
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
                <input type="hidden" value="<?php echo $agent_name; ?>" name="trackingBy">
                <div class="col-md-6">
                    <div class="form-group row">
                        <div class="col-md-12">
                            <select name="carrier" required="required" id="" class="form-control">
                                <option> Select Carrier...</option>
                                <option value="DHL">DHL</option>
                                <option value="UPS">UPS</option>
                                <option value="USPS">USPS</option>
                                <option value="FEDEX">FEDEX</option>
                                <option value="Amazon Prime">Amazon Prime</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">                            
                                <input name="tracking" type="number" class="form-control"   >
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
        <style>
            .acion_close{
                background: red;
                color: #fff;
                padding: 5px 6px;
                border-radius: 50%;
            }
        </style>
        
        <div class="row">
            <div class="col-md-12">
                <table class="table" width="100%">
                    <thead>
                        <tr>                        
                            <th class="text-center">Action</th>
                            <th class="text-center">Date</th>
                            <th class="text-center">By</th>
                            <th class="text-center">Tracking</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    $consultatrackings = mysqli_query($connect, "SELECT * FROM trackings WHERE jobOrderId='$id' ORDER BY id DESC ") or die ("Error al traer los datos");

                    while ($rowtrackings = mysqli_fetch_array($consultatrackings)){  
                        $trackingId = $rowtrackings['id'];
                        $agent_name_tracking = $rowtrackings['agent_name'];
                        $tracking= $rowtrackings['tracking'];
                        $fecha_tracking= $rowtrackings['fecha'];
                    ?>

                           <tr class="tr_<?php echo $trackingId;?>" >
                                <td class="text-center">
                                    <a href="#" onclick="tracking_delete(<?php echo $trackingId;?>)">                  
                                        <i class="fa fa-close acion_close"></i>
                                    </a>
                                </td>
                                <td class="text-center"><?php echo $fecha_tracking; ?></td>
                                <td class="text-center"><?php echo $agent_name_tracking; ?></td>
                                <td class="text-center"><?php echo $tracking; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
 <?php } ?>
 <script>
    $( document ).ready(function() {
         
    });
    </script>