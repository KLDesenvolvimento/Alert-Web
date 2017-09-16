<?php
	require_once "../../controllers/session.php";
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$selectSetor = " SELECT * FROM setor ORDER BY setor ASC ";
	$resultSetor = mysqli_query($link, $selectSetor);

	if(isset($_GET) && !empty($_GET['resposta']))//verifica se a variavel resposta tem valor ou se esta nula
	{//inicio do if

		$resposta = $_GET['resposta'];//armazena o valor do retorno resposta e armazena na variavel

		if($resposta == 'sucesso')//se o valor recebido for igual a sucesso irá exibir a seguinte mensagem
		{//inicio do if
			echo " <script> alert('Cadastro realizado com sucesso!'); window.location.href = 'http://localhost/alert_web/views/Cadastro/cadComando.php'; </script> ";
		}//ifm do if
		else if($resposta == 'erro')//se for igual a erro exibe a seguinte mensagem
		{//inicio do else if
			echo " <script> alert('Erro ao cadastrar!'); window.location.href = 'http://localhost/alert_web/views/Cadastro/cadComando.php'; </script> ";
		}//fim do else if

	}//fim do if

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Alert Web</title>
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" src="../../js/materialize.min.js"></script>
	<script type="text/javascript" src="../../js/java.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/materialize.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="shortcut icon" href="../../imagens/icone.ico" type="image/x-icon" />
</head>
<body>

<div>
	<?php
		require_once "menu.php";
	?>
</div>

<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<div class="row">
				<h5 class="center">Cadastro de Ramal</h5>
				<div class="row">
					<form class="" method="POST" action="../../controllers/cadastro/cadRamais.php">
						<div class="row">
							<div class="input-field col s4 m4 l4">
								<input type="text" name="nomeRamal" id="campoNomeRamal" maxlength="100">
								<label for="campoNomeRamal">Nome do Ramal</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<select id="comboSetor" name="setor">
									<option value="" selected>Selecione</option>
									<?php
										while($tblSetor = mysqli_fetch_array($resultSetor))
										{
											echo "<option value='" . $tblSetor['idSetor'] . "'>" . $tblSetor['setor'] . "</option>";
										}

										mysqli_close($link);

									?>
								</select>
								<label>Setor</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<input type="number" name="numeroRamal" id="campoNumeroRamal">
								<label for="campoNumeroRamal">Numero do Ramal</label>
							</div>
						</div><!--row-->
						<div class="row">
							<div class="center">
								<button class="btn waves-effect light-blue darken-4" type="submit" name="cadastrar">Cadastrar</button>
								<button class="btn waves-effect light-blue darken-4" type="reset" name="limpar">Limpar</button>
							</div>
						</div><!--row-->
					</form>
				</div><!--row-->
			</div><!--row-->
		</div>
	</div><!--col s12 m12 l12-->
</div><!--row-->

<div>
	<?php
		require_once "../rodape.php";
	?>
</div>
	
</body>
</html>