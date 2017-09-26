<?php
	require_once "../controllers/session.php";
	require_once "../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$selectFuncionario = " SELECT funcionario.*, setor.*  FROM funcionario, setor WHERE funcionario.fkSetor = setor.idSetor ";
	$resultFuncionario = mysqli_query($link, $selectFuncionario);
	$total = mysqli_num_rows($resultFuncionario);

	while($tblFuncionario = mysqli_fetch_array($resultFuncionario)){

		$idFuncionario[] = $tblFuncionario['idFuncionario'];
		$nomeFuncionario[] = $tblFuncionario['nomeFuncionario'];
		$usuario[] = $tblFuncionario['usuario'];
		$tipoUsuario[] = $tblFuncionario['tipoUsuario'];
		$setor[] = $tblFuncionario['setor'];

	}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Alert Web</title>
	<script type="text/javascript" src="../js/jquery.js"></script><!--importa o jquery java script-->
	<script type="text/javascript" src="../js/materialize.min.js"></script><!--importa o java script do materialize-->
	<script type="text/javascript" src="../js/java.js"></script><!--importa o java-->
	<link rel="stylesheet" type="text/css" href="../css/materialize.min.css"><!--importa o css do materialize-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><!--importa o local onde se localiza os icones utilizados-->
	<link rel="shortcut icon" href="../imagens/icone.ico" type="image/x-icon" />
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
				<h5 class="center">Consulta de Funcionarios</h5>
				<table class="centered striped">
					<thead>
						<tr>
							<th>Nome</th>
							<th>Usuario</th>
							<th>Setor</th>
							<th>Nivel de Acesso</th>
						</tr>
					</thead>
					<tbody>
						<?php
							for($indice = 0; $indice < $total; $indice++){
								echo "
								<tr>
									<td>$nomeFuncionario[$indice]</td>
									<td>$usuario[$indice]</td>
									<td>$setor[$indice]</td>
									<td>$tipoUsuario[$indice]</td>
								</tr>";
							}
						?>
					</tbody>
				</table>
			</div><!--row-->
		</div><!--card-panel-->
	</div><!--col s12 m12 l12-->
</div><!--row-->
	
</body>
</html>