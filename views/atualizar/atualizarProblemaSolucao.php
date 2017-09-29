<?php
	require_once "../../controllers/session.php";
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$id = $_GET['id'];

	$selectCategoria = " SELECT * FROM categoria ORDER BY nomeCategoria ASC ";
	$resultCategoria = mysqli_query($link, $selectCategoria);

	$selectFuncionario = " SELECT * FROM funcionario ORDER BY nomeFuncionario ASC ";
	$resultFuncionario = mysqli_query($link, $selectFuncionario);

	$selectProblemaSolucao = " SELECT categoria.*, problemaSolucao.*, funcionario.* FROM funcionario, problemaSolucao, categoria WHERE problemaSolucao.fkCategoria = categoria.idCategoria AND problemaSolucao.fkFuncionario = funcionario.idFuncionario AND idProblemaSolucao = $id";
	$resultProblemaSolucao = mysqli_query($link, $selectProblemaSolucao);
	$total = mysqli_num_rows($resultProblemaSolucao);

	while($ps = mysqli_fetch_array($resultProblemaSolucao)){
		$idProblemaSolucao[] = $ps['idProblemaSolucao'];
		$tituloProblemaSolucao[] = $ps['tituloProblemaSolucao'];
		$problema[] = $ps['problema'];
		$solucao[] = $ps['solucao'];
	}

?>

<!DOCTYPE html>
<html lang="en">
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
		require_once "menu.php"
	?>
</div>

<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<div class="row">
				<h5 class="center">Atualização de Problemas e Soluções</h5>
				<div class="row">
					<form class="col s12 m12 l12" method="POST" action="../../controllers/atualizar/atualizarProblemaSolucao.php">
						<div class="row">
							<div class="input-field col s2 m2 l2">
								<select id="comboCategoria" name="categoria">
									<option value="" selected>Selecione</option>
									<?php
										while($tblCategoria = mysqli_fetch_array($resultCategoria))
										{
											echo "<option value='" . $tblCategoria['idCategoria'] . "'>" . $tblCategoria['nomeCategoria'] . "</option>";
										}

										mysqli_close($link);

									?>
								</select>
								<label>Categoria</label>
							</div>
							<?php
								for ($i=0; $i < $total; $i++) { 
									echo "
										<div class='input-field col s5 m5 l5'>
											<input type='text' name='titulo' id='campoTitulo' maxlength='100' value='$tituloProblemaSolucao[$i]'>
											<label>Titulo Problema</label>
										</div>
									";
								}
							?>
							<div class="input-field col s3 m3 l3">
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
						</div><!--row-->
						<div class="row">
							<?php

								for ($i=0; $i < $total; $i++) { 

									echo "
										<div class='input-field col s6 m6 l6'>
											<textarea id='campoProblema' name='problema' type='text' data-length='2000' maxlength='2000' class='materialize-textarea'>$problema[$i]</textarea>
											<label>Problema</label>
										</div>
										<div class='input-field col s6 m6 l6'>
											<textarea id='campoSolucao' name='solucao' type='text' data-length='5000' maxlength='5000' class='materialize-textarea'>$solucao[$i]</textarea>
											<label>Solução</label>
										</div>
									";
								}
							?>
						</div>	<!--row-->
						<div class='row'>
							<?php
							for ($i=0; $i < $total; $i++) { 
								echo "
									<div class='input-field s1 m1 l1'>
										<input type='hidden' name='idProblemaSolucao' value='$idProblemaSolucao[$i]'>
									</div>
								";
							}
							?>
						</div>
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