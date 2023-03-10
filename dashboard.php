<?php 
session_start();
include_once("assets/conexao.php");

$paginaAtiva = 'Dashboard'; 

$hoje = date('d/m/Y');
$hoje = explode('/', $hoje);git init
$ano = $hoje[2];
$mes = $hoje[1];
$primeiroDia = '01';
$ultimoDia = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

$sqlDiarias = mysqli_query($conn, "SELECT * FROM diarias_solicitadas WHERE `HoraDeRegistro` BETWEEN '$ano-$mes-$primeiroDia' AND '$ano-$mes-$ultimoDia'");
$resultado_sqldiarias = mysqli_fetch_array($sqlDiarias);

$sql = "SELECT SUM(totaldehoras) AS 'totaldehoras' FROM diarias_solicitadas WHERE `HoraDeRegistro` BETWEEN '$ano-$mes-$primeiroDia' AND '$ano-$mes-$ultimoDia'";
$resultado = mysqli_query($conn, $sql);
$total = mysqli_fetch_array($resultado);

$HorasTotais = $total['totaldehoras'];
$emReal = $total['totaldehoras'] * 85;

// CHART DE HORAS MENSAIS

$query = "SELECT MONTH(HoraDeRegistro) AS mes, SUM(totaldehoras) AS totaldehoras FROM diarias_solicitadas WHERE YEAR(HoraDeRegistro) = '2023' GROUP BY mes";
$result = mysqli_query($conn, $query);

// Cria um array em PHP para armazenar os dados obtidos do MySQL
$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row['totaldehoras'];
}

// Converte os dados em PHP para um formato que possa ser lido pelo Chart.js, como JSON
$json_data = json_encode($data);

// MOTORISTAS
// MOTORISTAS

$query_motora = "SELECT motorista, SUM(totaldehoras) AS horas_totais, MAX(HoraDeRegistro) AS ultima_data FROM diarias_solicitadas GROUP BY motorista ORDER BY ultima_data DESC";
$result_motora = mysqli_query($conn, $query_motora);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multilog - Gestão de Patio</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
    <?php require_once 'assets/menu.php'; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Controle de Pátio</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Díarias Solicitadas</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $resultado_sqldiarias['id']; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Tempo de Díaria</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $total['totaldehoras']; ?> Horas</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Custo</h6>
                                                <h6 class="font-extrabold mb-0">R$ <?php echo number_format($emReal,2,",","."); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Preço por Hora</h6>
                                                <h6 class="font-extrabold mb-0">R$ 85,00</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Horas Por Mês</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="myChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Ultimas Solicitações</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Colaborador</th>
                                                        <th>Solicitação</th>
                                                        <th>Data Solicitada</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-md">
                                                                    <img src="assets/images/faces/4.jpg">
                                                                </div>
                                                                <p class="font-bold ms-3 mb-0">Jefferson</p>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">Solicito diaria, pois estamos com um caminhão parado</p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">09/03/2023</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-md">
                                                                    <img src="assets/images/faces/2.jpg">
                                                                </div>
                                                                <p class="font-bold ms-3 mb-0">Gerson Lima</p>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">Estamos com dois caminhões parados, favor aprovar solicitação urgente</p>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">10/03/2023</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="assets/images/faces/2.jpg" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold"><?php echo $_SESSION['nome'] ?></h5>
                                        <h6 class="text-muted mb-0"><?php echo $_SESSION['cargo'] ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Últimos Motoristas</h4>
                            </div>
                            <div class="card-content pb-4">
                                
                            <?php while ($row = mysqli_fetch_assoc($result_motora)) { 
                                $motorista = $row['motorista'];
                                $horas_totais = $row['horas_totais'];
                                $ultima_data = $row['ultima_data'];
                            ?>

                            <div class="recent-message d-flex px-4 py-3">
                                <div class="avatar avatar-lg">
                                    <img src="assets/images/faces/4.jpg">
                                </div>
                                <div class="name ms-4">
                                    <h5 class="mb-1"><?php echo $motorista; ?></h5>
                                    <h6 class="text-muted mb-0"><?php echo $horas_totais; ?> Horas</h6>
                                </div>
                            </div>

                            <?php }?>
                                <div class="px-4">
                                <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>Visualizar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <script src="assets/js/main.js"></script>

    <script>
    var data = <?php echo $json_data; ?>;
    var optionsProfileVisit = {
        annotations: {
            position: 'back'
        },
        dataLabels: {
            enabled:false
        },
        chart: {
            type: 'bar',
            height: 300
        },
        fill: {
            opacity:1
        },
        plotOptions: {
        },
        series: [{
            name: 'Horas',
            data: data
        }],
        colors: '#435ebe',
        xaxis: {
            categories: ["Jan","Fev","Mar","Abr","Mai","Jun","Jul", "Ago","Set","Out","Nov","Dez"],
        },
    };
    var chart = new ApexCharts(document.querySelector("#myChart"), optionsProfileVisit);
    chart.render();
    </script>
</body>

</html>