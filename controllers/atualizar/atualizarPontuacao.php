<?php


		require_once "../../controllers/session.php";
	require_once "../../controllers/conexaoBD.php";	

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	
	$idPontuacao = $_POST['idPont'];
	$funcionario = $_POST['funcionario'];
	$indicador = $_POST['indicador'];
	$justificativa = $_POST['justificativa'];
	$dataPontos = $_POST['dataPontos'];
	$erro = null;
	
	


	

	if($funcionario == null){
		$erro = "Funcionario não pode ficar em branco.";
		echo "<script>alert($erro); window.location.href='../../views/atualizar/atualizarPontuacao.php';</script>";
	}else if($indicador == null){
		$erro = "Indicador não pode ficar em branco.";
		echo "<script>alert($erro); window.location.href='../../views/atualizar/atualizarPontuacao.php';</script>";
	}else if($justificativa == null){
		$erro = "Justificativa do não pode ficar em branco.";
		echo "<script>alert($erro); window.location.href='../../views/atualizar/atualizarPontuacao.php';</script>";
	}
	
	$updateRamais = " UPDATE pontuacoes SET fkFuncionario = '$funcionario', fkIndicador = '$indicador', fkJustificativa = '$justificativa', dataPontos= '$dataPontos' WHERE idPontuacao='$idPontuacao' " ;
	$resultUpdate = mysqli_query($link, $updateRamais);

	if($resultUpdate){

		echo "<script>alert('Atualização realizada com sucesso.'); window.location.href='../../views/cadastro/cadPontuacao.php';</script>";

	}else{

		echo "<script>alert('Falha ao atualizar pontuacao.'); window.location.href='../view/atualizar/atualizarPontuacao.php?id=$idPontuacao'';</script>";

	}

?>