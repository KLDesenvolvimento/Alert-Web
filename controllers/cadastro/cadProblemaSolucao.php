<?php

	require_once "../conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	//variaveis
	$categoria = $_POST['categoria'];
	$titulo = $_POST['titulo'];
	$funcionario = $_POST['funcionario'];
	$problema = $_POST['problema'];
	$solucao = $_POST['solucao'];

	$data = date('20y-m-d', strtotime($dataInclusao));

	if($categoria == null){
		$erro = "Categoria não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadProblemaSolucao.php';</script> ";
	}else if($titulo == null){
		$erro = "Titulo não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadProblemaSolucao.php';</script> ";
	}else if($funcionario == null){
		$erro = "Funcionário não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadProblemaSolucao.php';</script> ";
	}else if($problema == null){
		$erro = "Problema não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadProblemaSolucao.php';</script> ";
	}else if($solucao == null){
		$erro = "Solução não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadProblemaSolucao.php';</script> ";
	}

	//comando SQL
	$insert = " INSERT INTO problemaSolucao (fkCategoria, tituloProblemaSolucao, problema, solucao, fkFuncionario, dataInclusao) VALUES ('$categoria', '$titulo', '$problema', '$solucao', '$funcionario', '$data') ";
	$result = mysqli_query($link, $insert);

	if($result)
	{
		echo "<script>alert('Cadastro realizado com sucesso'); window.location.href = '../../views/Cadastro/cadProblemaSolucao.php';</script> ";
	}
	else
	{
		echo "<script>alert('Falha ao cadastrar'); window.location.href = '../../views/Cadastro/cadProblemaSolucao.php';</script> ";
	}

?>