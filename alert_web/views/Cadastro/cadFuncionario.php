<?php

	require_once "../../controllers/session.php";//instancia a classe que inicia o session

	require_once "../../controllers/conexaoBD.php";//instancia a classe de conexao com o banco de dados

	$conexaoBD = new conexaoBD();//armazena a classe de conxao na variavel
	$link = $conexaoBD->conectar();//armazena o retorno da tentativa de conexao do banco de dados

	$selectSetor = " SELECT * FROM setor ORDER BY setor ASC ";//comando SQL de consulta na tabela Setor
	$resultSetor = mysqli_query($link, $selectSetor);//executa o comando SQL acima

	if(isset($_GET['resposta'])){
		$resposta = $_GET['resposta'];
	}else{
		$resposta = "";
	}

	mysqli_close($link);//fecha a conexao com o banco de dados

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

		require_once "menu.php";//importa o menu

	?>
</div>

<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
		<div class="row">
			<div class="row">
				<h5 class="center">Cadastro de Funcionário</h5>
					<form class="col s12 m12 l12" method="POST" action="../../controllers/cadastro/cadFuncionario.php">
						<div class="row">
							<div class="input-field col s3 m3 l3">
								<input id="campoNomeFuncionario" type="text" name="nomeFuncionario" maxlength="100">
								<label for="campoNomeFuncionario">Nome Funcionário</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<input type="text" name="usuario" id="campoUsuario" maxlength="80">
								<label for="campoUsuario">Usuário</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<input type="password" name="senha" id="campoSenha" maxlength="50">
								<label for="campoSenha">Senha</label>
							</div>
							<div class="input-field col s2 m2 l2">
								<select id="comboSetor" name="setor">
									<option value="" selected>Selecione</option>
									<?php

										while($tblSetor = mysqli_fetch_array($resultSetor)){//enquanto houver resultado ele ira executar o preenchimento do combo box

											echo "<option value='" . $tblSetor['idSetor'] . "'>" . $tblSetor['setor'] . "</option>";//preenche o combo box

										}//fim while

										mysqli_close($link);//fecha a conexao com o banco de dados

									?>
								</select>
								<label>Setor</label><!--label do combo box-->
							</div>
							<div class="input-field col s2 m2 l2">
								<select id="comboAcesso" name="acesso">
									<option value="" selected>Selecione</option>
									<option value="Administrador">Administrador</option>
									<option value="Funcionario">Funcionario</option>
								</select>
								<label>Nivel de Acesso</label><!--label do combo box-->
							</div>
						</div><!--row-->
						<div class="row">
							<div class="center">
								<button class="btn waves-effect light-blue darken-4" type="submit" name="cadastrar">Cadastrar</button>
								<button class="btn waves-effect light-blue darken-4" type="reset" name="limpar">Limpar</button>
							</div><!--center-->
						</div><!--row-->
					</form>
				</div><!--row-->
			</div><!--row-->
		</div><!--card-panel-->
	</div><!--col s12 m12 l12-->
</div><!--row-->

<div>
	<?php

		require_once "../rodape.php";//importa o rodape

	?>
</div>
	
</body>
</html>