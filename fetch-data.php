<?php 
	include 'conn.php';
	$idgd= $_POST['idgd'];
	if($idgd != 4){
	$q=mysqli_query($conn,"SELECT * From tbl_lokasi where id_gd ='$idgd'");
    }else{
    $q=mysqli_query($conn,"SELECT * From tbl_lokasi ");
    }
	while ($data=mysqli_fetch_array($q)) {

?>
		
		<option value='<?php echo $data['lat']; ?>,<?php echo $data['lng']; ?>'><?php echo $data['namalokasi']; ?></option>
<?php
	}

?>