<?php
	require_once "../../controllers/session.php";
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$selectFuncionario = " SELECT * FROM funcionario ";
	$resultFuncionario = mysqli_query($link, $selectFuncionario);

	$selectIndicador = " SELECT * FROM indicador ";
	$resultIndicador = mysqli_query($link, $selectIndicador);

	$selectJustificativa = " SELECT * FROM justificativa ";
	$resultJustificativa = mysqli_query($link, $selectJustificativa);

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
				<h5 class="center">Cadastrar Pontuação</h5>
				<form class="col s12 m12 l12" method="POST" action="../../controllers/cadastro/cadPontuacao.php">
					<div class="row">
						<div class="input-field col s3 m3 l3">
							<select id="comboFuncionario" name="funcionario">
								<option value="" selected>Selecione</option>
								<?php
									while($tblFuncionario = mysqli_fetch_array($resultFuncionario)){

										echo " <option value='" . $tblFuncionario['idFuncionario'] .  "'>". $tblFuncionario['nomeFuncionario'] . "</option>";

									}//fim do while

									mysqli_close($link);
								?>
							</select>
							<label>Funcionario</label>
						</div><!--input-field-->
						<div class="input-field col s3 m3 l3">
							<select id="comboIndicador" name="indicador">
								<option value="" selected>Selecione</option>
								<?php
									while($tblIndicador = mysqli_fetch_array($resultIndicador)){

										echo " <option value='" . $tblIndicador['valorPontos'] . "'>" . $tblIndicador['nomeIndicador'] . "</option>";

									}//fim do while

									mysqli_close($link);
								?>
							</select>
							<label>Indicador</label>
						</div><!--input-field-->
						<div class="input-field col s3 m3 l3">
							<select id="comboJustificativa" name="justificativa">
								<option value="" selected>Selecione</option>
								<?php
									while($tblJustificativa = mysqli_fetch_array($resultJustificativa)){

										echo " <option value='" . $tblJustificativa['idJustificativa'] . "'>" . $tblJustificativa['nomeJustificativa'] . "</option> ";

									}

									mysqli_close($link);
								?>
							</select>
							<label>Justificativa</label>
						</div>
						<div class="input-field col s3 m3 l3">
							<input type="date" name="dataPontuacao">
						</div>
					</div><!--row-->
					<div class="row">
						<div class="center">
							<button class="btn waves-effect light-blue darken-4" name="cadastrar">Cadastrar</button>
							<button class="btn waves-effect light-blue darken-4" name="limpar">Limpar</button>
						</div>
					</div><!--row-->
				</form>
			</div><!--row-->
		</div><!--card-panel-->
	</div><!--col s12 m12 l12-->
</div><!--row-->
	
</body>
</html>