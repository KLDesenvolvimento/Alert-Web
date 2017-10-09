<?php
	require_once "../../controllers/session.php";

	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$id = $_GET['id'];

	$selectFuncionario = " SELECT * FROM funcionario ORDER BY nomeFuncionario ASC ";
	$resultFuncionario = mysqli_query($link, $selectFuncionario);

	$selectComando = " SELECT funcionario.*, comandos.* FROM comandos, funcionario WHERE idComando = $id AND funcionario.idFuncionario = comandos.fkFuncionario ";
	$resultComando = mysqli_query($link, $selectComando);
	$total = mysqli_num_rows($resultComando);

	while($comando = mysqli_fetch_array($resultComando)){
		$idComando[] = $comando['idComando'];
		$tituloComando[] = $comando['tituloComando'];
		$descricaoComando[] = $comando['descricaoComando'];
		$nomeFuncionario[] = $comando['nomeFuncionario'];
	}

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
				<h5 class="center">Atualização de Comandos</h5>
				<div class="row">
					<form class="col s12 m12 l12" method="POST" action="../../controllers/atualizar/atualizarComando.php">
						<div class="row">
							<?php
							for($i = 0; $i < $total; $i++){

								echo "
								<div class='input-field col s3 m3 l3'>
									<input id='campoTituloComando' type='text' name='tituloComando' value='$tituloComando[$i]'>
									<label for='campoTituloComando'>Titulo</label>
								</div>
								";
							}
							?>
							<div class="input-field col s3 m3 l3">
								<select id="comboFuncionario" name="funcionario">
									<option value="">Selecione</option>
									<?php
										while($tblFuncionario = mysqli_fetch_array($resultFuncionario))
										{
											echo "<option value='" . $tblFuncionario['idFuncionario'] . "' selected>" . $tblFuncionario['nomeFuncionario'] . "</option>";
										}

										mysqli_close($link);//fecha a conexao com o banco de dados
									?>
								</select>
								<label>Funcionario</label>
							</div>
						</div><!--row-->
						<div class="row">
							<?php
								for ($i=0; $i < $total; $i++) { 
									echo "
									<div class='input-field col s6 l6 m6'>
										<textarea id='campoDescricaoComando' type='text' name='descricaoComando' data-length='5000' maxlength='5000' class='materialize-textarea'>$descricaoComando[$i]</textarea>
										<label for='campoDescricaoComando'>Descrição</label>
									</div>
									<div class='input-field col s1 m1 l1'>
										<input type='hidden' name='idComando' value='$idComando[$i]'>
									</div>
									";
								}
							?>
						</div><!--row-->
						<div class="row">
							<div class="center">
								<button class="btn waves-effect light-blue darken-4" type="submit" name="atualizar">Atualizar</button>
								<button class="btn waves-effect light-blue darken-4" type="reset" name="limpar">Limpar</button>
							</div>
						</div>
					</form>
				</div><!--row-->
			</div><!--row-->
		</div><!--card-panel-->
	</div><!--col s12 m12 l12-->
</div><!--row-->
	
</body>
</html>