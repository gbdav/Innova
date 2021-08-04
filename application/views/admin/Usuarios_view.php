<!-- Begin Page Content -->
<div class="container-fluid">
    
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row-right">
        <BUTTON 
            class="btn btn-light"
            data-toggle="modal" 
            data-target="#modal-agregar"
            onclick=""><I
            class="fas fa-plus"
            ></I>
                Agregar nuevo proyecto
        </BUTTON>
    </div> 
</br> 
    <div class="container">	
                <div class="row">
                    <div class="col col-sm-12">
                    <?php
                        $role_id = $this->session->userdata('role_id');
                        $querytabla= "SELECT FROM group_works";
                        $tabla = $this->db->query($querytabla)->result_array();
                    ?>
                        <table class="table table-hove" id="tabla-empleados">
                            <TR class="bg-Active">
                            <th class="text-center">ID</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">DESCRIPCION</th>
                            <th class="text-center">FECHA INICIO</th>
                            <!--<th class="text-center">ID USUARIO</th>-->
                            <th class="text-center">ACCIONES</th>
                        </tr>
                        <?php foreach ($tabla as $p) : ?>
                        <tr>
                            <td class="text-center"><?= $p['id']; ?></td>
                            <td class="text-center"><?= $p['name_project']; ?></td>
                            <td><?= $p['name']; ?></td>
                            
                            <td class="text-center">
                                <BUTTON 
                                    class="btn btn-sm btn-info btn-edit"
                                    data-toggle="modal" 
                                    data-target="#modal-actualizar"
                                    onclick=""><I
                                    class="fas fa-edit"
                                    ></I>
                                </BUTTON>
                                <BUTTON 
                                    class="btn btn-sm btn-danger btn-delete"
                                    data-toggle="modal" 
                                    data-target="#modal-borrar"><I
                                    class="fas fa-trash"
                                    onclick=""></I>
                                </BUTTON>
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
    



