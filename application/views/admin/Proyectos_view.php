<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row-right">
    <BUTTON id="inserta" class="btn btn-light" data-email=" <?= $user['email'] ?>" data-toggle="modal" data-target="#modal-actualizar" onclick="click_inserta('<?= $user['email'] ?>')"><I class="fas fa-plus"></I>
      Agregar nuevo proyecto
    </BUTTON>
  </div>
  <DIV id="mensaje" class="col col-md-5"></DIV>
  </br>
  <div class="container">
    <div class="row">
      <div class="col col-sm-12">
        <?php
        $em = $user['email'];
        $querytabla = "SELECT *FROM project WHERE email = '$em' ";
        $tabla = $this->db->query($querytabla)->result_array();
        ?>
        <table class="table table-hove" id="tabla-proyectos">
          <TR class="bg-Active">
            <th class="text-center">ID</th>
            <th class="text-center">Nombre</th>
            <th class="text-center">DESCRIPCION</th>
            <th class="text-center">FECHA INICIO</th>
            <th class="text-center">ACCIONES</th>
          </tr>
          <?php foreach ($tabla as $p) : ?>
            <tr>
              <td class="text-center"><?= $p['id']; ?></td>
              <td class="text-center"><a class="nav-link" href="<?= base_url('Tareas'); ?>"><?= $p['name_project']; ?></a></td>
              <td><?= $p['description']; ?></td>
              <td class="text-center"><?= $p['date_ini']; ?></td>
              <td class="text-center">
                <BUTTON id="actualizar" class="btn btn-sm btn-info btn-edit" data-id="<?= $p['id']; ?>" data-name_project="<?= $p['name_project']; ?>" data-email="<?= $p['email']; ?>" data-toggle="modal" data-target="#modal-actualizar" onclick="click_actualizar('<?= $p['id']; ?>','<?= $p['name_project']; ?>', '<?= $p['description']; ?>','<?= $p['date_ini']; ?>', '<?= $p['email']; ?>' )">
                  <I class="fas fa-edit"></I>
                </BUTTON>
                <BUTTON class="btn btn-sm btn-danger btn-borrar" data-id="<?= $p['id']; ?>" data-name_project="<?= $p['name_project']; ?>" data-toggle="modal" data-target="#modal-borrar" onclick="click_borrar('<?= $p['id']; ?>', '<?= $p['name_project']; ?>')"><I class="fas fa-trash"></I>
                </BUTTON>
              </td>
            </tr>
          <?php endforeach; ?>

        </table>
      </div>
    </div>
<<<<<<< Updated upstream
    <DIV id="mensaje" class="col col-md-5"></DIV> 
</br> 
<div class="container">	
                <div class="row">
                    <div class="col col-sm-12">
                    <?php
                        $em= $user['email'];
                        $querytabla= "SELECT *FROM project WHERE email = '$em' ";
                        $tabla = $this->db->query($querytabla)->result_array();
                    ?>
                        <table class="table table-hove" id="tabla-proyectos">
                            <TR class="bg-Active">
                            <th class="text-center">ID</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">DESCRIPCION</th>
                            <th class="text-center">FECHA INICIO</th>
                            <th class="text-center">ACCIONES</th>
                        </tr>
                        <?php foreach ($tabla as $p) : ?>
                        <tr>
                            <td class="text-center"><?= $p['id']; ?></td>
                            <td class="text-center"><?= $p['name_project']; ?></a></td>
                            <td><?= $p['description']; ?></td>
                            <td class="text-center"><?= $p['date_ini']; ?></td>
                            <td class="text-center">
                                <BUTTON 
                                    id="actualizar"
                                    class="btn btn-sm btn-info btn-edit"
                                    data-id="<?= $p['id']; ?>"
                                    data-name_project="<?= $p['name_project']; ?>"
                                    data-email="<?= $p['email']; ?>"
                                    data-toggle="modal" 
                                    data-target="#modal-actualizar"
                                    onclick="click_actualizar('<?= $p['id']; ?>','<?= $p['name_project']; ?>', '<?= $p['description']; ?>','<?= $p['date_ini']; ?>', '<?= $p['email']; ?>' )">
                                    <I class="fas fa-edit"></I>
                                </BUTTON>
                                <BUTTON 
                                    class="btn btn-sm btn-danger btn-borrar"
                                    data-id="<?= $p['id']; ?>"
                                    data-name_project="<?= $p['name_project']; ?>"
                                    data-toggle="modal" 
                                    data-target="#modal-borrar"
                                    onclick="click_borrar('<?= $p['id']; ?>', '<?= $p['name_project']; ?>')"
                                    ><I
                                    class="fas fa-trash"
                                    ></I>
                                </BUTTON>
                            </td>
                        </tr>    
                        <?php endforeach; ?>
                       
                        </table>
                    </div>
                </div>
        </div>   
    
=======
  </div>

>>>>>>> Stashed changes
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
<<<<<<< Updated upstream
<div class="modal fade" id="modal-actualizar">
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
=======
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
                    <DIV class="form-group col col-md-3">
                      <LABEL><STRONG>ID:</STRONG></LABEL>
                      <INPUT type="text" minlenght="8" class="form-control" id="modal-i">
                    </DIV>
                    <DIV class="form-group col col-md-5">
                      <LABEL><STRONG>Nombre:</STRONG></LABEL>
                      <INPUT type="text" minlenght="8" class="form-control" id="modal-name_project">
                    </DIV>
>>>>>>> Stashed changes

                    <DIV class="form-group col col-md-4">
                      <LABEL><STRONG>Fecha de creacion:</STRONG></LABEL>
                      <INPUT type="text" minlenght="10" class="form-control" id="modal-f">
                    </DIV>

                    <DIV class="form-group col col-md-5">
                      <LABEL><STRONG>email</STRONG></LABEL>
                      <INPUT type="text" minlenght="8" class="form-control" id="modal-email">
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