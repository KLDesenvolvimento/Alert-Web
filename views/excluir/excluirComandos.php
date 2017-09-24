<?php
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$id = $_GET['id'];

	$deleteComando = " DELETE FROM comandos WHERE idComando = '$id' ";
	$resultDelete = mysqli_query($link, $deleteComando);

	mysqli_close($link);

	header("Location:../comandos.php");

?>