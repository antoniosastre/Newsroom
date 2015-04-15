<?php 

function bytesToSizeString($bytes){

	$fileSize = $bytes;
			$fileUnit = 0;

			while ($fileSize >= 1000){
				$fileSize = $fileSize/1000;
				$fileUnit++;
			}

			$fileSize = round($fileSize, 2);

			$fileSize = number_format($fileSize, 2, ",",".");

			switch ($fileUnit) {
				case '0':
					$fileUnit = "B";
					break;

				case '1':
					$fileUnit = "KB";
					break;

				case '2':
					$fileUnit = "MB";
					break;

				case '3':
					$fileUnit = "GB";
					break;
				
				case '4':
					$fileUnit = "TB";
					break;

				case '5':
					$fileUnit = "PB";
					break;
				
				default:
					$fileUnit = "--";
					break;
			}

			$fileSize = $fileSize." ".$fileUnit;
			return $fileSize;

}

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function fechaNormal($fecha){
	if ($fecha){
	preg_match( "#([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})#", $fecha, $mifecha); 
	$lafecha=$mifecha[3]." / ".$mifecha[2]." / ".$mifecha[1];
	return $lafecha;
	}
	return null;
}

function fechaSQL($fecha){
	if ($fecha){
	preg_match( "#([0-9]{1,2})/([0-9]{1,2})/([0-9]{2,4})#", $fecha, $mifecha);
	$lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
	return $lafecha;
	}
	return null;
}

function secondsToTimeString($init){



	$hours = floor($init / 3600);
	$minutes = floor(($init / 60) % 60);
	$seconds = round(fmod($init, 60));

	if(!empty($hours)){

		return $hours."h ".$minutes."m ".$seconds."s";

	}else if(!empty($minutes)){

		return $minutes."m ".$seconds."s";

	}else{

		return $seconds." sec.";

	}


}


function printVideoRows($res){

	echo "<table class=\"table table-striped table-bordered table-condensed\">";

	echo "<thead><tr>";
	echo "<th>ID</th><th>Título</th><th>Grabado</th><th>Duración</th><th>Peso</th><th>Resolución</th><th>FPS</th><th>Tipo</th>";
	echo "</tr></thead><tbody>";

	while($video = mysqli_fetch_array($res)){

		echo "<tr>";
			echo "<td class=\"text-right\">".$video['id']."</td>"."<td><a href=\"video.php?id=".$video['id']."\">".$video['title']."</a></td>"."<td class=\"text-center\">".fechaNormal($video['recorded_when'])."</td>"."<td class=\"text-right\">".secondsToTimeString($video['length'])."</td>"."<td class=\"text-right\">".bytesToSizeString($video['size'])."</td>"."<td class=\"text-right\">".resolutionString($video['resolutionx'], $video['resolutiony'])."</td>"."<td class=\"text-center\">".$video['framerate']."</td>"."<td class=\"text-center\">".$video['type']."</td>";
		echo "</tr>";
	}

	echo "</tbody></table>";

}

function resolutionString($resx, $resy){

if(!empty($resx) && !empty($resy)){
	$g = gcd($resx, $resy);
	$ratio = round(($resx/$resy),3).":1";
	return $resx." x ".$resy." (".$ratio.")";
}

return "n/d";

}

function gcd($a,$b) {
    $a = abs($a); $b = abs($b);
    if( $a < $b) list($b,$a) = Array($a,$b);
    if( $b == 0) return $a;
    $r = $a % $b;
    while($r > 0) {
        $a = $b;
        $b = $r;
        $r = $a % $b;
    }
    return $b;
}

function progressBarWord($remaining){

	require_once 'config.php';

	if($remaining<70){
		return "success";
	}else if($remaining<80){
		return "info";
	}else if($remaining<90){
		return "warning";
	}else{
		return "danger";
	}



}


function inboxFilesOptions(){

	$files = scandir("inbox");

	for ($i=0; $i < sizeof($files); $i++) {

		if($files[$i] != "." && $files[$i] != ".." && $files[$i] != "@eaDir" && $files[$i] != ".gitignore"){
		echo "<option value=\"".$files[$i]."\">";
		echo $files[$i];
		echo "</option>\n";
	}
	}

}

function videosInInbox(){

	$files = scandir("inbox");
	$count = 0;
	for ($i=0; $i < sizeof($files); $i++) {

		if($files[$i] != "." && $files[$i] != ".." && $files[$i] != "@eaDir" && $files[$i] != ".gitignore"){
			$count++;
		}
	}	

	return $count;

}

function printQueuedNewsTable($res){

	include 'config.php';

	$return_page = explode('/',$_SERVER['SCRIPT_NAME'])[2];

	echo "<table class=\"table table-striped table-bordered table-condensed\">";
	echo "<thead><tr>";
	echo "<th>Títular</th><th>Prompter</th><th>Vídeo</th><th>Acciones</th>";
	echo "</tr></thead><tbody>";

	while($noticia = mysqli_fetch_array($res)){

		echo "<tr>";
			echo "<td style=\"width: 230px;\" class=\"lead\">".$noticia['header']."</td>"."<td>".$noticia['prompter']."</td>"."<td>";
			
			echo "<video id=\"video-".$noticia['position']."\" width=\"256\" height=\"144\" controls>";
			echo "<source src=\"".$PRE_RUTA_A_VIDEOS.urlOfVideo($noticia['related_media'])."\" />";
			echo "</video>";
			echo "</td>"."<td style=\"width: 80px;\">";
				
				echo "<a href=\"news-engine.php?r=".$return_page."&a=edit&n=".$noticia['id']."\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span> Editar</a><br>";
				echo "<a href=\"news-engine.php?r=".$return_page."&a=insert&n=".$noticia['id']."\"><span class=\"glyphicon glyphicon-log-in\" aria-hidden=\"true\"></span> Meter</a><br>";
				echo "<a href=\"news-engine.php?r=".$return_page."&a=tomorrow&n=".$noticia['id']."\"><span class=\"glyphicon glyphicon-share\" aria-hidden=\"true\"></span> Mañana</a><br>";
				echo "<a href=\"news-engine.php?r=".$return_page."&a=delete&n=".$noticia['id']."\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span> Borrar</a>";

			echo "</td>";
		echo "</tr>";
	}

	echo "</tbody></table>";

}

function printAcceptedNewsTable($res){

	include 'config.php';
	require_once 'db.php';

	$return_page = explode('/',$_SERVER['SCRIPT_NAME'])[2];

	echo "<table class=\"table table-striped table-bordered table-condensed\">";
	echo "<thead><tr>";
	echo "<th>Nº</th><th>Títular</th><th>Prompter</th><th>Vídeo</th><th>Acciones</th>";
	echo "</tr></thead><tbody>";

	while($noticia = mysqli_fetch_array($res)){

		echo "<tr>";
			echo "<td class=\"text-center\" style=\"width: 30px;\"><strong>".$noticia['position']."</strong></td>"."<td style=\"width: 230px;\" class=\"lead\">".$noticia['header']."</td>"."<td>".$noticia['prompter']."</td>"."<td>";
			
			echo "<video id=\"video-".$noticia['position']."\" width=\"256\" height=\"144\" controls>";
			echo "<source src=\"".$PRE_RUTA_A_VIDEOS.urlOfVideo($noticia['related_media'])."\" />";
			echo "</video>";

			echo "</td>"."<td style=\"width: 80px;\">";

				if($noticia['position'] != 1) echo "<a href=\"news-engine.php?r=".$return_page."&a=up&n=".$noticia['id']."\"><span class=\"glyphicon glyphicon-collapse-up\" aria-hidden=\"true\"></span> Subir</a><br>";
				if($noticia['position'] != realLastPositionToday()) echo "<a href=\"news-engine.php?r=".$return_page."&a=down&n=".$noticia['id']."\"><span class=\"glyphicon glyphicon-collapse-down\" aria-hidden=\"true\"></span> Bajar</a><br>";
				echo "<a href=\"news-engine.php?r=".$return_page."&a=edit&n=".$noticia['id']."\"><span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span> Editar</a><br>";
				echo "<a href=\"news-engine.php?r=".$return_page."&a=extract&n=".$noticia['id']."\"><span class=\"glyphicon glyphicon-log-out\" aria-hidden=\"true\"></span> Sacar</a><br>";
				echo "<a href=\"news-engine.php?r=".$return_page."&a=tomorrow&n=".$noticia['id']."\"><span class=\"glyphicon glyphicon-share\" aria-hidden=\"true\"></span> Mañana</a><br>";
				echo "<a href=\"news-engine.php?r=".$return_page."&a=delete&n=".$noticia['id']."\"><span class=\"glyphicon glyphicon-trash\" aria-hidden=\"true\"></span> Borrar</a>";

			echo "</td>";
		echo "</tr>";
	}

	echo "</tbody></table>";

}

function printSingleNew($newsId){

	include 'config.php';

	echo "<table class=\"table table-striped table-bordered table-condensed\">";
	echo "<thead><tr>";
	echo "<th>Nº</th><th>Títular</th><th>Prompter</th><th>Vídeo</th>";
	echo "</tr></thead><tbody>";

	$noticia = getNewsById($newsId);

		echo "<tr>";
			echo "<td class=\"text-center\" style=\"width: 30px;\"><strong>".$noticia['position']."</strong></td>"."<td style=\"width: 230px;\" class=\"lead\">".$noticia['header']."</td>"."<td>".$noticia['prompter']."</td>"."<td>";
			
			echo "<video id=\"video-".$noticia['position']."\" width=\"256\" height=\"144\" controls>";
			echo "<source src=\"".$PRE_RUTA_A_VIDEOS.urlOfVideo($noticia['related_media'])."\" />";
			echo "</video>";
			echo "</td>";
		echo "</tr>";

	echo "</tbody></table>";

}

function prompterFilesLinks(){

$files = scandir("prompterfiles");

echo "<table class=\"table table-striped table-bordered table-condensed\">";
echo "<thead><tr>";
echo "<th>Archivos</th>";
echo "</tr></thead><tbody>";

	for ($i=0; $i < sizeof($files); $i++) {

		if($files[$i] != "." && $files[$i] != ".." && $files[$i] != "@eaDir" && $files[$i] != ".gitignore"){
		echo "<tr><td><a href=\"prompterfiles/".$files[$i]."\" download>".$files[$i]."</a></td></tr>\n";
	}
	}

	echo "</tbody></table>";


}

?>