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
	<?php include 'head.php' ?>
	</head>
	<body>
		<?php include 'topmenu.php'; ?>
		
<div class="container">

<?php 

require_once 'functions.php';

echo "<h1>Vídeo ".$_GET['id']."</h1><br>"; 


$video = videoById($_GET['id']);

echo "<div class=\"row\"><div class=\"col-md-1\"></div><div class=\"col-md-11\">";
echo "<dl class=\"dl-horizontal\">";
	echo "<dt>Título</dt>";
	echo "<dd>".$video['title']."</dd>";

	echo "<dt>Grabado</dt>";
	echo "<dd>".fechaNormal($video['recorded_when'])."</dd>";

	echo "<dt>Por</dt>";
	echo "<dd>".userShowNameById($video['recorded_who'])."</dd>";

	echo "<dt>Duración</dt>";
	echo "<dd>".secondsToTimeString($video['length'])."</dd>";

	echo "<dt>Tamaño</dt>";
	echo "<dd>".bytesToSizeString($video['size'])."</dd>";

	echo "<dt>Enlace</dt>";
	echo "<dd><a href=\"".$video['pathtofile']."\" download=\"".str_replace(' ', '-', preg_replace("/[^A-Za-z0-9 ]/", '', $video['title']))."\">".$video['pathtofile']."</a></dd>";
	echo "<br>";
	echo "<dt>Personas</dt>";
	echo "<dd>";
	echo peopleOfVideo($video['id']);
	echo "</dd><br>";

	echo "<dt>Lugares</dt>";
	echo "<dd>";
	echo placesOfVideo($video['id']);
	echo "</dd><br>";

	echo "<dt>Etiquetas</dt>";
	echo "<dd>";
	echo tagsOfVideo($video['id']);
	echo "</dd>";

echo "</dl></div></div>";



echo "<br><br>";

echo "<div class=\"embed-responsive embed-responsive-16by9\">";
// class=\"video-js vjs-default-skin vjs-big-play-centered\"
echo "<video id=\"video-".$video['id']."\" width=\"640\" height=\"360\" controls>";

  //echo "poster=\"http://video-js.zencoder.com/oceans-clip.png\"";

echo "<source src=\"".$video['pathtofile']."\" />";
echo "</video></div>";

?>

<br><br><br>
</div>
		
	<?php include 'footer.php' ?></body>
</html>

<?
}
?>