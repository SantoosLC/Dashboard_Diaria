<?php
session_start();
include_once("assets/conexao.php");

$paginaAtiva = 'Planilha_Diaria';

$diarias_sql = mysqli_query($conn, "SELECT diarias_solicitadas.*, web_login.nome FROM diarias_solicitadas INNER JOIN web_login ON diarias_solicitadas.registradoPor = web_login.login");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTable - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <!-- DataTable Plugin -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.3.1/css/dataTables.dateTime.min.css">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <?php require_once("assets/menu.php")?>

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
                            <h3>Planilha de Díarias</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Planilha de Díarias</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                
                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <table id="example" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Motorista</th>
                                        <th>Placa</th>
                                        <th>Hora de Entrada</th>
                                        <th>Hora de Saída</th>
                                        <th>Registrado Por</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php            
                                        while($diarias_row = mysqli_fetch_assoc($diarias_sql)){

                                        $motorista = $diarias_row['motorista'];
                                        $placaCavalo = $diarias_row['placaCavalo'];
                                        $HoraDeInicio = $diarias_row['HoraDeInicio'];
                                        
                                        $formatar_hora = explode('-', $HoraDeInicio);
                                        $formatar_hora = implode('/', $formatar_hora);
                                        $HoraDeInicio = $formatar_hora;
                                        
                                        $HoraDeSaida = $diarias_row['HoraDeSaida'];

                                        $formatar_hora_saida = explode('-', $HoraDeSaida);
                                        $formatar_hora_saida = implode('/', $formatar_hora_saida);
                                        $HoraDeSaida = $formatar_hora_saida;

                                        $motivo = $diarias_row['motivo'];

                                        $duracao1 = $diarias_row['totaldehoras'];
                                        $duracao2 = substr($duracao1, 0, 2);
                                        $duracao = trim($duracao2, '.-');
                                            
                                        $RegistradoPor = $diarias_row['nome'];

                                        $id = $diarias_row['id'];

                                        $custo_sql =  mysqli_query($conn,"SELECT SUM(totaldehoras) AS 'totaldehoras' FROM diarias_solicitadas WHERE id = $id");
                                        $total = mysqli_fetch_array($custo_sql);
                                        
                                        $emReal = $total['totaldehoras'] * 85;
                                        $emReal = number_format($emReal,2,",",".");     
                                        
                                    ?>
                                        <tr>
                                            <td> <?php echo $motorista; ?> </td>
                                            <td> <?php echo $placaCavalo; ?> </td>
                                            <td> <?php echo $HoraDeInicio; ?> </td>
                                            <td> <?php echo $HoraDeSaida; ?> </td>
                                            <td> <?php echo $RegistradoPor; ?> </td>
                                            <td> 
                                                <button type="button" style='width:50px;' class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" 
                                                
                                                data-whatever="<?php echo $id; ?>" 
                                                data-whatevermotorista="<?php echo $motorista; ?>" 
                                                data-whateverplaca="<?php echo $placaCavalo; ?>" 
                                                data-whateverinicio="<?php echo $HoraDeInicio; ?>" 
                                                data-whateversaida="<?php echo $HoraDeSaida; ?>" 
                                                data-whatevermotivo="<?php echo $motivo; ?>" 

                                                ><i class="bi bi-pencil-square"></i></button>

                                                <button type="button" style='width:50px;' class="btn btn-success " data-toggle="modal" data-target="#ModalVisualizar" 

                                                data-whatever="<?php echo $id; ?>" 
                                                data-whatevermotorista="<?php echo $motorista; ?>" 
                                                data-whateverplaca1="<?php echo $placaCavalo; ?>" 
                                                data-whatevermotivo="<?php echo $motivo; ?>" 
                                                data-whatevercusto="<?php echo $emReal; ?>" 
                                                data-whateverduracao="<?php echo $duracao; ?>" 

                                                ><i class="bi bi-eye"></i></button>

                                                <a id="confirmLink_<?php echo $id; ?>" data-inicio="<?php echo $HoraDeInicio; ?>" data-id="<?php echo $id; ?>" type="button" style='width:50px;' class="btn btn-danger"

                                                ><i class="bi bi-x-octagon"></i></a>

                                            </td>
                                        </tr>
                                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalVisualizar" tabindex="-1" role="dialog" aria-labelledby="ModalVisualizarLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalVisualizarLabel">Detalhes Diaria</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Motorista: <span id="recipient-motorista">Lucas Santos</span></div>
                <div class="modal-body">Placa: <span id="recipient-placa1"></span></div>
                <div class="modal-body">Motivo: <span id="recipient-motivo">Lucas Santos</span></div>
                <div class="modal-body">Custo: R$ <span id="recipient-custo">Lucas Santos</span></div>
                <div class="modal-body">Duracao: <span id="recipient-duracao">Lucas Santos</span> Horas</div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edição de Diaria</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            </div>
            <div class="modal-body">
            <form method="POST" action="edicao_diaria-db.php" enctype="multipart/form-data">
                <div class="form-group">
                <label for="recipient-motorista" class="control-label">Motorista:</label>
                <input name="motorista" type="text" class="form-control" id="recipient-motorista">
                </div>
                <div class="form-group">
                <label for="recipient-placa" class="control-label">Placa:</label>
                <input name="placa" type="text" class="form-control" id="recipient-placa">
                </div>
                <div class="form-group" data-date-format="dd/mm/yyyy HH:ii">
                <label for="recipient-inicio" class="control-label">Hora de Entrada:</label>
                <input name="inicio" type="text" class="form-control" id="recipient-inicio">
                </div>
                <div class="form-group" data-date-format="dd/mm/yyyy HH:ii">
                <label for="recipient-saida" class="control-label">Hora de Saída:</label>
                <input name="saida" type="text" class="form-control" id="recipient-saida">
                </div>
                <div class="form-group">
                <label for="recipient-motivo" class="control-label">Motivo:</label>
                <input name="motivo" type="text" class="form-control" id="recipient-motivo">
                </div>
            <input name="id" type="hidden" class="form-control" id="id-editar">
            
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-success">Alterar</button>
            
            </form>
            </div>
            
        </div>
        </div>
    </div>

    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <!-- Jquery CDN -->

    <script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha256-a2yjHM4jnF9f54xUQakjZGaqYs/V1CYvWpoqZzC2/Bw=" crossorigin="anonymous"></script>

    <!-- Font Awesome -->

    <script src="https://kit.fontawesome.com/a947e5abc9.js" crossorigin="anonymous"></script>

    <!-- DataTable Plugin -->

    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.3.1/js/dataTables.dateTime.min.js"></script>

    <!-- SweetAlert -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="assets/js/main.js"></script>

    <!-- Chamar -->

    <script>
        $('a[id^="confirmLink_"]').click(function(e) {
            e.preventDefault();
            var data = $(this).data('inicio');
            var id = $(this).data('id');

            Swal.fire({
                title: 'Tem certeza?',
                text: 'Você deseja excluir a diaria do dia ' + data + '?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, Excluir!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'enviar_cancelamento-diaria.php?id=' + id;
                }
            }) 
        });
    </script>

    <script type="text/javascript">
		$('#exampleModal').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget)
		  var recipient = button.data('whatever')
		  var recipientmotorista = button.data('whatevermotorista')
		  var recipientplacaCavalo = button.data('whateverplaca')
		  var recipientInicio = button.data('whateverinicio')
		  var recipientSaida = button.data('whateversaida')
		  var recipientMotivo = button.data('whatevermotivo')

		  var modal = $(this)
		  modal.find('#id-editar').val(recipient)

		  modal.find('#recipient-motorista').val(recipientmotorista)
		  modal.find('#recipient-placa').val(recipientplacaCavalo)
		  modal.find('#recipient-inicio').val(recipientInicio)
		  modal.find('#recipient-saida').val(recipientSaida)
		  modal.find('#recipient-motivo').val(recipientMotivo)
		  
		})
	</script>

    <script type="text/javascript">
		$('#ModalVisualizar').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('whatever') // Extract info from data-* attributes
		  var recipientmotorista = button.data('whatevermotorista')
		  var recipientplacaCavalo1 = button.data('whateverplaca1')
		  var recipientMotivo = button.data('whatevermotivo')
		  var recipientCusto = button.data('whatevercusto')
		  var recipientDuracao = button.data('whateverduracao')
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		//   modal.find('.modal-title').text('ID ' + recipient)
		  modal.find('#id-editar').text(recipient)

		  modal.find('#recipient-motorista').text(recipientmotorista)
		  modal.find('#recipient-placa1').text(recipientplacaCavalo1)
		  modal.find('#recipient-motivo').text(recipientMotivo)
		  modal.find('#recipient-custo').text(recipientCusto)
		  modal.find('#recipient-duracao').text(recipientDuracao)
		  
		})
	</script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                searching: true, // ativa a pesquisa
                search: { // define um valor padrão para a pesquisa
                search: '03/2023'
                },
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ Resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    },
                    "select": {
                        "rows": {
                            "_": "Selecionado %d linhas",
                            "0": "Nenhuma linha selecionada",
                            "1": "Selecionado 1 linha"
                        }
                    },
                    "buttons": {
                        "copy": "Copiar para a área de transferência",
                        "copyTitle": "Cópia bem sucedida",
                        "copySuccess": {
                            "1": "Uma linha copiada com sucesso",
                            "_": "%d linhas copiadas com sucesso"
                        }
                    }
                }
            });
        });
    </script>
</body>

</html>