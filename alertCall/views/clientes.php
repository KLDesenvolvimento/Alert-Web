<?php
	require_once "../../controllers/session.php";
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$selectCliente = " SELECT * FROM cliente  ";

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
		require_once "../menu.php";
	?>
</div>

<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<div class="row">
				<h5 class="center">Consulta de Cliente</h5>
				<div class="row">
					<form class="col s12 m12 l12" method="POST" action="../../controllers/cadastro/cadCliente.php">
						<div class="row">
							<div class="input-field col s4 m4 l4">
								<input type="search" name="pesquisaCliente">
								<label>Pesquisar cliente</label>
							</div>
							<div>
								<button class="btn waves-effect light-blue darken-4" style="margin-top: 20px;">Pesquisar</button>
							</div>
						</div><!--row-->
						<div class="row">
							<table>
								<thead>
									<tr>
										<th>Nome</th>
										<th>Telefone</th>
										<th>Rua</th>
										<th>Bairro</th>
										<th>Cidade</th>
										<th>UF</th>
										<th>Detalhes</th>
									</tr>
								</thead>
								<tbody>
									<?php
										
									?>
								</tbody>
							</table>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	
</body>
</html>