<?php
require_once 'conexao.php';

$nome = mb_strtoupper($_POST['nome']);
$email = $_POST['email'];
$senha = password_hash($_POST['senha'], PASSWORD_BCRYPT, ["cost" => 11]);

//verifica se o nome existe no banco de dados
$result_user = "SELECT nome FROM usuario WHERE nome = '$nome'";
$resultado_user = mysqli_query($con, $result_user);
$cont_resultado = mysqli_num_rows($resultado_user);
//var_dump($cont_resultado);
//exit();
if ($cont_resultado == 0) {
	$sql = "INSERT INTO usuario (nome, email, senha, data_cad) VALUES ('$nome', '$email', '$senha', NOW())";
	if (mysqli_query($con, $sql)) {
		$_SESSION['SucessoCadastro'] = " $nome CADASTRADO(A) COM SUCESSO!";
		header("Location: index.php");
	} else {
		$_SESSION['ErroCadastro'] = " ERRO AO CADASTRAR $nome! " . mysqli_error($con);
		header("Location: index.php");
	}
} else {
	$_SESSION['CadastroDuplicado'] = " $nome JÁ FOI CADASTRADO(A)! ";
		header("Location: index.php");
}
?>