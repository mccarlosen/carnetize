$(document).ready(function(){

    (function( carnetizeConnection, $, undefined ) {

        // Consiguiendo la lista de conexiones
        function loadListConnections(){
            $("#box-list-connection").load("/list_connections #div-list-connections", function(){
                on_off_ds();
                editConnection();
                deleteConnection();
            });
        };

        // Refrescar List Data
        function refreshListConnections(){
            $("#refresh_list").on('click', function(){
                loadListConnections();
            })
        }

        //Registrar una nueva conexión
        function addConnection(){
            // validación:
            $("#formAddConnection").validate({
                submitHandler: function(){
                    $.ajax({
                        data: $('#formAddConnection').serialize(),
                        url:   "/add_connection",
                        type:  'POST',
                        dataType: "json",
                        beforeSend: function () {
                            $('#createNewConexModal').modal('hide');
                            messageInfo = new PNotify({
                                title: 'Nueva Conexión',
                                text: 'Enviando información. Por favor espere...',
                                type: 'info'
                            });
                        },
                        success:  function(data) {
                            if (data.response == 0) {
                                messageError = new PNotify({
                                    title: 'Error de Nueva Conexión',
                                    text: 'Ya existe una conexión con ese nombre.',
                                    type: 'error'
                                });
                                setTimeout(function(){
                                    messageInfo.remove();
                                }, 2000)
                            }else{
                                if (data.response) {
                                    messageSuccess = new PNotify({
                                        title: 'Nueva Conexión',
                                        text: 'Conexión guardada con éxito.',
                                        type: 'success'
                                    });
                                    setTimeout(function(){
                                        messageInfo.remove();
                                    }, 2000)

                                    loadListConnections();
                                }
                            }
                        },
                        error: function(error){
                            messageError = new PNotify({
                                title: 'Error de Servidor',
                                text: 'Ha ocurrido algún problema con la respuesta del servidor.',
                                type: 'error'
                            });
                            $.each(error, function(i, j){
                                console.log(i+" :: "+j);
                            });
                        },
                        complete: function(data){
                            setTimeout(function(){
                                // if(messageError.remove()) messageError.remove();
                                if(messageSuccess.remove()) messageSuccess.remove();
                            }, 5000)
                        }
                    });
                },
                rules:{
                    name_connection:{
                        "required":true,
                        "maxlength":20
                    },
                    host_db:{
                        "required":true
                    },
                    name_db:{
                        "required":true,
                        "maxlength":15
                    },
                    user_db:{
                        "required":true
                    },
                    pwd_db:{
                        "maxlength":15
                    },
                    name_table_db:{
                        "required":true,
                        "maxlength":15
                    }
                },
                messages:{
                    name_connection:{
                        "required":"La conexión debe poseer un nombre."
                    },
                    host_db:{
                        "required":"Debe indicar el host de la BD, es obligatorio."
                    },
                    name_db:{
                        "required":"Indique el nombre de la BD, es obligatorio."
                    },
                    user_db:{
                        "required":"Debe indicar el usuario de la BD que pretende registrar, es obligatorio."
                    },
                    pwd_db:{
                        "message":"El password debe tener un máximo de 15 caracteres."
                    },
                    name_table_db:{
                        "required":"Debe indicar la tabla de la BD que contiene la data, es obligatorio."
                    }
                }
            })
        }

        //Actualizando data conexión
        function UpdateConnection(){
            // validación:
            $("#formEditConnection").validate({
                submitHandler: function(){
                    $.ajax({
                        data: $('#formEditConnection').serialize(),
                        url:   "/edit_connection",
                        type:  'POST',
                        dataType: "json",
                        beforeSend: function () {
                            $('#EditConexModal').modal('hide');
                            messageInfo = new PNotify({
                                title: 'Actualizando',
                                text: 'Enviando información. Por favor espere...',
                                type: 'info'
                            });
                        },
                        success:  function(data) {
                            if (data.response == 0) {
                                messageError = new PNotify({
                                    title: 'Mensaje del Servidor',
                                    text: 'Los datos no puedieron ser actualizados.',
                                    type: 'error'
                                });
                                setTimeout(function(){
                                    messageInfo.remove();
                                }, 2000)
                            }else{
                                if (data.response) {
                                    messageSuccess = new PNotify({
                                        title: 'Datos actualizados',
                                        text: 'La información de la conexión ha sido guardada con éxito.',
                                        type: 'success'
                                    });
                                    setTimeout(function(){
                                        messageInfo.remove();
                                    }, 2000)

                                    loadListConnections();
                                }
                            }
                        },
                        error: function(error){
                            messageError = new PNotify({
                                title: 'Error de Servidor',
                                text: 'Ha ocurrido algún problema con la respuesta del servidor.',
                                type: 'error'
                            });
                            $.each(error, function(i, j){
                                console.log(i+" :: "+j);
                            });
                        }
                    });
                },
                rules:{
                    name_connection:{
                        "required":true,
                        "maxlength":20
                    },
                    host_db:{
                        "required":true
                    },
                    name_db:{
                        "required":true,
                        "maxlength":15
                    },
                    user_db:{
                        "required":true
                    },
                    pwd_db:{
                        "maxlength":15
                    },
                    name_table_db:{
                        "required":true,
                        "maxlength":15
                    }
                },
                messages:{
                    name_connection:{
                        "required":"La conexión debe poseer un nombre."
                    },
                    host_db:{
                        "required":"Debe indicar el host de la BD, es obligatorio."
                    },
                    name_db:{
                        "required":"Indique el nombre de la BD, es obligatorio."
                    },
                    user_db:{
                        "required":"Debe indicar el usuario de la BD que pretende registrar, es obligatorio."
                    },
                    pwd_db:{
                        "message":"El password debe tener un máximo de 15 caracteres."
                    },
                    name_table_db:{
                        "required":"Debe indicar la tabla de la BD que contiene la data, es obligatorio."
                    }
                }
            })
        }

        // On/Off connection ds
        function on_off_ds(){
            $(".btns_op_on_off").on('click', function(){
                $.getJSON('/on_off_ds/'+$(this).parent().parent().attr('id'), function(data){
                    if(data.response == 1){
                        message = new PNotify({
                            title: 'Mensaje de Servidor',
                            text: 'Se ha activado satisfactoriamente.',
                            type: 'success'
                        });
                        loadDataSource();
                    }else{
                        if (data.response == 0) {
                            message = new PNotify({
                                title: 'Mensaje de Servidor',
                                text: 'Se ha desactivado satisfactoriamente.',
                                type: 'info'
                            });
                            loadDataSource();
                        }else{
                            message = new PNotify({
                                title: 'Mensaje de Servidor',
                                text: data.response,
                                type: 'error'
                            });
                        }
                    }
                    loadListConnections(); // Actualizando Listado
                    // loadDataSource();
                }) // Fin del Metodo Ajax
            })
        }

        // Edit Connections
        function editConnection(){
            $('.btns_op_edit').on('click', function(){
                $.getJSON('/edit_connection/'+$(this).parent().parent().attr('id'), function(data){
                    $("#conex_edit").attr('value', data['Connection'].name_connection);
                    $("#host_edit").attr('value', data['Connection'].host_db);
                    $("#db_edit").attr('value', data['Connection'].name_db);
                    $("#user_edit").attr('value', data['Connection'].user_db);
                    $("#passwd_edit").attr('value', data['Connection'].pwd_db);
                    $("#table_edit").attr('value', data['Connection'].name_table_db);
                    $("#field_oculto").attr('value', data['Connection'].id)

                    // Cargando el modal Edit Connection
                    $("#EditConexModal").modal('show');
                })
            })
        }

        // Delete Connection
        function deleteConnection(){
            var id = null;
            $('.btns_op_delete').on('click', function(){
                id = $(this).parent().parent().attr('id');
                (new PNotify({
                    title: 'Eliminar DataSource',
                    text: 'Está seguro de realizar esta acción ?',
                    icon: 'glyphicon glyphicon-question-sign',
                    hide: false,
                    confirm: {
                        confirm: true
                    },
                    buttons: {
                        closer: false,
                        sticker: false
                    },
                    history: {
                        history: false
                    }
                })).get().on('pnotify.confirm', function() {
                    $.getJSON('/delete_connection/'+id, function(data){
                        if (data.response) {
                            new PNotify({
                                title: 'Mensaje de Servidor',
                                text: 'Se ha eliminado satisfactoriamente.',
                                type: 'success'
                            })
                        }else{
                            new PNotify({
                                title: 'Mensaje de Servidor',
                                text: 'El DS no fue eliminado.',
                                type: 'error'
                            })
                        }
                        loadListConnections();
                    })
                }).on('pnotify.cancel', function() {
                    // Código en caso contrario
                });
            })
        }

        // Method Public init
        carnetizeConnection.init = function(){
            addConnection();
            loadListConnections();
            refreshListConnections();
            UpdateConnection();
        }

    }( window.carnetizeConnection = window.carnetizeConnection || {}, jQuery ));

    carnetizeConnection.init();
})
