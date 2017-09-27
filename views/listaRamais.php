<?php

	require_once "../controllers/session.php";//instancia a classe que inicia o session

	require_once "../controllers/conexaoBD.php";//instancia a classe de conxao com o banco de dados
	$conexaoBD = new conexaoBD();//armazena a classe de conexao na variavel
	$link = $conexaoBD->conectar();//armazena o retorno da conexao com o banco de dados na variavel

	@$pesquisa = $_GET['pesquisa'];

	if($pesquisa == null){

		$selectRamais = " SELECT ramais.*, setor.* FROM ramais, setor WHERE ramais.fkSetorRamal = setor.idSetor ORDER BY setor ASC ";//comando SQL de consulta nas tabelas ramais e setor
		$resultRamais = mysqli_query($link, $selectRamais);//executa o comando SQL acima
		$total = mysqli_num_rows($resultRamais);//verifica se tem registros na tabela

		while($tbl = mysqli_fetch_array($resultRamais)){//enquanto houver registros na tabela ele irá armazenar nas seguintes variaveis

			//tabela ramal
			$idRamal[] = $tbl['idRamal'];//armazena o id do ramal
			$nomeRamal[] = $tbl['nomeRamal'];//armazena o nome do ramal
			$numeroRamal[] = $tbl['numeroRamal'];//armazena o numero do ramal

			//tabela setor
			$setor[] = $tbl['setor'];//armazena o setor do ramal

		}//fim do while


	}else{

		$selectRamais = " SELECT ramais.*, setor.* FROM ramais, setor WHERE ramais.fkSetorRamal = setor.idSetor AND ramais.nomeRamal LIKE '%$pesquisa%'  ORDER BY setor ASC ";//comando SQL de consulta nas tabelas ramais e setor
		$resultRamais = mysqli_query($link, $selectRamais);//executa o comando SQL acima
		$total = mysqli_num_rows($resultRamais);//verifica se tem registros na tabela

		while($tbl = mysqli_fetch_array($resultRamais)){//enquanto houver registros na tabela ele irá armazenar nas seguintes variaveis

			//tabela ramal
			$idRamal[] = $tbl['idRamal'];//armazena o id do ramal
			$nomeRamal[] = $tbl['nomeRamal'];//armazena o nome do ramal
			$numeroRamal[] = $tbl['numeroRamal'];//armazena o numero do ramal

			//tabela setor
			$setor[] = $tbl['setor'];//armazena o setor do ramal

		}//fim do while


	}

	mysqli_close($link);//fecha a conexao com o banco de dados

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
		require_once "menu.php";//importa o menu
	?>
</div>

<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<div class="row">
			<h5 class="center">Lista de Ramais</h5>
				<form class="col s12 m12 l12" method="POST" action="pesquisa/pesquisaRamais.php">
					<div class="row">
						<div class="input-field col s3 m3 l3">
							<input type="search" name="pesquisaRamal">
							<label>Pesquisa Ramal</label>
						</div><!--input-field-->
						<button class="btn waves-effect light-blue darken-4" style="margin-top: 20px;">Pesquisar</button>
					</div><!--row-->
					<ul class="collapsible popout" data-collapsible="accordion">

						<table class="centered striped "><!--tipo de tabela-->
							<thead><!--inicio do cabeçalho da tabela-->
								<tr><!--estrutura do cabeçalho-->
									<th>Setor</th><!--label setor da tabela-->
									<th>Funcionário</th><!--label funcionario da tabela-->
									<th>Ramal</th><!--label ramal da tabela-->
									<?php
										if($_SESSION['acesso'] == "Administrador"){
											echo "
											<th>Deletar</th>
											<th>Atualizar</th>
											";
										}
									?>
								</tr><!--fim da estrutura do cabeçalho-->
							</thead><!--fim do cabeçalho da tabela-->
							<tbody><!--inicio do corpo da tabela-->
							<?php

								if($_SESSION['acesso'] == "Administrador"){

									for($indice = 0; $indice < $total; $indice++){//verifica enquanto o indice for menor que a quantidade de registros encontrados na tabela ele ira alimentando a tabela

										//inicio da tabela
										echo "

													<tr>
														<td>$setor[$indice]</td>
														<td>$nomeRamal[$indice]</td>
														<td>$numeroRamal[$indice]</td>
														<td><a class='btn waves-effect light-blue darken-4' href='excluir/excluirRamais.php?id=$idRamal[$indice]'>Deletar</a></td>
														<td><a class='btn waves-effect light-blue darken-4' href='atualizar/atualizarRamais.php?id=$idRamal[$indice]'>Atualizar</a></td>
													</tr>

										";
										//fim da tabela

									}//fim do for

								}else{

									for($indice = 0; $indice < $total; $indice++){//verifica enquanto o indice for menor que a quantidade de registros encontrados na tabela ele ira alimentando a tabela

										//inicio da tabela
										echo "

													<tr>
														<td>$setor[$indice]</td>
														<td>$nomeRamal[$indice]</td>
														<td>$numeroRamal[$indice]</td>
													</tr>

										";
										//fim da tabela

									}//fim do for

								}

							?>
							</tbody><!--fim do corpo da tabela-->
						</table>
					</ul>
				</form>
			</div>
		</div>
	</div>
</div>
	
</body>
</html>