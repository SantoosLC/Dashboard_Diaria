<?php
session_start();
require_once 'conexao.php';

// Recebe os dados do formulário
$email = $_POST['email'];
$token = $_POST['token'];
$senha = $_POST['senha'];

// Verifica se o email e o token existem na tabela
$query = "SELECT * FROM web_login WHERE email = '$email' AND token = '$token'";
$resultado = mysqli_query($conn,$query);

if (mysqli_num_rows($resultado) == 1) {
  // O email e o token existem na tabela, atualiza a senha do usuário
  $query = "UPDATE web_login SET senha = '$senha', token = NULL WHERE email = '$email'";
  mysqli_query($conn,$query);

  $_SESSION['login_success'] = "Senha alterada com sucesso, redirecionando para a pagina de login...";
  header('Location: ../login.php');
  exit();
} else {

  $_SESSION['login_error'] = "Erro, tente novamente mais tarde.";
  header('Location: ../login.php');
  exit();
}

// Fecha a conexão com o banco de dados
mysqli_close($conexao);
?>
