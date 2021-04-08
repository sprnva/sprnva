<?php

use App\Core\App;
?>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel='icon' href='<?= public_url('/favicon.ico') ?>' type='image/ico' />
	<title>
		<?= ucfirst($pageTitle) . " | " . App::get('config')['app']['name']; ?>
	</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<style>
		body {
			background-color: #eef1f4;
		}
	</style>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>

	<div class="container pt-3 pb-3">
		<div class="row pb-2">
			<div class="col-md-12" style="margin-left: 20px;">
				<h3>Database Migration</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2" style="padding-left: 33px;padding-top: 0px;">
				<div style="margin-top: 0px;">
					<button type="button" class="btn btn-md btn-success btcmd" style="text-align: right !important;border-radius: 4px;background-color: #4caf50;width: 100%;margin-bottom: 10px" onclick="runCommand('migration:migrate')">Migrate</button>

					<button type="button" class="btn btn-md btn-success btcmd" style="text-align: right !important;border-radius: 4px;background-color: #4caf50;width: 100%;margin-bottom: 10px" onclick="runCommand('migration:fresh')">Fresh</button>

					<button type="button" class="btn btn-md btn-success btcmd" style="text-align: right !important;border-radius: 4px;background-color: #4caf50;width: 100%;margin-bottom: 10px" onclick="runCommand('migration:rollback')">Rollback</button>
				</div>

				<div style="margin-top: 20px;">
					<h5 class="text-muted">Schema</h5>
					<button type="button" class="btn btn-md btn-success btcmd" style="text-align: right !important;border-radius: 4px;background-color: #4caf50;width: 100%;margin-bottom: 10px" onclick="runCommand('schema:dump')">Dump</button>

					<button type="button" class="btn btn-md btn-success btcmd" style="text-align: right !important;border-radius: 4px;background-color: #4caf50;width: 100%;margin-bottom: 10px" onclick="runCommand('schema:dump-prune')">Dump Prune</button>
				</div>

				<div style="margin-top: 30px;">
					<a href="http://sprnva.000webhostapp.com/docs/migration" target="_blank">
						Visit the migration documentation here.
					</a>
				</div>
			</div>

			<div class="col-md-9">
				<div class="row">
					<div class="col-md-12">
						<div class="box box-solid" style="border: 1px solid #dcdcdc;border-radius: 3px;box-shadow: 0 4px 5px 0 rgba(0,0,0,0.2);">
							<div class="box-body" style="padding: 17px;color: #222222;background-color: #fff;">
								<div class="col-md-12">
									<div class="row form-inline" style="display: flex;flex-direction: row;align-items: baseline;">
										<input type="text" class="form-control" id="migrationName" placeholder="migration file name" style="margin-right: 5px;width: 90%;">

										<button type="button bt" class="btn btn-md btn-success btcmd" style="text-align: left !important;border-radius: 4px;background-color: #4caf50;margin-bottom: 10px" onclick="runCommand('migration:make')">Make</button>
									</div>
								</div>

								<div class="col-md-12" style="padding: 10px;border: 1px solid #ddd;height: 430px;overflow-y: auto;">
									<div id="outputContent" style="color: #5d5d5d;"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-1">
		</div>

		<div class="row">
			<div class="col-md-12" style="text-align: center;">
				<span>made with coffee && love by J.Guapin</span>
			</div>
		</div>
	</div>

	<script>
		function runCommand(command) {
			var retval = confirm("Are you sure you want to execute " + command + "?");
			if (retval) {
				$(".btcmd").prop("disabled", true);
				$("#outputContent").html("loading...");

				var migrationName = $("#migrationName").val();
				if (migrationName == "" && command == "migration:make") {
					$("#outputContent").html("Migration name is empty.");
					$(".btcmd").prop("disabled", false);
				} else {
					$.post("migrate-run", {
						command: command,
						migrationName: migrationName
					}, function(data) {
						$("#migrationName").val("");
						$("#outputContent").html(data);
						$(".btcmd").prop("disabled", false);
					});
				}
			}
		}
	</script>

</body>

</html>