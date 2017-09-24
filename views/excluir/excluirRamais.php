<?php
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$id = $_GET['id'];

	$deleteRamal = " DELETE FROM ramais WHERE idRamal = '$id' ";
	$resultDelete = mysqli_query($link, $deleteRamal);

	mysqli_close($link);

	header("Location:../listaRamais.php");

?>