<?php
	
	session_start();//inicia o session

	if(isset($_SESSION['usuarioLog'])){//verifica se ja existe uma session aberta
		header('location:../index.php');//caso essa session exista ele voltara para o index que seria a tela de login, assim nao possibilitando o acesso ao sistema
		die();//logo depois ele encerra toda a conexao
	}//fim do if

	require_once "conexaoBD.php";//instancia a classe de conxao com o banco de dados

	$conexaoBD = new conexaoBD();//armazena a classe na variavel
	$link = $conexaoBD->conectar();//armazena o retorno da tentativa de conexao com o banco de dados na variavel $link

	$usuario = $_POST['usuario'];//recebe o valor do campo usuario
	$senha = $_POST['senha'];//recebe o valo do campo senha
	$md5 = MD5($senha);//converte o valor recebido do campo senha em MD5 criptografando os dados para maior segurança

	$selectLogin = " SELECT * FROM funcionario WHERE usuario = '$usuario' AND senha = '$md5' ";//query de verificação de dados na tabela de funcionario
	$resultLogin = mysqli_query($link, $selectLogin);//executa a query acima
	$total = mysqli_num_rows($resultLogin);//recebe a quantidade de linhas encontradas na execução da query

	while($tbl = mysqli_fetch_array($resultLogin)){//enquanto tiver valor ele ira armazenando nas variaveis correspondentes

		$idFuncionario = $tbl['idFuncionario'];//recebe o id do funcionario logado
		$nomeFuncionario = $tbl['nomeFuncionario'];//recebe o nome do funcionario logado
		$fkSetor = $tbl['fkSetor'];//recebe o setor do funcionario logado
		$tipoAcesso = $tbl ['tipoUsuario'];//recebe o tipo de acesso no sistema que o usuario logado tem

	}//fim do while

	if($total > 0){//verifica se foi encontrado algum valor

		$_SESSION['usuarioLog'] = true;//seta a seção como verdadeira abrindo assim uma session para o funcionario logado
		$_SESSION['nome'] = $nomeFuncionario;//inicia uma session com o nome do funcionario logado
		$_SESSION['id'] = $idFuncionario;//inicia uma session com o id do funcionario logado
		$_SESSION['setor'] = $fkSetor;//inicia uma session com o setor do funcionario logado
		$_SESSION['acesso'] = $tipoAcesso;//inicia uma session com o tipo de acesso do funcionario logado

		header('Location:../views/home.php');//abre o sistema mandando o funcionario diretamente para a tela home do site

	}else{//senao for verdadeira a condição acima
		header('location:../index.php');//ele voltara para a tela de login
		//echo "<script>alert('Usuário e Senha não encontrado')</script>";
	}

	mysqli_close($link);//fecha a conexao com o banco de dados
?>