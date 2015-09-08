<?php
	header("Content-type: text/html");
	include("config.inc.php");
?>
<!DOCTYPE html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<title><?= $content["title"] ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="<?= $content["author"] ?>">

	<link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.min.css" rel="stylesheet">

	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
<div class="container">
	<div class="well">
		<h1><?= $content["title"] ?></h1>
		<h3><?= $content["subtitle"] ?></h3>
<?php
	if(!is_writable($file_groups)){
		print "<div class=\"alert alert-error\">{$file_groups} is not writable!</div>";
	}
	if(!is_writable($file_students)){
		print "<div class=\"alert alert-error\">{$file_students} is not writable!</div>";
	}
?>
		<form id="signup" class="form-horizontal" method="post" action="#">
			<fieldset>
				<legend><?= $content["formtitle"] ?></legend>
<?php
	foreach($fields as $field) {
		switch($field["type"]) {
			case "text";
			case "email";
?>
				<div class="control-group">
					<label class="control-label"><?= $field["label"] ?></label>
					<div class="controls">
						<div class="input-prepend">
						<span class="add-on"><i class="icon-<?= $field["icon"] ?>"></i></span>
							<input type="<?= $field["type"] ?>" class="input-xlarge" id="<?= $field["name"] ?>" name="<?= $field["name"] ?>" placeholder="<?= $field["placeholder"] ?>">
						</div>
					</div>
				</div>
<?php
			break;
			case "checkbox";
?>
				<div class="control-group">
					<div class="controls">
						<?= $field["label"] ?>
						<label class="checkbox">
							<input type="<?= $field["type"] ?>" id="<?= $field["name"] ?>" name="<?= $field["name"] ?>" value="<?= $field["name"] ?>"> <?= $field["placeholder"] ?>
						</label>
					</div>
				</div>
<?php
			break;
		}
	}
?>

				<div class="control-group">
					<label class="control-label"><?= $content["grouptitle"] ?></label>
					<div class="controls">
<?php
	try {
		$f = new SplFileObject($file_groups, "r");
		$data = array();
		while (!$f->eof()) {
			$data = $f->fgetcsv(";");
			if ($data[0] != "#" && count($data) > 1){
?>
						<label class="radio">
							<input type="radio" name="group" id="group<?= $data[0] ?>" value="<?= $data[0] ?>" <?php if($data[4]>=$data[3]){print("disabled");} ?> >
							<strong><?= $data[1] ?>:</strong>&nbsp;<?= $data[2] ?>&nbsp;(<?= $data[4] ?>/<?= $data[3] ?>)
						</label>
<?php
			}
		}
	} catch (Exception $e) {
		print $e->getMessage();
	}
?>
					</div>
				</div>
				<div id="response" class="alert" style="display:none;"></div>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls" id="thecontrol">
						Please activate Javascript!
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/jquery.validate.min.js"></script>
<!-- Uncomment for field validation localization -->
<!-- <script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.12.0/localization/messages_de.js"></script> -->

<script type="text/javascript">
	$(document).ready(function(){
		// Ensure activated Javascript
		$("#thecontrol").html('<button type="submit" class="btn btn-success" ><?= $content["signup"] ?></button>');

		// Suggest some data for the user, but dont restrict
<?php
		foreach($suggestions as $ta) {
?>
			$('#<?= $ta["name"] ?>').typeahead({source:<?= json_encode($ta["suggest"]) ?>});
<?php
		};
?>
		// Ensure form is valid and fields fulfill requirements
		$("#signup").submit(function(e) {
			e.preventDefault();
			// Disable button before processing, prevent user from sending the form multiple times
			$('#signup button').attr("disabled", true);
		}).validate({
			rules:<?= $validation ?>,
			errorClass: "help-inline",
			submitHandler: function(form) {
				$.post('signup.php', $("#signup").serialize(), "json").done( function(data){
					if(data['status'] == "success"){
						$("#response").removeClass("alert-error").addClass("alert-success").html(data['message']).show();
						$("#signup")[0].reset();
					} else {
						$("#response").removeClass("alert-success").addClass("alert-error").html(data['message']).show();
					}
					$('#signup button').attr("disabled", false);
				});
			},
			invalidHandler: function(event, validator) {
				$('#signup button').attr("disabled", false);
			},
		}); // end validate
	}); // end document ready
</script>

</body>
</html>
