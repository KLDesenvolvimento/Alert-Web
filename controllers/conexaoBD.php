<?php

	class conexaoBD{//inicio da class conexao

		private $servername = "localhost";//nome ou caminho do servidor
		private $username = "root";//usuario do banco de dados
		private $password = "";//senha do banco de dados
		private $dbname = "alert_web";//nome do banco de dados

		public function conectar(){//inicio da funcao conectar

			$conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);//realiza a conexao com o banco de dados
			mysqli_set_charset($conn, "utf8");//seta o tipo de dados do banco de dados como UTF-8


			return $conn;//retorna a se a conexao esta funcionando corretamente.

		}//fim da funcao conectar

	}//fim da class conexao
?>