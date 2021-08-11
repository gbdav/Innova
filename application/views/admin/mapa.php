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
    <!-- <?= $user['latitud']; ?>
    <?= $user['longitud']; ?>-->

    <h1 align="center" class="h1 text-gray-900 mb-4" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">Mi ubicacion</h1>

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
        var id = '<?= $user['id'] ?>'
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
                url: '<?php echo base_url(); ?>admin/updateUbicacion',
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