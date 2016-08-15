<?php
// Esta página hay que mejorarla
$index1 = 1;
?>
<div id="loadcontentdata">
    <div class="tabs-left">
        <ul class="nav nav-tabs btn-menu-tabs">
            <li class="links_data active"><a href="#home" data-toggle="tab" class="tab_menu_data"><i class="glyphicon glyphicon-home"></i></a></li>
            <!-- List Tabs Connections -->
            <?php if(isset($connections)){ ?>
            <?php foreach ($connections as $campo => $connection) : ?>
                <li class="links_data"><a href="#tab<?php echo $index1; ?>" data-toggle="tab" class="tab_menu_data"><i class="glyphicon glyphicon-hdd"></i>&nbsp;&nbsp;<?php echo $connection['Connection']['name_connection']; ?></a></li>
            <?php $index1++; endforeach; }else {
                // Este enlace es solo para administradores
                if($current_user['role'] == 'admin') {
            ?>
                <a class="link_menu_data"><i class="glyphicon glyphicon-hdd"></i>&nbsp;&nbsp;<?php echo "Activa o Añade un DS"; ?></a>
            <?php
                }else{ ?>
                <a href="mailto:osen.10112@gmail.com" class="link_menu_data"><i class="glyphicon glyphicon-hdd"></i>&nbsp;&nbsp;"No hay un DS activo. Consulte al administrador del sistema."</a>
            <?php
                }}
            ?>
        </ul>
    </div>
    <div class="col-xs-12  tab-content-wrap" id="contenido">
        <div class="tab-content">
            <div class="tab-pane active" id="home">
                <h1 class="title_data">Data Source</h1>
            </div>
        <?php
        if (isset($connections)) :
        $index2 = 1;
            foreach ($connections as $campo => $field_connection) {
            @$mysqli = new mysqli($field_connection['Connection']['host_db'],$field_connection['Connection']['user_db'],$field_connection['Connection']['pwd_db'],$field_connection['Connection']['name_db']);
            if ($mysqli->error) {
        ?>
            <div class="tab-content">
                <div class="tab-pane active" id="home">
                    <h1 class="text-center text-danger">No se pudo establecer conexión. (<?php echo $mysqli->error; ?>).</h1>
                </div>
            </div>
        <?php
            }
            if(!$mysqli->connect_error){
                $name_table = $field_connection['Connection']['name_table_db'];
                $consult = "SELECT * FROM $name_table";
                $datasource = $mysqli->query($consult);
                $fields = $datasource->fetch_fields();
        ?>
            <div class="tab-pane fade" id="tab<?php echo $index2; ?>">
                <div class="col-xs-1 tabs-menus-inter"> <!-- required for floating -->
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-left sideways">
                      <li class="active"><a href="#data_<?php echo $index2; ?>" data-toggle="tab">DataSource</a></li>
                      <li><a href="#photo_<?php echo $index2; ?>" data-toggle="tab">CamCarnetize</a></li>
                    </ul>
                </div>
                <div class="tab-content tabs-inter">
                    <div class="col-xs-6 tab-pane active" id="data_<?php echo $index2; ?>">
                        <div class="table-datasource" id="table-datasource_<?php echo $index2; ?>">
                            <table id="dt_basic_<?php echo $index2; ?>" class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <?php foreach ($fields as $key => $field): ?>
                                            <th>
                                                <?php echo $field->name; ?>
                                            </th>
                                        <?php endforeach ?>
                                    </tr>
                                </thead>
                                <tbody>
                        <?php while ($result = $datasource->fetch_row()) { ?>
                                    <tr>
                                        <?php for ($i=0; $i < count($fields); $i++) { ?>
                                        <td id="<?php echo $fields[$i]->name; ?>">
                                            <?php echo $result[$i]; ?>
                                        </td>
                                        <?php } ?>
                                    </tr>
                        <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-xs-6 col-webcam tab-pane" id="photo_<?php echo $index2; ?>">
                        Cámara de Fotos
                    </div>
                </div>
                <div class="col-xs-4 col-lienzo">
                    <div class="row controles">
                        <div class="btn-group">
                            <button id="btn-add-modal_<?php echo $index2; ?>" class="btn btn-primary" name="nuevo_campo" data-toggle="modal" data-target="#addCampoModal_<?php echo $index2; ?>">
                                    <i class="ghyphicon glyphicon-plus"></i>
                            </button>
                            <button class="btn btn-primary" data-toggle="modal" data-target="#addDesignModal_<?php echo $index2; ?>">
                                Cargar diseño
                            </button>
                            <button class="btn btn-primary" data-toggle="modal" data-target="">
                                Guardar
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div id="container-stage<?php echo $index2; ?>" class="lienzo"></div>
                    </div>
                </div>
            </div>


            <!-- creando los modal para cada datasource -->

            <!-- Modal Insertar Campo -->
            <div class="modal fade modallienzo" id="addCampoModal_<?php echo $index2; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Agregar Campo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Identificador</label>
                                    <select id="fieldId_<?php echo $index2; ?>" class="form-control">
                                        <option>seleccione un identificador</option>
                                        <?php foreach ($fields as $key => $field): ?>
                                        <option><?php echo $field->name; ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <br>
                                    <label>Tipo Fuente</label>
                                    <div id="fonts-add_<?php echo $index2; ?>" class="fontSelect form-control">
                                        <div class="arrow-down"></div>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <label>Color de Fuente</label>
                                    <input type="text" name="font-color" class="color-picker-add form-control" id="MyColorPickerAdd_<?php echo $index2; ?>">
                                    <br><br>
                                    <label>Tamaño de Fuente</label>
                                    <input type="number" min="12" max="28" value="12" class="form-control" id="font-size-control_<?php echo $index2; ?>" placeholder="Tamaño">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn-add-field_<?php echo $index2; ?>" type="button" class="btn btn-default" data-dismiss="modal">Agregar Campo</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Editar Campo -->
            <div class="modal fade modallienzo" id="editCampoModal_<?php echo $index2; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar Campo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Identificador</label>
                                    <input class="form-control" id="fieldId_<?php echo $index2; ?>" type="text" name="identificador" placeholder="Ingrese un identificador para el campo">
                                    <br>
                                    <label>Tipo Fuente</label>
                                    <div id="fonts-edit_<?php echo $index2; ?>" class="fontSelect form-control">
                                        <div class="arrow-down"></div>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <label>Color de Fuente</label>
                                    <input type="text" name="font-color" class="color-picker-edit form-control" id="MyColorPickerEdit_<?php echo $index2; ?>">
                                    <br><br>
                                    <label>Tamaño de Fuente</label>
                                    <input type="number" min="12" max="28" value="12" class="form-control" id="font-edit-size-control_<?php echo $index2; ?>" placeholder="Tamaño">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn-delete-field_<?php echo $index2; ?>" type="button" class="btn btn-default" data-dismiss="modal">Eliminar Campo</button>
                            <button id="btn-edit-field_<?php echo $index2; ?>" type="button" class="btn btn-default" data-dismiss="modal">Editar Campo</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add Design -->
            <div class="modal fade modallienzo" id="addDesignModal_<?php echo $index2; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Editar Campo</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label>Identificador</label>
                                    <input class="form-control" id="fieldId_<?php echo $index2; ?>" type="text" name="identificador" placeholder="Ingrese un identificador para el campo">
                                    <br>
                                    <label>Tipo Fuente</label>
                                    <div id="fonts-edit_<?php echo $index2; ?>" class="fontSelect form-control">
                                        <div class="arrow-down"></div>
                                    </div>
                                </div>

                                <div class="col-xs-6">
                                    <label>Color de Fuente</label>
                                    <input type="text" name="font-color" class="color-picker-edit form-control" id="MyColorPickerEdit_<?php echo $index2; ?>">
                                    <br><br>
                                    <label>Tamaño de Fuente</label>
                                    <input type="number" min="12" max="28" value="12" class="form-control" id="font-size-control_<?php echo $index2; ?>" placeholder="Tamaño">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn-delete-field_<?php echo $index2; ?>" type="button" class="btn btn-default" data-dismiss="modal">Eliminar Campo</button>
                            <button id="btn-edit-field_<?php echo $index2; ?>" type="button" class="btn btn-default" data-dismiss="modal">Editar Campo</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

    <?php $index2++; $mysqli->close(); }} endif;?>
        </div>
    </div>
</div>
