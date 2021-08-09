<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>


    <div class="card" style="width: 18rem;">
        <img src="<?= base_url('assets/img/perfil/') . $user['image']; ?>" class="card-img-top" alt="...">
        <div class="card-body">
            <p class="card-text">
                Nombre completo:</br><?= $user['name']; ?>
                </br>
                Correo electronico: </br><?= $user['email']; ?>
                <!--   </br>
                Fecha de creación:</br><?= date('d m Y', $user['date_created']); ?>-->
            </p>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->