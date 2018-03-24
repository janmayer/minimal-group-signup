<?php
	header("Content-type: text/html");
	include("config.inc.php");
?>
<!doctype html>
<html lang="de">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="<?= $content["author"] ?>">
	<title><?= $content["title"] ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" integrity="sha384-3AB7yXWz4OeoZcPbieVW64vVXEwADiYyAEhwilzWsLw+9FgqpyjjStpPnpBO8o8S" crossorigin="anonymous">
</head>

<body>
<div class="container">
	<div class="py-5 text-center">
		<h1><?= $content["title"] ?></h1>
		<h3><?= $content["subtitle"] ?></h3>
	</div>
	<div class="center">
<?php
	if(!is_writable($file_groups)){
		print "<div class=\"alert alert-danger\">{$file_groups} is not writable!</div>";
	}
	if(!is_writable($file_students)){
		print "<div class=\"alert alert-danger\">{$file_students} is not writable!</div>";
	}
?>
		<form id="signup" method="post" class="needs-validation" novalidate>
			<fieldset>
				<legend><?= $content["formtitle"] ?></legend>
<?php
	foreach($fields as $field) {
		switch($field["type"]) {
			case "text";
			case "email";
			case "number";
?>
				<div class="form-group row">
					<label class="col-sm-2 col-form-label" for="<?= $field["name"] ?>"><?= $field["label"] ?></label>
					<div class="col-sm-10">
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa <?= $field["icon"] ?>"></i></span>
							</div>
							<input class="form-control" type="<?= $field["type"] ?>" id="<?= $field["name"] ?>" name="<?= $field["name"] ?>" placeholder="<?= $field["placeholder"] ?>" <?= $field["required"] ?><?= $field["type"] === "number" ? ' min="'.$field["min"].'" max="'.$field["max"].'"' : "" ?>>
						</div>
					</div>
				</div>
<?php
			break;
			case "checkbox";
?>
				<div class="form-group row">
					<label class="col-sm-2"><?= $field["label"] ?></label>
					<div class="col-sm-10">
						<div class="form-check">
							<input class="form-check-input" type="<?= $field["type"] ?>" id="<?= $field["name"] ?>" name="<?= $field["name"] ?>" value="<?= $field["name"] ?>" <?= $field["required"] ?>>
							<label class="form-check-label" for="<?= $field["name"] ?>">
								 <?= $field["placeholder"] ?>
							</label>
						</div>
					</div>
				</div>
<?php
			break;
		}
	}
?>

				<div class="form-group row">
					<label class="col-sm-2"><?= $content["grouptitle"] ?></label>
					<div class="col-sm-10">
<?php
	try {
		$f = new SplFileObject($file_groups, "r");
		$data = array();
		$group_ids = array();
		while (!$f->eof()) {
			$data = $f->fgetcsv(";");
			if ($data[0] != "#" && count($data) > 1){
				if(in_array($data[0], $group_ids)){
					print "<div class=\"alert alert-danger\">Group ID {$data[0]} is not unique!</div>";
				} else {
					$group_ids[] = $data[0];
?>
						<div class="form-check py-1">
							<input class="form-check-input" type="radio" name="group" id="group<?= $data[0] ?>" value="<?= $data[0] ?>" <?php if($data[4]>=$data[3]){print("disabled");} ?> required>
							<label class="form-check-label">
								<strong><?= $data[1] ?>:</strong>&nbsp;<?= $data[2] ?>&nbsp;(<?= $data[4] ?>/<?= $data[3] ?>)
							</label>
						</div>
<?php
				}
			}
		}
	} catch (Exception $e) {
		print $e->getMessage();
	}
?>
					</div>
				</div>
				<div id="response" class="alert" role="alert" style="display:none;"></div>
				<div class="form-group row">
					<div class="offset-sm-2 col-sm-10" id="thecontrol">
						<button type="submit" class="btn btn-success" ><?= $content["signup"] ?></button>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" integrity="sha256-F6h55Qw6sweK+t7SiOJX+2bpSAa3b/fnlrVCJvmEj1A=" crossorigin="anonymous"></script>

<script>
$(document).ready(function(){
	$("#signup").submit(function (event) {
		event.preventDefault();
		if ($("#signup")[0].checkValidity() === false) {
			event.stopPropagation();
		} else {
			$.post('signup.php', $("#signup").serialize(), "json").done( function(data){
				if(data['status'] === "success"){
					$("#response").removeClass("alert-danger").addClass("alert-success").html(data['message']).show();
					$("#signup")[0].reset();
				} else {
					$("#response").removeClass("alert-success").addClass("alert-danger").html(data['message']).show();
				}
			});
		};
		$("#signup").addClass('was-validated');
	});
});
</script>

</body>
</html>
