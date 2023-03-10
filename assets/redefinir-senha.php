<?php
session_start();
require_once 'conexao.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendors/PHPMailer/src/Exception.php';
require 'vendors/PHPMailer/src/PHPMailer.php';
require 'vendors/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

//Server settings
$mail->SMTPDebug = SMTP::DEBUG_SERVER;         
$mail->isSMTP();                              
$mail->Host       = 'smtp.office365.com';              
$mail->SMTPAuth   = true;                                
$mail->Username   = 'lucas.santos@lksagenciadigital.com.br';                   
$mail->Password   = 'Luk!nhas11!';                              
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;          
$mail->Port       = 587;                       


// Recebe o email do formulário
$email = $_POST['email'];

// Verifica se o email existe na tabela
$query = "SELECT * FROM web_login WHERE email = '$email' AND status = 'aprovado'";
$resultado = mysqli_query($conn,$query);

if (mysqli_num_rows($resultado) == 1) {
  // O email existe na tabela, gera um token de recuperação de senha
  $token = md5(uniqid(rand(), true));

  // Insere o token no banco de dados
  $query = "UPDATE web_login SET token = '$token' WHERE email = '$email'";
  mysqli_query($conn,$query);

//   Envia um email com o link de recuperação de senha

    $mail->setFrom('lucas.santos@lksagenciadigital.com.br', 'Lucas Santos');
    $mail->addAddress($email);
    $mail->Subject = 'Recuperação de senha';
    $mail->Body = "Para redefinir sua senha, acesse o link abaixo:\n\n";
    $mail->Body .= "http://localhost/mudar-senha.php?email=" . urlencode($email) . "&token=$token\n\n";
    $mail->Body .= "Se você não solicitou a recuperação de senha, ignore este email.\n";
    $mail->send();

  // Redireciona o usuário para uma página de confirmação
  $_SESSION['email_success'] = "Email encontrado, em breve enviaremos um link para redefinição da senha.";
  header('Location: ../esqueci-senha.php');
  exit();
} else {
  // O email não existe na tabela
  $_SESSION['email_error'] = "Email não encontrado no banco de dados.";
  header('Location: ../esqueci-senha.php');
  exit();
}

// Fecha a conexão com o banco de dados
mysql_close($conexao);
?>
