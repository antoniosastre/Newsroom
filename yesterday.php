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

<h1>Ayer - <?php 

$date = new DateTime(date("Y-m-d"));
$date->modify('-1 day');
echo $date->format('d/m/Y');

 ?></h1>

<h3>Escaleta</h3>

<?

	tableOfNews(1,-1);

?>
<br>
<h3>Cola de Noticias</h3>

<?

	tableOfNews(0,-1);	

?>

</div>

<?php include 'footer.php' ?></body>
</html>


<?
}
?>