<nav class="navbar navbar-inverse navbar-static-top">
	    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Newsroom</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "index.php")) echo "class=\"active\""; ?>><a href="index.php"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Inicio</a></li>
        <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "list.php")) echo "class=\"active\""; ?>><a href="list.php"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Vídeos</a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Ir a...<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li>
                <form action="video.php" method="GET" class="navbar-form navbar-left">
                  <div class="form-group">
                    <input type="text" class="form-control" name="id" placeholder="Video ID">
                  </div>
                </form>
            </li>
            <li>
                <form action="user.php" method="GET" class="navbar-form navbar-left">
                  <div class="form-group">
                    <input type="text" class="form-control" name="u" placeholder="Usuario">
                  </div>
                </form>
            </li>
            
            <li><form action="person.php" method="GET" class="navbar-form navbar-left">
                  <div class="form-group">
                    <input type="text" class="form-control" name="q" placeholder="Persona">
                  </div>
                </form>
            </li>

            <li><form action="place.php" method="GET" class="navbar-form navbar-left">
                  <div class="form-group">
                    <input type="text" class="form-control" name="q" placeholder="Lugar">
                  </div>
                </form>
            </li>

            <li><form action="tag.php" method="GET" class="navbar-form navbar-left">
                  <div class="form-group">
                    <input type="text" class="form-control" name="q" placeholder="Etiqueta">
                  </div>
                </form>
            </li>

          </ul>
        </li>

        <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "upload-video.php")) echo "class=\"active\""; ?>><a href="upload-video.php"><span class="glyphicon glyphicon-upload" aria-hidden="true"></span> Subir vídeo 
        <?php 

        require_once 'functions.php'; 

        if(videosInInbox()>0){
          echo "<span class=\"badge\">".videosInInbox()."</span>";
        }
        ?>

        </a></li>

        <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "today.php")) echo "class=\"active\""; ?>><a href="today.php"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Escaleta 
        <?php 
        require_once 'db.php'; 

        if(newsInQueueToday()>0){
          echo "<span class=\"badge\">".newsInQueueToday()."</span>";
        }
        ?>
        </a></li>

        <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "news-editor.php")) echo "class=\"active\""; ?>><a href="news-editor.php?a=new"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Nueva Noticia</a></li>

      </ul>
      <form action="search.php" method="GET" class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" name="q" placeholder="Buscar vídeo" class="form-control">
        </div>
      </form>
      <ul class="nav navbar-nav navbar-right">

      <li <?php if (strpos($_SERVER['SCRIPT_NAME'], "get-broadcast.php")) echo "class=\"active\""; ?>><a href="get-broadcast.php"><span class="glyphicon glyphicon-save" aria-hidden="true"></span> Descargar Emisión</a></li>

<?php

if(isValidCookie("newsroom")){

	echo "<li class=\"dropdown";
  if (strpos($_SERVER['SCRIPT_NAME'], "user.php")) echo " active";
  echo "\"><a href=\"user.php\" class=\"dropdown-toggle\" data-toggle=\"dropdown\" role=\"button\" aria-expanded=\"false\">".userShowNameByUser(explode("-and-", $_COOKIE['newsroom'])[0])."<span class=\"caret\"></span></a>
          <ul class=\"dropdown-menu\" role=\"menu\">
          	<li><a href=\"user.php\"><span class=\"glyphicon glyphicon-user\" aria-hidden=\"true\"></span>  Página de usuario</a></li>
          	<li class=\"divider\"></li>
            <li><a href=\"user.php?a=close\"><span class=\"glyphicon glyphicon-off\" aria-hidden=\"true\"></span> Cerrar Sesión</a></li>
          </ul>
        </li>";

}else{
	echo "<li><a href=\"login.php\">Iniciar Sesión</a></li>";
}

?>

        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
	</nav>