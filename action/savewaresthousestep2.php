<?php 

	error_reporting(0);
	require_once('conn.php');

		$warehouse_id=$_POST['warehouse_id'];
		$byBoxes_piecesx=$_POST['byBoxes_piecesx'];
		$byBoxes_lenghtX=$_POST['byBoxes_lenghtX'];
		$byBoxes_widthX=$_POST['byBoxes_widthX'];
		$byBoxes_heightX=$_POST['byBoxes_heightX'];
		$byBoxes_weightX=$_POST['byBoxes_weightX'];

		$ruta="../images/warehouse/";//ruta carpeta donde queremos copiar las imágenes     
		
        $uploadfile_temporal1=$_FILES['image_file']['tmp_name'];
        $extension1 = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $filename=$_FILES['image_file']['name'];
        $path_parts = pathinfo($filename);
        $filename= $path_parts['filename'];

    if ($uploadfile_temporal1=='') {
    }else{
        $uploadfile_nombre1=$ruta.time().$filename.'.'.$extension1; 


        if (is_uploaded_file($uploadfile_temporal1)) 
        { 
            move_uploaded_file($uploadfile_temporal1,$uploadfile_nombre1); 
        } 
        
	}
	$total_pieces=$_POST['total_pieces'];
	$total_weight=$_POST['total_weight'];
	$total_volume=$_POST['total_volume'];
	$total_charg_weight=$_POST['total_charg_weight'];
	$queryModel = mysqli_query($connect, "UPDATE warehouse SET image_url='$uploadfile_nombre1',total_pieces='$total_pieces',total_weight='$total_weight',total_volume='$total_volume',total_charg_weight='$total_charg_weight' WHERE id='$warehouse_id' ") or die ('error');
	
	if(isset($_POST['byBoxes_piecesx']) && !empty($_POST['byBoxes_piecesx'])){
        $queryModel = mysqli_query($connect, "DELETE FROM warehousecontents WHERE warehouse_id='$warehouse_id' and type=''");  
        foreach($_POST['byBoxes_piecesx'] as $key=>$item){
            if($_POST['byBoxes_piecesx'][$key]){
                $querywarehousecontents = mysqli_query($connect, "INSERT INTO warehousecontents(warehouse_id, byBoxes_pieces, byBoxes_lenght, byBoxes_width, byBoxes_height, byBoxes_weight) 
                VALUES ('$warehouse_id', '".$_POST['byBoxes_piecesx'][$key]."', '".$_POST['byBoxes_lenghtX'][$key]."', '".$_POST['byBoxes_widthX'][$key]."', '".$_POST['byBoxes_heightX'][$key]."', '".$_POST['byBoxes_weightX'][$key]."' )");
 
            }
        }
	}
	
	echo "<meta http-equiv=\"refresh\" content=\"0;URL= ../createWarehouse.php?step=1\">"; 

 ?>