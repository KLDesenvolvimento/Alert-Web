<?php
	require_once "../../controllers/session.php";
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$id = $_GET['id'];

	$selectCliente = " SELECT  *  FROM clientes WHERE idCliente = '$id' ";
	$resultSelect = mysqli_query($link, $selectCliente);
	$total = mysqli_num_rows($resultSelect);

	while($tblCliente = mysqli_fetch_array($resultSelect)){

		$idCliente[] = $tblCliente['idCliente'];
		$nomeCliente[] = $tblCliente['nomeCliente'];
		$cnpjCliente[] = $tblCliente['cnpjCliente'];
		$inscEst[] = $tblCliente['inscEst'];
		$emailCliente[] = $tblCliente['emailCliente'];
		$telefoneCliente[] = $tblCliente['telefoneCliente'];
		$numCliente[] = $tblCliente['numCliente'];
		$cepCliente[] = $tblCliente['cepCliente'];
		$ruaCliente[] = $tblCliente['ruaCliente'];
		$bairroCliente[] = $tblCliente['BairroCliente'];
		$cidadeCliente[] = $tblCliente['cidadeCliente'];
		$ufCliente[] = $tblCliente['ufCliente'];
		$suporteCliente[] = $tblCliente['suporteCliente'];
		$obsCliente[] = $tblCliente['obsCliente'];

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
		require_once "../menu.php";
	?>
</div>

<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<div class="row">
				<h5 class="center">Consulta de Cliente</h5>
				<div class="row">
						<div class="row">
							<h5 class="center">Dados Pessoais</h5>
							<table>
								<thead>
									<tr>
										<th>Nome</th>
										<th>CNPJ</th>
										<th>Inscrição Estadual</th>
										<th>E-Mail</th>
										<th>Telefone</th>
									</tr>
								</thead>
								<tbody>
									<?php

										for($indice = 0; $indice < 1; $indice++){

											echo "
				
												<tr>
													<td>$nomeCliente[$indice]</td>
													<td>$cnpjCliente[$indice]</td>
													<td>$inscEst[$indice]</td>
													<td>$emailCliente[$indice]</td>
													<td>$telefoneCliente[$indice]</td>
												</tr>

											";
										}

									?>
								</tbody>
							</table>
						</div><!--row-->
						<div clss="row">
							<h5 class="center">Endereço</h5>
							<table>
								<thead>
									<tr>
										<th>Rua</th>
										<th>Numero</th>
										<th>Bairro</th>
										<th>Cidade</th>
										<th>UF</th>
									</tr>
								</thead>
								<tbody>
									<?php

									for($indice = 0; $indice < 1; $indice++){

										echo "
				
												<tr>
													<td>$ruaCliente[$indice]</td>
													<td>$numCliente[$indice]</td>
													<td>$bairroCliente[$indice]</td>
													<td>$cidadeCliente[$indice]</td>
													<td>$ufCliente[$indice]</td>
												</tr>

											";
										}

									?>
								</tbody>
							</table>
						</div><!--row-->
						<div class="row">
							
						</div>
						<div class="row">
							<div class="center">
								<a class="btn waves-effect light-blue darken-4" href="clientes.php?pesquisa=">Voltar</a>
							</div><!--center-->
						</div>
				</div><!--row-->
			</div>
		</div>
	</div>
</div>
	
</body>
</html>