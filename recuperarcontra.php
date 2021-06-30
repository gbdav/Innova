<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <!--  <div class="col-xl-10 col-lg-12 col-md-9">-->
        <!---->
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <!--<div class="col-lg-6 d-none d-lg-block bg-login-image"></div>-->
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Recuperar contraseña</h1>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="post" action="<?= base_url('auth/recuperarcontra'); ?>">
                                    <div class="form-group">
                                        <input type="email" id="email" name="email" class="form-control form-control-user" placeholder="Escribe tu correo" value="<?= set_value('email'); ?>">
                                        <?= form_error('email', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;  </button> <center><strong>Error! <br> </strong>', ' </div></center>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-user btn-block">
                                        Recuperar contraseña
                                    </button>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth'); ?>">Inicio de sesión</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>