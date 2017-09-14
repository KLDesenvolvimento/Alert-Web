<?php

	require_once "../session.php";//instancia a sessao
	require_once "../conexaoBD.php";//instancia a classe do banco de dados

	$conexaoBD = new conexaoBD();//armazena a classe de conexao com o banco de dados na variavel
	$link = $conexaoBD->conectar();//armazena o retorno da classe de conexao com o banco de dados

	//variaveis
	$tituloComando = $_POST['tituloComando'];
	$funcionario = $_POST['funcionario'];
	$dataInclusao = $_POST['dataInclusao'];
	$descricaoComando = $_POST['descricaoComando'];
	$descricao = addslashes($descricaoComando);

	//converte a data de dd/mm/aaaa para aaaa/mm/dd
	$dataBanco = date('20y-m-d', strtotime($dataInclusao));

	//comandos SQL
	$insertComando = "INSERT INTO `comandos` (`idComando`, `tituloComando`, `descricaoComando`, `fkFuncionario`, `dataInclusao`) VALUES (NULL, '$tituloComando', '$descricao', '$funcionario', '$dataBanco')";
	$resultComando = mysqli_query($link, $insertComando);

	if($resultComando)
	{
		header('Location:../../views/Cadastro/cadComando.php?resposta=sucesso');
	}
	else
	{
		//header('Location:../../views/Cadastro/cadComando.php?resposta=erro');
		var_dump($link);
	}

	mysqli_close($link);//fecha a conexao com o banco de dados
?>