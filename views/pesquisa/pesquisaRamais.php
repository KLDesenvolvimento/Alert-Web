<?php
	$pesquisa = $_POST['pesquisaRamal'];

	header("Location:../listaRamais.php?pesquisa=$pesquisa");
?>