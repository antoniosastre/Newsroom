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

}else if(!isset($_GET['r']) && !isset($_POST['r'])){

?>

<html>
	<head>
	<meta http-equiv="refresh" content="1;url=index.php">
        <script type="text/javascript">
            window.location.href = "index.php"
        </script>
	</head>
</html>

<?

}else if((!isset($_GET['a']) && !isset($_POST['a'])) || (!isset($_GET['n']) && !isset($_POST['n']))){

if(isset($_POST['r'])){

echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_POST['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_POST['r']."</script></head></html>";

         }else{

echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_GET['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_GET['r']."</script></head></html>";


         }

}else{

	require_once 'functions.php';
	//require_once 'db.php';

	if($_GET['a']=="delete" && $_GET['c']=="true"){

		deleteNewsByID($_GET['n']);

		trimNewsPositions();

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_GET['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_GET['r']."</script></head></html>";

	}else if($_GET['a']=="delete"){
		echo "<html>
	<head>";
	require_once 'head.php';
	
	echo "</head>
	<body>";

	require_once 'topmenu.php';
		
	echo "<div class=\"container\">


<h3 class=\"text-center\">¿Confirma la eliminación de la noticia? Esta acción no se puede deshacer.</h3><br>";

echo printSingleNew($_GET['n']);

echo "<p class=\"text-center\"><a href=\"".$_GET['r']."\"><button type=\"button\" class=\"btn btn-primary\">Volver</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"news-engine.php?r=".$_GET['r']."&a=delete&n=".$_GET['n']."&c=true\"><button type=\"button\" class=\"btn btn-danger\">Eliminar</button></a></p>";

echo "</div>


</body>
</html>";
	
	}else if($_GET['a']=="edit"){

         ?>

         <html>
	<head>
	<?php require_once 'head.php' ?>
	</head>
	<body>

<?php require_once 'topmenu.php'; ?>
		
<div class="container">

<h1>Editar noticia</h1>

         <form action="news-engine.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="r" value="<?php echo $_GET['r']; ?>">
<input type="hidden" name="a" value="saveedit">
<input type="hidden" name="n" value="<?php echo $_GET['n']; ?>">

<div class="form-group">
    <label for="header">Títular</label>
	<input type"text" name="header" id="header" class="form-control" value="<?php echo str_replace("\"", '\'', headerOf($_GET['n'])); ?>"required>
</div>

<div class="form-group">
    <label for="prompter">Prompter</label>
	<textarea name="prompter" id="prompter" class="form-control" rows="5"><?php echo str_replace("\"", '\'', prompterOf($_GET['n'])); ?></textarea>
</div>

	<div class="row">

	<div class="col-md-2">

		<div class="form-group">
		<label for="related_media">ID del Vídeo</label>
		<input type"text" name="related_media" id="related_media" class="form-control" value="<?php echo relatedOf($_GET['n']); ?>">
		</div>

		</div>
	<div class="col-md-2">

		<div class="form-group">
		<label for="showdate">Fecha de emisión</label>
		<input type="date" name="showdate" id="showdate" class="form-control" value="<?php echo showdateOf($_GET['n']); ?>" required>
		</div>

	</div>

	<div class="col-md-2">
		<button type="submit" class="btn btn-primary" name="submit" style="position:relative; top:25px;">Actualizar noticia</button>
	</div>

	<div class="col-md-6"></div>

	</div>

    

</form>
<br><br>

</div>

</body>
</html>


         <?

	}else if($_POST['a']=="new" && !empty($_POST['header'])){

		insertNewNews($_POST['header'], $_POST['prompter'], $_POST['related_media'], $_POST['showdate'], userIdByUser(explode("-and-", $_COOKIE['newsroom'])[0]));

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_POST['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_POST['r']."</script></head></html>";

	}else if($_POST['a']=="saveedit"){

		updateNews($_POST['n'], str_replace('\'', "\"", $_POST['header']), str_replace('\'', "\"", $_POST['prompter']), $_POST['related_media'], $_POST['showdate']);

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_POST['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_POST['r']."</script></head></html>";
		

	}else if($_GET['a']=="extract"){

		setNewsPosition($_GET['n'], "clear");
		setNewsStatus($_GET['n'], 0);

		trimNewsPositions();

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_GET['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_GET['r']."</script></head></html>";

	}else if($_GET['a']=="insert"){

		setNewsPosition($_GET['n'], "last");
		setNewsStatus($_GET['n'], 1);

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_GET['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_GET['r']."</script></head></html>";

	}else if($_GET['a']=="tomorrow"){

	}else if($_GET['a']=="up"){

		decreaseInPosition($_GET['n']);

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_GET['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_GET['r']."</script></head></html>";

	}else if($_GET['a']=="down"){

		increaseInPosition($_GET['n']);

		echo "<html><head><meta http-equiv=\"refresh\" content=\"1;url=".$_GET['r']."\">
        <script type=\"text/javascript\">
            window.location.href = ".$_GET['r']."</script></head></html>";

	}

}
?>


<!--
<html>
	<head>
	<?php //require_once 'head.php' ?>
	</head>
	<body>

<?php //require_once 'topmenu.php'; ?>
		
<div class="container">

<h1>Inicio</h1>


</div>

</body>
</html>

-->