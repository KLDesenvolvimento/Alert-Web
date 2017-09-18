<?php

	require_once "../controllers/session.php";//importa a classe que cria a seção

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Web Help</title>
	<script type="text/javascript" src="../js/jquery.js"></script><!--importa o jquery-->
	<script type="text/javascript" src="../js/materialize.min.js"></script><!--importa o java script do materialize-->
	<script type="text/javascript" src="../js/java.js"></script><!--importa o java-->
	<link rel="stylesheet" type="text/css" href="../css/materialize.min.css"><!--importa o css do materialize-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><!--local onde se localiza os icones utilizados-->
</head>
<body>

<div>
	<?php
		require_once "menu.php";//importa o menu
	?>
</div>	
<div class="row">
	<div class="card-panel">
		<ul class="collapsible popout" data-collapsible="accordion">
			<fieldset>
				<table class="centered striped "><!--tipo de tabela-->
					<thead><!--inicio do cabeçalho da tabela-->
						<?php
							$data_incio = mktime(0, 0, 0, date('m') , 1 , date('Y')); // pega o primeiro dia do mês e a primeira hora 
							$data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y')); //pega o ultimo dia do mês e a ultima hora
							$primeiroDia =  date('Y-m-d',$data_incio);  // recebe apenas a  primeira data do mês formatada 01-09-2017
							$ultimoDia =  date('Y-m-d',$data_fim); // recebe apenas a  ultima  data do mês formatada 31-09-2017

							$meses = array(
							    '01'=>'Janeiro',
							    '02'=>'Fevereiro',
							    '03'=>'Março',
							    '04'=>'Abril',
							    '05'=>'Maio',
							    '06'=>'Junho',
							    '07'=>'Julho',
							    '08'=>'Agosto',
							    '09'=>'Setembro',
							    '10'=>'Outubro',
							    '11'=>'Novembro',
							    '12'=>'Dezembro'
							);

							//echo $meses[date('m')];

							echo "Periodo de ".$primeiroDia." a  ".date('Y-m-d'). " do mês de ".$meses[date('m')]."." ;
							echo"<br>";
						  ?>
						
						<tr><!--estrutura do cabeçalho-->
							<th>Posição</th><!--label posição do funcionario-->
							<th>Funcionário</th><!--label funcionario do Funcionario-->
							<th>Pontuação</th><!--label Total de Pontos do Funcionario-->
						</tr>
					</thead>
					
					<tbody>
						
						<?php
						
							require_once "../controllers/conexaoBD.php";//instancia a classe de conxao com o banco de dados
							$conexaoBD = new conexaoBD();//armazena a classe de conexao na variavel
							$link = $conexaoBD->conectar();//armazena o retorno da conexao com o banco de dados na variavel
							
								

							

							 $selectTotalFunc = "SELECT COUNT(idFuncionario) FROM funcionario";// select  para saber o total de registros	
							 $resultTotalFunc = mysqli_query($link,$selectTotalFunc); 
							 $tblFunc = mysqli_fetch_array($resultTotalFunc); //monta um array com o resultado da query
							 $totalFunc = (int)$tblFunc[0]; //passa o valor do campo escolhido cada campo é uma numeração
							// echo "resultado selectTotalFunc = ".$totalFunc; // echo para teste saida: resultado selectTotalFunc = 5
							// echo"<br>";

							$vetorId = array(); // recebe a lista de id de funcionairo
							$vetorNome = array( );// recebe a lista com os nomes de funcionarios
							$vetorPontos = array( );// recebe a lista da soma de pontos por id
							
							$sql = "SELECT idFuncionario FROM funcionario ORDER BY idFuncionario";// consulta os numero de id da tabela funcionario
							$result = mysqli_query($link,$sql); // execulta a query e salva na variavel
							$posicao = 0;
								
								while($tbl = mysqli_fetch_array($result)){ //verifica o valor do result montando um array

									$valor = $tbl['idFuncionario']; //atribui o valor da 1º varredura do fetch_array								
									$vetorId[$posicao] =  (int)$valor; // salva em no vetor o valor da 1º varredura
									//echo $vetorId[$posicao]; // printa para teste
									// echo"<br>";
									$posicao = $posicao +1;
								}

								$posicao = 0;
							for ($i=1; $i <$totalFunc ; $i++) { 
								// echo"<br>";
								//echo $vet[$i]; // printa para t
							
								 $selectPontos = "SELECT SUM(pontos) FROM pontuacoes WHERE fkFuncionario=$vetorId[$i] AND dataPontos BETWEEN $primeiroDia and CURDATE() ";// faz a soma de todos os pontos de acordo com o ID
								 $resultTotalPontos = mysqli_query($link,$selectPontos); 
								 $tblPontos = mysqli_fetch_array($resultTotalPontos); //monta um array com o resultado da query
								 $totalPontos = $tblPontos[0]; //passa o valor do campo escolhido cada campo é uma numeração
								 $vetorPontos[$posicao] = $totalPontos; 


								 $sqlf = "SELECT * FROM funcionario WHERE idfuncionario=$vetorId[$i] ORDER BY idFuncionario";// consulta os numero de id da tabela funcionario
								$resultf = mysqli_query($link,$sqlf); // execulta a query e salva na variavel
							
									while($tblf = mysqli_fetch_array($resultf)){ //verifica o valor do result montando um array

									$nomef = $tblf['nomeFuncionario']; //atribui 
									$vetorNome[$posicao] = (string)$nomef; 
								
									}// fm while
									
									$posicao = $posicao +1;
															
							}// fim for	

							arsort($vetorPontos); // ordena o vetorPontução por ordem decrecente
							$posicao = 1;
							
							foreach ($vetorPontos  as  $key =>$pontos) {// comando foreach varre o array e exibe o array por elementos buscando a chave e salvando por loop
												
								echo 
									"<tr>
										<td>$posicao</td>	
										<td> $vetorNome[$key]</td>
										<td>$pontos</td>
									</tr>";
									

									$posicao = $posicao+1;
								echo "<br>"; // quebra linha
							}
						
							?>

					</tbody>				
				</table>	
			</fieldset>	
			<br>
			<fieldset>
				<table class="centered striped "><!--tipo de tabela-->
					<thead><!--inicio do cabeçalho da tabela-->
						<?php 	
							Function forma_semana($numeroSemana,$ano){
								$semana_atual = strtotime('+'.$numeroSemana.' weeks', strtotime($ano.'0101') ); 

								/*
								pega o número do dia da semana
								0 - Domingo
								...
								6 - Sábado
								*/
								$dia_semana = date('w', $semana_atual);//Diminui o dia da semana sobre o dia da semana atual
								;
								/*ex.: $semana_atual: 10/09/2013 terça-feira
								$dia_semana: 2 (terça-feira)
								$data_inicio_semana: 08/09/2013

								*/
								$data_inicio_semana = strtotime('-'.$dia_semana.' days', $semana_atual); // Data início semana */
								$primeiro_dia_semana = date('d-m-Y', $data_inicio_semana);// Soma 6 dias */
								$ultimo_dia_semana = date('d-m-Y', strtotime('+6 days', strtotime($primeiro_dia_semana)));

								//echo $primeiro_dia_semana;
								//echo date('d-m-y'), strtotime($primeiro_dia_semana);
								return $primeiro_dia_semana;	
							}

							$numero_semana = date('W')-1;
							$periodoDias = array( );
							$hoje = date('z'); // pega  o numero do dia de hj somando do 1º dia do ano ate agora 
							//echo $hoje;
							$semana = intval($hoje / 7) ; // numero da semana dividido po / da o numero da semana 
							$ano_atual = date('Y');
												
							$proximo_dia_semana = forma_semana($semana,$ano_atual);
							//echo $proximo_dia_semana;
							
							for ($indice=0; $indice <7 ; $indice++) { 
								$periodoDias[$indice] = $proximo_dia_semana;

								$proximo_dia_semana= date('d-m-Y', strtotime('+1 days', strtotime($proximo_dia_semana)));
				
							}


								echo"<tr><!--estrutura do cabeçalho-->
							        	          <th>Funcionario</th><!--label posição do funcionario-->";

								echo"<th>Segunda"."<br>".$periodoDias[1]."</th>";
								echo"<th>Terça"."<br>".$periodoDias[2]."</th>";
								echo"<th>Quarta"."<br>".$periodoDias[3]."</th>";
								echo"<th>Quinta"."<br>".$periodoDias[4]."</th>";
								echo"<th>Sexta"."<br>".$periodoDias[5]."</th>
									</tr>
						

					</thead>
					
					<tbody>
						";
	




						
						//function get_inicio_fim_semana($numero_semana = "", $ano = ""){
						/* soma o número de semanas em cima do início do ano 01/01/2013 */
						
						
						  echo "<br>";
						  echo "<br>";

						  function tabelaPontuacao($link,$id,$data,$indicador){
						  
						 $select = "SELECT COUNT(fkIndicador) FROM pontuacoes WHERE fkFuncionario='2' AND dataPontos='2017-09-11' and fkIndicador='3'";
						 $result = mysqli_query($link,$select);
						 $tbl=mysqli_fetch_array($result);

						 $valorIndicador = $tbl[0];

						
						return $valorIndicador;
						}	


							



							for ($indice=0; $indice <$totalFunc  ; $indice++) { 
							
							$indVerde = tabelaPontuacao($link,$vetorId[$indice],$periodoDias[1],3);
							echo $indVerde;
							
							
						}	
						asort($vetorNome);
							foreach ($vetorNome as $key => $value) {
								echo"
								<tr>
									<td>".$vetorNome[$key]."</td>
									<td>Verde".$indVerde."</td>
								</tr>
									
							";
														//for

							}
						echo "<tr><td>Verde".$indVerde."</td></tr>";
							
						 ?>
						
					</tbody>
				</table>
			</fieldset>	
		</ul>
	</div>
</div>


<div>
	<?php
		require_once "rodape.php";//importa o rodape
	?>
</div>
	
</body>
</html>