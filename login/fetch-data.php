<?php
	include "conn.php";
	// $_GET['id']=1;
	if (isset($_GET['id'])) {
		$id=$_GET['id'];
		$val=$_GET['val'];
		if ($val==0) {
			$nval=1;
		}else{
			$nval=0;
		}

		mysqli_query($conn,"UPDATE tbl_lokasi set status='$nval' where id_lokasi='$id'");
		if ($nval==0) {
			echo "Pangkalan Tidak aktif";
		}else{
			echo "Pangkalan aktif";
		}
	}
?>