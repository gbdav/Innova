<head>
    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
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

        <h1 align="center" class="h1 text-gray-900 mb-4" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">Modificar empleado</h1>
        <br>


        <form class="was-validated" method="POST" enctype="multipart/form-data">

            <?php foreach ($mod as $fila) { ?>

                <div class="form-row">
                    <div class="col">

                        <label> <i class="fas fa-hotel">&nbsp;&nbsp;&nbsp;</i>Nombre</label>
                        <input type="text" name="name" class="form-control" value="<?php echo $fila->name; ?>" placeholder="" required>
                    </div>
                    <div class="col">

                        <label> <i class="fas fa-hotel">&nbsp;&nbsp;&nbsp;</i>Correo electronico</label>
                        <input type="text" name="email" class="form-control" value="<?php echo $fila->email; ?>" placeholder="" readonly>
                    </div>



                <?php } ?>
                </div>

                <center>
                    <div class="row" style="margin:0px auto; display:block;">


                        <br>
                        <br><button type="submit" name="submit" value="Modificar" class="btn btn-success btn-icon-split">
                            <span class="icon text-white-50">
                                <i class="fas fa-edit"></i>
                            </span>
                            <span class="text">Modificar</span>
                        </button>
                        <?php foreach ($mod as $row) { ?>
                            <a href="<?= base_url('admin/usuarios/') ?>" class="btn btn-facebook btn-icon-split ">
                                <span class="icon text-white-50">
                                    <i class="fas fa-undo-alt"></i>
                                </span>
                                <span class="text">Regresar</span>
                            </a>
                        <?php } ?>
                        <?php foreach ($mod as $row) { ?>
                            <a href="<?php echo base_url("admin/delempleados/") ?><?= encriptar($fila->id) ?>" class="btn btn-danger btn-icon-split ">
                                <span class="icon text-white-50">
                                    <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Eliminar</span>
                            </a>
                        <?php } ?>
                    </div>
                </center>
                <br>


                <br>

        </form>

</body>