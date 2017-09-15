<?php

	require_once "../conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	//variaveis
	$nomeRamal = $_POST['nomeRamal'];
	$setor = $_POST['setor'];
	$numeroRamal = $_POST['numeroRamal'];

	//comando SQL
	$insertRamal = " INSERT iNTO ramais (fkSetorRamal, nomeRamal, numeroRamal) VALUES ('$setor', '$nomeRamal', '$numeroRamal') ";
	$resultInsert = mysqli_query($link, $insertRamal);

	if($resultInsert)
	{
		echo "<script>alert('Cadastro realizado com sucesso')</script>";
		header('Location:../../views/Cadastro/cadRamais.php?resposta=sucesso');
	}
	else
	{
		echo "<script>alert('Falha ao cadastrar')</script>";
		header('Location:../../views/Cadastro/cadRamais.php?resposta=erro');
	}
	
?>