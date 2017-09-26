<?php
	$pesquisa = $_POST['pesquisaComando'];

	header("Location:../comandos.php?pesquisa=$pesquisa");
?>