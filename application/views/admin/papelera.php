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
        <h1 align="center" class="h1 text-gray-900 mb-4" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">Papelera de proyectos</h1>

        <div class="form-goup" align="center">

            <div class="form-inline">
                <input class="form-control form-control-lg" id="searching" type="text" placeholder="Buscar proyecto..." style="margin:0px auto; display:block;">
            </div>
            <br>

            <?= $this->session->flashdata('message'); ?>

        </div>


        <div class="row" id="cards">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" align="center">Nombre</th>
                        <th scope="col" align="center">Descripción</th>
                        <th scope="col" align="center">Fecha</th>
                        <th scope="col" align="center">Acciones</th>
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
                                <td align="center"><?php echo $fila->name_project ?></td>
                                <td align="center"><?php echo $fila->description ?></td>
                                <td align="center"><?php echo $fila->date_ini ?></td>
                                <td align="center">
                                    <a href="<?= base_url("admin/resproyectofinal/") ?><?= encriptar($fila->id) ?>" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="bottom" title="Restaurar proyecto">
                                        <i class="fas fa-trash-restore-alt"></i> </a>
                                    <a href="<?php echo base_url("admin/delproyectofinal/") ?><?= encriptar($fila->id) ?>" class="btn btn-danger btn-circle" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                                        <i class="fas fa-trash"></i>
                                    </a>
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
</body>

</html>