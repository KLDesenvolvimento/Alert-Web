<?php

	require_once "../controllers/session.php";//instancia a classe que inicia a seção

	require_once "../controllers/conexaoBD.php";//instancia a classe de conxao com o banco de dados
	$conexaoBD = new conexaoBD();//armazena a classe na variavel
	$link = $conexaoBD->conectar();//armazena o retorno da tentativa de conexao com o banco de dados

	$selectProblemaSolucao = " SELECT funcionario.*, problemaSolucao.*, categoria.* FROM problemaSolucao, funcionario, categoria WHERE problemaSolucao.fkFuncionario = funcionario.idFuncionario and problemaSolucao.fkCategoria = categoria.idCategoria ORDER BY problemaSolucao.tituloProblemaSolucao ASC ";//comando SQL de consulta nas tabelas funcionario, problemaSolucao e categoria
	$resultProblemaSolucao = mysqli_query($link, $selectProblemaSolucao);//executa o comando SQL acima
	$total = mysqli_num_rows($resultProblemaSolucao);//verifica a quantidade de registros

	while($tbl = mysqli_fetch_array($resultProblemaSolucao)){//enquanto houver registros ira ser armazenados nas seguintes variaveis

		$titulo[] = $tbl['tituloProblemaSolucao'];//armazena o titulo do problema
		$problema[] = $tbl['problema'];//armazena o problema
		$solucao[] = $tbl['solucao'];//armazena a solução
		$funcionario[] = $tbl['nomeFuncionario'];//armazena o nome do funcionario que criou a solução para o problema
		$data[] = $tbl['dataInclusao'];//armazena a data da inclusao

	}//fim do while

	$selectCategoria = " SELECT * FROM categoria ORDER BY nomeCategoria ASC ";//comando SQL de consulta na tabela de categoria
	$resultCategoria = mysqli_query($link, $selectCategoria);//executa o comando SQL acima
	$totalCategoria = mysqli_num_rows($resultCategoria);//verifica a quantidade de registros encontrados na tabela

	while($tblCategoria = mysqli_fetch_array($resultCategoria)){//enquanto houver registros ira armazenar os valores nas seguintes variaveis

		$categoria[] = $tblCategoria['nomeCategoria'];//armazena a categoria do problema

	}//fim do while

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Alert Web</title>
	<script type="text/javascript" src="../js/jquery.js"></script><!--importa o jquery-->
	<script type="text/javascript" src="../js/materialize.min.js"></script><!--importa o java script do materialize-->
	<script type="text/javascript" src="../js/java.js"></script><!--importa o java das funçoes do materialize-->
	<link rel="stylesheet" type="text/css" href="../css/materialize.min.css"><!--importa o css do materialize-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><!--local onde se encontra os icones utilizados no site-->
	<link rel="shortcut icon" href="../imagens/icone.ico" type="image/x-icon" />
</head>
<body>

<div>
	<?php

		require_once "menu.php";//importa o menu

	?>
</div>

<div class="row">
	<div class="card-panel">
		<ul class="collapsible popout" data-collapible="accordion">
			<?php

				for($indice = 0; $indice < $total; $indice++){//faz uma repetição

					$solucao[$indice] = preg_replace("/\//",'<br>',$solucao[$indice]);//verifica se tem "/" na solução, caso haja ele ira fazer a quebra de linha

					//monta o collapsible de problemas e soluções
					echo "

						<li>
							<div class='collapsible-header'><i class='material-icons'>label</i>$titulo[$indice]</div>
							<div class='collapsible-body'><span>
								Problema: $problema[$indice]<br><br>
								Solução: $solucao[$indice]<br><br>
								Funcionário: $funcionario[$indice]<br><br>
								Data Incusão: $data[$indice]
							</span></div>
						</li>

					";
					//fim do collapsible

				}//fim do for

				mysqli_close($link);//fecha a conexao com o banco de dados

			?>	
		</ul>
	</div><!--card-panel-->
</div><!--row-->

</body>
</html>