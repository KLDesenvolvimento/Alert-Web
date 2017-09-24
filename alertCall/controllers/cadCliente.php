<?php
	
	require_once "../../controllers/conexaoBD.php";//instancia do banco de dados

	$conexaoBD = new conexaoBD();//armazena a classe de conexao com o banco de dados na variavel
	$link = $conexaoBD->conectar();//armazena o retorno da conexao com o banco de dados

	//vairaveis
	$nomeCliente = $_POST['nomeCliente'];
	$cnpjCliente = $_POST['cnpjCliente'];
	$inscEst = $_POST['inscEst'];
	$emailCliente = $_POST['emailCliente'];
	$telefoneCliente = $_POST['telefoneCliente'];
	$suporteCliente = $_POST['suporteCliente'];
	$cepCliente = $_POST['cepCliente'];
	$ruaCliente = $_POST['ruaCliente'];
	$numCliente = $_POST['numCliente'];
	$bairroCliente = $_POST['bairroCliente'];
	$cidadeCliente = $_POST['cidadeCliente'];
	$ufCliente = $_POST['ufCliente'];
	$obsCliente = $_POST['obsCliente'];
	$erro = null;

	if($nomeCliente == null){
		$erro = "Nome do cliente não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($cnpjCliente == null){
		$erro = "CNPJ não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($inscEst == null){
		$erro = "Inscrição Estadual não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($emailCliente){
		$erro = "E-Mail não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($telefoneCliente){
		$erro = "Telefone não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($suporteCliente == null){
		$erro = "Suporte não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($cepCliente == null){
		$erro = "CEP não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($ruaCliente == null){
		$erro = "Rua não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($numCliente == null){
		$erro = "Numero não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($bairroCliente == null){
		$erro = "Bairro não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($cidadeCliente == null){
		$erro = "Cidade não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}else if($ufCliente == null){
		$erro = "CNPJ não pode ser vazio.";
		echo "<script>alert('$erro'); window.location.href = '../views/cadCliente.php'; </script>";
	}

	$selectCliente = " SELECT cnpjCliente, inscEst FROM  clientes WHERE cnpjCliente = '$cnpjCliente' AND inscEst = '$inscEst'";
	$resultSelect = mysqli_query($link, $selectCliente);
	$total = mysqli_num_rows($resultSelect);

	if($total > 0)
	{
		echo "<script>alert('Nenhum campo deve ser vazio.'); window.location.href = '../views/cadCliente.php'; </script>";
	}
	else
	{

		$insertCliente = " INSERT INTO clientes (nomeCliente, cnpjCliente, inscEst, emailCliente, telefoneCliente, suporteCliente, cepCliente, ruaCliente, numCliente, bairroCliente, cidadeCliente, ufCliente, obsCliente) VALUES ('$nomeCliente', '$cnpjCliente', '$inscEst', '$emailCliente', '$telefoneCliente', '$suporteCliente', '$cepCliente', '$ruaCliente', '$numCliente', '$bairroCliente', '$cidadeCliente', '$ufCliente', '$obsCliente') ";
		$resultCliente = mysqli_query($link, $insertCliente);

		if($resultCliente)
		{
			header('Location:http://localhost/alert_web/alertCall/views/cadCliente.php?resposta=sucesso');
		}else{
			header('Location:http://localhost/alert_web/alertCall/views/cadCliente.php?resposta=erro');
		}

	}//fim do if

	mysqli_close($link);//fecha a conexao com o banco de dados

?>