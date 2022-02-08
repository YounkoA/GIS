<?php
if(!empty($_POST['asal']) AND !empty($_POST['tujuan'])){

function curl_get_contents($url)
{
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
$data = curl_exec($ch);
curl_close($ch);
return $data;
}

$asal=urlencode($_POST['asal']);
$tujuan=urlencode($_POST['tujuan']);
$result= curl_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?units=imperial&origins=$asal&destinations=$tujuan");
$obj = json_decode($result, true);
?>
<div class="panel panel-info">
    <div class="col-md-4"></div>
        <div class="panel-heading">
                <h2><i class="fa fa-car"></i> Hasil Hitung Jarak Dan Waktu Tempuh</h2>
        </div>
            <div class="panel-body">
             Alamat Asal :<p>
            <strong><?php echo $_POST['asal'];?></strong>
            </p>
            <p>
            Alamat Tujuan : <p>
            <strong><?php echo $_POST['tujuan'];?></strong>
            </p>
            <p>
            Jarak Tempuh : <p>
            <strong><?php echo $obj['rows']['0']['elements']['0']['distance']['text'];?></strong>
            </p>
            <p>
            Perkiraan Waktu Tempuh : <p>
            <strong><?php echo $obj['rows'][0]['elements'][0]['duration']['text'];?></strong>
            </p>
        </div>
</div>


<?php
}else{
    echo "<p class='alert alert-danger'><i class='fa fa-info-circle'></i> <b>Maaf Bos</b>, Silahkan Pilih Lokasi</p>";
}

?>