<?php
	require_once "../conexaoBD.php";// instancia a classe de conexao com o banco de dados

	$conexaoBD = new conexaoBD();//armazena a classe de conexao com o banco em uma variavel
	$link = $conexaoBD->conectar();//armazena o retorno da conexao na variavel

	$funcionario = $_POST['funcionario'];//recebe o id do funcionario selecionado
	$indicadorPonto = $_POST['indicador'];//recebe o id do indicador selecionado
	$justificativa = $_POST['justificativa'];//recebe o id da justificativa
	$dataPontuacao = $_POST['dataPontuacao'];//recebe a data da pontuação
	$erro = null;//variavel de erro de campos nulos

	if($funcionario == null){//verifica se o campo funcionario é nulo
		$erro = "Funcionário deve ser selecionado.";
		echo " <script>alert($erro); window.location.href='../../views/Cadastro/cadPontuacao.php';</script> ";
	}else if($indicadorPonto == null){//verifia se o campo de indicador é nulo
		$erro = "Indicador deve ser selecionado.";
		echo " <script>alert($erro); window.location.href='../../views/Cadastro/cadPontuacao.php';</script> ";
	}else if($justificativa == null){//verifica se o campo de justificativa é nulo
		$erro = "Justificativa deve ser selecionada.";
		echo " <script>alert($erro); window.location.href='../../views/Cadastro/cadPontuacao.php';</script> ";
	}else if($dataPontuacao == null){//verifica se o campo data é nulo
		$erro = "Data da pontuação deve ser selecionada.";
		echo "<script>alert($erro); window.location.href='../../views/Cadastro/cadPontuacao.php';</script>";
	}

	$selectIndicador = " SELECT idIndicador FROM indicador WHERE valorPontos = '$indicadorPonto' ";//executa o comando de busca SQL para trazer o id do indicador onde o valor seja igual ao selecionado pelo usuario
	$resultIndicador = mysqli_query($link, $selectIndicador);//executa o comando SQL acima

	while($tblIndicador = mysqli_fetch_array($resultIndicador)){//enquanto houver linha ele ira pesquisar e trazer o valor encontrado
		$indicador = $tblIndicador['idIndicador'];//recebe o valor encontrado na pesquisa SQL
	}//fim do while

	$insertPontuacao = " INSERT INTO pontuacoes (fkFuncionario, fkIndicador, fkJustificativa, pontos, dataPontos) VALUES ('$funcionario', '$indicador', '$justificativa', '$indicadorPonto', '$dataPontuacao') ";//executa o comando de inserção na tabela de pontuação
	$resultPontuacao = mysqli_query($link, $insertPontuacao);//executa o comando SQL acima

	if($resultPontuacao){//verifica se o comando foi executado com sucesso

		echo "<script>alert('Cadastro realizado com sucesso.'); window.location.href='../../views/Cadastro/cadPontuacao.php';</script>";//se foi executado com sucesso ele ira exibir um alerta e retornar a tela de cadastro

	}else{//se houver erros

		echo "<script>alert('Falha ao cadastrar.');window.location.href='../../views/Cadastro/cadPontuacao.php?i=$indicador';</script>";//ele exibira um alerta de erro e voltara para a tela de cadastro.

	}//fim do if

	mysqli_close($link);//fecha a conexao com o banco de dados

?>