<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <!--<div class="col-lg-5 d-none d-lg-block bg-register-image"></div>-->
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Registro</h1>
                        </div>
                        <form class="user" method="post" action="<?= base_url('auth/resgistro'); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nombre completo">
                                <?= form_error('name', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;  </button> <center><strong>Error! <br> </strong>', '  <br> El campo nombre es obligatorio. </div></center>'); ?>
                                <!-- <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>-->
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Correo electronico">
                                <?= form_error('email', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;  </button> <center><strong>Error! <br> </strong>', ' </div></center>'); ?>
                                <!-- <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>-->


                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Contraseña">
                                    <?= form_error('password1', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;  </button> <center><strong>Error! <br> </strong>', '  <br> El campo contraseña es obligatorio. </div></center>'); ?>
                                    <!-- <?= form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>-->
                                     <div class="col">
                                                <button id="show_password" class="btn btn-success" type="button" onclick="mostrarPassword1()"><span class="fa fa-eye-slash icon1"></span>
                                                </button>
                                    </div>

                                </div>


                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Repita contraseña">
                                    <?= form_error('password2', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;  </button> <center><strong>Error! <br> </strong>', '  <br> La contraseña no es semejante. </div></center>'); ?>
                                    <!--<?= form_error('password2', '<small class="text-danger pl-3">', '</small>'); ?>-->
                                     <div class="col">
                                                <button id="show_password" class="btn btn-success" type="button" onclick="mostrarPassword2()"><span class="fa fa-eye-slash icon1"></span>
                                                </button>
                                        </div>

                                </div>

                            </div>
                            <button type="submit" class="btn btn-success btn-user btn-block">
                                Regitrarse
                            </button>

                            <!-- <hr>
                            <a href="index.html" class="btn btn-google btn-user btn-block">
                                <i class="fab fa-google fa-fw"></i> Register with Google
                            </a>
                            <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                <i class="fab fa-facebook-f fa-fw"></i> Register with Facebook
                            </a>-->
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth/recuperarcontra'); ?>">¿Quieres recuperar tu contraseña?</a>
                        </div>
                        <div class="text-center">
                            <a class="small" href="<?= base_url('auth'); ?>">Inicio de sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function mostrarPassword1() {
        var cambio1 = document.getElementById("password1");
        if (cambio1.type == "password") {
            cambio1.type = "text";
            $('.icon1').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio1.type = "password";
            $('.icon1').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }
</script>
<script type="text/javascript">
    function mostrarPassword2() {
        var cambio2 = document.getElementById("password2");
        if (cambio2.type == "password") {
            cambio2.type = "text";
            $('.icon2').removeClass('fas fa-lock').addClass('fas fa-unlock-alt');
        } else {
            cambio2.type = "password";
            $('.icon2').removeClass('fas fa-unlock-alt').addClass('fas fa-lock');
        }
    }
</script>