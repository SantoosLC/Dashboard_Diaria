<?php
require_once 'conexao.php';

// Recebe os dados do formulário
$nome = $_POST['nome'];
$email = $_POST['email'];
$usuario = $_POST['usuario'];
$cargo = $_POST['cargo'];
$senha = $_POST['senha'];
$status = 'pendente';
$token = null;
$permissao = 'Normal';

// Insere o usuário na tabela
$query = mysqli_query($conn,"INSERT INTO web_login (login, senha, nome, email, funcao, permissao, status)
          VALUES ('$usuario', '$senha', '$nome', '$email', '$cargo', '$permissao', '$status')");

header('location: ../login.php');
mysqli_close($conn);
exit();

// Envia um email para o administrador avisando do novo registro
// $to = "admin@example.com";
// $subject = "Novo registro de usuário";
// $message = "Um novo usuário foi registrado e aguarda sua aprovação. Acesse o painel de administração para aprovar o registro.";
// $headers = "From: webmaster@example.com\r\n";
// mail($to, $subject, $message, $headers);

// Redireciona o usuário para uma página de confirmação
