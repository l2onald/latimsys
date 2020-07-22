<?php 

  error_reporting(0);
  require_once('conn.php');

    $consulta_invoice = mysqli_query($connect, "SELECT * FROM joborders ORDER BY id DESC LIMIT 1");

     $num_rows_invoice = mysqli_num_rows($consulta_invoice);

if($num_rows_invoice==0)
{
  $invoice=1000;
  $mensaje='No existen invoices';
}
else
{

  while ($extraido_email = mysqli_fetch_array($consulta_invoice)) {

        $invoice= $extraido_email['id'];
        
    }

  $invoice=$invoice+1;
}
    


                $client_id=$_POST['client_id'];
                $supplier_id=$_POST['supplier_id'];

                $cus_id=$_POST['cus_id'];
                $supp_id=$_POST['supp_id'];

                        $customer_name=$_POST['customer_name'];
                        $customer_company=$_POST['customer_company'];
                        $customer_telf1=$_POST['customer_telf1'];
                        $customer_telf2=$_POST['customer_telf2'];
                        $customer_qq=$_POST['customer_qq'];
                        $customer_wechat=$_POST['customer_wechat'];

                        $branch='';


                        if ($customer_telf1!='') {$customer_telf1=' - Mobile: '.$customer_telf1;}
if ($customer_telf2!='') {$customer_telf2=' - Office: '.$customer_telf2;}
if ($customer_qq!='') {$customer_qq=' - QQ: '.$customer_qq;}
if ($customer_wechat!='') {$customer_wechat=' - WeChat: '.$customer_wechat;}




                        $customer_telf=$customer_telf1.$customer_telf2.$customer_qq.$customer_wechat;
                        $customer_email=$_POST['customer_email'];
                        $customer_address=$_POST['customer_address'];

                        $customer_city=$_POST['customer_city'];
                        $customer_state=$_POST['customer_state'];
                        $customer_country=$_POST['customer_country'];


                        
                        $supplier_company=$_POST['supplier_company'];
                        $supplier_name=$_POST['supplier_name'];
                        $supplier_telf1=$_POST['supplier_telf1'];
                        $supplier_telf2=$_POST['supplier_telf2'];
                        $supplier_qq=$_POST['supplier_qq'];
                        $supplier_wechat=$_POST['supplier_wechat'];

                        if ($supplier_telf1!='') {$supplier_telf1=' - Mobile: '.$supplier_telf1;}
if ($supplier_telf2!='') {$supplier_telf2=' - Office: '.$supplier_telf2;}
if ($supplier_qq!='') {$supplier_qq=' - QQ: '.$supplier_qq;}
if ($supplier_wechat!='') {$supplier_wechat=' - WeChat: '.$supplier_wechat;}


                        $supplier_telf=$supplier_telf1.$supplier_telf2.$supplier_qq.$supplier_wechat;
                        $supplier_email=$_POST['supplier_email'];
                        $supplier_address=$_POST['supplier_address'];

                          
                          $agent_name=$_POST['agent_name'];
                          $agent_email=$_POST['agent_email'];

                          $service=$_POST['service'];
                          $commodity=$_POST['commodity'];
                          $wh_receipt=$_POST['wh_receipt'];
                          $remark=$_POST['remark'];

                          $payment=$_POST['payment'];

                          

                          $dt = new DateTime($fecha_segundos);

                          $segundos = $dt->format('H:i:s');

                          $fecha=$_POST['fecha'];
                          $hora=$_POST['hora'];

                          $fecha.= ' '.$hora;

                          $fecha=str_replace('/','-',$fecha);

                          $dt = new DateTime($fecha);

$fecha = $dt->format('Y-m-d H:i:s');

                          $status='PENDING';
                          



$queryModel = mysqli_query($connect, "UPDATE accounts SET client_id='$client_id' WHERE id='$cus_id' ");

$queryModel = mysqli_query($connect, "UPDATE accounts SET client_id='$supplier_id' WHERE id='$supp_id' ");


$queryModel = mysqli_query($connect, "INSERT INTO joborders(id, customer_name, customer_company, customer_telf, customer_email, customer_address, customer_city, customer_state, customer_country, supplier_company, supplier_name, supplier_telf, supplier_email, supplier_address, agent_name, agent_email, service, commodity, wh_receipt, remark, payment, status, fecha, branch, client_id, supplier_id) 

                VALUES ('$invoice', '$customer_name', '$customer_company', '$customer_telf', '$customer_email', '$customer_address','$customer_city','$customer_state','$customer_country', '$supplier_company', '$supplier_name', '$supplier_telf', '$supplier_email', '$supplier_address', '$agent_name', '$agent_email', '$service', '$commodity', '$wh_receipt', '$remark', '$payment', '$status', '$fecha', '$branch', '$client_id', '$supplier_id')")
or die ("");

echo "<meta http-equiv=\"refresh\" content=\"0;URL= ../createJobOrder.php?message=JobOrderSaved\">";


 ?>