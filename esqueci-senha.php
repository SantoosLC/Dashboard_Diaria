<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="stylesheet" href="assets/css/estilo-lucas.css">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Redefinição de Senha</h1>
                    <p class="auth-subtitle mb-5">Insira seu e-mail e enviaremos o link de redefinição de senha.</p>
                    <?php
                    if(isset($_SESSION['email_error'])) {
                        echo "<div class='alert alert-danger my-4 p-3 border'><p>".$_SESSION['email_error']."</p></div>";
                        unset($_SESSION['email_error']);
                    }

                    if(isset($_SESSION['emaill_success'])) {
                        echo "<div class='alert alert-success my-4 p-3 border'><p>".$_SESSION['emaill_success']."</p></div>";
                        unset($_SESSION['emaill_success']);
                        echo '<script>setTimeout(function() { window.location.href = "login.php"; }, 3000);</script>';
                    }
                    ?>
                    <form action="assets/redefinir-senha.php" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" name="email" placeholder="Email">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Enviar</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Lembrou da senha? <a href="login.php" class="font-bold">Login</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>