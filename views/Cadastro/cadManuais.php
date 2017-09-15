<?php
	require_once "../../controllers/session.php";
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$selectMes = " SELECT * FROM mes ";
	$resultMes = mysqli_query($link, $selectMes);

	$selectFuncionario = " SELECT * FROM funcionario ORDER BY nomeFuncionario ASC ";
	$resultFuncionario = mysqli_query($link, $selectFuncionario);

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
				<h5 class="center">Cadastro de Manuais</h5>
				<div class="row">
					<form class="col s12 m12 l12" method="POST" action="../../controllers/cadastro/cadManuais.php">
						<div class="row">
							<div class="input-field col s3">
								<input id="campoTituloManual" type="text" name="tituloManual">
								<label for="campoTituloManual">Titulo</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<select id="comboMesManual" name="mesManual">
									<option value="" selected>Selecione</option>
									<?php
										while($tblMes = mysqli_fetch_array($resultMes))
										{
											echo "<option value='" . $tblMes['idMes'] . "'>" . utf8_encode($tblMes['mes']) . "</option>";
										}

										mysqli_close($link);
									?>
								</select>
								<label>Mês do Manual</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<select id="comboFuncionario" name="funcionario">
									<option value="" selected>Selecione</option>
									<?php
										while($tblFuncionario = mysqli_fetch_array($resultFuncionario))
										{
											echo "<option value='" . $tblFuncionario['idFuncionario'] . "'>" . $tblFuncionario['nomeFuncionario'] . "</option>";
										}

										mysqli_close($link);
									?>
								</select>
								<label>Funcionário</label>
							</div>
							<div class="input-field col s3 m3 l3">
								<input id="campoVersaoSistema" type="text" name="versaoSistema" maxlength="50">
								<label for="campoVersaoSistema">Versão do Sistema</label>
							</div>
						</div><!--row-->
						<div class="row">
							<div class="input-field col s6">
								<textarea id="campoDescricaoManual" type="text" name="descricaoManual" data-length="120" maxlength="120" class="materialize-textarea"></textarea>
								<label for="campoDescricaoManual">Descrição</label>
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
		</div><!--card-panel-->
	</div>
</div><!--row-->

<div>
	<?php
		require_once "../rodape.php";
	?>
</div>
	
</body>
</html>