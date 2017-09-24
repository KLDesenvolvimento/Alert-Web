<?php
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$id = $_GET['id'];

	$deleteProblemaSolucao = " DELETE FROM problemaSolucao WHERE idProblemaSolucao = '$id' ";
	$resultDelete = mysqli_query($link, $deleteProblemaSolucao);

	mysqli_close($link);

	header("Location:../ProblemaSolucao.php");

?>