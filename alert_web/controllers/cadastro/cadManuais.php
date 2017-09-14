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

	//comando SQL

	$insertManual = " INSERT INTO manuais (tituloManual, descricaoManual, fkMes, fkFuncionario, versaoSistema ) VALUES ('$tituloManual', '$descricaoManual', '$mesManual', '$funcionario', '$versaoSistema') ";
	$resultInsert = mysqli_query($link, $insertManual);

	if($resultInsert)
	{
		echo "<script>alert('Cadastro realizado com sucesso')</script>";
		header('Location:../../views/Cadastro/cadManuais.php?resposta=sucesso');
	}
	else
	{
		echo "<script>alert('Falha ao cadastrar')</script";
	}

	mysqli_close($link);

?>