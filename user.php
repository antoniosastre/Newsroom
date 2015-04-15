<!DOCTYPE HTML>
<?php

if($_GET['a']=="close"){
	setcookie('newsroom', $_POST['user'], time() - 86400, "/"); // 86400 = 1 day

	echo "<html>
	<head>
	<meta http-equiv=\"refresh\" content=\"1;url=index.php\">
        <script type=\"text/javascript\">
            window.location.href = \"index.php\"
        </script>
	</head>
</html>";

}else{

?>


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

	$userdata = userDataByUser(explode("-and-", $_COOKIE['newsroom'])[0]);

	if(!isset($_GET['u'])){

		echo "<h1>".$userdata['showname']."</h1>";

	}else{

		echo "<h1>".userShowNameByUser($_GET['u'])."</h1>";

	}

?>
<br><br>
<div class="row">

	<div class="col-md-3">

<form action="user.php" method="GET" class="form-horizontal">
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
if(!isset($_GET['u'])){
		echo "<input type=\"hidden\" name=\"u\" value=\"".$userdata['user']."\">";
	}else{
		echo "<input type=\"hidden\" name=\"u\" value=\"".$_GET['u']."\">";
	}
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

<form action="user.php" method="GET" class="form-horizontal">
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
if(!isset($_GET['u'])){
		echo "<input type=\"hidden\" name=\"u\" value=\"".$userdata['user']."\">";
	}else{
		echo "<input type=\"hidden\" name=\"u\" value=\"".$_GET['u']."\">";
	}
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

<form action="user.php" method="GET" class="form-horizontal">
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
if(!isset($_GET['u'])){
		echo "<input type=\"hidden\" name=\"u\" value=\"".$userdata['user']."\">";
	}else{
		echo "<input type=\"hidden\" name=\"u\" value=\"".$_GET['u']."\">";
	}
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

if(!empty($_GET['y'])){
	echo "Se muestran todos los vídeos de ".$_GET['y']." de ".userShowNameByUser($_GET['u']).":";
	echo "<hr>";
	echo tableOfYear($_GET['y'],$_GET['u']);
}

if(!empty($_GET['f']) && !empty($_GET['t'])){
	echo "Se muestra desde el ".explode('-', $_GET['f'])[1]."/".explode('-', $_GET['f'])[0]." hasta el ".explode('-', $_GET['t'])[1]."/".explode('-', $_GET['t'])[0]." de ".userShowNameByUser($_GET['u']).":";
	echo "<hr>";
	echo tableOfInterval($_GET['f'], $_GET['t'],$_GET['u']);
}

if(!empty($_GET['d'])){
	echo "Se muestran los últimos ".$_GET['d']." días de ".userShowNameByUser($_GET['u']).":";;
	echo "<hr>";
	echo tableOfLast($_GET['d'],$_GET['u']);
}

?>

</div>

<br><br><br>
		
	</body>
</html>

<?
} }
?>