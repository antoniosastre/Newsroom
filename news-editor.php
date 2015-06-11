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

}else if($_GET['a']!="new" && $_GET['a']!="edit"){

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

}else{

?>

<html>
	<head>
	<?php require_once 'head.php' ?>
	</head>
	<body>

<?php require_once 'topmenu.php'; ?>
		
<div class="container">

<h3>Componer nueva línea para la escaleta</h3>
<br>

<?php

if($_GET['a']=="new"){

?>

<form action="news-engine.php" method="post" enctype="multipart/form-data">

<input type="hidden" name="a" value="new">
<input type="hidden" name="r" value="today.php">
<input type="hidden" name="n" value="new">

<div class="form-group">
    <label for="header">Título</label>
	<input type"text" name="header" id="header" class="form-control" required>
</div>

<div class="form-group">
    <label for="prompter">Prompter</label>
	<textarea name="prompter" id="prompter" class="form-control" rows="5"></textarea>
</div>

	<div class="row">

	<div class="col-md-2">

		<div class="form-group">
		<label for="related_media">ID del Vídeo</label>
		<input type"text" name="related_media" id="related_media" class="form-control">
		</div>

		</div>
	<div class="col-md-2">

		<div class="form-group">
		<label for="showdate">Fecha de emisión</label>
		<input type="date" name="showdate" id="showdate" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
		</div>

	</div>

	<div class="col-md-2">
		<button type="submit" class="btn btn-primary" name="submit" style="position:relative; top:25px;">Insertar noticia</button>
	</div>

	<div class="col-md-6"></div>

	</div>

    

</form>

<br><br>

</div>

<?php include 'footer.php' ?></body>
</html>


<?
} }
?>