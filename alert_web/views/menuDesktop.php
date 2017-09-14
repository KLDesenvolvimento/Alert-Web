<!--submenu de consulta-->
<ul id="mais" class="dropdown-content">
	<li><a href="pontuacoes.php">Pontuações</a></li>
	<li><a href="listaRamais.php">Ramais</a></li>
</ul>
<!--fim submenu consulta-->

<!--submenu de cadastro-->
<ul id="cadastro" class="dropdown-content">
	<li><a href="Cadastro/cadFuncionario.php">Funcionário</a></li>
	<li><a href="Cadastro/cadComando.php">Comandos</a></li>
	<li><a href="Cadastro/cadManuais.php">Manuais</a></li>
</ul>
<!--fim submenu cadastro-->

<!--menus de consulta-->
<nav class="light-blue darken-4">
<div class="nav-wrapper left">
		<ul class="left hide-on-med-and-down">
			<li><a href="comandos.php">Comandos</a></li><!--menu de consulta de comandos-->
			<li><a href="manuais.php">Manuais</a></li><!--menu de consulta de manuais-->
			<li><a href="problemaSolucao.php">Problema/Solução</a></li><!--menu de consulta de problemaSolucao-->
			<!-- menu dropdown de mais opções de consulta -->
			<li><a class="dropdown-button" href="#!" data-activates="mais">Mais Opções<i class="material-icons right">arrow_drop_down</i></a></li>
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
		<!--botao de sair para encerrar a session-->
		<ul>
			<li><a href="?deslogar">Sair</a></li>
		</ul>
</div>
</nav>