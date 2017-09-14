<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Alert Web</title>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/java.js"></script>
	<script type="text/javascript" src="js/materialize.js"></script>
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<link rel="stylesheet"  href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="shortcut icon" href="imagens/icone.ico" type="image/x-icon" />
</head>
<body class="light-blue darken-4">

<div class="container">
	<div class="card-panel white">
		<div class="row">
			<form method="POST" id="formLogin" action="controllers/login.php">
				<div class="row">
					<div class="header col m5 s5 push-m5">
						<!--<h1 style="color: black; font-family: arial; text-indent: center">Web Help</h1>--><!--nome do sistema na tela de login-->
						<img src="imagens/logoIndex.png" height="150px" width="150px" alt="Logo" title="Logo" id="Logo">
					</div><!--header-->
				</div><!--row-->
				<div class="row"></div>
				<div class="row">
					<div class="input-field col m4 push-m4">
						<i class="material-icons prefix">account_circle</i>
						<input type="text" name="usuario" class="validate" id="campoUsuario"><!--campo usuario-->
						<label for="campoUsuario">Usuario</label><!--label do campo usuario-->
					</div>
				</div><!--row-->
				<div class="row">
					<div class="input-field col m4 push-m4">
						<i class="material-icons prefix">lock</i>
						<input type="password" name="senha" id="campoSenha" class="validate"><!--campo senha-->
						<label for="campoSenha">Senha</label><!--label do campo senha-->
					</div><!--input-->
				</div><!--row-->

				<div class="row">
					<div class="col m4 push-m4">
						<button class="btn blue darken-4" onclick="validar();" type="submit" name="login">Login</button><!--bota para fazer o login-->
					</div>
				</div>
			</form>
		</div><!--row-->
		<?php
			for($indice = 0; $indice <= 5; $indice++){
				echo "<div class='row'></div>";
			}//fim do for
			echo "<div class=''>© 2017 CDS Sistemas | Desenvolvido por KL Desenvolvimento</div>";
		?>

	</div><!--cardpanel-->
</div><!--container-->
	
</body>
</html>