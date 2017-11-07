<?php
	require_once "../../controllers/session.php";
	require_once "../../controllers/conexaoBD.php";

	$conexaoBD = new conexaoBD();
	$link = $conexaoBD->conectar();
	$texto = 'Leandro';

	$idPont = $_GET['id'];


	function inverteData($data){
		 if(count(explode("/",$data)) > 1){
		    $data = implode("-",array_reverse(explode("-",$data)));
		   }elseif(count(explode("-",$data)) > 1){
		     $data = implode("/",array_reverse(explode("-",$data)));
		 }

		 return $data;
	}// fim função inverteData

	$selectFunc = "SELECT * FROM funcionario WHERE tipoUsuario = 'Funcionario' AND status='1' ORDER BY nomeFuncionario";
	$resultFunc = mysqli_query($link,$selectFunc);

	$selectInd = "SELECT * FROM indicador ORDER BY nomeIndicador";	
	$resultInd = mysqli_query($link,$selectInd);

	$selectJust = "SELECT * FROM justificativa ";
	$resultJust = mysqli_query($link,$selectJust);
	



	$selectPontucao = "SELECT Func.nomeFuncionario,Func.idFuncionario,Ind.nomeIndicador,Ind.idIndicador,Just.nomeJustificativa,Just.idJustificativa, Pont.fkFuncionario,Pont.dataPontos,Pont.idPontuacao,Pont.pontos FROM funcionario Func INNER JOIN pontuacoes Pont ON Func.idFuncionario = Pont.fkFuncionario INNER JOIN indicador Ind ON Ind.idIndicador = Pont.fkIndicador INNER JOIN justificativa Just ON Just.idJustificativa = Pont.fkJustificativa WHERE idPontuacao='$idPont' ";
	
	// $selectPontucao = "SELECT * FROM pontuacoes ";
	// echo $selectPontucao;
	$resultPontuacao = mysqli_query($link, $selectPontucao);
	$total = mysqli_num_rows($resultPontuacao);

	while($tbl = mysqli_fetch_array($resultPontuacao)){
		
		$idPontuacao = $tbl['idPontuacao'];
		$nomeFuncionario = $tbl['nomeFuncionario'];
		$fkFuncionario = $tbl['idFuncionario'];
		$fkIndicador = $tbl['idIndicador'];
		$fkJustificativa = $tbl['idJustificativa'];
		$nomeJustificativa = $tbl['nomeJustificativa'];
		$pontos = $tbl['pontos'];
		$dataPontos = $tbl['dataPontos'];

	}

	
	$dataPontos = strtotime($dataPontos);	


	
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Alert Web</title>
	<link rel="stylesheet" type="text/css" href="../../css/materialize.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="shortcut icon" href="../../imagens/icone.ico" type="image/x-icon" />
	<script type="text/javascript" src="../../js/jquery.js"></script>
	<script type="text/javascript" src="../../js/materialize.min.js"></script>
	<script type="text/javascript" src="../../js/java.js"></script>
	
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

				<h5 class="center">Atualização Pontuaçao</h5>

				<div class="row">

					<form class="" method="POST" action='../../controllers/atualizar/atualizarPontuacao.php'>
						<div class="row">
							

							<div class="input-field col s2 m2 l2">

							 <select id="fkFuncionario" name="funcionario">

									 <option value="" >Selecione</option>
 
								 <?php while($tbl = mysqli_fetch_array($resultFunc)){ ?>
											
									 	<option <?php echo ($tbl['idFuncionario'] == $fkFuncionario) ? 'selected="selected"' : '' ?> value='<?php echo $tbl['idFuncionario'] ?>' ><?php echo $tbl['nomeFuncionario'] ?></option> 
										



									 <?php }  ?> 
								 </select>

								<label>Funcionario</label> 

							</div>

						
						<div class="input-field col s2 m2 l2">

							 <select id="fkFuncionario" name="indicador">

									 <option value="" >Selecione</option>
 
								 <?php while($tbl = mysqli_fetch_array($resultInd)){ ?>
											
									 	<option <?php echo ($tbl['idIndicador'] == $fkIndicador) ? 'selected="selected"' : '' ?> value='<?php echo $tbl['idIndicador'] ?>' ><?php echo $tbl['nomeIndicador'] ?></option> 
										



									 <?php }   ?> 
								 </select>

								<label>Indicador</label> 

							</div>
							
							
							<div class="input-field col s2 m2 l2">
							

								<select id="fkJustificativa" name="justificativa">

									 <option value="" >Selecione</option>

									<?php while($tbl = mysqli_fetch_array($resultJust)){ echo $tbl['idJustificativa'];?>

											
									 	<option <?php echo ($tbl['idJustificativa'] == $fkJustificativa) ? 'selected="selected"' : '' ?> value='<?php echo $tbl['idJustificativa'] ?>' ><?php echo $tbl['nomeJustificativa'] ?></option>
										
									<?php }  mysqli_close($link); ?>
								</select>

								<label>Justificativa</label>

							</div> 
							<div class="input-field col s2 m2 l2">
								<input type="date" name="dataPontos" id="dataPontos" value="<?php  echo date ('Y-m-d',$dataPontos); ?>">
							</div>
							
							
						</div>
							<?php
							
									
									
									echo "
										
										<div class='input-field col s1 m1 l1'>
												<input type='hidden' name='idPont' value='$idPontuacao'>
											</div>
										";
									
									

								?>
						
						
						<div class="row"> 
							
							<div class="center">
								<button class="btn waves-effect light-blue darken-4" type="submit" name="atualizar">Atualizar</button>
								<button class="btn waves-effect light-blue darken-4" type="reset" name="limpar">Limpar</button>
							</div>
							</div>

						</div><!--row-->
					</form>
				</div><!--row-->
			</div><!--row-->
		</div>
	</div><!--col s12 m12 l12-->
</div><!--row-->
	
</body>
</html>