<?php

	require_once "../conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	//variaveis
	$tituloManual = $_POST['tituloManual'];
	$mesManual = $_POST['mesManual'];
	$funcionario = $_POST['funcionario'];
	$versaoSistema = $_POST['versaoSistema'];
	$descricaoManual = $_POST['descricaoManual'];

	if($tituloManual == null){
		$erro = "Titulo do manual não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadManuais.php';</script> ";
	}else if($mesManual == null){
		$erro = "Mês do manual não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadManuais.php';</script> ";
	}else if($funcionario  == null){
		$erro = "Funcionário não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadManuais.php';</script> ";
	}else if($versaoSistema == null){
		$erro = "Versão do sistema deve ser informada.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadManuais.php';</script> ";
	}else if($descricaoManual == null){
		$erro = "Descrição do manual não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadManuais.php';</script> ";
	}

	//comando SQL

	$insertManual = " INSERT INTO manuais (tituloManual, descricaoManual, fkMes, fkFuncionario, versaoSistema ) VALUES ('$tituloManual', '$descricaoManual', '$mesManual', '$funcionario', '$versaoSistema') ";
	$resultInsert = mysqli_query($link, $insertManual);

	if($resultInsert)
	{
		echo " <script>alert('Cadastro realizado com sucesso.'); window.location.href='../../views/Cadastro/cadManuais.php';</script> ";
	}
	else
	{
		echo " <script>alert('Erro ao cadastrar'); window.location.href='../../views/Cadastro/cadManuais.php';</script> ";
	}

	mysqli_close($link);

?>