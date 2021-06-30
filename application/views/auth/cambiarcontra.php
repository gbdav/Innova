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
                                    <h1 class="h4 text-gray-900">Cambiar contraseña</h1>
                                    <h5 class="mb-4"><?= $this->session->userdata('reset_email'); ?></h5>
                                </div>
                                <?= $this->session->flashdata('message'); ?>
                                <form class="user" method="post" action="<?= base_url('auth/cambiarcontra'); ?>">
                                    <div class="form-group">
                                        <input type="password" id="password1" name="password1" class="form-control form-control-user" placeholder="Escribe tu contraseña nueva" value="<?= set_value('email'); ?>">
                                        <?= form_error('password1', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;  </button> <center><strong>Error! <br> </strong>', ' </div></center>'); ?>
                                          <div class="col">
                                                <button id="show_password" class="btn btn-success" type="button" onclick="mostrarPassword1()"><span class="fa fa-eye-slash icon1"></span>
                                                </button>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password2" name="password2" class="form-control form-control-user" placeholder="Vuele a repetir tu contraseña nueva" value="<?= set_value('email'); ?>">
                                        <?= form_error('password2', '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert">&times;  </button> <center><strong>Error! <br> </strong>', ' </div></center>'); ?>
                                          <div class="col">
                                                <button id="show_password" class="btn btn-success" type="button" onclick="mostrarPassword2()"><span class="fa fa-eye-slash icon1"></span>
                                                </button>
                                    </div>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-user btn-block">
                                        Cambiar contraseña
                                    </button>
                                </form>
                            </div>
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