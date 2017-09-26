<?php

	require_once "../controllers/session.php";//instancia a classe para abertura do session

	require_once "../controllers/conexaoBD.php";//instancia a classe de conexao com o banco de dados

	$conexaoBD = new conexaoBD();//armazena a classe de conexao na variavel
	$link = $conexaoBD->conectar();//armazena a resposta do retorno da conexao com o banco de dados

	@$pesquisa = $_GET['pesquisa'];

	if($pesquisa == null){

		$selectComandos = " SELECT funcionario.*, comandos.* FROM funcionario, comandos WHERE comandos.fkFuncionario = funcionario.idFuncionario ORDER BY tituloComando ASC ";//select de verificação nas tabelas funcionario e comandos	
	$resultComandos = mysqli_query($link, $selectComandos);//executa o comando SQL acima
	$total = mysqli_num_rows($resultComandos);//verifica se existe linhas na consulta acima

	while($tbl = mysqli_fetch_array($resultComandos)){//enquanto houver linhas irá armazer os valores nas variaveis a seguir

		$idComando[] = $tbl['idComando'];//recebe o id do comando
		$titulo[] = $tbl['tituloComando'];//recebe o titulo do comando
		$descricao[] = $tbl['descricaoComando'];//recebe a descrição do comando
		$funcionario[] = $tbl['nomeFuncionario'];//recebe o nome do funcionario que criou o comando
		$dataInclusao[] = $tbl['dataInclusao'];//recebe a data de inclusao do comando no banco de dados

	}//fim do while

	}else{

		$selectComandos = " SELECT funcionario.*, comandos.* FROM funcionario, comandos WHERE comandos.fkFuncionario = funcionario.idFuncionario AND comandos.tituloComando LIKE '%$pesquisa%' ORDER BY tituloComando ASC ";//select de verificação nas tabelas funcionario e comandos	
	$resultComandos = mysqli_query($link, $selectComandos);//executa o comando SQL acima
	$total = mysqli_num_rows($resultComandos);//verifica se existe linhas na consulta acima

	while($tbl = mysqli_fetch_array($resultComandos)){//enquanto houver linhas irá armazer os valores nas variaveis a seguir

		$idComando[] = $tbl['idComando'];//recebe o id do comando
		$titulo[] = $tbl['tituloComando'];//recebe o titulo do comando
		$descricao[] = $tbl['descricaoComando'];//recebe a descrição do comando
		$funcionario[] = $tbl['nomeFuncionario'];//recebe o nome do funcionario que criou o comando
		$dataInclusao[] = $tbl['dataInclusao'];//recebe a data de inclusao do comando no banco de dados

	}//fim do while

	}

	mysqli_close($link);//fecha a conexao com o banco de dados

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Alert Web</title>
	<script type="text/javascript" src="../js/jquery.js"></script><!--importa o jquery-->
	<script type="text/javascript" src="../js/materialize.min.js"></script><!--importa o java script do materialize-->
	<script type="text/javascript" src="../js/java.js"></script><!--importa o arquivo java que tambem é java script-->
	<link rel="stylesheet" type="text/css" href="../css/materialize.css"><!--importa o css do materialize-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><!--caminho dos icones utilizados-->
	<link rel="shortcut icon" href="../imagens/icone.ico" type="image/x-icon" />
</head>
<body>
	
<div>
	<?php

		require_once "menu.php";//instancia o menu

	?>

<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<h5 class="center">Consulta de Comandos</h5>
			<div class="row">
				<form class=" col s12 m12 l12" method="POST" action="pesquisa/pesquisaComando.php">
				<div class="input-field col s3 m3 l3">
					<input type="search" name="pesquisaComando">
					<label>Pesquisar Comando</label>
				</div>
				<button class="btn waves-effect light-blue darken-4" style="margin-top: 20px;">Pesquisar</button>
			</div>
			<ul class="collapsible popout" data-collapsible="accordion">
				
				<?php

				if($_SESSION['acesso'] == "Administrador"){

					for($indice = 0; $indice < $total; $indice++){//faz uma repetição ate o indice ser igual ao numero de resultados encontrados na tabela de comandos

						$data[$indice] = date('d/m/20y', strtotime($dataInclusao[$indice]));//sempre que for encontrado uma data ele fará a conversão de ano/mes/dia para dia/mes/ano

						//$string = "asdasdadadasda / zcnlnzxlvn / zcxzxcxz";
						$descricao[$indice] = preg_replace("/\//",'<br>',$descricao[$indice]);//sempre que for encontrado uma "/" ele irá fazer a quebra de linha no comando
						//echo $descricao[$indice];

						//monta a tabela
						echo "

							<li>
								<div class='collapsible-header'><i class='material-icons'>label</i>$titulo[$indice]</div>
								
								<div class='collapsible-body'><span>
									<b>Comando SQL:</b> <br>$descricao[$indice]<br></br>
									<b>Autor:</b> $funcionario[$indice]<br></br>
									<b>Data Inclusão:</b> $data[$indice]<br></br>
									<a class='btn waves-effect light-blue darken-4' href='excluir/excluirComandos.php?id=$idComando[$indice]'>Deletar</a><br></br>
									<a class='btn waves-effect light-blue darken-4' href='atualizar/atualizarComando.php?id=$idComando[$indice]'>Alterar</a>
								</span></div>
							</li>

						";
						//fim da tabela

					}//fim do for

				}else{

					for($indice = 0; $indice < $total; $indice++){//faz uma repetição ate o indice ser igual ao numero de resultados encontrados na tabela de comandos

						$data[$indice] = date('d/m/20y', strtotime($dataInclusao[$indice]));//sempre que for encontrado uma data ele fará a conversão de ano/mes/dia para dia/mes/ano

						//$string = "asdasdadadasda / zcnlnzxlvn / zcxzxcxz";
						$descricao[$indice] = preg_replace("/\//",'<br>',$descricao[$indice]);//sempre que for encontrado uma "/" ele irá fazer a quebra de linha no comando
						//echo $descricao[$indice];

						//monta a tabela
						echo "

							<li>
								<div class='collapsible-header'><i class='material-icons'>label</i>$titulo[$indice]</div>
								
								<div class='collapsible-body'><span>
									<b>Comando SQL:</b> <br>$descricao[$indice]<br></br>
									<b>Autor:</b> $funcionario[$indice]<br></br>
									<b>Data Inclusão:</b> $data[$indice]<br></br>
								</span></div>
							</li>

						";
						//fim da tabela

					}//fim do for

				}

				?>

			</ul>
		</form>
		</div><!--row-->
	</div><!--card-panel-->
</div><!--row-->

</body>
</html>