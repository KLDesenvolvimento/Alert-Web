<?php

	require_once "../controllers/session.php";//importa a classe que cria a seção

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Alert Web</title>
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
							
								
							

							 $selectTotalFunc = "SELECT COUNT(idFuncionario) FROM funcionario  where status='1' and fksetor='2' ";// select  para saber o total de registros	
							
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
							
							$sql = "SELECT idFuncionario FROM funcionario where status='1' and fksetor='2' ORDER BY idFuncionario";// consulta os numero de id da tabela funcionario
							
							$result = mysqli_query($link,$sql); // execulta a query e salva na variavel

							$posicao = 1;
								
								while($tbl = mysqli_fetch_array($result)){ //verifica o valor do result montando um array

									$valor = $tbl['idFuncionario']; //atribui o valor da 1º varredura do fetch_array								
									$vetorId[$posicao] =  (int)$valor; // salva em no vetor o valor da 1º varredura
									//echo $vetorId[$posicao]; // printa para teste
									// echo"<br>";
									$posicao = $posicao +1;
								}


								
								

								$posicao = 0;// variavel de controle de posições no vetor
								for ($i=1; $i <$totalFunc +1; $i++) { 

									 $selectPontos = "SELECT SUM(pontos) FROM pontuacoes WHERE fkFuncionario=$vetorId[$i] AND dataPontos BETWEEN '$primeiroDia' and '$ultimoDia' ";// faz a soma de todos os pontos de acordo com o ID
									 

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
							}// fim foreach

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
							$vetorTotalndAmarelo = array();
							$vetorTotalndAzul = array();
							$vetorTotalndVerde = array();
							$vetorTotalndVermelho = array();



							// função para Saber o 1º dia da semana (domingo)

							Function forma_semana($numeroSemana,$ano){// função para montar is dias da semana
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
							}// fim função FORMA_SEMANA


							$periodoDias = array( ); // vetor para armazenar as datas da semana
							$numero_semana = date('W')-1;// pega o numero da semana do ano							
							$hoje = date('z'); // pega  o numero do dia de hj somando do 1º dia do ano ate agora 
							//echo $hoje;							
							$semana = intval($hoje / 7) ; // numero do dia no ano (EX 254) dividido por  7 					
							$ano_atual = date('Y');// pega o ano atual												
							$proximo_dia_semana = forma_semana($semana,$ano_atual);//// a variavel recebe a data do 1º dia da semana passada nos parametros

							
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
											echo"<th>Sexta"."<br>".$periodoDias[5]."</th>";
											echo"<th>Total Indicadores</th>
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
						 	 
						 $result = mysqli_query($link,$select);
						 $tbl=mysqli_fetch_array($result);

						// print_r($tbl);
						 $valorIndicador = $tbl[0];

						
						return $valorIndicador;
						}	// fim função tabelaPontuacao


						$posicao = 1; // variavel de controle de indice
						foreach ($vetorNome as  $value) {// varre o vetor e ordenado e retorna o valor
							$vetorNomeTabela[$posicao] = $value; // vetor recebe o valor do vetor da ordem que encontrar
							$posicao = $posicao +1; // adiciona +1 na posição do vetor 
						}// fim foreach
						
							//$posicao = 1; // variavel de controle para a linha
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
									 if ($totalposicao <$totalFunc+1 ) {
									 $totalposicao = $totalposicao +1;
									} // fim if
									
								} // fim for								
								
								for ($indice=1; $indice <$totalFunc+1 ; $indice++) { 
										$vetorTotalndAmarelo[$indice] = ($vetorSegAmarelo[$indice]+$vetorTerAmarelo[$indice]+$vetorQuaAmarelo[$indice]+$vetorQuiAmarelo[$indice]+$vetorSexAmarelo[$indice]);

										$vetorTotalndAzul[$indice] = ($vetorSegAzul[$indice]+$vetorTerAzul[$indice]+$vetorQuaAzul[$indice]+$vetorQuiAzul[$indice]+$vetorSexAzul[$indice]);

										$vetorTotalndVerde[$indice] = ($vetorSegVerde[$indice]+$vetorTerVerde[$indice]+$vetorQuaVerde[$indice]+$vetorQuiVerde[$indice]+$vetorSexVerde[$indice]);

										$vetorTotalndVermelho[$indice] = ($vetorSegVermelho[$indice]+$vetorTerVermelho[$indice]+$vetorQuaVermelho[$indice]+$vetorQuiVermelho[$indice]+$vetorSexVermelho[$indice]);


										
									}


								for ($coluna=1; $coluna <$totalFunc +1; $coluna++) { 
								
								echo"
									<tr>
									<td>".$vetorNomeTabela[$coluna]."</td>

										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorSegAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorSegAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorSegVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorSegVermelho[$coluna]."<br>"."</td>

										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorTerAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorTerAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorTerVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorTerVermelho[$coluna]."<br>"."</td>

										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorQuaAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorQuaAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorQuaVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorQuaVermelho[$coluna]."<br>"."</td>

										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorQuiAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorQuiAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorQuiVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorQuiVermelho[$coluna]."<br>"."</td>

										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorSexAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorSexAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorSexVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorSexVermelho[$coluna]."<br>"."</td>
										<td><font color = #FFD700><b>"."Amarelo = </font>".$vetorTotalndAmarelo[$coluna]."</br>"."<font color = #0000FF>"." Azul = "."</font> ".$vetorTotalndAzul[$coluna]. "</br>"."<font color = #008000> Verde = </font>".$vetorTotalndVerde[$coluna]."</br>"."<font color = #FF0000> Vermelho = </font> ".$vetorTotalndVermelho[$coluna]."<br>"."</td>

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
						<?php

							// FUNÇÃO PARA SABER O NUMERO DO MÊS ATUAL
							function numeroMes($mesAtual){// RECEBE O NOME DO MÊS POR TEXTO EX: SETEMBRO
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
							$numMes = array_search($mesAtual, $meses); // FAZ UMA BUSCA NO ARRAY COM O NOME E RETORNA A CHAVE

							return $numMes; // A CHAVE É O NUMERO DO MÊS
							}

							// ´FUNÇÃO PARA SABER QUANTAS SEMANAS TEM NO MÊS ATUAL
							function quantidadeSemanasMes($mesAno) // RECEBE POR MEIO DE CONCATENAÇÃO O MÊS E ANO EX: 09/2017
							{
							    $data = '01/'.$mesAno; // CONCATENA COM O 1 DIA DO MÊS
							    $start = \DateTime::createFromFormat('d/m/Y', $data);

							    $end = clone $start;
							    $end->add(new \DateInterval("P1M"));
							    $end->sub(new \DateInterval("P1D"));

							    return ceil(($start->format('w') + $end->format('d')) / 7);// RETORNA A QTD DE MESES DO MES EX: 5
							}

							$numMes = numeroMes($meses[date('m')]); // CHAMA A FUNÇÃO PARA PEGAR O NUMERO DO MÊS
							$numSem = quantidadeSemanasMes($numMes.'/'.$ano_atual);//CHAMA A FUNÇÃO APRA SABER A QTD DE SEMANAS NO MÊS

							$vetorPontosSemana1 = array( );
							$vetorPontosSemana2 = array( );
							$vetorPontosSemana3 = array( );
							$vetorPontosSemana4 = array( );
							$vetorPontosSemana5 = array( );
							$vetorPontosSemana6 = array( );
							$vetorTotalSemana = array();

							$vetorInicioSemana = array(); // vetor para receber o a data incial da semana
							$vetorFimSemana = array(); // vetor para receber a data final da semana

							$posicao = 0;// variavel de controle de posições no vetor

							 $primeiroDia = inverteData($primeiroDia);
							
							 $dataAtual = date('d-m-20y');
					
							// Cria uma função que retorna o timestamp de uma data no formato DD/MM/AAAA
							function geraTimestamp($data) {
							$partes = explode('-', $data);
							return mktime(0, 0, 0, $partes[1], $partes[0], $partes[2]);
							}
							// Usa a função criada e pega o timestamp das duas datas:
							$time_inicial = geraTimestamp($primeiroDia);
							$time_final = geraTimestamp($dataAtual);
							// Calcula a diferença de segundos entre as duas datas:
							$diferenca = $time_final - $time_inicial; // 19522800 segundos
							// Calcula a diferença de dias
							$dias = (int)floor( $diferenca / (60 * 60 * 24)); // 225 dias
							// Exibe uma mensagem de resultado:
							//echo "A diferença entre as datas ".$data_inicial." e ".$data_final." é de <strong>".$dias."</strong> dias";

							// A diferença entre as datas 23/03/2009 e 04/11/2009 é de 225 dias
							//echo 'hoje '. $hoje;// = date('z'); 

							$numDiaAno =($hoje -$dias) ; 

							$semana1 = intval($numDiaAno / 7) ;
							
								function inverteData($data){
									 if(count(explode("/",$data)) > 1){
									      $data = implode("-",array_reverse(explode("-",$data)));
									    }elseif(count(explode("-",$data)) > 1){
									       $data = implode("-",array_reverse(explode("-",$data)));
									    }

									    return $data;
								}// fim função inverteData

								//==== EXCLUSIVO PARA 1º SEMANA ==================
								
								$valorChave = array_search($primeiroDia, $periodoDias); // FAZ UMA BUSCA NO ARRAY COM O NOME E RETORNA A CHAVE
								
								
								if ($valorChave == 0) {// se o valor da chave cair no domingo ele coloca para a segunda feira
									
									$valorChave = 1;
								}
								if ($valorChave == 6) {
									
									$valorChave = 1;
									$semana1 = $semana1+1;
									$numSem = $numSem -1;	
								}
								
								$proximo_dia_semana = forma_semana($semana1,$ano_atual); // pega o numero da semana  e soma +1
										
									for ($posicao=0; $posicao <7 ; $posicao++) { 
									$periodoDias[$posicao] = $proximo_dia_semana;

									$proximo_dia_semana= date('d-m-Y', strtotime('+1 days', strtotime($proximo_dia_semana)));
					
									}// fim for que monta o vetor com as datas da semana
					
								$data = $periodoDias[$valorChave]; // recebe a data que esta no vetor no formato 01-01-1111
								
								$data = inverteData($data);  //invete posição da data  para inserir no banco 1111-11-11
								//echo 'valor da data'.$data;						
								$vetorInicioSemana[0] = $data; // posição zero recebe o 1º dia do mês						
								
								if ($valorChave >5) { // caso o 1 dia do mês seja no sabado o ultimo dia da semana fica igual
									
									$vetorFimSemana[0] = $data; // recebe a mesma data que o inicio
								}else{
									
								$data = $periodoDias[5]; // recebe a data que esta no sexta feira do vetor
								$data = inverteData($data); // inverte a posição da data para 1111-11-11

								$vetorFimSemana[0] = $data; // salva no vetor do fim de semana a data da fim de semana
								}

								// =========== FIM DA 1º SEMANA =========================
											//
								//============ SEMANAS DO MEIO=========================
								
								for ($indice=1; $indice < $numSem-1 ; $indice++) {  // for para alimentar o vetor com as datas do meio da semana

									$proximo_dia_semana = forma_semana($semana1+$indice,$ano_atual); // pega o numero da semana  e soma +1

										
									for ($posicao=0; $posicao <7 ; $posicao++) { 
									$periodoDias[$posicao] = $proximo_dia_semana;

									$proximo_dia_semana= date('d-m-Y', strtotime('+1 days', strtotime($proximo_dia_semana)));
					
									}// fim for que monta o vetor com as datas da semana

									$data =$periodoDias[1];
									$data = inverteData($data);

									$vetorInicioSemana[$indice] = $data;

									$data =$periodoDias[5];
									$data = inverteData($data);

									$vetorFimSemana[$indice] = $data;
									
								}// fim for que mota o vetor de intervalos de inicio e final da semana

								// ============FIM MEIOS DA SEMANA =====================
											//
								// ============ULTIMA SEMANA DO MES ===========================
								$ultimoDia = inverteData($ultimoDia);				
								$semana1 = $semana1+$numSem -1;
								
								$proximo_dia_semana = forma_semana($semana1,$ano_atual); // pega o numero da semana 

									for ($posicao=0; $posicao <7 ; $posicao++) { 
									$periodoDias[$posicao] = $proximo_dia_semana;

									$proximo_dia_semana= date('d-m-Y', strtotime('+1 days', strtotime($proximo_dia_semana)));
					
									}// fim for que monta o vetor com as datas da semana	

							
								$valorChave = array_search($ultimoDia, $periodoDias); // FAZ UMA BUSCA NO ARRAY COM O NOME E RETORNA A CHAVE										

								if ($valorChave == 0) {

									$proximo_dia_semana = forma_semana($semana1-1,$ano_atual); // pega o numero da semana 

										
									for ($posicao=0; $posicao <7 ; $posicao++) { 
									$periodoDias[$posicao] = $proximo_dia_semana;

									$proximo_dia_semana= date('d-m-Y', strtotime('+1 days', strtotime($proximo_dia_semana)));
					
									}// fim for que monta o vetor com as datas da semana

									$data = $periodoDias[5];
									$numSem = $numSem -1;

									$valorChave = array_search($data, $periodoDias); // FAZ UMA BUSCA NO ARRAY COM O NOME E RETORNA A CHAVE
								}


								$data = $periodoDias[1];
								$data = inverteData($data);
								$vetorInicioSemana[$numSem -1] = $data;
								
								$data = $periodoDias[$valorChave];
								$data = inverteData($data);
								$vetorFimSemana[$numSem -1] = $data;								


								//============FIM ULTIMA SEMANA DO MES ========================
						
							echo "
							<tr><!--estrutura do cabeçalho-->
								
								<th>Posição</th><!--label posição do funcionario-->
								<th>Funcionário</th><!--label funcionario do Funcionario-->
								";
								for ($indice=1; $indice < $numSem+1 ; $indice++) { // cria a qtd de semanas de acordo com a qtd do mes
									$dataini = $vetorInicioSemana[$indice-1];
									$dataini = inverteData($dataini);
									$datafim = $vetorFimSemana[$indice-1];
									$datafim = inverteData($datafim);
								
								echo "<th>Semana ".$indice."<br>".$dataini. " a ".$datafim."</th>"; //label posição do funcionario
								}
								
								echo "<th>Total Pontuação</th><!--label Total de Pontos do Funcionario-->
							</tr>
						
							";							
						?>
					</thead>					
					<tbody> 

						<?php
								 function montaSemana($link,$id,$dataInicio,$dataFinal){

									
									 $selectPontos = "SELECT SUM(pontos) FROM pontuacoes WHERE fkFuncionario=$id AND dataPontos BETWEEN '$dataInicio' and '$dataFinal' ";// faz a soma de todos os pontos de acordo com o 
									 $resultTotalPontos = mysqli_query($link,$selectPontos); 
									 $tblPontos = mysqli_fetch_array($resultTotalPontos); //monta um array com o resultado da query
									 $totalPontos = $tblPontos[0]; //passa o valor do campo escolhido cada campo é uma numeração

									 return	$totalPontos;
									
									}// fim da função
									
									$posicao = 1; 
									 for ($linha=1; $linha < $totalFunc+1 ; $linha++) { 
										
										
										for ($coluna=0; $coluna <1 ; $coluna++) { 
											  $vetorPontosSemana1[$posicao] =  montaSemana($link,$vetorId[$linha],$vetorInicioSemana[0],$vetorFimSemana[0]);
											 $vetorPontosSemana2[$posicao] = montaSemana($link,$vetorId[$linha],$vetorInicioSemana[1],$vetorFimSemana[1]);
											 $vetorPontosSemana3[$posicao] = montaSemana($link,$vetorId[$linha],$vetorInicioSemana[2],$vetorFimSemana[2]);
											 $vetorPontosSemana4[$posicao] = montaSemana($link,$vetorId[$linha],$vetorInicioSemana[3],$vetorFimSemana[3]);
											
											if ($numSem == 5) {
										
											 	 $vetorPontosSemana5[$posicao] = montaSemana($link,$vetorId[$linha],$vetorInicioSemana[4],$vetorFimSemana[4]);
											 }
											
											if ($numSem == 6) {
												 $vetorPontosSemana6[$posicao] = montaSemana($link,$vetorId[$linha],$vetorInicioSemana[5],$vetorFimSemana[5]);
											}
											 											 	
										} // for coluna	
											
											 $posicao = $posicao +1;
										}
								
								
									$posicao = 1;	
									


									for ($indice=1; $indice <$totalFunc+1 ; $indice++) { 
										$vetorTotalSemana[$indice] = ($vetorPontosSemana1[$indice]+$vetorPontosSemana2[$indice]+$vetorPontosSemana3[$indice]+$vetorPontosSemana4[$indice]);
										if ($numSem >6) {
											$vetorTotalSemana[$indice] = ($vetorPontosSemana6[$indice]);
										}
									}
									

								foreach ($vetorPontosSemana1 as $key => $value) {
									
								}
								arsort($vetorTotalSemana);
							foreach ($vetorTotalSemana  as  $key =>$pontos) {// comando foreach varre o array e exibe o array por elementos buscando a chave e salvando por loop
												
								echo 
									"<tr>
										<td>$posicao</td> <!-- numeor da posição-->
										<td> $vetorNomeTabela[$key]</td> <!-- vetor com os nomes do funcionarios-->
										<td>$vetorPontosSemana1[$key]</td><!-- vartiavel que vem do vetor atravez do foreach-->
										<td>$vetorPontosSemana2[$key]</td><!-- vartiavel que vem do vetor atravez do foreach-->
										<td>$vetorPontosSemana3[$key]</td><!-- vartiavel que vem do vetor atravez do foreach-->
										<td>$vetorPontosSemana4[$key]</td><!-- vartiavel que vem do vetor atravez do foreach-->";
										if ($numSem == 5) {
											echo "
										
												<td>$vetorPontosSemana5[$key]</td><!-- vartiavel que vem do vetor atravez do foreach-->	";	
												}
										if ($numSem == 6) {
											
											echo "
										
												<td>$vetorPontosSemana6[$key]</td><!-- vartiavel que vem do vetor atravez do foreach-->	";	
												}	

																		
								echo 		"<td> $vetorTotalSemana[$key]</td> <!-- vetor com os nomes do funcionarios-->
									</tr>";
									

									$posicao = $posicao+1;
							}
						?>

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