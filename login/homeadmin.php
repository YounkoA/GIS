<?php
include "conn.php";
session_start();

//cek apakah user sudah login
if(!isset($_SESSION['userid'])){
die("Anda belum login");//jika belum login jangan lanjut..
}

//cek level user
if($_SESSION['level']!="admin"){
die("Anda bukan admin");//jika bukan admin jangan lanjut
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin siGAS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="custom.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKH2F9gZMQyATwBodQsEr-uM0fokVCvZw&callback=initMap"></script>

    
    <script>
  
  
  
      
    var marker;
      function initialize() {
        
        
        
        // Variabel untuk menyimpan informasi (desc)
        var infoWindow = new google.maps.InfoWindow;
      
        //  Variabel untuk menyimpan peta Roadmap
        var mapOptions = {
           zoom: 4,
           mapTypeId: google.maps.MapTypeId.ROADMAP
        }
      
        // Pembuatan petanya
        var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            
        // Variabel untuk menyimpan batas kordinat
        var bounds = new google.maps.LatLngBounds();

        // Pengambilan data dari database
        <?php
            $query = mysqli_query($conn,"select * from tbl_lokasi");
            if(mysqli_num_rows($query) < 1){?>
               //peta tanpa marker-2.5446949,118.3207873,5.29z
        var properti_peta = {
                    center: new google.maps.LatLng(-2.5446949, 118.3207873),
                    zoom: 4,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                 var peta = new google.maps.Map(document.getElementById("map"), properti_peta);
             //end
          

            <?php
            }else{
            while ($data = mysqli_fetch_array($query))
            {
                $nama = mystripslashesjs($data['namalokasi']);
                $alamat = mystripslashesjs($data['alamat']);
                $lat = $data['lat'];
                $lng = $data['lng'];
                $alamat = str_replace(array("\r","\n"),"",$alamat);
                echo ("addMarker($lat, $lng, '<b>$nama</b><br>$alamat');");              
              
            }
            }
          ?>
        
        // Proses membuat marker
        function addMarker(lat, lng, info) {
            var lokasi = new google.maps.LatLng(lat, lng);
            bounds.extend(lokasi);
            var marker = new google.maps.Marker({
                map: map,
                 position: lokasi,
              
            });      
            map.fitBounds(bounds);
            bindInfoWindow(marker, map, infoWindow, info);
         }
      
        // Menampilkan informasi pada masing-masing marker yang diklik
        function bindInfoWindow(marker, map, infoWindow, html) {
          google.maps.event.addListener(marker, 'click', function() {
            infoWindow.setContent(html);
            infoWindow.open(map, marker);
          });
        }

        }
      google.maps.event.addDomListener(window, 'load', initialize);
  
  
  
     $(document).ready(function(){
        $('#modal-edit').on('show.bs.modal', function (e) {
            var idx = $(e.relatedTarget).data('id');
             $.ajax({
                type : 'post',
                url : 'detaildata.php',
                data :  'idx='+ idx,
                success : function(data){
                $('.hasil-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });


      </script>
      <style>
        
      </style></head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
   <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">si<b>GAS</b></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a class="active" href="homeadmin.php">Home</a></li>
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Hitung Jarak <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li ><a href="../hitungjarak.php">Djikstra</a></li>
                <li><a href="../wilayah.php">Ant Colony</a></li>
            </ul>
        </li>
        <li><a href="../rute.php">About</a></li>
          </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="../login/index.php"><span class="glyphicon glyphicon-log-in"></span> Relogin</a></li>
        <li><a href="../index.php"><span class="glyphicon glyphicon-home"></span> LogOut</a></li>
        <li><a class="btn btn-info"><?php echo "Welcome ".$_SESSION['userid']."";?></a></li>
    </ul>
     </div>
  </div>
</nav>
<br>
<br>
  <header class="w3-container w3-center" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small">si</span>GAS</h1>
    <p>Gas Distribution Information System.</p>
<!--     <img src="img/12.jpg" alt="boy" class="w3-image" width="1500" height="500"> -->
  </header>

<div class="container-fluid">
<div class="row">
<div class="col-md-12">  
<div id="map" style="height:500px;"></div>
</div>

<div class="col-md-12">  
  <br>
<!----------------------- ini bagian tambah data ----------------------------->
<?php
if(isset($_POST['save'])){
// $id=myaddslashes($_POST['id_lokasi']);
$id_gd=myaddslashes($_POST['id_gd']);
$nama=myaddslashes($_POST['nama']);
$alamat=myaddslashes($_POST['alamat']);
$lat=myaddslashes($_POST['lat']);
$lng=myaddslashes($_POST['lng']);
$status=myaddslashes($_POST['status']);
$save=mysqli_query($conn,"INSERT INTO tbl_lokasi VALUES ('','$id_gd','$nama','$alamat','$lat','$lng','$status')");
if($save){
echo "<p class='alert alert-success'>Data Berhasil Di Simpan</p>";
}else{
echo "<p class='alert alert-danger'>Data Gagal Di SImpan</p>";
}
echo "<script>document.location='homeadmin.php'</script>";
}
?>

<!-- -------------------------------------------------------------------------- -->
<?php
if(isset($_POST['update'])){
$nama=myaddslashes($_POST['nama']);
$id_gd=myaddslashes($_POST['id_gd']);
$alamat=myaddslashes($_POST['alamat']);
$lat=$_POST['lat'];
$lng=$_POST['lng'];
$status=myaddslashes($_POST['status']);
mysqli_query($conn,"UPDATE tbl_lokasi SET namalokasi='$nama', id_gd='$id_gd', alamat='$alamat', lat='$lat', lng='$lng' WHERE id_lokasi='".$_POST['id_lokasi']."'") or die (mysqli_error());
echo "<script>document.location='homeadmin.php'</script>";
}?>

<?php
if(isset($_GET['hapus'])){
$id=$_GET['hapus'];
mysqli_query($conn,"DELETE FROM tbl_lokasi WHERE id_lokasi='$id'");
echo "<script>document.location='homeadmin.php'</script>";
}?>

 <div class="panel panel-primary">
    <div class="panel-heading">
                <h2><i class="fa fa-map-marker"></i> Tabel Lokasi Pangkalan Gas LPG</h2>
    </div>
<!-- ---------------tabel lokasi----------------------- -->
    <div class="panel-body">
      
        <div class="table-responsive">
        <table class="table table-striped">
                <thead>
                <tr>
                <th>NAMA</th>
                <th>ALAMAT PANGKALAN</th>
                <th>STATUS</th>
                <th>LATITUDE</th>
                <th>LONGITUDE</th>
                <td class='text-center'><a data-target='#modal-add' data-toggle='modal'><i class="btn btn-success">+ DATA</a></td>
                </tr>
                </thead>
        <tbody>
        <?php
         $tampil=mysqli_query($conn,"SELECT*FROM tbl_lokasi order by id_lokasi");
         while($datatampil=mysqli_fetch_assoc($tampil)){
         echo "<tr>";
         echo "<td>".mystripslashes($datatampil['namalokasi'])."</td>";
         echo "<td>".mystripslashes($datatampil['alamat'])."</td>";
         echo "<td>".mystripslashes($datatampil['status'])."</td>";
         ?>
         <!-- <td><label class='switch status'><input type='checkbox' data-id='<?php echo $datatampil['id_lokasi']; ?>' value="<?php echo $datatampil['status']; ?>" <?php if ($datatampil['status']==0) {echo "unchecked";}else{echo "checked";} ?> data-toggle='toggle' data-onstyle='primary'><span class='slider round'></span></label></td> -->
         <?php
         echo "<td>".$datatampil['lat']."</td>";
         echo "<td>".$datatampil['lng']."</td>";
         echo "<td class='text-center'><a href='#modal-edit' data-id='$datatampil[id_lokasi]' data-toggle='modal'><i class='btn btn-primary'>Edit</i></a>
         <a href='?hapus=$datatampil[id_lokasi]'><i class='btn btn-danger'>Hapus</i></a></td>";
         echo "</tr>";
         }
         ?>
         </tbody>
         </table>
         </div>
        
     </div>
</div>

 
<!-- ------------------modal conten---------------------------------- -->
 <div id="modal-edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-pencil-square"></i> Update Data</h4>
      </div>
      <div class="modal-body">
                <div class="hasil-data"></div>

        </div>
     </div>

  </div>
</div>


 <div id="modal-add" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Tambah Data</h4>
      </div>
      <div class="modal-body">
        
         <form method="POST" action="">
       <!--  <div class="form-group">
            <label for="nama">ID</label>
            <input type="text" name="id" class="form-control" id="id_lokasi" placeholder="ID" required>
        </div> -->
        <div class="form-group">
            <label for="nama">ID Gudang</label>
            <input type="text" name="id_gd" class="form-control" id="id_gd" placeholder="ID Gudang" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama Lokasi</label>
            <input type="text" name="nama" class="form-control" id="nama" placeholder="Nama Lokasi" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" id="alamat" Placeholder="Alamat" required></textarea>
         </div>
        <div class="form-group">
            <label for="lat">Latitude</label>
            <input type="text" name="lat" class="form-control" id="lat" placeholder="Posisi Latitude" required>
        </div>
        <div class="form-group">
            <label for="lng">Longitude</label>
            <input type="text" name="lng" class="form-control" id="lng" placeholder="Posisi Longitude" required>
        </div>
        <div class="form-group">
            <label for="nama">Status</label>
            <input type="text" name="status" class="form-control" id="status" placeholder="Status" required>
        </div>
        <hr>
        <button type="submit" name="save" class="btn btn-primary">Simpan Data</button>
        </form>

        </div>
     </div>
 </div>
</div>
 
<!-- -----------------------------------ini bagian gudang---------------------------------------- -->
<!-- <div class="col-md-12">  
  <br> -->
<!----------------------- ini bagian tambah data gd----------------------------->
<!-- <?php
if(isset($_POST['save_gd'])){
$id=myaddslashes($_POST['id_gd']);
$nama=myaddslashes($_POST['n_gd']);
$alamat=myaddslashes($_POST['a_gd']);
$lat=myaddslashes($_POST['lat']);
$lng=myaddslashes($_POST['lng']);
$save=mysqli_query($conn,"INSERT INTO tbl_gd VALUES ('$id_gd','$n_gd','$a_gd','$lat','$lng')");
if($save){
echo "<p class='alert alert-success'>Data Berhasil Di Simpan</p>";
}else{
echo "<p class='alert alert-danger'>Data Gagal Di SImpan</p>";
}
echo "<script>document.location='homeadmin.php'</script>";
}
?> -->

<!-- -------------------------------------------------------------------------- -->
<!-- <?php
if(isset($_POST['update_gd'])){
$nama=myaddslashes($_POST['n_gd']);
$alamat=myaddslashes($_POST['a_gd']);
$lat=$_POST['lat'];
$lng=$_POST['lng'];
mysqli_query($conn,"UPDATE tbl_gd SET namalokasi='$n_gd', alamat='$a_gd', lat='$lat', lng='$lng' WHERE id_gd='".$_POST['id_gd']."'") or die (mysqli_error());
echo "<script>document.location='homeadmin.php'</script>";
}?>

<?php
if(isset($_GET['hapus_gd'])){
$id=$_GET['hapus_gd'];
mysqli_query($conn,"DELETE FROM tbl_gd WHERE id_gd='$id'");
echo "<script>document.location='homeadmin.php'</script>";
}?>

 <div class="panel panel-primary">
    <div class="panel-heading">
                <h2><i class="fa fa-map-marker"></i> Tabel Lokasi Gudang Gas LPG</h2>
    </div> -->
<!-- ---------------tabel lokasi----------------------- -->
<!--     <div class="panel-body">
      
        <div class="table-responsive">
        <table class="table table-striped">
                <thead>
                <tr>
                <th>NAMA</th>
                <th>ALAMAT Gudang</th>
                <th>LATITUDE</th>
                <th>LONGITUDE</th>
                <td class='text-center'><a data-target='#gd-add' data-toggle='gd'><i class="btn btn-success">+ Gudang</a></td>
                </tr>
                </thead>
        <tbody>
        <?php
         $tampil=mysqli_query($conn,"SELECT*FROM tbl_gd");
         while($datatampil=mysqli_fetch_assoc($tampil)){
         echo "<tr>";
         echo "<td>".mystripslashes($datatampil['n_gd'])."</td>";
         echo "<td>".mystripslashes($datatampil['a_gd'])."</td>";
         echo "<td>".$datatampil['lat']."</td>";
         echo "<td>".$datatampil['lng']."</td>";
         echo "<td class='text-center'><a href='#gd-edit' data-id='$datatampil[id_gd]' data-toggle='gd'><i class='btn btn-primary'>Edit</i></a>
         <a href='?hapus=$datatampil[id_gd]'><i class='btn btn-danger'>Hapus</i></a></td>";
         echo "</tr>";
         }
         ?>
         </tbody>
         </table>
         </div>
        
     </div>
</div> -->

 
<!-- ------------------modal conten---------------------------------- -->
<!--  <div id="gd-edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-pencil-square"></i> Update Gudang</h4>
      </div>
      <div class="modal-body">
                <div class="hasil-data"></div>

        </div>
     </div>

  </div>
</div>


 <div id="gd-add" class="modal fade" role="dialog">
  <div class="modal-dialog"> -->

    <!-- Modal content-->
<!--     <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><i class="fa fa-plus-circle"></i> Tambah Gudang</h4>
      </div>
      <div class="modal-body">
        
         <form method="POST" action="">
        <div class="form-group">
            <label for="nama">ID</label>
            <input type="text" name="id_gd" class="form-control" id="id_gd" placeholder="ID" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama Lokasi</label>
            <input type="text" name="n_gd" class="form-control" id="n_gd" placeholder="Nama Lokasi" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="a_gd" class="form-control" id="a_gd" Placeholder="Alamat" required></textarea>
         </div>
        <div class="form-group">
            <label for="lat">Latitude</label>
            <input type="text" name="lat" class="form-control" id="lat" placeholder="Posisi Latitude" required>
        </div>
        <div class="form-group">
            <label for="lng">Longitude</label>
            <input type="text" name="lng" class="form-control" id="lng" placeholder="Posisi Longitude" required>
        </div>
        <hr>
        <button type="submit" name="save_gd" class="btn btn-primary">Simpan Data</button>
        </form>

        </div>
     </div>
 </div>
</div> -->
<footer class="text-center" class="w3-content w3-padding-64 w3-text-black w3-xxlarge">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-whatsapp w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-google w3-hover-opacity"></i>
    <p class="w3-medium">Powered by <a href="https://twitter.com/ilyas_ihsan" target="_blank" class="w3-hover-text-green">Ihsan Ilyas</a></p>
  </footer>
  </body>
</html>

<!-- --------------------------css-------------------------------------- -->
<style>
$(document).ready(function(){
    $(".dropdown-toggle").dropdown('toggle');
}); 

.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {display:none;}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 25px;
  width: 25px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}
input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

<script>
     $(document).ready(function(){
        $('.status input').click(function () {
            var val=$(this).val();
            var id=$(this).attr('data-id');
            $.ajax({
                url:'fetch-data.php',
                data:{val:val,id:id},
                type:"GET",
                success:function(data) {
                    alert(data);
                }
            });
        });
     });
 </script>