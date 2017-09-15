<?php

	require_once "../conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	//variaveis
	$categoria = $_POST['categoria'];
	$titulo = $_POST['titulo'];
	$funcionario = $_POST['funcionario'];
	$dataInclusao = $_POST['dataInclusao'];
	$problema = $_POST['problema'];
	$solucao = $_POST['solucao'];

	$data = date('20y-m-d', strtotime($dataInclusao));

	//comando SQL
	$insert = " INSERT INTO problemaSolucao (fkCategoria, tituloProblemaSolucao, problema, solucao, fkFuncionario, dataInclusao) VALUES ('$categoria', '$titulo', '$problema', '$solucao', '$funcionario', '$data') ";
	$result = mysqli_query($link, $insert);

	if($result)
	{
		header('Location:../../views/Cadastro/cadProblemaSolucao.php?resposta=sucesso');
	}
	else
	{
		header('Location:../../views/Cadastro/cadProblemaSolucao.php?resposta=erro');
	}

?>