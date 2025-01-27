<!-- Begin Page Content -->
<div class="container-fluid">
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
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="container">
    <div class="row">
      <div class="col col-sm-12">
        <?php
        $id = $user['id'];
        $querytabla = "SELECT id_tarea,id_user,date_ini,name_project,nombre,stat_tarea,project.description, id_pro,name_project, user.id,project.id,des_tareas from tareas, project, user where tareas.id_user = user.id and tareas.id_pro = project.id and user.id = '$id' and stat_tarea != 2 and stat_pro = 1 ";
        $tabla = $this->db->query($querytabla)->result_array();
        ?>
        <table class="table table-hove" id="tabla-proyectos">
          <TR class="bg-Active">
            <th class="text-center">Estatus</th>
            <th class="text-center">Proyecto</th>
            <th class="text-center">Des Proyecto</th>
            <th class="text-center">Fecha Inicio</th>
            <th class="text-center">Tareas</th>
            <th class="text-center">Desc Tareas</th>
            <th class="text-center">ACCION</th>
          </tr>
          <?php foreach ($tabla as $p) : ?>
            <tr>
              <?php
              if ($p['stat_tarea'] == 0) {
                $estado = "warning";
                $pr = "exclamation";
              }
              if ($p['stat_tarea'] == 1) {
                $estado = "success";
                $pr = "check";
              }
              ?>
              <td><button type="button" class="btn btn-<?php echo $estado ?> btn-circle"></a><i class="fas fa-<?php echo $pr ?>"></i></button></td>
              <td class="text-center"><?= $p['name_project']; ?></a></td>
              <td><?= $p['description']; ?></td>
              <td class="text-center"><?= $p['date_ini']; ?></td>
              <td class="text-center"><?= $p['nombre']; ?></td>
              <td class="text-center"><?= $p['des_tareas']; ?></td>
              <td class="text-center">
                <a type="button" id="btn-actualizar-confirma" href="<?php echo base_url("user/realizatarea2/") ?><?= encriptar($p['id_tarea']) ?>" class="btn btn-sm btn-success btn-edit">
                  <I class="fas fa-check"></I>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>

        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<!-- Modal ELIMINAR-->
<div class="modal fade" id="modal-borrar">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header" style="background-color: #FB9FB8 !important;">
        <h4 class="modal-title">Eliminar proyecto</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        ¿Realmente quieres eliminar el proyecto <STRONG><SPAN id="modal-name_project"></SPAN></STRONG>?
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><I class="fas fa-times-circle"></I>
          Cancelar</button>
        <button type="button" id="btn-borrar-confirma" class="btn btn-danger" data-dismiss="modal"><I class="fas fa-check-circle" "></I>
        	Borrar</button>
      </div>

    </div>
  </div>
</div>

<!-- Modal MODIFICAR / INSERTAR -->
<div class=" modal fade" id="modal-actualizar">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header" style="background-color: #BCF7BC !important;">
                  <h4 class="modal-title"><SPAN id="modal-accion"></SPAN>Proyecto</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                  <DIV class="row">

                    <DIV class="form-group col col-md-5">
                      <LABEL><STRONG>Nombre:</STRONG></LABEL>
                      <INPUT type="text" minlenght="8" class="form-control" id="modal-name_project">
                    </DIV>

                    <DIV class="form-group col col-md-8">
                      <LABEL><STRONG>Descripcion:</STRONG></LABEL>
                      <INPUT type="text" minlenght="10" class="form-control" id="modal-des">
                    </DIV>
                  </DIV>
                  <!-- Modal footer -->
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><I class="fas fa-times-circle">
                      </I>Cancelar</button>
                    <button type="submit" id="btn-actualizar-confirma" class="btn btn-success" data-dismiss="modal"><I class="fas fa-check-circle">
                      </I>Guardar</button>
                  </div>
                </div>

              </div>
            </div>
      </div>