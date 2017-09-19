<?php

	require_once "../conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	//variaveis
	$nomeRamal = $_POST['nomeRamal'];
	$setor = $_POST['setor'];
	$numeroRamal = $_POST['numeroRamal'];

	if($nomeRamal == null){
		$erro = "Nome do ramal não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadRamais.php';</script> ";
	}else if($setor == null){
		$erro = "Setor não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadRamais.php';</script> ";
	}else if($numeroRamal == null){
		$erro = "Número do ramal não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadRamais.php';</script> ";
	}

	//comando SQL
	$insertRamal = " INSERT iNTO ramais (fkSetorRamal, nomeRamal, numeroRamal) VALUES ('$setor', '$nomeRamal', '$numeroRamal') ";
	$resultInsert = mysqli_query($link, $insertRamal);

	if($resultInsert)
	{
		echo "<script>alert('Cadastro realizado com sucesso'); window.location.href = '../../views/Cadastro/cadRamais.php';</script> ";
	}
	else
	{
		echo "<script>alert('Falha ao cadastrar'); window.location.href = '../../views/Cadastro/cadRamais.php';</script> ";
	}
	
?>