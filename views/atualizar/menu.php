<!-- MENU DESKTOP -->

<!--submenu de consulta-->
<ul id="consultar" class="dropdown-content">
	<?php
		if($_SESSION['acesso'] == "Administrador"){
			echo "<li><a href='../funcionarios.php'>Funcionarios</a></li>";
		}
	?>
	<li><a href="../comandos.php">Comandos</a></li>
	<li><a href="../manuais.php">Manuais</a></li>
	<li><a href="../listaRamais.php">Ramais</a></li>
	<li><a href="../pontuacoes.php">Pontuações</a></li>
	<li><a href="../problemaSolucao.php">P/S</a></li>
</ul>
<!--fim submenu consulta-->

<!--submenu de cadastro-->
<ul id="cadastro" class="dropdown-content">
	<li><a href="../Cadastro/cadFuncionario.php">Funcionário</a></li>
	<li><a href="../Cadastro/cadComando.php">Comandos</a></li>
	<li><a href="../Cadastro/cadManuais.php">Manuais</a></li>
	<li><a href="../Cadastro/cadRamais.php">Ramal</a></li>
	<li><a href="../Cadastro/cadPontuacao.php">Pontuação</a></li>
	<li><a href="../Cadastro/cadProblemaSolucao.php">P/S</a></li>
</ul>
<!--fim submenu cadastro-->

<!--submenu ferramentas-->
<ul id="ferramentas" class="dropdown-content">
	<li><a href="http://www.nfe.fazenda.gov.br/portal/consulta.aspx?tipoConsulta=completa&tipoConteudo=XbSeqxE8pl8=" target="_blank">Consultar NF-e</a></li>
	<li><a href="http://www.nfe.fazenda.gov.br/portal/disponibilidade.aspx?versao=0.00&tipoConteudo=Skeuqr8PQBY=" target="_blank">Disponibilidade Sefaz</a></li>
</ul>
<!--fim do submenu ferramentas-->

<!--menus de consulta-->
<nav class="light-blue darken-4">
	<div class="nav-wrapper">
			<ul class="left hide-on-med-and-down">
				<li><a href="../home.php">Home</a></li>
				<!-- menu dropdown de mais opções de consulta -->
				<li><a class="dropdown-button" href="#!" data-activates="consultar">Consultar<i class="material-icons right">arrow_drop_down</i></a></li>
			</ul>
			<!--fim menu dropdown de mais opções de consulta-->

			<!--menu dropdown de cadastro-->
			<ul class="left hide-on-med-and-down">
				<?php

					if($_SESSION['acesso'] == "Administrador"){//verifica se o usuario logado é administrador caso seja ele irá exibir o menu de cadastro juntamente com seus submenus

						echo "<li><a class='dropdown-button' href='#!' data-activates='cadastro'>Cadastro<i class='material-icons right'>arrow_drop_down</i></a></li>";

					}else{//caso nao seja ele nao exibira o menu de cadastro

						echo "";

					}

				?>
			</ul>
			<ul class="left hide-on-med-and-down">
				<li><a href="http://helpdesk.servhost.com.br/admin" target="_blank">HelpDesk</a></li>
				<li><a href="../../alertDesk/views/consTicket.php">Alert Desk</a></li>
				<li><a href="../../alertCall/views/clientes.php">Alert Call</a></li>
				<li><a href="http://ponttierp.com/cds" target="_blank">Pontti</a></li>
			</ul>
			<ul>
				<li><a class="dropdown-button" href="#!" data-activates="ferramentas">Ferramentas<i class="material-icons right">arrow_drop_down</i></a></li>
			</ul>
			<!--botao de sair para encerrar a session-->
			<ul class="right hide_on_med_and_down">
				<li><a href="#!"><?php

				echo $_SESSION['nome'];

				?></a></li>
				<li><a href="../?deslogar">Sair</a></li>
			</ul>

<!--MENU MOBILE-->
	<ul id="slide-out" class="side-nav">
	<!--cabeçalho-->
		<li>
			<div class="user-view">
				<div class="background">
					<img src="../../imagens/suporte.jpg">
				</div>
				<a href="#!user"><img class="circle" src="../../imagens/logo.png"></a>
				<a href="#!name"><span class="white-text name" style="font-size: 16px;"><?php echo $_SESSION['nome']; ?></span></a>
				<a href="#!email"><span class="white-text acesso" style="font-size: 14px;"><?php echo $_SESSION['acesso']; ?></span></a>
			</div>
		</li>
		<!--fim do cabeçalho-->
		<!--menus de opções-->
		<li class="no-padding">
	<ul class="collapsible collapsible-accordion">
		<li>
			<a class="collapsible-header">Consultar</a>
<div class="collapsible-body">
	<ul>
		<li><a href="../comandos.php">Comandos</a></li>
		<li><a href="../manuais.php">Manuais</a></li>
		<li><a href="../problemaSolucao.php">P/S</a></li>
		<li><a href="../listaRamais.php">Ramais</a></li>
		<li><a href="../pontuacoes.php">Pontuações</a></li>
	</ul>
</div><!--collapsible-body-->
		</li>
		<?php

			if($_SESSION['acesso'] == "Administrador")
			{

				echo "

					<li>
						<a class='collapsible-header'>Cadastrar</a>
						<div class='collapsible-body'>
							<ul>
								<li><a href='cadFuncionario.php' class='waves-effect'>Funcionário</a></li>
								<li><a href='cadComando.php' class='waves-effect'>Comandos</a></li>
								<li><a href='cadManuais.php' class='waves-effect'>Manuais</a></li>
								<li><a href='cadProblemaSolucao.php' class='waves-effect'>P/S</a></li>
								<li><a href='cadRamal.php' class='waves-effect'>Ramais</a></li>
								<li><a href='cadPontuacao.php' class='waves-effect'>Pontuações</a></li>
						</div>
					</li>

				";

			}
			else
			{
				echo "";
			}

		?>
		<li><a href="../?deslogar">Sair</a></li>	
	</ul><!--collapsible collapsible-accorion-->
	</ul><!--slide-out-->
		<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
		<!--fim dos menus de opções-->
	</ul>

	</div><!--nav-wrapper-->
</nav>