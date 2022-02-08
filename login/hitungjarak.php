<?php 
 include "conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>siGAS</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="custom.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKH2F9gZMQyATwBodQsEr-uM0fokVCvZw&callback=initMap"></script> 
  

</head>
<body>
<nav class="navbar navbar-default">
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
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="hitungjarak.php">Hitung Jarak</a></li>
        </ul>
     </div>
  </div>
</nav>


<div class="container-fluid">
<div class="row">
<div class="col-md-4">
    <div class="panel panel-info">
        <div class="panel-heading">
                <h2><i class="fa fa-car"></i> Hitung Jarak Dan Waktu Tempuh</h2>
        </div>
        <div class="panel-body">
            <form class="form" action="" method="post">
                <div class="form-group">
                    <label for="asal">Lokasi Asal</label>
                    <select id="asal" name="asal" class="form-control" required>
                    <option value="">Pilih Lokasi Asal</option>
                        <?php
                            $query = mysqli_query($conn,"select alamat,namalokasi from tbl_lokasi");
                            while ($data = mysqli_fetch_array($query))
                            {
                            echo "<option value='$data[alamat]'>".mystripslashes($data['namalokasi'])."</option>";
                            }
                
                ?>
                </select>
                </div>
                
                <div class="form-group">
                    <label for="tujuan">Lokasi Tujuan</label>
                    <select id="tujuan" name="tujuan" class="form-control" required>
                    <option value="">Pilih Lokasi Tujuan</option>
                        <?php
                            $query = mysqli_query($conn,"select alamat,namalokasi from tbl_lokasi");
                            while ($data = mysqli_fetch_array($query))
                            {
                            echo "<option value='$data[alamat]'>".mystripslashes($data['namalokasi'])."</option>";
                            }
                
                ?>
                </select>
                </div>
                </form>
                <button class="btn btn-primary btn-hitung" onclick="calcRoute()">Hitung</button>
        </div>
        
        
    </div>
    
    
<div id="hasildata"></div>
</div>

<div class="col-md-8">
<div id="map" style="height:500px;"></div>
</div>
  



</div>
</div>

</div>


    <script>
     var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
   
  function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();
    var latlng = new google.maps.LatLng(5.3816168,95.9615897);
    var mapOptions = {
   zoom: 11,
   center: latlng
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    directionsDisplay.setMap(map);
  }

  function calcRoute() {
    var start = document.getElementById('asal').value;
    var end = document.getElementById('tujuan').value;
    var request = {
     origin:start,
     destination:end,
     travelMode: google.maps.TravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
   if (status == google.maps.DirectionsStatus.OK) {
     directionsDisplay.setDirections(response);
   }
    });
  }

   
   
     google.maps.event.addDomListener(window, 'load', initialize);
   
     $(document).ready(function(){
        $('.btn-hitung').click(function () {
           var data = $('.form').serialize();
           $.ajax({
                type : 'post',
                url : 'hasildata.php',
                data : data,
                success : function(data){
                $('#hasildata').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  
  
      </script>




</body>
</html>