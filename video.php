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

echo "<table>";
echo "<tr>";
echo "<td colspan=\"2\">Título: ".$video['title']."</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=\"2\">Grabado el ".fechaNormal($video['recorded_when'])." por ".userShowNameById($video['recorded_who'])."</td>";
echo "</tr>";
echo "<tr>";
echo "<td>Duración: ".secondsToTimeString($video['length'])."</td><td>Tamaño ".bytesToSizeString($video['size']).".</td>";
echo "</tr>";
echo "<tr>";
echo "<td colspan=\"2\">Ruta: /".$video['pathtofile']."</td>";
echo "</tr>";
echo "</table>";


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
		
	</body>
</html>

<?
}
?>