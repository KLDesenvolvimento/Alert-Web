<?php

	require_once "../controllers/session.php";//instancia a classe que cria o session

	require_once "../controllers/conexaoBD.php";//instancia a classe de conexao com o banco de dados
	$conexaoBD = new conexaoBD();//armazena a classe de conexao em uma variavel
	$link = $conexaoBD->conectar();//armazena a resposta da tentativa de conexao com o banco de dados

	$selectManuais = " SELECT funcionario.*, manuais.*, mes.* FROM funcionario, manuais, mes WHERE manuais.fkFuncionario = funcionario.idFuncionario AND manuais.fkMes = mes.idMes ORDER BY tituloManual ASC ";//comando SQL de consulta nas tabelas funcionario e manuais
	$resultManuais = mysqli_query($link, $selectManuais);//executa o comando SQL acima
	$total = mysqli_num_rows($resultManuais);//verifica se contem registros encontrados

	while($tbl = mysqli_fetch_array($resultManuais)){//enquanto houver registros ele ira armazenar os valores nas variaveis

		$funcionario[] = $tbl['nomeFuncionario'];//armazena o nome do funcionario
		$titulo[] = $tbl['tituloManual'];//armazena o titulo do manual
		$descricao[] = $tbl['descricaoManual'];//armazena a descrição do manual
		$data[] = $tbl['mes'];//armazena a data do manual
		$versaoSistema[] = $tbl['versaoSistema'];//armazena a versao do sistema que o manual atende

	}//fim do while

	mysqli_close($link);//fecha a conexao com o banco de dados

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Alert Web</title>
	<script type="text/javascript" src="../js/jquery.js"></script><!--importa o jquery-->
	<script type="text/javascript" src="../js/materialize.min.js"></script><!--importa o java script do materialize-->
	<script type="text/javascript" src="../js/java.js"></script><!--importa o java que inicia as funcionalidades do materialize-->
	<link rel="stylesheet" type="text/css" href="../css/materialize.min.css"><!--importa o css do materialize-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><!--local onde se encontra os icones utilizados no sistema-->
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
		<ul class="collapsible popout" data-collapsible="accordion">
			<?php

				for($indice = 0; $indice < $total; $indice++){//faz um repetição enquanto o indice for menor que a quantidade de registros encontrados

					//monta o collapsible
					echo "

						<li>
							<div class='collapsible-header'><i class='material-icons'>label</i>$titulo[$indice] $data[$indice]</div>
							<div class='collapsible-body'><span>
								Download PDF: <a href='$descricao[$indice]' target='_black'>$descricao[$indice]</a><br><br>
								Data do Manual: $data[$indice]<br><br>
								Funcionário: $funcionario[$indice]<br><br>
								Versão do Sistema: $versaoSistema[$indice]
							</span></div>
						</li>

					";
					//fim do collapsible

				}//fim do for

			?>
		</ul>
	</div>
</div>
	
</body>
</html>