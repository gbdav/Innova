</div>
<!-- End of Main Content -->

<head>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container-fluid" id="inner">
        <h1 align="center" class="h1 text-gray-900 mb-4" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">Mi perfil</h1>
    </div><br>
    <div class="card text-center">
        <h5 class="card-header">¡Bienvenido a InnovaNotes!</h5>
        <div class="card-body">
            <h5 class="card-title">Nombre completo: <?= $user['name']; ?></h5>
            <h5 class="card-title">Correo electronico: <?= $user['email']; ?></h5>
        </div>
    </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

</body>

</html>