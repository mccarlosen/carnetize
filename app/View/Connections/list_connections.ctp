<div id="div-list-connections">
    <?php if (isset($list_connections)) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>
                    Nombre de Conexión
                </th>
                <th>
                    Host de Conexión
                </th>
                <th>
                    Nombre del DataSourse
                </th>
                <th>
                    Estado
                </th>
                <th>
                    Operaciones
                </th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list_connections as $connection): ?>
            <tr class="row_ds" id="<?php echo $connection['Connection']['id'] ?>">
                <td>
                    <?php echo $connection['Connection']['name_connection'] ?>
                </td>
                <td>
                    <?php echo $connection['Connection']['host_db'] ?>
                </td>
                <td>
                    <?php echo $connection['Connection']['name_table_db'] ?>
                </td>
                <td>
                    <?php echo $estado = ($connection['Connection']['status']) ? "Activa" : "Inactiva"; ?>
                </td>
                <td>
                    <button class="btn btn-default op_tooltip btns_op_on_off" data-toggle="tooltip" data-placement="top" title="On/Off Conexión"><i class="glyphicon glyphicon-off"></i></button>
                    <button class="btn btn-default op_tooltip btns_op_edit" data-toggle="tooltip" data-placement="top" title="Editar Conexión"><i class="glyphicon glyphicon-edit"></i></button>
                    <button class="btn btn-default op_tooltip btns_op_delete" data-toggle="tooltip" data-placement="top" title="Eliminar Conexión"><i class="glyphicon glyphicon-remove"></i></button>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
<?php } ?>

<script charset="utf-8">
    $(document).ready(function(){
        $(".op_tooltip").tooltip();
    })
</script>
