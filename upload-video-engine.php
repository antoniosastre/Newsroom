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
	<?php include 'head.php';
		  require_once('getid3/getid3.php'); ?>
	</head>
	<body>
		<?php include 'topmenu.php'; ?>
		
<div class="container">

<?php

//This function separates the extension from the rest of the file name and returns it
function findexts ($filename){
	$filename = strtolower($filename) ;
	$exts = split("[/\\.]", $filename) ;
	$n = count($exts)-1;
	$exts = $exts[$n];
	return $exts;
}

require_once 'functions.php';

$target_dir = "storage/".date('Y')."/".date('m')."/".date('d')."/";
$inbox_dir = "inbox/";

$ext = findexts($_POST['video']);
$tmpfilename = generateRandomString();

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);    
}

$target_file = $target_dir . $tmpfilename .".". $ext;

if(rename($inbox_dir.$_POST['video'], $target_file)){

	echo "El archivo ".$_POST['video']." ha sido trasladado a su ubicación definitiva.<br>";

	$getID3 = new getID3;

	$ThisFileInfo = $getID3->analyze($target_file);

	$idinsertedmedia = insertVideoInfo($_POST['title'], $_POST['recorded_when'], userIdByUser(explode("-and-", $_COOKIE['newsroom'])[0]), $ThisFileInfo['playtime_seconds'], $target_file, $ThisFileInfo['filesize'], $ThisFileInfo['mime_type'], $ThisFileInfo['video']['resolution_x'], $ThisFileInfo['video']['resolution_y'], $ThisFileInfo['video']['frame_rate']);

	if($idinsertedmedia != -1){

		$def_target_file = $target_dir."v-".$idinsertedmedia.'.'.$ext;

		if(rename($target_file, $def_target_file)){

			updateFilenameInDB($idinsertedmedia, $def_target_file);

			processPeople($idinsertedmedia, $_POST['people']);
			processPlaces($idinsertedmedia, $_POST['places']);
			processTags($idinsertedmedia, $_POST['tags']);

		}else{
			echo "El archivo no ha podido ser renombrado a su nombre final.";
		}

	}else{
		echo "No ha podido ser insertado el registro en la base de datos.<br>";
	}

}else{
	echo "No se ha podido trasladar el archivo a su posición.<br>";
}

?>

</div>

		
	</body>
</html>

<?
}
?>