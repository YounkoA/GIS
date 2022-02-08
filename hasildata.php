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

$from=$_POST['asal'];
$to=$_POST['tujuan'];

$dataJson = file_get_contents("https://maps.googleapis.com/maps/api/distancematrix/json?units=metric&origins=".$from."&destinations=".$to."&key=%20AIzaSyCWpwVwu1hO6TJW1H8x_zlhrLfbSbQ2r3o");

$data = json_decode($dataJson,true);
$nilaiJarak = $data['rows'][0]['elements'][0]['distance']['text'];
$time=$data['rows'][0]['elements'][0]['duration']['text'];
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
            <strong><?php echo $nilaiJarak;?></strong>
            </p>
            <p>
            Perkiraan Waktu Tempuh : <p>
            <strong><?php echo $time;?></strong>
            </p>
        </div>
</div>


<?php
}else{
    echo "<p class='alert alert-danger'><i class='fa fa-info-circle'></i> <b>Maaf Bos</b>, Silahkan Pilih Lokasi</p>";
}

?>