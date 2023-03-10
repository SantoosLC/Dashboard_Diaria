<?php
    session_start();
    require_once 'conexao.php';

    if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] == true) {
        echo "";
    } else {
        header("Location: error-page/403.php");
        exit();
    }
    
    $motorista = $_POST['motorista'];
    $placaCavalo = $_POST['placa-cavalo'];
    $HoraDeInicio = $_POST['hora-entrada'];
    $HoraDeSaida = $_POST['hora-saida'];
    $motivo = $_POST['motivo'];
    $id = $_POST['id'];

    $usuario = $_SESSION['usuario'];

    // DATA DE SAIDA

    if ($HoraDeSaida == '') {
        $HoraDeSaida = "";
    } else {
        $result = explode('/',$HoraDeSaida);
        $dia = $result[0];
        $mes = $result[1];
        $ano = $result[2];
        $HoraDeSaida = $dia.'-'.$mes.'-'.$ano;
        if ($HoraDeSaida == '--') {
            $HoraDeSaida = "";
        } else {
            $HoraDeSaida = $dia.'-'.$mes.'-'.$ano;
        }
    }

    // DATA DE ENTRADA

    $result_data_entrada = explode('/',$HoraDeInicio);
    $dia_entrada = $result_data_entrada[0];
    $mes_entrada = $result_data_entrada[1];
    $ano_entrada = $result_data_entrada[2];
    $HoraDeInicio = $dia_entrada.'-'.$mes_entrada.'-'.$ano_entrada;
    
    $data = $_POST['hora-entrada'];

    $data = explode(" ", $data);
    list($date, $hora) = $data;
    $data_sem_barra = array_reverse(explode("/", $date));
    $data_sem_barra = implode("-", $data_sem_barra);

    // SOMAR TEMPO DA DIARIA

    $entrada_b = new DateTime($HoraDeInicio);
    $saida_b = new DateTime($HoraDeSaida);
    
    $SomaHora1 = (( $saida_b->getTimestamp() - $entrada_b->getTimestamp()) / 60) / 60; 
    
    $SomaHora2 = substr($SomaHora1, 0, 2);
    $SomaHora = trim($SomaHora2, '.-');

    $sql = mysqli_query($conn,"UPDATE diarias_solicitadas SET motorista='$motorista', placaCavalo='$placaCavalo', HoraDeInicio='$HoraDeInicio', HoraDeSaida='$HoraDeSaida', motivo='$motivo', totaldehoras='$SomaHora', RegistradoPor='$usuario', WHERE id = '$id'");

    if (mysqli_affected_rows($conn) == 1) {
        $_SESSION['diaria_success'] = 'Diaria Atualizada, aguarde.';
        header('Location: ../cadastrar-diaria.php');
    } else {
        $_SESSION['diaria_success'] = 'Houve um erro, verifique as informações.';
        header('Location: ../cadastrar-diaria.php');
    }
?>