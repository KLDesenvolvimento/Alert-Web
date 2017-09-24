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

	if($nomeFuncionario == null){
		$erro = "Nome do funcionario não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadFuncionario.php';</script> ";
	}else if($usuario == null){
		$erro = "Usuário não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadFuncionario.php';</script> ";
	}else if($senha == null){
		$erro = "Senha não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadFuncionario.php';</script> ";
	}else if($fkSetor == null){
		$erro = "Setor não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadFuncionario.php';</script> ";
	}else if($tipoAcesso == null){
		$erro = "Tipo de acesso do funcionário não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadFuncionario.php';</script> ";
	}

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

		echo "<script>alert('Cadastro realizado com sucesso'); window.location.href = '../../views/Cadastro/cadFuncionario.php';</script> ";

	}else{

		echo "<script>alert('Erro ao cadastrar'); window.location.href = '../../views/Cadastro/cadFuncionario.php';</script> ";

	}//fim do if

}//fim do if de validação de usuario

	mysqli_close($link);//fecha a conexao com o banco de dados

?>