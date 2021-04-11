<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    session_start();

	if(isset($_SESSION['mesaconfirm'])){
    $mesa = $_SESSION['mesaconfirm'];
	$erro = "location:/pap/index.php?mesa=$mesa&erro=1";
	}else{
		unset($_SESSION['mesaconfirm']);
	}
    
    if(isset($_SESSION['mesaconfirm'])){
        $_SESSION['check'] = $_GET['erro'];
        header($erro);
    }else if((isset ($_SESSION['nick']) == true) && (isset ($_SESSION['senha_login']) == true)){
		header('location:homeadmin.php');
	}

    ?>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
	if(isset($_GET['erro'])){
		echo "<div class='alert alert-danger'>
		<a href='#' class='close' data-dismiss='alert'>&times;</a>
		<i>ERRO!</i> Senha ou Username Errados!
	</div>";
	}
	if(isset($_GET['sucess'])){
		echo "<div class='alert alert-success'>
		<a href='#' class='close' data-dismiss='alert'>&times;</a>
		<i>Sucesso!</i> Inicie sessão com os novos dados!
	</div>";
	}
	?>
	
	<link rel="icon" href="\pap\images\logoatual.png">
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form method="POST" class="login100-form validate-form" action="valida.php">
					<span class="login100-form-logo">
						<img src="images/logoatual.png" height="70" width="70" style="border-radius: 30%;">
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Smart Meal Administration Login
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" id="nick" placeholder="Username">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="pass" id="pass" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-90">
						<a class="txt1" href="#">
							Esqueceu a Password?
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="vendor/animsition/js/animsition.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
	<script src="vendor/countdowntime/countdowntime.js"></script>
	<script src="js/main.js"></script>
	<script src="assets/js/pace.min.js"></script>

</body>
</html>