<?php
	$pesquisa = $_POST['pesquisaCliente'];

	 header("Location:../views/clientes.php?pesquisa=$pesquisa");

?>