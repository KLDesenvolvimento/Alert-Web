<?php

	require_once "../controllers/session.php";//instancia a classe de criação da seção

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title>Alert Web</title>
	<script type="text/javascript" src="../js/jquery.js"></script><!--importa o jquery-->
	<script type="text/javascript" src="../js/materialize.min.js"></script><!--importa o materialize java script-->
	<script type="text/javascript" src="../js/java.js"></script><!--importa o java -->
	<link rel="stylesheet" type="text/css" href="../css/materialize.min.css"><!--importa o css do materialize-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"><!--local onde se encontra os icones utilizados-->
	<link rel="shortcut icon" href="../imagens/icone.ico" type="image/x-icon" />
</head>
<body class="grey lighten-2">

<div>
	<?php

		require_once "menu.php";//instancia o menu para desktop

	?>
</div>

 <div class="row">
        <div class="col s12 m12 l12">
          <div class="card">
            <div class="card-image">
              <img src="../imagens/home1480x600.jpg">
              <span class="card-title black-text" style="font-size: 30px;"><b>O site ALERT WEB</b></span>
            </div>
            <div class="card-content">
              <p>O ALERT WEB é desenvolvido para facilitar o trabalho dos funcionários da empresa, atuando principalmente como uma base de dados com várias ferramentas em um único local, como por exemplo: 
              Manuais, Comandos SQL, Problemas e suas Soluções, Lista de Ramais, entre outras funcionalidades.</p><p>O melhor de tudo é que o funcionário poderá ajudar com a ampliação desses materiais ja disponibilizados, entrando em contato 
              com a gente e mandando sua idéia para uma análise, para que assim possamos ampliar nossa base de conhecimento.</p>
            </div>
            <!--<div class="card-action">
              <a href="#">This is a link</a>
            </div>-->
          </div>
        </div>
      </div>

<div>
	<?php
		require_once "rodape.php";//importa o rodape
	?>
</div>
	
</body>
</html>