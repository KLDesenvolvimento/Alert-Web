<?php

	session_start();//inicia a session

	if(!isset($_SESSION['usuarioLog'])){//verifica se nao existe sessao aberta 
		header('location:../index.php');//volta para a tela de login
		session_destroy();//destroi a seção
	}//fim if

	if(isset($_GET['deslogar'])){//verifica se existe seção aberta
		session_destroy();//destroi a seção
		header('location:../index.php');//volta para a pagina de login
	}//fim if

?>