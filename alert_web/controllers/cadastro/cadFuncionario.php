<?php

	require_once "../conexaoBD.php";//instancia a classe de conexao com o  banco de dados

	$conexaoBD = new conexaoBD();//armazena a classe de conxao na variavel
	$link = $conexaoBD->conectar();//armazena o retorno da tentativa de conexao com o banco de dados

	//variaveis
	$nomeFuncionario = $_POST['nomeFuncionario'];
	$usuario = $_POST['usuario'];
	$senha = $_POST['senha'];
	$fkSetor = $_POST['setor'];
	$tipoAcesso = $_POST['acesso'];
	$senhaMD5 = MD5($senha);

	//validação de usuario igual
	$selectUsuario = " SELECT usuario FROM funcionario WHERE usuario = '$usuario' ";
	$resultUsuario = mysqli_query($link, $selectUsuario);
	$total = mysqli_num_rows($resultUsuario);

	if($total > 0){

		header('Location:../../views/cadastro/cadFuncionario.php?resposta=erro');

	}else{

	//comando SQL
	$insertFuncionario = " INSERT INTO funcionario (nomeFuncionario, usuario, senha, fkSetor, tipoUsuario) VALUES ('$nomeFuncionario', '$usuario', '$senhaMD5', '$fkSetor', '$tipoAcesso') ";//comando SQL de inserção na tabela de funcionario
	$resultFuncionario = mysqli_query($link, $insertFuncionario);//executa o comando SQL acima

	if($resultFuncionario){

		header('Location:../../views/cadastro/cadFuncionario.php?resposta=sucesso');
		echo "<script>alert('Cadastro realizado com sucesso')</script>";

	}else{

		header('Location:../../views/cadastro/cadFuncionario.php?resposta=erro');
		echo "<script>alert('Falha ao cadastrar')</script>";

	}//fim do if

}//fim do if de validação de usuario

	mysqli_close($link);//fecha a conexao com o banco de dados

?>