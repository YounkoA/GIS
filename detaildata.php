<?php
include "conn.php";

$tampiledit=mysqli_query($conn,"SELECT*FROM tbl_lokasi WHERE id_lokasi='".$_POST['idx']."'");
$datatampiledit=mysqli_fetch_assoc($tampiledit);?>

<form method="POST" action="">
<div class="form-group">
    <label for="nama">Nama Lokasi</label>
    <input type="hidden" name="id_lokasi" class="form-control" value="<?php echo $datatampiledit['id_lokasi']?>" required>
    <input type="text" name="nama" class="form-control" value="<?php echo mystripslashes($datatampiledit['namalokasi'])?>" id="nama" placeholder="Nama Lokasi" required>
</div>
<div class="form-group">
    <label for="alamat">Alamat</label>
    <textarea name="alamat" class="form-control" id="alamat" Placeholder="Alamat" required><?php echo mystripslashes($datatampiledit['alamat'])?></textarea>
 </div>
<div class="form-group">
    <label for="lat">Latitude</label>
    <input type="text" name="lat" class="form-control" value="<?php echo $datatampiledit['lat']?>"  id="lat" placeholder="Posisi Latitude" required>
</div>
<div class="form-group">
    <label for="lng">Longitude</label>
    <input type="text" name="lng" class="form-control" value="<?php echo $datatampiledit['lng']?>"  id="lng" placeholder="Posisi Longitude" required>
</div>
        <hr>

 <button type="submit" name="update" class="btn btn-primary">Simpan Update Data</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
 </form>
      

