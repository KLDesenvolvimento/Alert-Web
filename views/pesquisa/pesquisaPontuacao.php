<?php
	$dataInicial = $_POST['buscaDataInicial'];

	$dataFinal = $_POST['buscaDataFinal'];

	header("Location:../Cadastro/cadPontuacao.php?pesquisa=$dataInicial&pesquisa2=$dataFinal");
?>