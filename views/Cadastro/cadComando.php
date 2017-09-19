<?php
	require_once "../../controllers/session.php";

	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$selectFuncionario = " SELECT * FROM funcionario ORDER BY nomeFuncionario ASC ";
	$resultFuncionario = mysqli_query($link, $selectFuncionario);

	// if(isset($_GET) && !empty($_GET['resposta']))//verifica se a variavel resposta tem valor ou se esta nula
	// {//inicio do if

	// 	$resposta = $_GET['resposta'];//armazena o valor do retorno resposta e armazena na variavel

	// 	if($resposta == 'sucesso')//se o valor recebido for igual a sucesso irá exibir a seguinte mensagem
	// 	{//inicio do if
	// 		echo " <script> alert('Cadastro realizado com sucesso!'); window.location.href = 'http://localhost/alert_web/views/Cadastro/cadComando.php'; </script> ";
	// 	}//ifm do if
	// 	else if($resposta == 'erro')//se for igual a erro exibe a seguinte mensagem
	// 	{//inicio do else if
	// 		echo " <script> alert('Erro ao cadastrar!'); window.location.href = 'http://localhost/alert_web/views/Cadastro/cadComando.php'; </script> ";
	// 	}//fim do else if

	// }//fim do if

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
				<h5 class="center">Cadastro de Comandos</h5>
				<div class="row">
					<form class="col s12 m12 l12" method="POST" action="../../controllers/cadastro/cadComando.php">
						<div class="row">
							<div class="input-field col s3 m3 l3">
								<input id="campoTituloComando" type="text" name="tituloComando">
								<label for="campoTituloComando">Titulo</label>
							</div>
							<div class="input-field col s3 m3 l3">
								<select id="comboFuncionario" name="funcionario">
									<option value="" selected>Selecione</option>
									<?php
										while($tblFuncionario = mysqli_fetch_array($resultFuncionario))
										{
											echo "<option value='" . $tblFuncionario['idFuncionario'] . "'>" . $tblFuncionario['nomeFuncionario'] . "</option>";
										}

										mysqli_close($link);//fecha a conexao com o banco de dados
									?>
								</select>
							</div>
							<!--<div class="input-field col s2 m2 l2">
								<input type="date" class="datepicker" name="dataInclusao" id="campoDataInclusao">
							</div>-->
						</div><!--row-->
						<div class="row">
							<div class="input-field col s6 l6 m6">
								<textarea id="campoDescricaoComando" type="text" name="descricaoComando" data-length="5000" maxlength="5000" class="materialize-textarea"></textarea>
								<label for="campoDescricaoComando">Descrição</label>
							</div>
						</div><!--row-->
						<div class="row">
							<div class="center">
								<button class="btn waves-effect light-blue darken-4" type="submit" name="cadastrar">Cadastrar</button>
								<button class="btn waves-effect light-blue darken-4" type="reset" name="limpar">Limpar</button>
							</div>
						</div>
					</form>
				</div><!--row-->
			</div><!--row-->
		</div><!--card-panel-->
	</div><!--col s12 m12 l12-->
</div><!--row-->

<div>
	<?php
		require_once "../rodape.php";
	?>
</div>
	
</body>
</html>