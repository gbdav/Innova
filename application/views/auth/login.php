<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

       <!-- <div class="col-xl-10 col-lg-12 col-sm-9">-->
        
        <div class="col-lg-7">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                <center>
                                    <img src="<?= base_url('assets/img/logo1.jpg') ?> "/>
                                </center>
                                    <h1 class="h4 text-gray-900 mb-4">Inicio de sesión</h1>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                        <input type="email" id="email" name="email" class="form-control form-control-user" placeholder="Escribe tu correo" value="<?= set_value('email'); ?>">
                                         <?= form_error('email', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;  </button> <center><strong>Error! <br> </strong>', ' </div></center>'); ?>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" name="password" class="form-control form-control-user" placeholder="Escribe tu contraseña">
                                       <?= form_error('password', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;  </button> <center><strong>Error! <br> </strong>', ' </div></center>'); ?>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-user btn-block" id="entrar">
                                        Iniciar sesión
                                    </button>

                                    <!--<div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck"></label>
                                            </div>
                                            </div>-->
                                    <!--<a href="index.html" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </a>
                                        <hr>
                                        <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                    </form>-->
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/recuperarcontra'); ?>">¿Quieres recuperar tu contraseña?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/resgistro'); ?>">Crear usuario</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>