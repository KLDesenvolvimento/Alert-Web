<?php
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$id = $_GET['id'];

	$deleteManual = " DELETE FROM manuais WHERE idManual = $id ";
	$resultDelete = mysqli_query($link, $deleteManual);

	mysqli_close($link);

	header("Location:../manuais.php");

?>