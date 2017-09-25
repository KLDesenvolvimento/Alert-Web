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
	<link rel="shortcut icon" href="../imagens/icone.ico" type="image/x-icon" />
</head>
<body>

<div>
	<?php
		require_once "menu.php";//importa o menu
	?>
</div>	
<div class="row">
	<div class="col s12 m12 l12">
		<div class="card-panel">
			<div class="row">
				<?php
						//============ Faz a busca do primeiro dia do mês e ultimo dia =======================================
							$data_incio = mktime(0, 0, 0, date('m') , 1 , date('Y')); // pega o primeiro dia do mês e a primeira hora 
							$data_fim = mktime(23, 59, 59, date('m'), date("t"), date('Y')); //pega o ultimo dia do mês e a ultima hora
							$primeiroDia =  date('Y-m-d',$data_incio);  // recebe apenas a  primeira data do mês formatada 01-09-2017
							$ultimoDia =  date('Y-m-d',$data_fim); // recebe apenas a  ultima  data do mês formatada 31-09-2017


					//================== lista de Meses para exibir na mensagem do topo===========================================
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
							); //fim array
					//====================================================================
							
							// converte as datas alternando a posição 

							 // if(count(explode("/",$primeiroDia)) > 1){
							 //      $primeiroDia = implode("-",array_reverse(explode("-",$primeiroDia)));
							 //  }elseif(count(explode("-",$primeiroDia)) > 1){
							 //       $primeiroDia = implode("-",array_reverse(explode("-",$primeiroDia)));

							 //* }// fim if de conversão de data

							


							  // Mensagem do topo do ranking=======================================
							// echo "<h4 class='center'>Ranking de Pontuações</h4>";
							// echo "<h6 class='center'>Periodo de ".$primeiroDia." a  ".date('Y-m-d'). " do mês de ".$meses[date('m')].".</h6>" ;
						  ?>
						
						<h4 class='center'>Ranking de Pontuações</h4>
						<?php
						echo "<h6 class='center'>Periodo de ".date('d/m/20y', strtotime($primeiroDia))." a  ".date('d/m/20y'). " do mês de ".$meses[date('m')].".</h6>";
						?>

				<br></br>
				<h5 class="center">Ranking Geral do Mês</h5>
				<table class="centered striped col m4 push-m4" style="border: 1px solid #bdbdbd  "><!--tipo de tabela-->
					<thead><!--inicio do cabeçalho da tabela-->
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


							 // vetores da tabela de ranking =============================

							$vetorId = array(); // recebe a lista de id de funcionairo							
							$vetorNome = array( );// recebe a lista com os nomes de funcionarios							
							$vetorPontos = array( );// recebe a lista da soma de pontos por id
							


			//======================================================== Vetores da tabela de pontuação =========================================================================
							$vetorIdTabela = array(); // recebe os id da tabelas em ordenados e sem indice 0
							$vetorNomeTabela = array(); //recebe os nomes da tabela sem o indice 0

							$vetorSegAmarelo = array();
							$vetorSegAzul = array();
							$vetorSegVerde = array();
							$vetorSegVermelho = array();

							$vetorTerAmarelo = array();
							$vetorTerAzul = array();
							$vetorTerVerde = array();
							$vetorTerVermelho = array();

							$vetorQuaAmarelo = array();
							$vetorQuaAzul = array();
							$vetorQuaVerde =  array();
							$vetorQuaVermelho = array();

							$vetorQuiAmarelo = array();
							$vetorQuiAzul = array();
							$vetorQuiVerde =  array();
							$vetorQuiVermelho = array();

							$vetorSexAmarelo = array();
							$vetorSexAzul = array();
							$vetorSexVerde =  array();
							$vetorSexVermelho = array();
			//============================================================ fim fetor da tabela semanal ==========================================================================
							
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
								$posicao = 0;// variavel de controle de posições no vetor
								
								for ($i=1; $i <$totalFunc ; $i++) { 

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
							}
						
							?>

					</tbody>				
				</table>	
			</div><!--row-->
			<div class="row">
				<br></br>
				<h5 class="center">Pontuação da Semana Atual</h5>
				<table class="centered striped col s12 m12 l12" style="border: 1px solid #bdbdbd  "><!--tipo de tabela-->
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


								echo"	<tr><!--estrutura do cabeçalho-->
							        	        		  <th>Funcionario</th><!--label posição do funcionario-->";

											echo"<th>Segunda"."<br>".$periodoDias[1]."</th>";// mota os dias da semana com a data atual do servidor
											echo"<th>Terça"."<br>".$periodoDias[2]."</th>";// mota os dias da semana com a data atual do servidor
											echo"<th>Quarta"."<br>".$periodoDias[3]."</th>";// mota os dias da semana com a data atual do servidor
											echo"<th>Quinta"."<br>".$periodoDias[4]."</th>";// mota os dias da semana com a data atual do servidor
											echo"<th>Sexta"."<br>".$periodoDias[5]."</th>
									</tr>
						

					</thead>					
					<tbody> 
						";

						  function tabelaPontuacao($link,$id,$data,$indicador){
						  	 if(count(explode("/",$data)) > 1){
						      $data = implode("-",array_reverse(explode("-",$data)));
						    }elseif(count(explode("-",$data)) > 1){
						       $data = implode("-",array_reverse(explode("-",$data)));
						    }
							 
							



						 $select = "SELECT COUNT(fkIndicador) FROM pontuacoes WHERE fkFuncionario=$id AND dataPontos='$data' and fkIndicador=$indicador";
						 	// echo $select;
						 	//  echo "<br>";
						 $result = mysqli_query($link,$select);
						 $tbl=mysqli_fetch_array($result);

						// print_r($tbl);
						 $valorIndicador = $tbl[0];

						
						return $valorIndicador;
						}	


						$posicao = 1; // variavel de controle de indice
						foreach ($vetorNome as  $value) {// varre o vetor e ordenado e retorna o valor
							$vetorNomeTabela[$posicao] = $value; // vetor recebe o valor do vetor da ordem que encontrar
							$posicao = $posicao +1; // adiciona +1 na posição do vetor 
						}// fim foreach

							$posicao = 1; // variavel de controle para a linha
							$totalposicao = 2;
							// for para consulta dos dados da semana
							//for ($coluna=1; $coluna <$totalFunc ; $coluna++) {  // controla a quantidade de consultas

								for ($linha=1; $linha <$totalposicao; $linha++) { 	// controla a consulta por linha na tabela 
																	

									$vetorSegAmarelo[$linha] = tabelaPontuacao($link,$vetorId[$linha],$periodoDias[1],1); //  faz consulta no banco  usando por controle o dia da semana e o
									$vetorTerAmarelo[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[2],1);
									$vetorQuaAmarelo[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[3],1);
									$vetorQuiAmarelo[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[4],1);
									$vetorSexAmarelo[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[5],1);

									$vetorSegAzul[$linha] = tabelaPontuacao($link,$vetorId[$linha],$periodoDias[1],2); // salva no vetor o resultado da Função pegando um vetor com a consulta de cada dia da semana
									$vetorTerAzul[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[2],2);
									$vetorQuaAzul[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[3],2);
									$vetorQuiAzul[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[4],2);
									$vetorSexAzul[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[5],2);
									
									$vetorSegVerde[$linha] = tabelaPontuacao($link,$vetorId[$linha],$periodoDias[1],3); // salva no vetor o resultado da Função pegando um vetor com a consulta de cada dia da semana
									$vetorTerVerde[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[2],3);
									$vetorQuaVerde[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[3],3);
									$vetorQuiVerde[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[4],3);
									$vetorSexVerde[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[5],3);
									
									$vetorSegVermelho[$linha] = tabelaPontuacao($link,$vetorId[$linha],$periodoDias[1],4); // salva no vetor o resultado da Função pegando um vetor com a consulta de cada dia da semana
									$vetorTerVermelho[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[2],4);
									$vetorQuaVermelho[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[3],4);
									$vetorQuiVermelho[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[4],4);
									$vetorSexVermelho[$linha] =  tabelaPontuacao($link,$vetorId[$linha],$periodoDias[5],4);
									
																	
									if ($posicao <$totalFunc) {
										$posicao = $posicao+1;
									}			
									 if ($totalposicao <$totalFunc ) {
									 $totalposicao = $totalposicao +1;
									} // fim if
								} // fim for
								
								
								for ($coluna=1; $coluna <$totalFunc ; $coluna++) { 
							
								echo"
									<tr>
									<td>".$vetorNomeTabela[$coluna]."</td>

										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorSegAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorSegAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorSegVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorSegVermelho[$coluna]."<br>"."</td>

										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorTerAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorTerAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorTerVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorTerVermelho[$coluna]."<br>"."</td>

										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorQuaAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorQuaAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorQuaVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorQuaVermelho[$coluna]."<br>"."</td>

										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorQuiAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorQuiAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorQuiVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorQuiVermelho[$coluna]."<br>"."</td>

										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorSexAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorSexAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorSexVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorSexVermelho[$coluna]."<br>"."</td>
									</tr>";		
								
							}// fim for
					
							
						 ?>
						
					</tbody>
				</table>
			</div><!--row-->
			<div class="row">
				<br></br>
				<h5 class="center">Ranking das Semanas do Mês</h5>
				<table class="centered striped " style="border: 1px solid #bdbdbd  "><!--tipo de tabela-->
					<thead><!--inicio do cabeçalho da tabela-->
			'			<?php
							echo "
							<tr><!--estrutura do cabeçalho-->
							
								<th>Funcionário</th><!--label funcionario do Funcionario-->
								<th>Semana 1</th><!--label posição do funcionario-->
								<th>Semana 2</th><!--label Total de Pontos do Funcionario-->
								<th>Semana 3</th><!--label posição do funcionario-->
								<th>Semana 4</th><!--label Total de Pontos do Funcionario-->
								<th>Semana 5</th><!--label posição do funcionario-->
								<th>Total Pontuação</th><!--label Total de Pontos do Funcionario-->
							</tr>
							";
						?>
					</thead>					
					<tbody> 
					</tbody>
				</table>	
			</div><!--row-->
	</div><!--card-panel-->
</div><!--col s12 m12 l12-->
</div><!--row-->


<div>
	<?php
		require_once "rodape.php";//importa o rodape
	?>
</div>
	
</body>
</html>