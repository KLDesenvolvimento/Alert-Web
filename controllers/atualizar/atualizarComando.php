<?php
	require_once "../conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	//variaveis
	$idComando = $_POST['idComando'];
	$tituloComando = $_POST['tituloComando'];
	$funcionario = $_POST['funcionario'];
	$descricaoComando = $_POST['descricaoComando'];
	$descricao = addslashes($descricaoComando);
	$erro = null;

	//converte a data de dd/mm/aaaa para aaaa/mm/dd
	$dataBanco = date('20y-m-d');

	if($tituloComando == null){
		$erro = "Titulo não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadComando.php';</script> ";
	}else if($funcionario == null){
		$erro = "Funcionário não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadComando.php';</script> ";
	}else if($descricaoComando == null){
		$erro = "descrição não pode não pode ser em branco.";
		echo "<script>alert('$erro'); window.location.href = '../../views/Cadastro/cadComando.php';</script> ";
	}

	//comandos SQL
	$insertComando = " UPDATE comandos SET tituloComando = '$tituloComando', descricaoComando = '$descricaoComando', fkFuncionario = '$funcionario' WHERE idComando = '$idComando' ";
	$resultComando = mysqli_query($link, $insertComando);

	if($resultComando)
	{
		echo "<script>alert('Cadastro realizado com sucesso'); window.location.href = '../../views/comandos.php';</script> ";	
	}
	else
	{
		echo "<script>alert('Falha ao cadastrar'); window.location.href = '../../views/comandos.php';</script> ";
		//header('Location:../../views/Cadastro/cadComando.php?resposta=erro');
		//var_dump($link);
	}

	mysqli_close($link);//fecha a conexao com o banco de dados

?>