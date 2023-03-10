<?php session_start();
include_once("assets/conexao.php");

if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
    echo "";
} else {
    header("Location: assets/error-page/403.php");
    exit();
}

$paginaAtiva = 'Cadastrar-Diaria'; 

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
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <div id="app">
        <?php require_once 'assets/menu.php'; ?>

            <!-- Basic Horizontal form layout section start -->
            <section id="basic-horizontal-layouts" class="mt-5">
                <div class="row match-height justify-content-center">
                    <div class="col-md-6 offset-md-2">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Cadastro de Diarias</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-horizontal" action="assets/cadastro-diaria.php" method="POST">
                                        <div class="form-body">
                                            <div class="row">
                                            <?php
                                                if(isset($_SESSION['diaria_error'])) {
                                                    echo "<div class='alert alert-danger border'><p>".$_SESSION['diaria_error']."</p></div>";
                                                    unset($_SESSION['diaria_error']);
                                                }

                                                if(isset($_SESSION['diaria_success'])) {
                                                    echo "<div class='alert alert-success border'><p>".$_SESSION['diaria_success']."</p></div>";
                                                    unset($_SESSION['diaria_success']);
                                                    echo '<script>setTimeout(function() { window.location.href = "planilha_diarias.php"; }, 3000);</script>';
                                                }
                                            ?>
                                                <div class="col-md-6">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">

                                                            <input type="text" name="motorista" class="form-control"
                                                                placeholder="Nome do Motorista" id="first-name-icon" required>

                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">

                                                            <input type="text" name="placa-cavalo" class="form-control" onkeyup="validarPlaca(this)" maxlength="8"
                                                                placeholder="Placa Cavalo" id="first-name-icon" required>

                                                            <div class="form-control-icon">
                                                                <i class="bi bi-badge-ad"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">

                                                            <input type="text" name="hora-entrada"  class="form-control data_formato" data-date-format="dd/mm/yyyy HH:ii"
                                                                placeholder="Hora de Entrada" autocomplete="off" required>

                                                            <div class="form-control-icon">
                                                                <i class="bi bi-calendar-week"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">

                                                            <input type="text" name="hora-saida" autocomplete="off" class="form-control data_formato" data-date-format="dd/mm/yyyy HH:ii"
                                                                placeholder="Hora de Saída">

                                                            <div class="form-control-icon">
                                                                <i class="bi bi-calendar-week"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 offset-md-2">
                                                    <div class="form-group has-icon-left">
                                                        <div class="position-relative">

                                                            <input type="text" name="motivo" class="form-control"
                                                                placeholder="Motivo de Acesso" required>

                                                            <div class="form-control-icon">
                                                                <i class="bi bi-card-heading"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 p-3">
                                                <button type="submit"
                                                    class="btn btn-primary me-1 mb-1">Cadastrar</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Recomeçar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>        
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/main.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/locales/bootstrap-datetimepicker.pt-BR.js"></script>

    <script>
        let nomeOriginal = document.getElementById("motorista");
        let nomeParts = nomeOriginal.toLowerCase().split(" ");
        let nomeFormatted = nomeParts.map(part => part.charAt(0).toUpperCase() + part.slice(1)).join(" ");
        console.log(nomeFormatted);
    </script>

    <script>
        $('input[name=placa-cavalo]').mask('AAA 0U00', {
        translation: {
            'A': {
                pattern: /[A-Za-z]/
            },
            'U': {
                pattern: /[A-Za-z0-9]/
            },
        },
        onKeyPress: function (value, e, field, options) {
            e.currentTarget.value = value.toUpperCase();

            let val = value.replace(/[^\w]/g, '');

            let isNumeric = !isNaN(parseFloat(val[4])) && isFinite(val[4]);
            let mask = 'AAA-0U00';
            if(val.length > 4 && isNumeric) {
                mask = 'AAA-0000';
            }
            $(field).mask(mask, options);
        }
    });
    </script>

    <script>
        $('.data_formato').datetimepicker({
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1,
            language: "pt-BR",
            format: 'dd/mm/yyyy HH:ii'
            //startDate: '+0d'
        });
  </script>
</body>

</html>