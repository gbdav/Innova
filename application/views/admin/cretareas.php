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

        <h1 align="center" class="h1 text-gray-900 mb-4" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">Agregar Tarea</h1>
        <br>
        <form class="was-validated" method="POST" enctype="multipart/form-data" action="<?= base_url('admin/cretareas/'); ?>"" value=" <?= encriptar($id) ?>">
            <div class="form-row">
                <div class="col">
                    <LABEL><STRONG>Id :</STRONG></LABEL>
                    <input type="text" id="pro" name="pro" class="form-control form-control-tar" value="<?php echo $id ?>" readonly />

                </div>
                <div class="col">
                    <?php
                    $querytabla = "SELECT * FROM project WHERE id='$id'";
                    $id = $this->db->query($querytabla)->result_array();
                    ?>
                    <LABEL><STRONG>Proyecto :</STRONG></LABEL>
                    <?php foreach ($id as $e) : ?>
                        <input type="text" class="form-control form-control-tar" value="<?= $e['name_project'] ?>" readonly />
                    <?php endforeach; ?>

                </div>
                <div class="col">
                    <LABEL><STRONG>Nombre de la tarea:</STRONG></LABEL>
                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escribe un nombre" required>

                </div>

                <div class="col">
                    <LABEL><STRONG>Descripción:</STRONG></LABEL>
                    <input type="text" id="des_tareas" name="des_tareas" class="form-control form-control-tar" placeholder="Escribe una descripcion" required>
                </div>

                <div class="col">
                    <?php
                    $querytabla = "SELECT * FROM user WHERE role_id=2";
                    $empleado = $this->db->query($querytabla)->result_array();
                    ?>
                    <LABEL><STRONG>Usuario:</STRONG></LABEL>
                    <SELECT class="form-control" id="id_user" name="id_user">
                        <?php foreach ($empleado as $e) : ?>
                            <OPTION value="<?= $e['id'] ?>"><?= $e['name'] ?></OPTION>
                        <?php endforeach; ?>
                    </SELECT>
                </div>


            </div>
            <center>
                <div class="row" style="margin:0px auto; display:block;">
                    <br>
                    <br><button type="submit" name="submit" value="aceptar" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Aceptar</span>
                    </button>
                </div>
            </center>
            <br>


            <br>

        </form>

</body>