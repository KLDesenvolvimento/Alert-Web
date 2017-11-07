<?php
	require_once "../../controllers/session.php";
	require_once "../../controllers/conexaoBD.php";

	
	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();
////////////////////////////////////////////////////////////////////// SELECT COMBOBOX ////////////////////////////////////////////////////////////////////////////////////////////
	$selectFuncionario = " SELECT * FROM funcionario where idFuncionario >'1' and status='1' and fksetor='2' order by nomeFuncionario";
	
	$resultFuncionario = mysqli_query($link, $selectFuncionario);

	$selectIndicador = " SELECT * FROM indicador ";
	$resultIndicador = mysqli_query($link, $selectIndicador);

	$selectJustificativa = " SELECT * FROM justificativa ";
	$resultJustificativa = mysqli_query($link, $selectJustificativa);
/////////////////////////////////////////////////////////////////// FIM SELECT COMBOBOX ////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////// ATUALIZAR PONTUACAO ////////////////////////////////////////////////////////////////////////////////
	@$id = $_GET['id'];


////////////////////////////////////////////////////////////// FIM ATUALIZAR //////////////////////////////////////////////////////////////////////////////////////////////////// 	

///////////////////////////////////////////////////////////////// PESQUISA PONTUACAO ///////////////////////////////////////////////////////////////////////////////////
	@$pesquisa = $_GET['pesquisa']; // pega o valor da data Inicial
	@$pesquisa2 = $_GET['pesquisa2']; // pega o valor da data Final
	
	date_default_timezone_set('America/Sao_Paulo'); // padrão de data]

	function inverteData($data){
		 if(count(explode("/",$data)) > 1){
		    $data = implode("-",array_reverse(explode("-",$data)));
		   }elseif(count(explode("-",$data)) > 1){
		     $data = implode("/",array_reverse(explode("-",$data)));
		 }

		 return $data;
	}// fim função inverteData

	///////////////////// DEIXA OS CAMPOS DE DATAS SEMPRE COM A DATA ATUAL /////
		 if ($pesquisa == null && $pesquisa2 ==null ) {
			$dataInicial = date('Y-m-d');
			$dataFinal =  date('Y-m-d');
			$dataInicial = strtotime($dataInicial);
			$dataFinal = strtotime($dataFinal);
									
		 }else{
		 	$dataInicial = strtotime($pesquisa);
			$dataFinal = strtotime($pesquisa2);							
		 }
	/////////////////////////////////////////////////// FIM DATAS ATUAS /////////////////////////////////////////////////////

	////////////////////////////////////////////////// VERIFICA AS PONTUAÇOES ADCIONADAS AO DIA ////////////////////////////////////////
	 $selectDadosDia = "SELECT datapontos FROM pontuacoes WHERE  datapontos=CURDATE() ";
	
	 $resultDadosDia = mysqli_query($link,$selectDadosDia);
	
		if (mysqli_num_rows($resultDadosDia) >0){
			$exibeCadastrados = 1;			
		}else{
			$exibeCadastrados = 0;
		}
	
	if ($pesquisa != null && $pesquisa2 !=null){
		$selectBusca = " SELECT Func.nomeFuncionario,Ind.nomeIndicador,Just.nomeJustificativa, Pont.dataPontos,Pont.idPontuacao,Pont.pontos FROM funcionario Func INNER JOIN pontuacoes Pont ON Func.idFuncionario = Pont.fkFuncionario INNER JOIN indicador Ind ON Ind.idIndicador = Pont.fkIndicador INNER JOIN justificativa Just ON Just.idJustificativa = Pont.fkJustificativa WHERE datapontos BETWEEN '$pesquisa' AND '$pesquisa2' ORDER by dataPontos ";
		
		 $resultBusca = mysqli_query($link,$selectBusca);
		 $total = mysqli_num_rows($resultBusca);

		 	while($tbl = mysqli_fetch_array($resultBusca)){
		 		$idPontuacao[] = $tbl['idPontuacao'];
		 		$fkFuncionario[] = $tbl['nomeFuncionario'];
		 		$fkIndicador[] = $tbl['nomeIndicador'];
		 		$fkJustificativa[] = $tbl['nomeJustificativa'];
		 		$pontos[] = $tbl['pontos'];
		 		
		 		$dataPontos[] = inverteData($tbl['dataPontos']);
		 	}// fim while
	}else{
		$selectBusca = " SELECT Func.nomeFuncionario,Ind.nomeIndicador,Just.nomeJustificativa, Pont.dataPontos,Pont.idPontuacao,Pont.pontos FROM funcionario Func INNER JOIN pontuacoes Pont ON Func.idFuncionario = Pont.fkFuncionario INNER JOIN indicador Ind ON Ind.idIndicador = Pont.fkIndicador INNER JOIN justificativa Just ON Just.idJustificativa = Pont.fkJustificativa WHERE datapontos=CURDATE() ORDER BY Pont.idPontuacao DESC";
		
		 $resultBusca = mysqli_query($link,$selectBusca);
		 $total = mysqli_num_rows($resultBusca);

		 	while($tbl = mysqli_fetch_array($resultBusca)){
		 		$idPontuacao[] = $tbl['idPontuacao'];
		 		$fkFuncionario[] = $tbl['nomeFuncionario'];
		 		$fkIndicador[] = $tbl['nomeIndicador'];
		 		$fkJustificativa[] = $tbl['nomeJustificativa'];
		 		$pontos[] = $tbl['pontos'];
		 		
		 		$dataPontos[] = inverteData($tbl['dataPontos']);
		 	}// fim while
	}// fim else
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	 	
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Alert Web</title>
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" src="../../js/materialize.min.js"></script>
	<script type="text/javascript" src="../../js/java.js"></script>
	<link rel="stylesheet" type="text/css" href="../../css/materialize.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="shortcut icon" href="../../imagens/icone.ico" type="image/x-icon" />
</head>
<body>

<div>
	<?php
		require_once "menu.php";
	?>
</div>

<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<div class="row">
				<h5 class="center">Cadastrar Pontuação</h5>
				<form class="col s12 m12 l12" method="POST" action="../../controllers/cadastro/cadPontuacao.php">
					<div class="row">
						<div class="input-field col s3 m3 l3">
							<select id="comboFuncionario" name="funcionario">
								<option value="" selected>Selecione</option>
								<?php
									while($tblFuncionario = mysqli_fetch_array($resultFuncionario)){

										echo " <option value='" . $tblFuncionario['idFuncionario'] .  "'>". $tblFuncionario['nomeFuncionario'] . "</option>";

									}//fim do while

									mysqli_close($link);
								?>
							</select>
							<label>Funcionario</label>
						</div><!--input-field-->
						<div class="input-field col s3 m3 l3">
							<select id="comboIndicador" name="indicador">
								<option value="" selected>Selecione</option>
								<?php
									while($tblIndicador = mysqli_fetch_array($resultIndicador)){

										echo " <option value='" . $tblIndicador['valorPontos'] . "'>" . $tblIndicador['nomeIndicador'] . "</option>";

									}//fim do while

									mysqli_close($link);
								?>
							</select>
							<label>Indicador</label>
						</div><!--input-field-->
						<div class="input-field col s3 m3 l3">
							<select id="comboJustificativa" name="justificativa">
								<option value="" selected>Selecione</option>
								<?php
									while($tblJustificativa = mysqli_fetch_array($resultJustificativa)){

										echo " <option value='" . $tblJustificativa['idJustificativa'] . "'>" . $tblJustificativa['nomeJustificativa'] . "</option> ";

									}

									mysqli_close($link);
								?>
							</select>
							<label>Justificativa</label>
						</div>

						<div class="input-field col s3 m3 l3">						
						
								<input name="dataPontuacao" id="dataPontuacao" type="date" value="<?php echo date('Y-m-d'); ?>" />

								

						</div>
						<div class="row">
						<div class="center">
							<button class="btn waves-effect light-blue darken-4" name="cadastrar">Cadastrar</button>
							<button class="btn waves-effect light-blue darken-4" name="limpar">Limpar</button>
						</div>
						
					</div><!--row-->
				</form>
				
					
			</div><!--row-->
		</div><!--card-panel-->
	</div><!--col s12 m12 l12-->
	<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<div class="row">
				<h5 class="center">Editar Pontuação</h5>
				<form class="col s12 m12 l12" method="POST" action="../pesquisa/pesquisaPontuacao.php">	
					<div class="row">
						<div class="input-field col s3 m3 l3">
							
						 	<?php
							
																
							?> 
									<input name="buscaDataInicial" id="dataPontuacao" type="date" value="<?php  echo date ('Y-m-d',$dataInicial); ?>" />
									
																
								
						</div>
						<div class="input-field col s3 m3 l3">
						
								<input name="buscaDataFinal" id="dataPontuacao" type="date" value="<?php  echo date('Y-m-d',$dataFinal); ?>" />

						
												
						</div><!--Fim div class imput-->

							<button class="btn waves-effect light-blue darken-4" style="margin-top: 20px;">Pesquisar</button>
						</div>
						<ul class="collapsible popout" data-collapsible="accordion">

						<table class="centered striped "><!--tipo de tabela-->
							<thead><!--inicio do cabeçalho da tabela-->
								<tr><!--estrutura do cabeçalho-->

									<?php
										if($_SESSION['acesso'] == "Administrador" ){
											
												if($exibeCadastrados == 1){												
												
												
											echo "
											<th>Funcionario</th><!--label funcionario da tabela-->
											<th>Indicador</th><!--label Indicador da tabela-->
											<th>Justificativa</th><!--label ramal da tabela-->
											<th>Data</th><!--data da pontuação-->
											<th>Deletar</th>
											<th>Atualizar</th>
											";
												}// fim insert
										//	}// fim if pesquisa
										}// fim if session
									?>
										
								</tr><!--fim da estrutura do cabeçalho-->
							</thead><!--fim do cabeçalho da tabela-->
							<tbody><!--inicio do corpo da tabela-->
							<?php
	
								if($_SESSION['acesso'] == "Administrador"){

									for($indice = 0; $indice < $total; $indice++){//verifica enquanto o indice for menor que a quantidade de registros encontrados na tabela ele ira alimentando a tabela
										
										//inicio da tabela
										echo "

													<tr>
														<td>$fkFuncionario[$indice]</td>
														<td>$fkIndicador[$indice]</td>
														<td>$fkJustificativa[$indice]</td>
														<td>$dataPontos[$indice]</td>
														
														<td><a class='btn waves-effect light-blue darken-4' href='../excluir/excluirPontuacao.php?id=$idPontuacao[$indice]'>Deletar</a></td>
														<td><a class='btn waves-effect light-blue darken-4' href='../atualizar/atualizarPontuacao.php?id=$idPontuacao[$indice]'>Atualizar</a></td>													</tr>

										";
										//fim da tabela

									}//fim do for

								 }
								 //else{

								// 	for($indice = 0; $indice < $total; $indice++){//verifica enquanto o indice for menor que a quantidade de registros encontrados na tabela ele ira alimentando a tabela

								// 		//inicio da tabela
								// 		echo "

								// 					<tr>
								// 						<td>$setor[$indice]</td>
								// 						<td>$nomeRamal[$indice]</td>
								// 						<td>$numeroRamal[$indice]</td>
								// 					</tr>

								// 		";
								// 		//fim da tabela

								// 	}//fim do for

								// }

							?>
							</tbody><!--fim do corpo da tabela-->
						</table>
					</ul>
					
				</form>
		</div><!--card-panel-->
	</div><!--col s12 m12 l12-->
</div><!--row-->
	
</body>
</html>