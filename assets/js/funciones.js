$(document).ready(function() {

    $("#btn-borrar-confirma").click(function() {
        var id = $(this).attr("data-id");
        $.ajax({
            "url": base_url + "Proyectos/borra_proyect",
            "type": "POST",
            "data": {
                "id": id
            },
            "dataType": "JSON",
            "success": function(obj) {
                window.location.reload();
                alerta(obj.resultado, obj.mensaje);
            }

        });

    });

    $("#btn-actualizar-confirma").click(function() {
        var id = $("#modal-i").val();
        var name_project = $("#modal-name_project").val();
        var description = $("#modal-des").val();
        var date_ini = $("#modal-f").val();
        var email = $("#modal-email").val();
        var accion = $(this).attr("data-accion");
        if (accion == "inserta") {
            $.ajax({
                "url": base_url + "Proyectos/create_proyect",
                "type": "POST",
                "data": {
                    "name_project": name_project,
                    "description": description,
                    "date_ini": date_ini,
                    "email": email
                },
                "dataType": "JSON",
                "success": function(obj) {
                    window.location.reload();
                    alerta(obj.resultado, obj.mensaje);

                }
            });
        } else {
            $.ajax({
                "url": base_url + "Proyectos/actualiza_proyect",
                "type": "POST",
                "data": {
                    "id": id,
                    "name_project": name_project,
                    "description": description,
                    "date_ini": date_ini,
                    "email": email
                },
                "dataType": "JSON",
                "success": function(obj) {
                    window.location.reload();
                    alerta(obj.resultado, obj.mensaje);
                }
            });
        }
    });

});




function click_borrar(id, name_project) {
    $("#btn-borrar-confirma").attr("data-id", id);
    $("#modal-name_project").html(name_project);
}

function click_inserta(email) {
    $("#modal-i").val("");
    $("#modal-name_project ").val("");
    $("#modal-f").val("");
    $("#modal-des").val("");
    $("#modal-email").val(email);
    $("#btn-actualizar-confirma").attr("data-accion", "inserta");
}

function click_actualizar(id, name_project, description, date_ini, email) {
    $("#modal-i").val(id);
    $("#modal-name_project").val(name_project);
    $("#modal-des").val(description);
    $("#modal-f").val(date_ini);
    $("#modal-email").val(email);
}