<!DOCTYPE html>
<html lang="en">

<body>


    <div class="container-fluid">

        <h1 align="center" class="h1 text-gray-900 mb-4" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">Crear dominio</h1>

        <br>

        <form class="was-validated" method="POST" action="<?= base_url("admin/creproyecto/") ?>" enctype="multipart/form-data">



            <div class="form-row">
                <div class="col">

                    <label> <i class="fab fa-creative-commons-pd-alt">&nbsp;&nbsp;&nbsp;</i>Nombre</label>
                    <input type="text" name="nombre" class="form-control" value="" placeholder="nombre" required>



                </div>

                <div class="col">
                    <label> <i class="">&nbsp;&nbsp;&nbsp;</i>Description</label>
                    <br> <input type="text" name="description" class="form-control" value="" placeholder=" description " required>

                </div>

            </div>

            <center>
                <div class="row" style="margin:0px auto; display:block;">


                    <br><button type="submit" name="submit" value="Agregar" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Agregar proyecto</span>
                    </button>

                </div>
            </center>

        </form>

</body>

</html>