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
	<?php include 'head.php'; ?>
<script type="text/javascript">

  
  $(function(){


            var people = <?php echo json_encode(peopleArray()); ?>;
            var places = <?php echo json_encode(placesArray()); ?>;
            var tags = <?php echo json_encode(tagsArray()); ?>;


    $(document).ready(function() {
            $('#input_people').tagit({
                availableTags: people,
                allowSpaces: true
            });

            $('#input_places').tagit({
                availableTags: places,
                allowSpaces: true
            });

            $('#input_tags').tagit({
                availableTags: tags,
                allowSpaces: true
            });
    });

    });
</script>
	</head>
	<body>
		<?php include 'topmenu.php'; ?>
		
<div class="container">

<h1>Subir Vídeo</h1><br>

<form action="upload-video-engine.php" method="post" enctype="multipart/form-data">
    
	<div class="row">

		<div class="col-md-7">

		<div class="form-group">
		<label for="videoSelector">Vídeo:</label>
		<select name="video" id="videoSelector" class="form-control" <?php if(videosInInbox() == 0) echo "disabled"; ?>>
		<?php 
		require_once 'functions.php';
		inboxFilesOptions(); ?>
		</select>
		</div>

		</div>
		<div class="col-md-5">

		<div class="form-group">
		<label for="recorded_when">Grabado el:</label>
		<input type="date" name="recorded_when" id="recorded_when" class="form-control" value="<?php echo date('Y-m-d'); ?>" required <?php if(videosInInbox() == 0) echo "disabled"; ?>>
		</div>

		</div>
	</div>
    
    <div class="form-group">
    <label for="title">Título:</label>
	<input type"text" name="title" id="title" maxlength="240" class="form-control" required <?php if(videosInInbox() == 0) echo "disabled"; ?>>
	</div>

	<div class="form-group">
	<label for="input_people">Personas:</label>
	<input name="people" id="<?php if(videosInInbox() != 0) echo "input_people"; ?>" class="form-control" <?php if(videosInInbox() == 0) echo "disabled"; ?>>
	</div>

	<div class="form-group">
	<label for="input_places">Lugares:</label>
	<input name="places" id="<?php if(videosInInbox() != 0) echo "input_places"; ?>" class="form-control" <?php if(videosInInbox() == 0) echo "disabled"; ?>>
	</div>

	<div class="form-group">
	<label for="input_tags">Etiquetas:</label>
	<input name="tags" id="<?php if(videosInInbox() != 0) echo "input_tags"; ?>" class="form-control" <?php if(videosInInbox() == 0) echo "disabled"; ?>>
	</div>
	<br>
    <button type="submit" class="btn btn-primary" name="submit" <?php if(videosInInbox() == 0) echo "disabled"; ?>>Procesar vídeo</button>

</form>

<br><br>

</div>

		
	<?php include 'footer.php' ?></body>
</html>

<?
}
?>