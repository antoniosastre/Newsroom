<!DOCTYPE HTML>
<html>
	<head>
	<?php include 'head.php' ?>
	<link rel="stylesheet" href="css/signin.css">
	</head>
	<body>

<div class="container">

<?php

if(isset($_POST['pass'])){

?>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Código de contraseña</h3>
  </div>
  <div class="panel-body">
    <?php

        echo password_hash($_POST['pass'], PASSWORD_DEFAULT);

    ?>
  </div>
</div>

<?

}else{

?>

 <form class="form-signin" action="password.php" method="POST" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Obtener código</h2>
        <label for="inputPass" class="sr-only">Usuario</label>
        <input type="password" id="inputPass" class="form-control" placeholder="Contraseña" name="pass" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Obtener</button>
      </form>

<?

}

?>

    </div>

    </body>
</html>