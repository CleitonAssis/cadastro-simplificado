<?php
	//error_reporting(0);
	
	if (!isset($_SESSION)) {
	  session_start();
	}

	$server = "localhost";
	$user = "root";
	$password = "";
	$db = "dbcaduser";

	$con = mysqli_connect($server, $user, $password, $db);
	if (!$con) {
		$_SESSION['ErroConexao'] = " ERRO DE CONEXÃO COM BANCO DE DADOS: (" . mysqli_connect_errno() . ")" . mysqli_connect_error() . "!";
	}
	//mysqli_close($con);