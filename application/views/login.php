<!DOCTYPE html>
<html lang="en">
<head>
	<title>Alam Jaya Pratama</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link rel="icon" type="image/png" href="<?= base_url();?>assets/front/images/icons/favicon.ico"/>

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/front/vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/front/fonts/font-awesome-4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/front/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/front/vendor/animate/animate.css">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/front/vendor/css-hamburgers/hamburgers.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/front/vendor/animsition/css/animsition.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/front/vendor/select2/select2.min.css">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/front/vendor/daterangepicker/daterangepicker.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/front/css/util.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url();?>assets/front/css/main.css">

</head>
<body id="body">
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form action="<?= base_url();?>login" method="POST" class="login100-form validate-form">
					<img src="<?= base_url();?>/assets/front/images/ajp1.jpeg" alt="" class="center p-b-20" height="200">
					<span class="login100-form-title p-b-20">
						Login to continue
					</span>
					<?= $this->session->flashdata('message');?>
					
					<div class="wrap-input100 validate-input" data-validate = "Username is required">
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
						<span class="label-input100">Username</span>
					</div>
					
					
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password">
						<span class="focus-input100"></span>
						<span class="label-input100">Password</span>
					</div>

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							
						</div>
					</div>
			

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" >
							Login
						</button>
					</div>
					
					

					<div class="login100-form-social flex-c-m">
						
					</div>
				</form>

				<div class="login100-more" style="background-image: url('assets/front/images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>
	
	

	
	

	<script src="<?= base_url();?>assets/front/vendor/jquery/jquery-3.2.1.min.js"></script>

	<script src="<?= base_url();?>assets/front/vendor/animsition/js/animsition.min.js"></script>

	<script src="<?= base_url();?>assets/front/vendor/bootstrap/js/popper.js"></script>
	<script src="<?= base_url();?>assets/front/vendor/bootstrap/js/bootstrap.min.js"></script>

	<script src="<?= base_url();?>assets/front/vendor/select2/select2.min.js"></script>

	<script src="<?= base_url();?>assets/front/vendor/daterangepicker/moment.min.js"></script>
	<script src="<?= base_url();?>assets/front/vendor/daterangepicker/daterangepicker.js"></script>

	<script src="<?= base_url();?>assets/front/vendor/countdowntime/countdowntime.js"></script>

	<script src="<?= base_url();?>assets/front/js/main.js"></script>
	<script>
var elem = document.getElementById("body");

function openFullscreen() {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  }
}
</script>

</body>
</html>