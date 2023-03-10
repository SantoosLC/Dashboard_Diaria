<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multilog - Gestão de Patio</title>
    <link rel="shortcut icon" href="assets/images/logo/logo_moderna.jpg" type="image/x-icon">

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
                    <h1 class="auth-title">Alteração de Senha</h1>
                    <p class="auth-subtitle mb-5">Escolha uma nova senha, não se esqueça de anotar...</p>
                    <?php
                    if(isset($_SESSION['senha_error'])) {
                        echo "<div class='alert alert-danger my-4 p-3 border'><p>".$_SESSION['senha_error']."</p></div>";
                        unset($_SESSION['senha_error']);
                    }

                    if(isset($_SESSION['senha_success'])) {
                        echo "<div class='alert alert-success my-4 p-3 border'><p>".$_SESSION['senha_success']."</p></div>";
                        unset($_SESSION['senha_success']);
                        echo '<script>setTimeout(function() { window.location.href = "login.php"; }, 3000);</script>';
                    }
                    ?>
                    <form action="assets/alterar-senha.php" method="POST">

                        <input type="hidden" class="form-control form-control-xl" name="token" value="<?php echo $_GET['email']; ?>">
                        <input type="hidden" class="form-control form-control-xl" name="email" value="<?php echo $_GET['token']; ?>">

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="senha" placeholder="Nova Senha" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Enviar</button>
                    </form>
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