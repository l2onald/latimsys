<?php 
include 'conn.php';
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
        $agent_name=$row['agent_name'];
        $customer_company= $row['customer_company'];
        $customer_name= $row['customer_name']; 
        $customer_telf= $row['customer_telf'];
        $supplier_telf= $row['supplier_telf'];
        $branch= $row['branch'];

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
}

 
?>

<!-- Modal content-->

<div class="modal-content">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong>Edit</strong> Job Order #<?php echo $id;?>
        <form method="POST" id="delete_order" action="./curd.php" style="display: contents;"> 
        <input  type="hidden" name="jobId" value="<?php echo $id;?>">
        <input  type="hidden" name="order_delete" value="delete">
        <button type="submit" Onclick="return ConfirmDelete()" class="btn btn-danger">Delete</button>
        </form>
        </h4>      

    </div>
    <form method="POST" id="edit_order" action="./curd.php">
        <input type="hidden" name="jobId"  value="<?php echo $jobId; ?>">
        <input type="hidden" name="editorder"  value="edit">
        <div class="modal-body">
            <div class="row" style="margin:30px">
                <div class="col-md-4">
                    <div class="form-group row text-center">
                        <div class="col-md-12">
                            <i class="fa fa-user icon"></i>
                            <h4 class="title">Customer Data</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                                <input type="text" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>" disabled placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-briefcase input-fa"></i></div>
                                <input type="text" name="customer_company" class="form-control" value="<?php echo $customer_company; ?>" disabled placeholder="Company Name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone input-fa"></i></div>
                                <input type="text" name="customer_telf" class="form-control" value="<?php echo $customer_telf; ?>" placeholder="Telephone 2">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-location-arrow input-fa"></i></div>
                                <textarea name="customer_address" id="" cols="30" rows="4" class="form-control"><?php echo $customer_address; ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row text-center">
                        <div class="col-md-12">
                            <i class="fa fa-briefcase icon"></i>
                            <h4 class="title">Supplier Data</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-briefcase input-fa"></i></div>
                                <input type="text" class="form-control"  value="<?php echo $supplier_company; ?>" disabled placeholder="Company Name">
                                <input type="hidden" value="<?php echo $supplier_company; ?>" name="supplier_company">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-user input-fa"></i></div>
                                <input type="text" class="form-control" value="<?php echo $supplier_name; ?>" disabled placeholder="Contact Person">
                                <input type="hidden" value="<?php echo $supplier_name; ?>" name="supplier_name">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-phone input-fa"></i></div>
                                <input type="text" name="supplier_telf" class="form-control" value="<?php echo $supplier_telf; ?>" placeholder="Telephone">                           
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-location-arrow input-fa"></i></div>
                                <textarea name="supplier_address" id="" cols="30" rows="4" class="form-control"><?php echo $supplier_address; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="">Branch 
                            <?php if ($branch=='USA') { ?>
                                <img src="./img/usaFlag.png" style="width:50px; padding:5px;">
                                <?php } ?>

                                <?php if ($branch=='TAIWAN') { ?>
                                <img src="./img/taiwanflag.png" style="width:50px; padding:5px;">
                                <?php } ?>

                                <?php if ($branch=='' OR $branch==' ') { ?>
                                <img src="./img/chinaFlag.png" style="width:50px; padding:5px;">
                                <?php } ?>
                            </label>
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-location-arrow input-fa"></i></div>
                                <select placeholder="Select Branch" name="branch" id="" class="form-control select2">
                                <?php if ($branch=='' OR $branch ==' '){ ?>
                                    <option value=" ">[Actual: CHINA]</option>
                                    <?php }elseif ($branch=='USA') { ?>
                                    <option value="USA">[Actual: USA]</option>
                                    <?php }elseif ($branch=='TAIWAN') { ?>
                                    <option value="TAIWAN">[Actual: TAIWAN]</option>
                                    <?php } ?>
                                    <?php if ($branch=='' OR $branch ==' '){ ?>
                                    <option value="USA">USA</option>
                                    <option value="TAIWAN">TAIWAN</option>
                                    <?php }elseif ($branch=='USA') { ?>
                                    <option value=" ">CHINA</option>
                                    <?php }elseif ($branch=='TAIWAN') { ?>
                                    <option value=" ">CHINA</option>
                                    <option value="USA">USA</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group row text-center">
                        <div class="col-md-12">
                            <i class="fa fa-plane icon"></i>
                            <h4 class="title">Service Data</h4>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-circle input-fa"></i></div>
                                <select id="" class="form-control select2" placeholder="Select Agent" <?php if ($level!='Seller'){ ?> name="agent_name" <?php } ?> <?php if ($level=='Seller'){ ?> disabled <?php } ?>>
                                <option value="<?php echo $agent_name; ?>"><?php echo $agent_name; ?></option>
                                <?php 
                                    $consultaList = mysqli_query($connect, "SELECT * FROM agents ORDER BY name asc ") or die ("Error al traer los datos");

                                    while ($rowList = mysqli_fetch_array($consultaList)){ 

                                    $agent_List=$rowList['name']; 
                                    if ($agent_name!=$agent_List){ 
                                    ?>
                                    <option value="<?php echo $agent_List; ?>"><?php echo $agent_List; ?></option>
                                    <?php }   ?>
                                    <?php }  ?>
                                </select>
                                <?php if ($level=='Seller'){ ?>
                                <input type="text" name="agent_name" type="hidden" value="<?php echo $agent_name; ?>">
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class=" input-group">
                                <div class="input-group-addon"><i class="fa fa-plane input-fa"></i></div>
                                <select name="service" id="" class="form-control select2" placeholder="Select Service" required>
                                    <option value="<?php echo $service; ?>"><?php echo $service; ?></option>
                                    <?php if ($service!='Air door to door'){ ?>
                                        <option value="Air door to door">Air door to door</option>
                                    <?php } ?>

                                    <?php if ($service!='Pending'){ ?>
                                        <option value="Pending">Pending</option>
                                    <?php } ?>

                                    <?php if ($service!='Ocean door to door'){ ?>
                                        <option value="Ocean door to door">Ocean door to door</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-cube input-fa"></i></div>
                                <input type="text" name="commodity" class="form-control" value="<?php echo $commodity; ?>" placeholder="Commodity" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="input-group">
                                <div class="input-group-addon"><i class="fa fa-folder-open-o input-fa"></i></div>
                                <input type="text" name="wh_receipt" class="form-control"  value="<?php echo $wh_receipt; ?>" placeholder="WH Receipt">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="">Need Pick-Up?</label>
                        </div>
                        <div class="col-md-12">
                            <label class="radio-inline">
                                <input type="radio" name="remark" checked value="no"  <?php if ($remark=='no'){ ?> checked <?php } ?>> No
                                </label>
                            <label class="radio-inline">
                                <input type="radio" name="remark" value="yes"  <?php if ($remark=='yes'){ ?> checked <?php } ?>> Yes
                                </label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <label for="">Need Payment Assistant?</label>
                        </div>
                        <div class="col-md-12">
                            <label class="radio-inline">
                                <input type="radio" name="payment" checked value="no" <?php if ($remark=='no'){ ?> checked <?php } ?>> No
                                </label>
                            <label class="radio-inline">
                                <input type="radio" name="payment" value="yes" <?php if ($remark=='yes'){ ?> checked <?php } ?>> Yes
                                </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit"  class="btn btn-success">Edit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </form>
</div>
