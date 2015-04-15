<!DOCTYPE HTML>
<?php 

require_once 'db.php';

if(!isValidCookie("newsroom")){

?>

<html>
	<head>
	<meta http-equiv="refresh" content="1;url=login.php">
        <script type="text/javascript">
            window.location.href = "login.php"
        </script>
	</head>
</html>

<?

}else{

?>

<html>
	<head>
	<?php require_once 'head.php' ?>
	<link rel="stylesheet" type="text/css" media="screen" href="css/estilos_201503181147.css" />
	</head>
	<body>

<?php require_once 'topmenu.php'; ?>
		
<div class="container">

<h1>Inicio</h1>

<?php

require_once 'functions.php';

$hddtotal = disk_total_space("storage/");
$hddfree = disk_free_space("storage/");
$hddused = $hddtotal-$hddfree;
$hddmath = $hddfree / $hddtotal * 100;
$hdd = round($hddmath,2);
$hddrem = 100-$hdd;

?>

<h3>Uso de disco</h3>
<div class="progress">
  <div class="progress-bar progress-bar-<?php echo progressBarWord($hddrem); ?> progress-bar-striped active" role="progressbar"
  aria-valuenow="<?php echo $hddused; ?>" aria-valuemin="0" aria-valuemax="<?php echo $hddtotal; ?>" style="width:<?php echo $hddrem; ?>%">
    <div style="color: black;"><?php echo "Uso ".$hddrem."% - Libre ".bytesToSizeString($hddfree); ?></div>
  </div>
</div>

<br>

<h3>Predicción Ceuta</h3>

<script type="text/javascript" src="js/jquery.flot.js"></script>
<script type="text/javascript" src="js/jquery.flot.valuelabels.js"></script>
<script type="text/javascript" src="js/jquery.cookie.js"></script>

<div style="">

<?php

$meteoURL = "http://www.aemet.es/es/eltiempo/prediccion/municipios/ceuta-id51001#detallada";
$meteo = file_get_contents($meteoURL); 
$meteo = utf8_encode($meteo);
$meteoIDIni = "<table id=\"tabla_prediccion\"";
$meteoIDFin = "</table>";
$meteoPosIni = strpos($meteo, $meteoIDIni);
$meteoPosFin = strpos($meteo, $meteoIDFin, $meteoPosIni);
$meteoLength = $meteoPosFin-$meteoPosIni;
$meteo = substr($meteo, $meteoPosIni, $meteoLength)."</table>";
$meteo = str_replace("/imagenes/", "http://www.aemet.es/imagenes/", $meteo);
$meteo = str_replace("<table", "<table class=\"table table-bordered table-condensed\" style=\"background-color: white; font-size:85%;\"", $meteo);

echo $meteo;

?>
<br><br><br>

    </div>

</div>

</body>
</html>


<?
}
?>