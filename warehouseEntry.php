<?php
ob_start();
include(dirname(__FILE__).'/res/pdf_demo.php');
	require_once('conn.php');

	$id = $_GET['id'];

 $consulta_invoice = mysqli_query($connect, "SELECT * FROM joborders WHERE id='$id' ");


  while ($extraido_email = mysqli_fetch_array($consulta_invoice)) {

  

  
  $customer_name= $extraido_email['customer_name'];
  $customer_company= $extraido_email['customer_company'];
  $customer_telf= $extraido_email['customer_telf'];
  $customer_email= $extraido_email['customer_email'];
  $customer_address= $extraido_email['customer_address'];

  $customer_city= $extraido_email['customer_city'];
  $customer_state= $extraido_email['customer_state'];
  $customer_country= $extraido_email['customer_country'];

    $client_id= $extraido_email['client_id'];
    $supplier_id= $extraido_email['supplier_id'];

  $supplier_name= $extraido_email['supplier_name'];
  $supplier_company= $extraido_email['supplier_company'];
  $supplier_telf= $extraido_email['supplier_telf'];
  $supplier_email= $extraido_email['supplier_email'];
  $supplier_address= $extraido_email['supplier_address'];

  $agent_name= $extraido_email['agent_name'];
  $agent_email= $extraido_email['agent_email'];

  $service= $extraido_email['service'];
  $commodity= $extraido_email['commodity'];
  $remark= $extraido_email['remark'];
  $payment= $extraido_email['payment'];
  $wh_receipt= $extraido_email['wh_receipt'];
  $fecha= $extraido_email['fecha'];
  $fondo='';
    }



$content = ob_get_clean();
        


        $content = '';

        $content .= '
    <style>
    table {
    border-collapse: collapse;
    }

    table{
     width:800px;
     margin:0 auto;
    }

    td{
    border: 1px solid #e2e2e2;
    padding: 10px; 
    max-width:520px;
    word-wrap: break-word;
    }


    </style>

    ';
        /* you css */



        $content .= '<div style="padding:42px;">';

        $content .= '<div style=" position:relative; right:-420px; top:00px; ">';
		$content .= '<p><span style="font-weight:700; font-weight:bolder; font-size:18px;">Warehouse Entry N°</span> <span style="border-bottom:2px solid black; color:#B70007; font-size:18px;">'.$id.'</span>.</p>';
		$content .= '</div>';

		$content .= '<div style="width:50%; height:300px;">';

		$content .= '<img src="./img/logoChina.png" style="width:100px; height:120px; position:relative; top:-40px; float:left;">';

			$content .= '<div style="float:right; position:relative; left:10px; top:-20px;">';
			$content .= '<img src="a.jpg" style="width:300px; position:absolute;  z-index:1; left:100px; top:60px;">';
			$content .= '</div>';


		$content .= '<div style="position:absolute; z-index:9999!important;  top:295px; left:345px; ">';
		$content .= '<p style="font-size:13px; position:absolute;  ">'.$supplier_name.' [Client #'.$supplier_id.'].'.'</p>';
		$content .= '</div>';


		$content .= '<div style="position:absolute; z-index:9999!important;  top:335px; left:345px; ">';
		$content .= '<p style="font-size:13px; position:absolute;  ">'.$customer_name.' / '.$customer_company.' [Client #'.$client_id.'].'.'</p>';
		$content .= '</div>';

		

		$content .= '<div style="position:absolute; z-index:9999!important;  top:335px; left:-40px; ">';
		$content .= '<p style="font-size:13px; position:absolute;  ">'.$service.' to ['.$customer_city.', '.$customer_state.'].'.'</p>';
		if ($customer_country=='VE') {

		}
		$content .= '<img src="./img/venezuela.png" style="width:40px; position:absolute; top:0px; left:300px;">';
		$content .= '</div>';

		$content .= '<div style="border-top:2px solid black; position:relative;z-index:1; top:10px; left:-44px; width:756px;">';
		$content .= '<img src="b.jpg" style="width:400px; position:relative; z-index:1; left:200px; top:10px;">';
		$content .= '</div>';

		$content .= '<div style="border-top:2px solid black; position:relative;z-index:1; top:10px; left:-44px; width:756px;">';
		$content .= '<img src="c.jpg" style="width:400px; position:relative; z-index:1; left:200px; top:10px;">';
		$content .= '</div>';

		$content .= '<div style="border-top:2px solid black; border-bottom:10px solid black;z-index:1; position:relative; top:10px; left:-44px; width:756px;">';
		$content .= '<img src="./img/d.png" style="width:752px; position:relative; z-index:1; left:2px; top:1px;">';
		$content .= '</div>';



		$content .= '<table style="margin-top:10px; margin-left:-42px;">';

				$content .= '<tr>';

				$content .= '<td style="width:120; padding-top:-3px;  text-align:left; border:none; border-bottom:2px solid black; border-right:2px solid black;"><span style="font-size:12px; position:relative; top:0px; left:-7px;"><img style="width:40px;" src="sm.jpg"><br>SHIPPING MARK</span></td>';

				$content .= '<td style="width:193px; padding-top:-3px;  text-align:left; border:none; border-bottom:2px solid black; border-right:2px solid black;" ><span style="font-size:12px; position:relative; top:5px; left:-5px;"><img style="width:70px;" src="cm.jpg"><br>COMMODITY</span> <img style="width:120px; position:relative; top:-24px; float:right" src="cp.jpg"></td>';

				$content .= '<td style="width:75px; padding-top:-3px;  text-align:left; border:none; border-bottom:2px solid black; border-right:2px solid black;" ><span style="font-size:12px; position:relative; top:2px; left:-5px;"><img style="width:36px;" src="pk.jpg"><br>PACKAGES</span></td>';

				$content .= '<td style="width:75px; padding-top:-3px;  text-align:left; border:none; border-bottom:2px solid black; border-right:2px solid black;" ><span style="font-size:12px; position:relative; top:5px; left:-5px;"><img style="width:70px;" src="cm.jpg"><br>VOLUME</span></td>';
				

				$content .= '<td style="width:75px; padding-top:-3px;  text-align:left; border:none; border-bottom:2px solid black; " ><span style="font-size:12px; position:relative; top:5px; left:-5px;"><img style="width:70px;" src="cm.jpg"><br>WEIGHT</span></td>';
				$content .= '</tr>';

				$content .= '</table>';



				$content .= '<table style="margin-left:-42px;">';


				$num_rows=0;

				$consultaWarehouseEntry0 = mysqli_query($connect, "SELECT * FROM cargo_information WHERE jo_ID='$id' ")
    			or die ("Error al traer los Quotations");

    			while($row = mysqli_fetch_array($consultaWarehouseEntry0)){
				$num_rows = mysqli_num_rows($consultaWarehouseEntry0);
				}

				$lineas=$num_rows;



				

				if ($lineas==0) {

					$content .= '<tr>';

				$content .= '<td style="width:120px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px;">'.''.'</td>';

				$content .= '<td style="width:193px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px;">'.''.'</td>';


				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px; "><span style="position:relative; left:0px;">'.''.'</span></td>';


				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px; "><span style="position:relative; left:0px;">'. '' .'</span></td>';

				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2;  font-size:11px; ">'. '' .'</td>';
				$content .= '</tr>';

				$content .= '<tr>';

				$content .= '<td style="width:120px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px;">'.''.'</td>';

				$content .= '<td style="width:193px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px;">'.''.'</td>';


				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px; "><span style="position:relative; left:0px;">'.''.'</span></td>';


				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px; "><span style="position:relative; left:0px;">'. '' .'</span></td>';

				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2;  font-size:11px; ">'. '' .'</td>';
				$content .= '</tr>';


				$content .= '<tr>';

				$content .= '<td style="width:120px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px;">'.''.'</td>';

				$content .= '<td style="width:193px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px;">'.''.'</td>';


				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px; "><span style="position:relative; left:0px;">'.''.'</span></td>';


				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px; "><span style="position:relative; left:0px;">'. '' .'</span></td>';

				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2;  font-size:11px; ">'. '' .'</td>';
				$content .= '</tr>';

				$content .= '<tr>';

				$content .= '<td style="width:120px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px;">'.''.'</td>';

				$content .= '<td style="width:193px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px;">'.''.'</td>';


				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px; "><span style="position:relative; left:0px;">'.''.'</span></td>';


				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px; "><span style="position:relative; left:0px;">'. '' .'</span></td>';

				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2;  font-size:11px; ">'. '' .'</td>';
				$content .= '</tr>';


					
				}else{


					$consultaWarehouseEntry = mysqli_query($connect, "SELECT * FROM cargo_information WHERE jo_ID='$id' ")
    			or die ("Error al traer los Quotations");

				while ($rowWarehouseEntry = mysqli_fetch_array($consultaWarehouseEntry)){

					$shipping_mark = $rowWarehouseEntry['shipping_mark'];
					$description = $rowWarehouseEntry['description'];
					$packages = $rowWarehouseEntry['packages'];
					$volume = $rowWarehouseEntry['volume'];
					$weight = $rowWarehouseEntry['weight'];



				$content .= '<tr>';

				$content .= '<td style="width:120px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px;">'.$shipping_mark.'</td>';

				$content .= '<td style="width:193px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px;">'.$description.'</td>';


				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px; "><span style="position:relative; left:0px;">'.$packages.'</span></td>';


				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2; border-right:2px solid black; font-size:11px; "><span style="position:relative; left:0px;">'. $volume .'</span></td>';

				$content .= '<td style="width:75px; border:none; border-bottom:1px solid #e2e2e2;  font-size:11px; ">'. $weight .'</td>';
				$content .= '</tr>';


			}
		}


				$content .= '</table>';


if ($lineas<3) {

	$content .= '<div style="padding:42px; position:relative; top:-35px;">';
		$content .= '<img style="width:580px;" src="map.jpg">';
		$content .= '</div>';
  
}elseif($lineas<6) {

	$content .= '<div style="padding:42px; position:relative; left:20px; top:-35px;">';
		$content .= '<img style="width:530px;" src="map.jpg">';
		$content .= '</div>';
}else{

	$content .= '<PAGE pagegroup="new" >';

$content .= '<div style="padding:42px; position:relative; top:10px;">';
		$content .= '<img style="width:680px;" src="map.jpg">';
		$content .= '</div>';
$content .= '</PAGE>';

}






		$content .= '</div>';



			
		
		
		
		
		
		
                
$content .= '</div>';


// conversion HTML => PDF
require_once(dirname(__FILE__).'/html2pdf/html2pdf.class.php');
try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'en');
    $html2pdf->AddFont('freesans', 'normal', 'freesans.php');
    $html2pdf->setDefaultFont('freesans');

    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('JobOrder_'.$id.'.pdf'); 
}
catch(HTML2PDF_exception $e) { echo $e; }
?>