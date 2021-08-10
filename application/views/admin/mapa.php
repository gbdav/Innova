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
                });
            }
            map.addListener("click", onMapClick)
        }

        function onMapClick(event) {
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
            alert('Guardando...')
        }
    </script>

</body>

</html>