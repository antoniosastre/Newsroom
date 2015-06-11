<!DOCTYPE HTML>
<html>
	<head>
	<?php include 'head.php' ?>
	<link rel="stylesheet" href="css/signin.css">
	</head>
	<body>

<div class="container">

      <form class="form-signin" action="login-engine.php" method="POST" enctype="multipart/form-data">
        <h2 class="form-signin-heading">Inicio de sesión</h2>
        <label for="inputUser" class="sr-only">Usuario</label>
        <input type="text" id="inputUser" class="form-control" placeholder="Usuario" name="user" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" name="password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
      </form>

    </div> <!-- /container -->

    <?php include 'footer.php' ?></body>
</html>