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


	if($_GET['a']=="generate"){


		generateTodayPrompters();


	}else if($_GET['a']=="clean"){

		$files = glob('prompterfiles/*'); // get all file names
		foreach($files as $file){ // iterate files
  		if(is_file($file))
    	unlink($file); // delete file
		}

	}

?>

<html>
	<head>
	<?php require_once 'head.php' ?>
	</head>
	<body>

<?php require_once 'topmenu.php'; ?>
		
<div class="container">

<h1>Descargar recursos para la emisión</h1>

<h3>Textos prompter</h3>

<br>

<div class="row">

<div class="col-md-2"></div>

<div class="col-md-2">
	<a href="get-broadcast.php?a=clean"><button class="btn btn-danger" type="submit">Eliminar escaleta</button></a>
</div>

<div class="col-md-2">
	<a href="get-broadcast.php?a=generate"><button class="btn btn-primary" type="submit">Generar escaleta</button></a>
</div>

<div class="col-md-6">
</div>

</div>

<br><br>

<div class="row">

<div class="col-md-1">
</div>

<div class="col-md-6">

<?php

require_once 'functions.php';

prompterFilesLinks();

?>
</div>
</div>

<h3>Vídeos de noticias</h3>
<br>
<div class="row">
<div class="col-md-1">
</div>

<div class="col-md-6">
<?php

videoFilesLinks();

?>
</div>
</div>

<br><br>

</div>

</body>
</html>


<?
}
?>