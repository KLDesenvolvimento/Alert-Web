<?php

	require_once "../controllers/session.php";//instancia a classe que inicia o session

	require_once "../controllers/conexaoBD.php";//instancia a classe de conxao com o banco de dados
	$conexaoBD = new conexaoBD();//armazena a classe de conexao na variavel
	$link = $conexaoBD->conectar();//armazena o retorno da conexao com o banco de dados na variavel

	$selectRamais = " SELECT ramais.*, setor.* FROM ramais, setor WHERE ramais.fkSetorRamal = setor.idSetor ORDER BY setor ASC ";//comando SQL de consulta nas tabelas ramais e setor
	$resultRamais = mysqli_query($link, $selectRamais);//executa o comando SQL acima
	$total = mysqli_num_rows($resultRamais);//verifica se tem registros na tabela

	while($tbl = mysqli_fetch_array($resultRamais)){//enquanto houver registros na tabela ele irá armazenar nas seguintes variaveis

		//tabela ramal
		$nomeRamal[] = $tbl['nomeRamal'];//armazena o nome do ramal
		$numeroRamal[] = $tbl['numeroRamal'];//armazena o numero do ramal

		//tabela setor
		$setor[] = $tbl['setor'];//armazena o setor do ramal

	}//fim do while

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
	<div class="card-panel col s12 m12 l12">
		<ul class="collapsible popout" data-collapsible="accordion">

			<table class="centered striped "><!--tipo de tabela-->
				<thead><!--inicio do cabeçalho da tabela-->
					<tr><!--estrutura do cabeçalho-->
						<th>Setor</th><!--label setor da tabela-->
						<th>Funcionário</th><!--label funcionario da tabela-->
						<th>Ramal</th><!--label ramal da tabela-->
					</tr><!--fim da estrutura do cabeçalho-->
				</thead><!--fim do cabeçalho da tabela-->
				<tbody><!--inicio do corpo da tabela-->
				<?php

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

			?>
				</tbody><!--fim do corpo da tabela-->
			</table>
		</ul>
	</div>
</div>
	
</body>
</html>