<div>
	<ul id="slide-out" class="side-nav fixed">
		<li>
			<div class="user-view">
				<div class="background">
					<img src="../../imagens/erro404.jpeg">
				</div><!--background-->
				<a href="#!user"><img src="../../imagens/logo.png" class="circle"></a>
				<a href="#!name"><span class="black-text name" style="font-size: 16px;"><b><?php echo $_SESSION['nome']; ?></b></span></a>
				<a href="#!acesso"><span class="black-text acesso" style="font-size: 14px;"><b><?php echo $_SESSION['acesso']; ?></b></span></a>
			</div><!--user-view-->
		</li>
			<!--collapsible menu-->
			<ul class="hide-on-med-and-down">
					<li><a href="consTicket.php">Home</a></li>
					<li><a href="#">Abrir Ticket</a></li>
					<li><a href="#">Ver Fechados</a></li>
				</ul><!--dropdown-content-->
				<li><a href="../../views/home.php">Alert Web</a></li>
				<li><a href="?deslogar">Sair</a></li>
			</ul><!--hide-on-me-and-down-->
			<!--fim collapsible menu-->
		</li>
	</ul><!--slide-out-->
	<a href="#" data-activates="slide-out" class="button-collapsible"><i class="material-icons">menu</i></a>
</div>
