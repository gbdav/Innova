<head>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<?php
function encriptar($a)
{
    $string = $a;
    $encrypt_method = 'AES-256-CBC';
    $secret_key = 'riju';
    $secret_iv = 'riju';
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
    return $output;
}
?>

<body>
    <div class="container-fluid">
        <h1 align="center" class="h1 text-gray-900 mb-4" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">Proyectos</h1>

        <div class="form-goup" align="center">

            <div class="form-inline">
                <input class="form-control form-control-lg" id="searching" type="text" placeholder="Buscar proyecto..." style="margin:0px auto; display:block;">
            </div>
            <br>

            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Nuevo proyecto</button>

            <br> <br>
            <!--<div class="row" style="margin:0px auto; display:block;" data-toggle="modal" data-target="#modal-actualizar">
                <a class="btn btn-success btn-icon-split ">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Nuevo proyecto</span>
                </a>

            </div>-->

            <br>

            <?= $this->session->flashdata('message'); ?>

        </div>


        <div class="row" id="cards">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">description</th>
                        <th scope="col">Fecha</th>
                    </tr>
                </thead>
                <tbody id="info">
                    <?php
                    $i = 0;
                    if ($p == 0 || $p == null) {
                    ?>
                        <h1>No hay proyectos disponibles</h1>
                        <?php
                    } else {
                        foreach ($p as $fila) {
                            $i = $i + 1;

                        ?>

                            <tr>
                                <td scope="row"><?php echo $fila->name_project ?></td>
                                <td><?php echo $fila->description ?></td>
                                <td><?php echo $fila->date_ini ?></td>
                                <td>
                                <td>
                                    <a href="" class="btn btn-facebook btn-circle" data-toggle="tooltip" data-placement="bottom" title="Tareas">
                                        <i class="fas fa-sticky-note"></i>
                                    </a>
                                    <a href="" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <!--<a href="<?php echo base_url("admin/delproyecto/") ?><?= encriptar($fila->id) ?>" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>-->
                                    <button type="button" class="btn btn-danger btn-circle" data-toggle="modal" data-target="#myModal2" title="Eliminar"><i class="fas fa-trash"></i></button>

                                </td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <br>
        <br>
        <br>
        <br>
    </div>

    <script>
        $(document).ready(function() {
            $("#searching").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#info tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>


    <div class="container">
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" align="center">
                        <h4 class="modal-title">Crear Proyecto</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <form class="pro" method="post" action="<?= base_url('admin/creproyecto/'); ?>">
                        <div class="form-group">
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escribe un nombre" required>

                        </div>
                        <div class="form-group">
                            <input type="text" id="description" name="description" class="form-control form-control-pro" placeholder="Escribe una descripcion" required>

                        </div>


                        <div class="modal-footer">
                            <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                            <button type="button" data-dismiss="modal" class="btn btn-danger">
                                Cerrar
                            </button>
                            <button type="submit" class="btn btn-success ">
                                Aceptar
                            </button>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Borrar Proyecto</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <br>
                    <br>
                    <h4 aling="center">El proyecto se eliminara de forma permanente</h4>
                    <br>
                    <div class="modal-footer">
                        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                        <button type="button" data-dismiss="modal" class="btn btn-success btn-circle">
                            <i class="fas fa-undo-alt"></i>
                        </button>
                        <a href="<?php echo base_url("admin/delproyecto/") ?><?= encriptar($fila->id) ?>" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<!-- Modal actualizar 
                <div class="modal-header" style="background-color: #BCF7BC !important;">
                    <h4 class="modal-title"><SPAN id="modal-accion"></SPAN>Crear proyecto</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <DIV class="row">
                        <form class="pro" method="post" action="<?= base_url('admin/creproyecto/'); ?>">
                            <div class="form-group">
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escribe un nombre">

                            </div>
                            <div class="form-group">
                                <input type="text" id="description" name="description" class="form-control form-control-pro" placeholder="Escribe una descripcion">

                            </div>
                            <button aling="center" type="submit" class="btn btn-success btn-user btn-block">
                                Aceptar
                            </button>
                    </div>
                </div>
            </div>
        </div>
    </div>-->


<!-- Modal -->