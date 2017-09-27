<?php
	require_once "../conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$idRamal = $_POST['idRamal'];
	$nomeRamal = $_POST['nomeRamal'];
	$setor = $_POST['setor'];
	$numeroRamal = $_POST['numeroRamal'];
	$erro = null;

	if($nomeRamal == null){
		$erro = "Nome do ramal não pode ser branco.";
		echo "<script>alert($erro); window.location.href='../../views/atualizar/atualizarRamais.php';</script>";
	}else if($setor == null){
		$erro = "Setor não pode ser branco.";
		echo "<script>alert($erro); window.location.href='../../views/atualizar/atualizarRamais.php';</script>";
	}else if($numeroRamal == null){
		$erro = "Numero do ramal não pode ser em branco.";
		echo "<script>alert($erro); window.location.href='../../views/atualizar/atualizarRamais.php';</script>";
	}

	$updateRamais = " UPDATE ramais SET nomeRamal = '$nomeRamal', fkSetorRamal = '$setor', numeroRamal = '$numeroRamal' ";
	$resultUpdate = mysqli_query($link, $updateRamais);

	if($resultUpdate){

		echo "<script>alert('Atualização realizada com sucesso.'); window.location.href='../../views/listaRamais.php';</script>";

	}else{

		echo "<script>alert('Falha ao atualizar ramal.'); window.location.href='../../views/listaRamais.php';</script>";

	}

?>