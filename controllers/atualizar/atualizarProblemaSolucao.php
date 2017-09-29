<?php
	require_once "../conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();

	$idProblemaSolucao = $_POST['idProblemaSolucao'];
	$titulo = $_POST['titulo'];
	$categoria = $_POST['categoria'];
	$problema = $_POST['problema'];
	$solucao = $_POST['solucao'];
	$funcionario = $_POST['funcionario'];
	$data = date('20y-m-d');

	if($titulo == null){
		echo "<script>alert('Campo titulo não pode ser vazio'); window.location.href='../../views/atualizar/atualizarProblemaSolucao.php';</script>";
	}else if($categoria == null){
		echo "<script>alert('Campo categoria não pode ser vazio'); window.location.href='../../views/atualizar/atualizarProblemaSolucao.php';</script>";
	}else if($problema == null){
		echo "<script>alert('Campo problema não pode ser vazio'); window.location.href='../../views/atualizar/atualizarProblemaSolucao.php';</script>";
	}else if($solucao == null){
		echo "<script>alert('Campo solução não pode ser vazio'); window.location.href='../../views/atualizar/atualizarProblemaSolucao.php';</script>";
	}else if($funcionario == null){
		echo "<script>alert('Campo funcionario não pode ser vazio'); window.location.href='../../views/atualizar/atualizarProblemaSolucao.php';</script>";
	}

	$updateProblemaSolucao = " UPDATE problemaSolucao SET tituloProblemaSolucao = '$titulo', fkCategoria = '$categoria', fkFuncionario = '$funcionario', problema = '$problema', solucao = '$solucao', dataInclusao = '$data' WHERE idProblemaSolucao = '$idProblemaSolucao' ";
	$resultProblemaSolucao = mysqli_query($link, $updateProblemaSolucao);

	if ($resultProblemaSolucao) {
		echo "<script>alert('Atualização realizada com sucesso.'); window.location.href='../../views/problemaSolucao.php';</script>";
	}else{
		echo "<script>alert('Falha ao atualizar.'); window.location.href='../../views/problemaSolucao.php?id=$idProblemaSolucao';</script>";
	}

	mysqli_close($link);

?>