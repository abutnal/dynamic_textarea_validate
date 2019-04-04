<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Personal Information</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/custom.css">
	<link href="assets/css/jquery.ui.css" rel="stylesheet" />
	<script type="text/javascript" src="assets/js/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/jquery.ui.js"></script>
	<script type="text/javascript" src="jscript.php"></script>
</head>
<body>
	<div class="container">
		<div class="row"><br>
			<div class="col-md-6 col-md-offset-3">
				<!-- Display result -->
				<div id="result"></div>

				<div class="panel panel-primary">
					<div class="panel-heading">Form Validation</div>
					<div class="panel-body">
						<form action="controller.php" method="post" id="saveForm">
							<div class="row">
								<div class="input_fields_wrap">
									<div>
										<div class="col-md-12 count_div">
											<div class="form-group">
												<label for="" class="label label_0">Plan: Day 1</label> 
												<textarea name="days[]" id="input_0" cols="30" rows="2" class="form-control"></textarea>
												<button class="add_field_button btn btn-xs btn-primary pull-right">Add Day +</button>
											</div>
										</div>
									</div>
								</div>

								<div class="col-md-12">
									<div class="form-group"><label for="" class="label label-name">Name</label><input type="text" name="name" id="input-name" autocomplete="off"  class="form-control"></div>
								</div>
								<div class="col-md-12"> 
									<div class="form-group"><label for="" class="label label-phone">Phone</label><input type="text" name="phone" id="input-phone" autocomplete="off" class="form-control"></div>
								</div>
								<div class="col-md-12">
									<div class="form-group"><label for="" class="label label-email">Email</label><input type="text" name="email" id="input-email" autocomplete="off" class="form-control"><div class="error"></div></div>
								</div>
								<div class="col-md-12">
									<a href="" class="btn btn-default pull-left">Reset</a>
									<input type="submit" name="submit" class="btn btn-primary pull-right">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>


<!-- End:: -->
</body>
</html>