<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/estilos_201503181147-c.css" />
</head>
<body>

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
//$meteo = str_replace("<table", "<table style=\"background-color: white;\"", $meteo);

echo $meteo;

?>


</body>
</html>