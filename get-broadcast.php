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
	</head>
	<body>

<?php require_once 'topmenu.php'; ?>
		
<div class="container">

<h1>Descargar recursos para la emisión</h1>
<br>
<h3>Textos prompter</h3>

<br>

<?php

require_once 'functions.php';

	$files = glob('prompterfiles/*'); // get all file names
	foreach($files as $file){ // iterate files
  	if(is_file($file))
    unlink($file); // delete file
	}

generateTodayPrompters();	

prompterFilesLinks();

?>
<br>
<h3>Vídeos de noticias</h3>
<br>
<?php

videoFilesLinks();

?>

<br><br>

</div>

<?php include 'footer.php' ?></body>
</html>


<?
}
?>