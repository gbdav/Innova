<head>
    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
</head>
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

<body>


    <div class="container-fluid">

        <h1 align="center" class="h1 text-gray-900 mb-4" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">Ubicacion de empleado</h1>
        <br>
        <div>
            <?php foreach ($mod as $fila) { ?>

                <div class="form-row">
                    <div class="col">

                        <label> <i class="fas fa-user">&nbsp;&nbsp;&nbsp;</i>Id</label>
                        <input type="text" name="id" class="form-control" value="<?php echo $fila->id; ?>" placeholder="" readonly>
                    </div>
                <?php } ?>
                </div>

                <!DOCTYPE html>
                <html>

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="initial-scale=1.0">
                    <title>Mapa</title>
                    <style>
                        #map {
                            height: 70vh;
                        }

                        html,
                        body {
                            height: 70vh;
                            margin: 0;
                            padding: 0;
                        }
                    </style>
                </head>

                <body>
                    <?=
                    $a = $user['id'];
                    $sql = "SELECT * FROM user WHERE id=$a";
                    ?>

                    <?= $user['id']; ?>
                    <?= $user['latitud']; ?>
                    <?= $user['longitud']; ?>
                    <div id="map"></div>
                    <div class="text-center">
                        <button id='btnGuardar' disabled type="button" class="btn btn-primary" onclick="Guardar()">Guardar</button>
                        <button id='btnCancelar' disabled type="button" class="btn btn-primary" onclick="Cancelar()">Cancelar</button>
                    </div>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7fmmGGoW2X9qs3h1VSXi3jAdioH5SnOo&callback=initMap" async defer></script>
                    <script>
                        var map;
                        var marker;
                        var infoWindow;
                        var id = 21;
                        var usuarioLat = parseFloat("<?= $user['latitud'] ?>")
                        var usuarioLng = parseFloat("<?= $user['longitud'] ?>")
                        var center = {
                            lat: 20.59,
                            lng: -100.39
                        } // Centro de queretaro

                        function initMap() {
                            map = new google.maps.Map(document.getElementById('map'), {
                                center: center,
                                zoom: 13,
                                options: {
                                    clickableIcons: false,
                                }
                            });
                            if (usuarioLat !== 0 && usuarioLng !== 0) {
                                map.setCenter(new google.maps.LatLng(usuarioLat, usuarioLng))
                                marker = new google.maps.Marker({
                                    position: {
                                        lat: usuarioLat,
                                        lng: usuarioLng
                                    },
                                    map: map,
                                    title: 'Ubicación de usuario'
                                });
                            } else {
                                marker = new google.maps.Marker({
                                    map: map,
                                    title: 'Ubicación de usuario'
                                });
                            }
                            map.addListener("click", onMapClick);
                            marker.addListener("click", () => {
                                infowindow = new google.maps.InfoWindow({
                                    content: "<p>Latitud: " + marker.getPosition().lat() + "\nLongitud: " + marker.getPosition().lng() + "</p>",
                                });
                                infowindow.open(map, marker);
                            })
                        }

                        function onMapClick(event) {
                            if (infoWindow) {
                                infoWindow.close();
                                infoWindow = null;
                            }
                            document.getElementById('btnGuardar').disabled = false
                            document.getElementById('btnCancelar').disabled = false
                            var lat = event.latLng.lat()
                            var lng = event.latLng.lng()
                            map.panTo({
                                lat: lat,
                                lng: lng
                            });
                            marker.setMap(map)
                            marker.setPosition({
                                lat: lat,
                                lng: lng
                            })
                        }

                        function Cancelar() {
                            document.getElementById('btnGuardar').disabled = true
                            if (usuarioLat !== 0 && usuarioLng !== 0) {
                                map.setCenter(new google.maps.LatLng(usuarioLat, usuarioLng))
                                marker.setPosition({
                                    lat: usuarioLat,
                                    lng: usuarioLng
                                })
                            } else {
                                map.setCenter(center)
                                marker.setMap(null)
                            }
                        }

                        function Guardar() {
                            $.ajax({
                                type: 'POST',
                                url: '<?php echo base_url(); ?>user/updateUbicacion',
                                data: {
                                    id: id,
                                    latitud: marker.getPosition().lat(),
                                    longitud: marker.getPosition().lng()
                                },
                                success: function(msg) {
                                    alert(msg)
                                    document.getElementById('btnGuardar').disabled = true
                                    document.getElementById('btnCancelar').disabled = true
                                },
                                error: function(msj) {
                                    alert("Ha ocurrido un error")
                                }
                            });
                        }
                    </script>

                </body>

                </html>


        </div>

        <center>
            <div class="row" style="margin:0px auto; display:block;">
                <br>
                <?php foreach ($mod as $row) { ?>
                    <a href="<?= base_url('admin/usuarios/') ?>" class="btn btn-facebook btn-icon-split ">
                        <span class="icon text-white-50">
                            <i class="fas fa-undo-alt"></i>
                        </span>
                        <span class="text">Regresar</span>
                    </a>
                <?php } ?>
            </div>
        </center>
        <br>


        <br>


</body>