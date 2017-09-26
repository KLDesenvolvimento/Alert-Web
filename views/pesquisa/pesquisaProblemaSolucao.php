<?php
	$pesquisa = $_POST['pesquisaProblemaSolucao'];

	header("Location:../problemaSolucao.php?pesquisa=$pesquisa");
?>