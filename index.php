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
</head>
<body>
	<div class="container">
		<div class="row"><br>
			<div class="col-md-6 col-md-offset-3">
				<!-- Display result -->
				<div id="result"></div>

				<div class="panel panel-warning">
					<div class="panel-heading">Validation Text</div>
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
									<input type="submit" name="submit" class="btn btn-danger pull-right">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		$(document).ready(function(){
	//Start:: Get Form Data		
			$(document).on('submit', '#saveForm', function(event){
				event.preventDefault();
				var $form = $(this);
				var x = $form.serializeArray();
				var y = $form.serializeArray();
				x.reverse(); 
			// x.splice(0, 1);
			var count = 0;
			$.each(x, function(key, feilds){
				if (feilds.value == "" && feilds.name!='days[]') {
					$('#input-'+feilds.name).addClass('bcolor');
					$('.label-'+feilds.name).addClass('label_val');
					$('#input-'+feilds.name).removeClass('green_bcolor');
					$('.label-'+feilds.name).removeClass('green_label_val');
					$('#input-'+feilds.name).focus();
					count++
				}
			});
			var  string = "";
			$.each(y, function(key, feilds){
				if (feilds.name=='days[]') {
					if($('#input_'+key).val()=="" || $('#input_'+key).val() == null){
						string = string.concat(key+',');
						count++;
					}
				}  
			});
			var new_string = string.replace(/,(\s+)?$/, ''); 
			var array = new_string.split(',');
			array.reverse(); 
			$.each(array, function(key, value){
				$('#input_'+value).addClass('bcolor');
				$('.label_'+value).addClass('label_val');
				$('#input_'+value).removeClass('green_bcolor');
				$('.label_'+value).removeClass('green_label_val');
				$('#input_'+value).focus();

			});

			if (count>0 || check_phone()==false){
				console.log('failed val');
			}else{
				$.ajax({
					url: $form.attr('action'),
					method: $form.attr('method'),
					data: $form.serialize(),
					success:function(response){
						// console.log(response);
						$('#result').html(response);
					}
				});
			}
		});
//End::


//Start:: remove validation css class
$(document).on('keydown', 'input:text', function(){
	$form = $(this);
	var x = $form.serializeArray();
	$.each(x, function(i, field){
		if ($.trim(field.value) != '') {
			$('#input-'+field.name).removeClass('bcolor');
			$('.label-'+field.name).removeClass('label_val');
			$('#input-'+field.name).addClass('green_bcolor');
			$('.label-'+field.name).addClass('green_label_val');
		}

	});
});
});

$(document).on('keydown', '#input_0', function(){
$('#input_0').removeClass('bcolor');
$('.label_0').removeClass('label_val');
$('#input_0').addClass('green_bcolor');
$('.label_0').addClass('green_label_val');
});
//End::

//Start:: Dynamic display Email Validation error.
$(document).on('keyup', '#input-email', function(){
	var data = this.value.toLowerCase();
	// console.log(data);
	$('#input-email').val(data);
	check_email();
});
//End::


//Start::Check Email Validation.
function check_email(){
	var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
	if(pattern.test($("#input-email").val())) {
		$('#input-email').removeClass('bcolor');
		$('.label-email').removeClass('label_val');
		$('#input-email').addClass('green_bcolor');
		$('.label-email').addClass('green_label_val');
		$('.label-email').html('Email');
		return true;
	} else {
		$('#input-email').removeClass('green_bcolor');
		$('.label-email').removeClass('green_label_val');
		$('#input-email').addClass('bcolor');
		$('.label-email').addClass('label_val');
		$('.label-email').html('Enter valid email id');
		return false;
	}	
}
//End::


//Start::Dynamic display Phone Validation error.
$(document).on('keyup', '#input-phone', function(){
	var maxLimit = 10;
	var lengthCount = this.value.length;              
	if (lengthCount > maxLimit) {
		this.value = this.value.substring(0, maxLimit);
		var charactersLeft = maxLimit - lengthCount + 1;                   
	}
	else {                   
		var charactersLeft = maxLimit - lengthCount;                   
	}
	$('.label-phone').html('Enter valid phone number <span class="phonecount"><b>'+ charactersLeft +'</b></span>');
	check_phone();	
});
//End::

//Start:: check phone number length (phone validation).
function check_phone(){
	var phone = $("#input-phone").val();
	if (phone.length!=10) {
		$('#input-phone').removeClass('green_bcolor');
		$('.label-phone').removeClass('green_label_val');
		$('#input-phone').addClass('bcolor');
		$('.label-phone').addClass('label_val');
		// $('.label-phone').html('Enter valid phone number');
		return false;
	}
	else{
		$('#input-phone').removeClass('bcolor');
		$('.label-phone').removeClass('label_val');
		$('#input-phone').addClass('green_bcolor');
		$('.label-phone').addClass('green_label_val');
		$('.label-phone').html('Phone');
		return true;
	}
}
//End::

//Start:: First Char Capital of Each word
$(document).on('keyup', '#input-name', function(){
	if($('#input-name').val()!=""){
		var data = $('#input-name').val();
		$('#input-name').val(capitalize_Words(data));
		$('#input-name').addClass('green_bcolor');
		$('.label-name').addClass('green_label_val');
		var maxLimit = 30;
		var lengthCount = this.value.length;              
		if (lengthCount > maxLimit) {
			this.value = this.value.substring(0, maxLimit);
			var charactersLeft = maxLimit - lengthCount + 1;                   
		}
		else {                   
			var charactersLeft = maxLimit - lengthCount;                   
		}
	// console.log(charactersLeft)
}
});

function capitalize_Words(data)
{
	return data.replace(/\w\S*/g, function(txt)
	{
		return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
	});
	console.log(data);
}
//End::



//Start:: Nuber Validation.
$(document).ready(function () {
	$("#input-phone").keypress(function (e) {
  	// allow numbers only.
  	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
  		return false;
  	}
  });
});
//End::

//Start:: Alphabets validation.
$(document).ready(function(){
	$("#input-name").keypress(function(event){
		var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 122) && (inputValue != 32 && inputValue != 0)) { 
        	event.preventDefault(); 
        }
    });
});
//End:: 
</script>

<!--Start:: Dynamic Textarea adding -->
<script type="text/javascript">
	$(document).ready(function() {
var max_fields      = 30; //maximum input boxes allowed
var wrapper       = $(".input_fields_wrap"); //Fields wrapper
var add_button      = $(".add_field_button"); //Add button ID

var x = 1; //initlal text box count
var count = 2;
$(add_button).click(function(e){ //on add input button click
	e.preventDefault();

if(x < max_fields){ //max input box allowed
x++; //text box increment
$(wrapper).append('<div class="col-md-12 count_div" id="txtarea"><div class="form-group"><label for="" class="label label_'+ (parseInt(x) - 1) +'">Plan: Day '+ x +'</label>               <textarea name="days[]" id="input_'+ (parseInt(x) - 1) +'" cols="30" rows="2" class="form-control"></textarea><a href="#" class="remove_field btn btn-danger btn-xs pull-right" id="remove'+ x +'">Remove</a> </div></div>'); //add input box
var cc = x - 1;
console.log(cc);
$('#input_'+cc).on('keydown', function(){
	// console.log(cc);
	$('#input_'+cc).removeClass('bcolor');
	$('.label_'+cc).removeClass('label_val');
	$('#input_'+cc).addClass('green_bcolor');
	$('.label_'+cc).addClass('green_label_val');
});
$('#remove'+cc).attr('disabled','disabled');
$('#remove'+cc).prop('disabled', true);
}
});

  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
  	e.preventDefault();
  	$(this).parent('div').remove();
  	x--;
  	var cc = x;
  	$('#remove'+cc).removeAttr("disabled");
  })
});
</script>
<!-- End:: -->
</body>
</html>