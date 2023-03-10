<?php
session_start();
$paginaAtiva = 'Devolucao_Vazio';

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: assets/error-page/403.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multilog - Gestão de Patio</title>
    <link rel="shortcut icon" href="assets/images/logo/logo_moderna.jpg" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="app">
        <?php require_once 'assets/menu.php';?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Central de Analise</h3>
                            <p class="text-subtitle text-muted">O Power BI pode ser útil no setor de operações com containers de diversas maneiras, permitindo que as empresas visualizem e analisem dados em tempo real para melhorar a eficiência e a eficácia de suas operações.</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                        </div>
                    </div>
                </div>
                <!-- Basic card section start -->
                <section id="content-types  match-height justify-content-center">
                    <div class="col-md-6 col-sm-12">
                        <div class="card">
                            <div class="card-content">
                                    <iframe class="card-img-top" caltitle="Controlador Patio" width="600" height="450" src="https://app.powerbi.com/view?r=eyJrIjoiZTk1MzQ0NTQtOTc0Ny00MzBkLWI5MTktYzA4MGM3NGZiMDcyIiwidCI6ImVmNmM3MDI4LTdmY2ItNGE0My1hM2JlLWE3NTgzMjBjNDEzMSJ9" frameborder="0" allowFullScreen="true"></iframe>
                            </div>
                        </div>
                    </div>
            </section>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>