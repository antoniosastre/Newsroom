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

	if(isset($_GET['q'])){

		echo "<h1>".$_GET['q']."</h1>";

?>
<br><br>
<div class="row">

	<div class="col-md-3">

<form action="search.php" method="GET" class="form-horizontal">
	<div class="form-group">
		<label for="yearSelector" class="col-sm-3 control-label">Año</label>
		<div class="col-sm-9">
		<select name="y" id="yearSelector" class="form-control">
  			<?php
  				foreach (videoYears() as $year) {
 				if(!empty($year)) echo "<option value=\"".$year."\">".$year."</option>\n";
  				}
  			?>
		</select>
		</div>
	</div>
	<?php
		echo "<input type=\"hidden\" name=\"q\" value=\"".$_GET['q']."\">";
	?>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
<button type="submit" class="btn btn-default">Listar</button>
</div>
</div>
</form>

	</div>
	<div class="col-md-1"></div>
	<div class="col-md-3">

<form action="search.php" method="GET" class="form-horizontal">
	<div class="form-group">
		<label for="daysSelector" class="col-sm-3 control-label">Últimos</label>
	 <div class="col-sm-9">
	 <select name="d" id="daysSelector" class="form-control">
  <option value="1">Hoy</option>
  <option value="2">2 Días</option>
  <option value="5">5 Días</option>
  <option value="7">7 Días</option>
  <option value="15">15 Días</option>
  <option value="30">30 Días</option>
</select>
	</div>
	</div>
	<?php
		echo "<input type=\"hidden\" name=\"q\" value=\"".$_GET['q']."\">";
	?>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
<button type="submit" class="btn btn-default">Listar</button>
</div>
</div>
</form>
	</div>
	<div class="col-md-1"></div>
	<div class="col-md-4">

<form action="search.php" method="GET" class="form-horizontal">
	<div class="form-group">
		<label for="fromSelector" class="col-sm-3 control-label">Desde</label>
		<div class="col-sm-9">
		<input type="month" name="f" id="fromSelector" class="form-control" value="<?php echo date('Y-m'); ?>">
		</div>
	</div>
	<div class="form-group">
		<label for="toSelector" class="col-sm-3 control-label">Hasta</label>
		<div class="col-sm-9">
		<input type="month" name="t" id="toSelector" class="form-control" value="<?php echo date('Y-m'); ?>">
		</div>
	</div>
	<?php
		echo "<input type=\"hidden\" name=\"q\" value=\"".$_GET['q']."\">";
	?>
<div class="form-group">
    <div class="col-sm-offset-3 col-sm-9">
<button type="submit" class="btn btn-default">Listar</button>
</div>
</div>
</form>
	</div>
	</div>

<hr>

<?php

if(!empty($_GET['f']) && !empty($_GET['t'])){
	echo "Se muestra desde el ".explode('-', $_GET['f'])[1]."/".explode('-', $_GET['f'])[0]." hasta el ".explode('-', $_GET['t'])[1]."/".explode('-', $_GET['t'])[0]." de ".$_GET['q'].":";
	echo "<hr>";
	echo tableOfInterval($_GET['f'], $_GET['t'], 0, 0, 0, 0, $_GET['q']);
}else

if(!empty($_GET['d'])){
	echo "Se muestran los últimos ".$_GET['d']." días de ".$_GET['q'].":";;
	echo "<hr>";
	echo tableOfLast($_GET['d'], 0, 0, 0, 0, $_GET['q']);
}else{

	echo "Se muestran todos los vídeos de ".$_GET['y']." de ".$_GET['q'].":";
	echo "<hr>";
	echo tableOfYear($_GET['y'], 0, 0, 0, 0, $_GET['q']);

}

?>

</div>

<?

	}else{

		echo "<h1>n/d</h1>";

	}

?>

<br><br><br>
		
	</body>
</html>

<?
}
?>