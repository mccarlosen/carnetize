var Carnetize = {
    stage: null,
    fieldslayer: null,
    loadLienzo: function(lienzo){
        //Creando el Contexto
        this.stage = new Kinetic.Stage({
            width: $("#"+lienzo).width(),
            height: $("#"+lienzo).height(),
            container: lienzo
        });
        this.fieldslayer = new Kinetic.Layer({
            name: "layer_fields"
        });
        this.stage.add(this.fieldslayer);

        var stageinter = this.stage;
        var ancho = $("#"+lienzo).width();
        var alto = $("#"+lienzo).height();

        // RESIZE STAGE
        $(window).resize(function(){
            if ($(window).height() - alto < 30)
            {
                $("#"+lienzo).css({
                    "width": ($(window).height() / 2.2) + "px",
                    "height": ($(window).height() - 195) + "px"
                })
            }else
            {
                $("#"+lienzo).css({
                    "width": ($(window).height() / 2.2) + "px",
                    "height": (($(window).height() + 195) - 390) + "px"
                })
            }

            var newAncho = $("#"+lienzo).width();
            var newAlto = $("#"+lienzo).height();

            stageinter.setAttr('scaleX', (newAncho / ancho) * 1);
            stageinter.setAttr('scaleY', (newAlto / alto) * 1);
            stageinter.setAttr('width', newAncho);
            stageinter.setAttr('height', newAlto);
            stageinter.draw();
        })
        // FIN RESIZE STAGE

    },
    loadEvents: function(idL){
        if (idL != "") {
            // Valores al inicio...del campo
            var fields = [];
            var exist = false;
            var id = null;
            var color = null;
            var font = null;
            var fontSize = null;
            var stage = Carnetize.stage;
            var fieldslayer = Carnetize.fieldslayer;

            $("#font-size-control_"+idL).css({
                "width": "56%"
            });
            $("#input-search_"+idL).css({
                "padding": "6px 12px",
                "margin-bottom": "6px",
                "font-size": "14px",
                "font-weight": "normal",
                "line-height": 1,
                "color": "#555",
                "text-align": "center",
                "background-color": "#eee",
                "border": "1px solid #ccc",
                "border-radius": "4px"
            });

            //Función que sirve para editar un campo en especifico.
            var editField = function(field){

                $('#editCampoModal_'+idL).modal('show');

                // Recuperando los valores del Campo
                var idField = field.attrs.id;
                var colorField = field.attrs.fill;
                var fontField = field.attrs.fontFamily;
                var fontSizeField = field.attrs.fontSize;

                $("#editCampoModal_"+idL+" #fieldId_"+idL).val(idField);
                $("#editCampoModal_"+idL+" #fieldId_"+idL).attr("disabled", true);
                $("#editCampoModal_"+idL+" .color-picker-edit").val(colorField);
                $("#MyColorPickerEdit_"+idL).colorpicker("val", colorField);

                $("#editCampoModal_"+idL+" #font-edit-size-control_"+idL).val(fontSizeField);
                $("#editCampoModal_"+idL+" #fonts-edit_"+idL+" > span").text(fontField);

            }

            //Evento añadir campo: Esta función añade un campo u etiqueta dentro del
            //Canvas, permitiendo referenciarlo con un dato del formulario...
            $('#btn-add-field_'+idL).on('click', function(){

                font = $("#addCampoModal_"+idL+" #fonts-add_"+idL+" > span").text();
                fontSize = $("#addCampoModal_"+idL+" #font-size-control_"+idL).val();
                color = $("#addCampoModal_"+idL+" .color-picker-add").val();
                id = $("#addCampoModal_"+idL+" #fieldId_"+idL).val();
                if (color == "") {
                    color = "000000";
                }
                if (id.match(/\s|[A-Z]/) || id == "") {
                    var idcampo = new PNotify({
                        title: "Notificación",
                        text: "Debes seleccionar un identificador para el campo",
                        type: 'error'
                    })
                    setTimeout(function(){
                        if(idcampo.remove()) idcampo.remove();
                    }, 3000);
                    return false;
                }
                // consiguiendo la capa para los campos
                var stageChildren = stage.getChildren();
                var layerChilds = stageChildren.getChildren();
                $.each(layerChilds, function(key, value){
                    fields = value.children;
                });
                if (fields.length > 0) {
                    $.each(fields, function(key, value){
                        console.log(value);
                        if (value.attrs.id == id) {
                            exist = false;
                            var idCampoExist = new PNotify({
                                title: "Notificación",
                                text: "Ya existe un campo con el identificador seleccionado dentro del escenario",
                                type: 'error'
                            })
                            setTimeout(function(){
                                if(idCampoExist.remove()) idCampoExist.remove();
                            }, 3000);
                        }else{
                            exist = true;
                        }
                    });
                    if (exist) {
                        var field = new Kinetic.Text({
                            id: id,
                            text : id,
                            fill: color,
                            align: 'center',
                            fontFamily: font,
                            fontSize: fontSize,
                            draggable: true
                        });

                        //Añadiendo el Campo a la Capa
                        fieldslayer.add(field);
                        fieldslayer.draw();
                    }
                }else{
                    if (id) {
                        var field = new Kinetic.Text({
                            id: id,
                            text : id,
                            fill: color,
                            align: 'center',
                            fontFamily: font,
                            fontSize: fontSize,
                            draggable: true
                        });

                        //Añadiendo el Campo a la Capa
                        fieldslayer.add(field);
                        fieldslayer.draw();
                    }
                }

                //Aqui se añade el evento click a cada campo para la llamada edit
                $.each(fields, function(i, obj){
                    if (!obj.eventListeners.click) {
                        obj.addEventListener('dblclick', function(){
                            editField(this);
                        })
                    }
                })
            });


            //Guardar los cambios
            $('#btn-edit-field_'+idL).on('click', function(){
                // Validando los campos
                color = $("#editCampoModal_"+idL+" .color-picker-edit").val();
                id = $("#editCampoModal_"+idL+" #fieldId_"+idL).val();
                font = $("#editCampoModal_"+idL+" #fonts-edit_"+idL+" > span").text();
                fontSize = $("#editCampoModal_"+idL+" #font-edit-size-control_"+idL).val();
                // console.log(font);
                if (color == "") {
                    color = "000000";
                }
                if (id.match(/\s|[A-Z]/) || id == "") {
                    var idcampo = new PNotify({
                        title: "Notificación",
                        text: "Debes seleccionar un identificador para el campo",
                        type: 'error'
                    })
                    setTimeout(function(){
                        if(idcampo.remove()) idcampo.remove();
                    }, 3000);
                    return false;
                }
                var field = fieldslayer.get('#'+id);

                // Comprobando que hayan cambios
                if (id != field.id && color != field.fill) {
                    field.fill(color);
                    field.fontFamily(font);
                    field.fontSize(fontSize);
                    fieldslayer.draw();
                }
            });
            // Eliminar el campo
            $("#btn-delete-field_"+idL).on('click', function(){
                id = $("#editCampoModal_"+idL+" #fieldId_"+idL).val();
                var field = fieldslayer.get('#'+id);
                field.remove();
                fieldslayer.draw();
            });
        }
    }
};
function loadDataSource(){
    $("#loaddatasource").load("/load_data #loadcontentdata", function(){
        var sizeTabsList = function(){
            // Agregando class active a el boton del tab_data
            var links_data = $(".tab_menu_data"), tab_data = [];
            $.each(links_data, function(key, element){
                tab_data.push($(element).attr("href"));
            });
            $(tab_data[0]).addClass('active');

            var btn_menu_tabs = $(".btn-menu-tabs li");
            $.each(btn_menu_tabs, function(key, element){
                // console.log(element);
                $(element).on("click", function(){
                    $.each(tab_data, function(key2, element2){
                        $(element2).addClass("fade");
                    })
                })
            })

            $(".lienzo").each(function(key, lienzo){
                var idcontenedor = $(lienzo).attr("id");
                clave = key+1;

                $("#font-edit-size-control_"+clave).css({
                    "width":"56%"
                });
                $("#container-stage"+clave).css({
                    "width": ($(window).height() / 2.2) + "px",
                    "height": ($(window).height() - 195) + "px"
                })

                Carnetize.loadLienzo(idcontenedor);
                Carnetize.loadEvents(clave);
                // Cargando el color Piker
                $("#MyColorPickerAdd_"+clave).colorpicker({
                    color: "#000000",
                    showOn: "button",
                    history: false
                });
                $("#MyColorPickerEdit_"+clave).colorpicker({
                    showOn: "button",
                    history: false
                });
                //Cargando Font-Family Añadir Campo
                $("#addCampoModal_"+clave+" #fonts-add_"+clave).fontSelector({
                    'hide_fallbacks' : true,
                    'initial' : 'Ubuntu,Helvetica,sans-serif',
                    'fonts' : [
                        'Ubuntu,Helvetica,sans-serif',
                        'Courier New,Courier New,Courier,monospace',
                        'FreeSans Bold,Helvetica,sans-serif',
                        'Nanum Gothic,Helvetica,serif',
                        'Tahoma,Geneva,sans-serif',
                        'Agency FB,Helvetica,sans-serif',
                        'Verdana,Geneva,Helvetica,sans-serif',
                        'Verdana Bold,Helvetica,sans-serif'
                        ]
                });
                //Cargando Font-Family Editar Campo
                $("#editCampoModal_"+clave+" #fonts-edit_"+clave).fontSelector({
                    'hide_fallbacks' : true,
                    'initial' : 'Ubuntu,Helvetica,sans-serif',
                    'fonts' : [
                        'Ubuntu,Helvetica,sans-serif',
                        'Courier New,Courier New,Courier,monospace',
                        'FreeSans Bold,Helvetica,sans-serif',
                        'Nanum Gothic,Helvetica,serif',
                        'Tahoma,Geneva,Helvetica,sans-serif',
                        'Agency FB,Helvetica,sans-serif',
                        'Verdana,Geneva,Helvetica,sans-serif',
                        'Verdana Bold,Helvetica,sans-serif'
                        ]
                });

                $("#dt_basic_"+clave).dataTable({
                    "sPaginationType" : "bootstrap_full"
                })

                // CustomScrollbar
                var contentHeight = $(window).height() - 142;
                $("#contenido").css({
                    "height": contentHeight+"px",
                    "padding-top":"12px",
                    "overflow": "hidden"
                })
                $(".tabs-menus-inter").css({
                    "height": ($(window).height() - 161) + "px"
                })
                $(window).resize(function(){
                    $("#contenido").css({
                        "height": ($(window).height() - 142)+"px"
                    })
                    $(".tabs-menus-inter").css({
                        "height": ($(window).height() - 161) + "px"
                    })
                })
                $("#contenido").mCustomScrollbar({
                    axis:"y",
                    theme: "dark",
                    scrollInertia:550
                    // scrollbarPosition:"outside"
                })
            });
        };
        var link_add_data = function(){
            $('.link_menu_data').css({'cursor':'pointer'});
            $('.link_menu_data').on('click', function(){
                $('#lnk_add_ds').click();
            })
        }
        link_add_data();
        sizeTabsList();
    });
};

$(document).ready(function(){
    loadDataSource();
})
