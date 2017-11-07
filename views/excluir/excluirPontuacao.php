<?php
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$id = $_GET['id'];

	$deletePontuacao = " DELETE FROM pontuacoes WHERE idPontuacao = '$id' ";
	$resultPontuacao = mysqli_query($link, $deletePontuacao);

	mysqli_close($link);

	header("Location:../Cadastro/cadPontuacao.php");

?>