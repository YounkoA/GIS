<!DOCTYPE html>
<html lang="en">
<head>
<title>About siGAS</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="custom.css">
<link rel="stylesheet" type="text/css" href="style.css" media="all" />
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cookie">
    <link rel="stylesheet" href="../assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/Pretty-Footer.css">
    <link rel="stylesheet" href="../assets/css/mdb.css">
    <link rel="stylesheet" href="../assets/css/mdb-min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAKH2F9gZMQyATwBodQsEr-uM0fokVCvZw&callback=initMap"></script>
<style>
body, h1,h2,h3,h4,h5,h6 {font-family: "Montserrat", sans-serif}
.w3-row-padding img {margin-bottom: 12px}
/* Set the width of the sidebar to 120px */
.w3-sidebar {width: 120px;background: #222;}
/* Add a left margin to the "page content" that matches the width of the sidebar (120px) */
#main {margin-left: 30px}
/* Remove margins from "page content" on small screens */
@media only screen and (max-width: 600px) {#main {margin-left: 0}}
</style>

</head>
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
        <li><a href="index.php">Home</a></li>
            <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="dropdown-toggle">Hitung Jarak <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="hitungjarak.php">Djikstra</a></li>
                <li><a href="wilayah.php">Ant Colony</a></li>
            </ul>
        </li>
        <li class="active"><a href="about.php">About</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li><a href="login/index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li></ul>
     </div>
  </div>
</nav>
<br>
<br>
<!-- <div class="w3-padding-large" id="main"> -->
  <header class="w3-container w3-row-padding w3-center w3-dark-grey" id="home">
    <h1 class="w3-jumbo"><span class="w3-hide-small">si</span>GAS</h1>
    <p>Gas Distribution Information System.</p>
<!--     <img src="img/12.jpg" alt="boy" class="w3-image" width="1500" height="500"> -->
  </header>

  <!-- About Section -->
  <div class="w3-content w3-justify w3-text-grey w3-collapse" id="about">
    <h2 class="w3-text-black">siGAS</h2>
    <hr style="width:200px" class="w3-opacity">
    <p>Adalah sebuah sistem aplikasi berbasis web yang bergerak dalam bidang pencarian rute distribusi gas LPG, adapun rute yang digunakan adalah rute distribusi gas yang dilakukan oleh SPBE PT.Rahmat Seulawah Jantan yang berada di Kab.Pidie Jaya menuju ke lokasi gudang/pangkalan yang ada diwilayah kota Sigli, kec Simpang Tiga dan wilayah sekitarya. <p>
      Aplikasi ini terdapat beberapa menu yaitu Home, Hitung Jarak (Djikstra/Ant Colony), About dan Login. 
      Pada aplikasi siGAS ini menggunakan dua metode pencarian yaitu Djikstra dan Ant Colony untuk menentukan rute tercepat distribusi gas.
    </p>
    
    <!-- Grid for pricing tables -->
    <h3 class="w3-padding-16 w3-text-black">Perbedaan</h3>
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-half w3-margin-bottom">
        <ul class="w3-ul w3-white w3-center w3-opacity w3-hover-opacity-off">
          <li class="w3-dark-grey w3-xlarge w3-padding-32">Djikstra</li>
          <li class="w3-padding-16">Pilih Lokasi</li>
          <li class="w3-padding-16">Waktu tempuh</li>
          <li class="w3-padding-16">Jarak tempuh</li>
          <li class="w3-padding-16">2 in 1</li>
          <li class="w3-padding-16">
            <h2>85 %</h2>
            <span class="w3-opacity">Akurasi</span>
          </li>
          <li class="w3-light-grey w3-padding-24">
            <button class="w3-button w3-white w3-padding-large w3-hover-black"><a href="hitungjarak.php">Find Location</button></a>
          </li>
        </ul>
      </div>

      <div class="w3-half">
        <ul class="w3-ul w3-white w3-center w3-opacity w3-hover-opacity-off">
          <li class="w3-dark-grey w3-xlarge w3-padding-32">Ant Colony</li>
          <li class="w3-padding-16">Tandai Lokasi</li>
          <li class="w3-padding-16">Waktu tempuh</li>
          <li class="w3-padding-16">-</li>
          <li class="w3-padding-16">10 in 1</li>
          <li class="w3-padding-16">
            <h2>90 %</h2>
            <span class="w3-opacity">Akurasi</span>
          </li>
          <li class="w3-light-grey w3-padding-24">
            <button class="w3-button w3-white w3-padding-large w3-hover-black"><a href="wilayah.php">Find Location</button></a>
          </li>
        </ul>
      </div>
    </div>
    <!-- End Grid/Pricing tables -->
    <h3 class="w3-padding-16 w3-text-black">Akurasi Pencarian</h3>
    <p class="w3-wide">Djikstra</p>
    <div class="w3-white">
      <div class="w3-dark-grey" style="height:28px;width:80%"></div>
    </div>
    <p class="w3-wide">Ant Colony</p>
    <div class="w3-white">
      <div class="w3-dark-grey" style="height:28px;width:90%"></div>
    </div>

  </div>
  <!-- Portfolio Section -->
  <div class="w3-padding-64 w3-content" id="photos">
    <h2 class="w3-text-black">Grafik Perbandingan</h2>
    <hr style="width:200px" class="w3-opacity">

    <!-- Grid for photos -->
    <div class="w3-row-padding" style="margin:0 -16px">
      <div class="w3-half">
        <img src="img/10.png" style="width:1000px">
      </div>
      </div>
    <!-- End photo grid -->
    </div>
  <!-- End Portfolio Section -->
  </div>

  <!-- Contact Section -->
  <div class="w3-padding-50 w3-content w3-text-black" id="contact">
    <h2 class="w3-text-black">Contact Me</h2>
    <hr style="width:200px" class="w3-opacity">

    <div class="w3-section">
      <p><i class="fa fa-map-marker fa-fw w3-text-black w3-xxlarge w3-margin-right"></i> Aceh, INA</p>
      <p><i class="fa fa-phone fa-fw w3-text-black w3-xxlarge w3-margin-right"></i> Phone: +62 81269259910</p>
      <p><i class="fa fa-envelope fa-fw w3-text-black w3-xxlarge w3-margin-right"> </i> Email: ihsanilyas17@.com</p>
    </div><br>
    <p>Send me a message:</p>

    <form action="/action_page.php" target="_blank">
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Name" required="" name="Name"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Email" required="" name="Email"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Subject" required="" name="Subject"></p>
      <p><input class="w3-input w3-padding-16" type="text" placeholder="Message" required="" name="Message"></p>
      <p>
        <button class="w3-button w3-dark-grey w3-padding-large" type="submit">
          <i class="fa fa-paper-plane"></i> SEND MESSAGE
        </button>
      </p>
    </form>
  <!-- End Contact Section -->
  </div>
  
<footer class="text-center" class="w3-content w3-padding-64 w3-text-black w3-xxlarge">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-whatsapp w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-google w3-hover-opacity"></i>
    <p class="w3-medium">Powered by <a href="https://twitter.com/ilyas_ihsan" target="_blank" class="w3-hover-text-black">Ihsan Ilyas</a></p>
  </footer>

<!-- END PAGE CONTENT -->
</div>


<input id="ext-version" type="hidden" value="1.3.5"></body></html>