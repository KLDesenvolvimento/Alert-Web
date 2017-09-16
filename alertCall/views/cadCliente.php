<?php
	require_once "../../controllers/session.php";
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$selectCliente = " SELECT * FROM cliente  ";

	if(isset($_GET) && !empty($_GET['resposta']))//verifica se a variavel resposta tem valor ou se esta nula
	{//inicio do if

		$resposta = $_GET['resposta'];//armazena o valor do retorno resposta e armazena na variavel

		if($resposta == 'sucesso')//se o valor recebido for igual a sucesso irá exibir a seguinte mensagem
		{//inicio do if
			echo " <script> alert('Cadastro realizado com sucesso!'); window.location.href = 'http://localhost/alert_web/alertCall/views/cadCliente.php'; </script> ";
		}//ifm do if
		else if($resposta == 'erro')//se for igual a erro exibe a seguinte mensagem
		{//inicio do else if
			echo " <script> alert('Erro ao cadastrar!'); window.location.href = 'http://localhost/alert_web/alertCall/views/cadCliente.php'; </script> ";
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
		require_once "../menu.php";
	?>
</div>

<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<div class="row">
				<h5 class="center">Cadastro de Cliente</h5>
				<div class="row">
					<form class="col s12 m12 l12" method="POST" action="../controllers/cadCliente.php">
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
								<label>Suporte</label>
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
							<div class="input-field col s1 m1 l1">
								<input type="text" name="numCliente" id="campoNumCliente">
								<label>Numero</label>
							</div>
							<div class="input-field col s3 m3 l3">
								<input id="campoBairro" type="text" name="bairroCliente">
								<label>Bairro</label>
							</div>
						</div><!--row-->
						<div class="row">
							<div class="input-field col s3 l3 m3">
								<input id="campoCidade" type="text" name="cidadeCliente">
								<label>Cidade</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<select id="comboUf" name="ufCliente">
									<option value="" selected>Selecione</option>
									<option value="Acre">Acre</option>
									<option value="Alagoas">Alagoas</option>
									<option value="Amapá">Amapá</option>
									<option vlaue="Amazonas">Amazonas</option>
									<option value="Bahia">Bahia</option>
									<option value="Ceará">Ceará</option>
									<option value="Distrito Federal">Distrito Federal</option>
									<option value="Espírito Santo">Espírito Santo</option>
									<option value="Goiás">Goiás</option>
									<option value="Maranhão">Maranhão</option>
									<option value="Mato Grosso">Mato Grosso</option>
									<option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
									<option value="Minas Gerais">Minas Gerais</option>
									<option value="Pará">Pará</option>
									<option value="Paraíba">Paraíba</option>
									<option value="Paraná">Paraná</option>
									<option value="Pernambuco">Pernambuco</option>
									<option value="Piauí">Piauí</option>
									<option value="Rio de Janeiro">Rio de Janeiro</option>
									<option value="Rio Grande do Norte">Rio Grande do Norte</option>
									<option value="Rio Grande do Sul">Rio Grande do Sul</option>
									<option value="Rondônia">Rondônia</option>
									<option value="Roraima">Roraima</option>
									<option value="Santa Catarina">Santa Catarina</option>
									<option value="São Paulo">São Paulo</option>
									<option value="Sergipe">Sergipe</option>
									<option value="Tocantins">Tocantins</option>
								</select>
								<label>UF</label>
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
						</div><!--row-->
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
	
</body>
</html>