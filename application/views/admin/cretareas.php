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
        <form class="was-validated" method="POST" enctype="multipart/form-data" 
        action="<?= base_url('admin/cretareas/'); ?>"" value="<?= encriptar($id) ?>">
                        <div class="form-row">
                              <div class="col">
                              <LABEL><STRONG>Nombre:</STRONG></LABEL>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Escribe un nombre" required>
                                    
                              </div>

                              <div class="col">
                              <LABEL><STRONG>Description:</STRONG></LABEL>
                              <input type="text" id="des_tareas" name="des_tareas" class="form-control form-control-tar" placeholder="Escribe una descripcion" required>
                              </div>

                              <div class="col">
                                <LABEL><STRONG>Proyecto:</STRONG></LABEL>
                                <input type="text" id="pro" name="pro" class="form-control form-control-tar"
                                value="<?php echo $id ?>"/>
                              </div>

                              <div class="col">
                                <?php
                                    $querytabla = "SELECT * FROM user WHERE role_id=2";
                                    $empleado = $this->db->query($querytabla)->result_array();
                                ?>
                                <LABEL><STRONG>Usuario:</STRONG></LABEL>
                                <SELECT class="form-control" id="id_user" name="id_user">
                                    <?php foreach ($empleado as $e) : ?>
                                        <OPTION value="<?= $e['id']?>"><?= $e['name']?></OPTION>
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
                       
                            <a href="<?= base_url('admin/tareas/') ?>" class="btn btn-facebook btn-icon-split ">
                                <span class="icon text-white-50">
                                    <i class="fas fa-undo-alt"></i>
                                </span>
                                <span class="text">Regresar</span>
                            </a>
                    </div>
                </center>
                <br>


                <br>

        </form>

</body>