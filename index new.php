<?php
include "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>siGAS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="custom.css">

    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="../assets/css/mdb.css">
    <link rel="stylesheet" href="../assets/css/mdb-min.css">
  
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
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 12px}
/* Set the width of the sidebar to 120px */
.w3-sidebar {width: 120px;background: #F0FFFF;}
/* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
#main {margin-left: 120px}
/* Remove margins from "page content" on small screens */
@media only screen and (max-width: 600px) {#main {margin-left: 0}}
</style>
</head><body class="w3-cyan" style="">
<!-- <nav class="navbar navbar-default">
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
        <li class="active"><a href="index.php">Home</a></li>
        <li ><a href="hitungjarak.php">Hitung Jarak</a></li>
        <li><a href="wilayah.php">Wilayah</a></li>
        <li><a href="about.php">Rute</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="login/index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li></ul>
     </div>
  </div>
</nav> -->
<nav class="w3-sidebar w3-bar-block w3-small w3-hide-small w3-center">
  <!-- Avatar image in top left corner -->
  <img src="7.jpg" style="width:100%">
  <a href="index.php" class="w3-bar-item w3-button w3-padding-large w3-light-blue">
    <i class="fa fa-home w3-xxlarge"></i>
    <p>HOME</p>
  </a>
  <a href="about.php" class="w3-bar-item w3-button w3-padding-large w3-hover-light-blue">
    <i class="fa fa-user w3-xxlarge"></i>
    <p>ABOUT</p>
  </a>
  <a href="wilayah.php" class="w3-bar-item w3-button w3-padding-large w3-hover-light-blue">
    <i class="fa fa-eye w3-xxlarge"></i>
    <p>Ant Colony</p>
  </a>
  <a href="hitungjarak.php" class="w3-bar-item w3-button w3-padding-large w3-hover-light-blue">
    <i class="fa fa-envelope w3-xxlarge"></i>
    <p>CONTACT</p>
  <a href="login/index.php" class="w3-bar-item w3-button w3-padding-large w3-hover-light-blue">
    <i class="glyphicon glyphicon-log-in w3-xxlarge"></i>
    <p>LOGIN</p>
  </a>
  </a>
</nav>

<!-- Navbar on small screens (Hidden on medium and large screens) -->
<div class="w3-top w3-hide-large w3-hide-medium" id="myNavbar">
  <div class="w3-bar w3-cyan w3-opacity w3-hover-opacity-off w3-center w3-small">
    <a href="index.php" class="w3-bar-item w3-button" style="width:25% !important">HOME</a>
    <a href="about.php" class="w3-bar-item w3-button" style="width:25% !important">ABOUT</a>
    <a href="wilayah.php" class="w3-bar-item w3-button" style="width:25% !important">PHOTOS</a>
    <a href="hitungjarak.php" class="w3-bar-item w3-button" style="width:25% !important">CONTACT</a>
  </div>
</div>
  <header class="w3-container w3-padding-15 w3-center w3-hover-teal" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small">siGAS</h1>
    <p>Place Distribution of GAS</p>
  </header>

<div class="w3-content w3-justify w3-text-grey w3-hax">  
<div id="map" style="width:1100px;"></div>
</div>

<div class="w3-content w3-justify w4-text-grey w3-hax">  
	<br>
<!----------------------- ini bagian tambah data ----------------------------->
<?php
if(isset($_POST['save'])){
$id=myaddslashes($_POST['id']);
$nama=myaddslashes($_POST['nama']);
$alamat=myaddslashes($_POST['alamat']);
$lat=myaddslashes($_POST['lat']);
$lng=myaddslashes($_POST['lng']);
$save=mysqli_query($conn,"INSERT INTO tbl_lokasi VALUES ('$id','$nama','$alamat','$lat','$lng')");
if($save){
echo "<p class='alert alert-success'>Data Berhasil Di Simpan</p>";
}else{
echo "<p class='alert alert-danger'>Data Gagal Di SImpan</p>";
}
echo "<script>document.location='index.php'</script>";
}
?>
<!-- -------------------------------------------------------------------------- -->
<?php
if(isset($_POST['update'])){
$nama=myaddslashes($_POST['nama']);
$alamat=myaddslashes($_POST['alamat']);
$lat=$_POST['lat'];
$lng=$_POST['lng'];
mysqli_query($conn,"UPDATE tbl_lokasi SET namalokasi='$nama', alamat='$alamat', lat='$lat', lng='$lng' WHERE id_lokasi='".$_POST['id_lokasi']."'") or die (mysqli_error());
echo "<script>document.location='index.php'</script>";
}?>

<?php
if(isset($_GET['hapus'])){
$id=$_GET['hapus'];
mysqli_query($conn,"DELETE FROM tbl_lokasi WHERE id_lokasi='$id'");
echo "<script>document.location='index.php'</script>";
}?>

 <div class="panel panel-primary">
    <div class="panel-heading">
                <h2><i class="fa fa-map-marker"></i> Tabel Lokasi Pangkalan Gas LPG</h2>

    </div>
    <div class="panel-body">
      
        <div class="w3-responsive">
        <table class="w3-table-all">
                <thead>
                <tr>
                <th>NAMA PANGKALAN</th>
                <th>ALAMAT PANGKALAN</th>
                <th>STATUS</th>
                <th>LATITUDE</th>
                <th>LONGITUDE</th>
                <!-- <td class='text-center'><a class="btn btn-primary" data-target='#modal-add' data-toggle='modal'><i class="fa fa-plus-circle"></a></td> -->
                </tr>
                </thead>
        <tbody>
        <?php
         $tampil=mysqli_query($conn,"SELECT*FROM tbl_lokasi");
         while($datatampil=mysqli_fetch_assoc($tampil)){
         echo "<tr>";
         echo "<td>".mystripslashes($datatampil['namalokasi'])."</td>";
         echo "<td>".mystripslashes($datatampil['alamat'])."</td>";
         ?>
         <td><label class='switch status'><input disabled type='checkbox' <?php if ($datatampil['status']==0) {echo "unchecked";}else{echo "checked";} ?> data-toggle='toggle' data-onstyle='primary'><span class='slider round'></span></label></td>
         <?php
         echo "<td>".$datatampil['lat']."</td>";
         echo "<td>".$datatampil['lng']."</td>";
         }
         ?>
         </tbody>
         </table>
         </div>
        
     </div>
</div>


 <div id="modal-edit" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
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
        <div class="form-group">
            <label for="nama">ID</label>
            <input type="text" name="id" class="form-control" id="id_lokasi" placeholder="ID" required>
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
        <hr>
        <button type="submit" name="save" class="btn btn-primary">Simpan Data</button>
        </form>

        </div>
     </div>

  </div>
</div>
</div>

  </div>
 </div>
<footer class="w3-content w3-padding-64 w3-text-white w3-xlarge">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
    <p class="w3-medium">Powered by <a href="https://twitter.com/ilyas_ihsan" target="_blank" class="w3-hover-text-green">Ihsan Ilyas</a></p>
  <!-- End footer -->
  </footer>
  </body>
</html>


<!-- --------------------------css-------------------------------------- -->
<style>
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
  height: 26px;
  width: 26px;
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