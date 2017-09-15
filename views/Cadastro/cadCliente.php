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
		require_once "menu.php";
	?>
</div>

<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<div class="row">
				<h5 class="center">Cadastro de Cliente</h5>
				<div class="row">
					<form class="col s12 m12 l12" method="POST" action="../../controllers/cadastro/cadCliente.php">
						<div class="row">
							<div class="input-field col s4 m4 l4">
								<input id="campoNomeCliente" type="text" name="nomeCliente" maxlength="150">
								<label>Nome Cliente</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<input id="campoCnpj" type="text" name="cnpjCliente">
								<label>CNPJ</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<input id="campoIncEst" type="text" name="inscEst">
								<label>Incrição Estadual</label>
							</div>
							<div class="input-field col s4 m4 l4">
								<input id="campoEmail" type="email" name="emailCliente" class="validate">
								<label data-success="E-Mail válido" data-error="E-Mail inválido">E-Mail</label>
							</div>
						</div><!--row-->
						<div class="row">
							<div class="input-field col s2 m2 l2">
								<input id="campoTelefone" type="text" name="telefoneCliente">
								<label>Telefone</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<select id="comboSuporte" name="suporteCliente">
									<option value="" selected>Selecione</option>
									<option value="Sim">Sim</option>
									<option value="Nao">Não</option>
								</select>
							</div>
						</div><!--row-->
						<h5 class="center">Endereço</h5>
						<div class="row">
							<div class="input-field col s2 m2 l2">
								<input id="campoCep" type="text" name="cepCliente">
								<label>CEP</label>
							</div>
							<div class="input-field col s4 m4 l4">
								<input id="campoRua" type="text" name="ruaCliente">
								<label>Rua</label>
							</div>
							<div class="input-field col s3 m3 l3">
								<input id="campoBairro" type="text" name="bairroCliente">
								<label>Bairro</label>
							</div>
							<div class="input-field col s3 l3 m3">
								<input id="campoCidade" type="text" name="cidadeCliente">
								<label>Cidade</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<select id="comboUf" name="ufCliente">
									<option value="" selected>Selecione</option>
								</select>
							</div>
						</div><!--row-->
						<div class="row">
							<h5>Observações do Cliente</h5>
							<div class="input-field col s6 m6 l6">
								<textarea id="campoObs" name="obsCliente" type="text" data-length="500" maxlength="500" class="materialize-textarea"></textarea>
								<label>Observações do Cliente</label>
							</div>
						</div><!--row-->
						<div class="row">
							<div class="center">
								<button id="btnCadastrar" name="cadastrar" class="btn waves-effect light-blue darken-4">Cadastrar</button>
								<button  id="btnLimpar" name="limpar" class="btn waves-effect light-blue darken-4">Limpar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	
</body>
</html>