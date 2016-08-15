<!--nocache-->
<!--=== PAGE PRELOADER ===-->
<div id="page-loader"><span class="page-loader-gif"></span></div>

<!--Barra de navegación de Sistema-->
<nav class="navbar navbar-default navbar-fixed-top navbar-carnetize" role="navigation">
<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">Carnetize</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
    </ul>

    <ul class="nav nav-tabs navbar-right menu-start" role="tablist">
        <li><a href="#tab_menu1" data-toggle="tab" class="tab_menu"><i class="glyphicon glyphicon-th"></i></a></li>
        <li><a href="#tab_menu2" data-toggle="tab" class="tab_menu"><i class="glyphicon glyphicon-book"></i>&nbsp;&nbsp;Manual</a></li>
        <?php if($current_user['role'] == 'admin') : ?>
        <li><a href="#tab_menu3" data-toggle="tab" id="lnk_add_ds" class="tab_menu"><i class="glyphicon glyphicon-cog"></i></a></li>
        <?php endif; ?>
    </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>

<!-- Modal msg response -->
<div class="modal fade" id="msg_response" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="msg_title"></h4>
            </div>
            <div class="modal-body">
                <h4 id="msg"></h4>
                <div class="spin" data-spin></div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<!-- Modal Crear Nueva Conexión -->
<div class="modal fade" id="createNewConexModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Crear Nueva Conexión</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="formAddConnection" class="form" method="post">
                        <div class="col-xs-6">
                            <label for="conex">Nombre de la Conexión</label>
                            <input type="text" id="conex" name="name_connection" class="form-control" placeholder="Ingrese un nombre para la Conexión">
                            <br>
                            <label for="host">Host de la Base de Datos</label>
                            <input type="text" id="host" name="host_db" class="form-control" placeholder="Indique el host de la BD">
                            <br>
                            <label for="db">Nombre de la Base de Datos</label>
                            <input type="text" id="db" name="name_db" class="form-control" placeholder="Indique el nombre de la BD">
                        </div>
                        <div class="col-xs-6">
                            <label for="user">Nombre de Usuario</label>
                            <input type="text" id="user" name="user_db" class="form-control" placeholder="Usuario de la BD">
                            <br>
                            <label for="passwd">Contraseña de la BD</label>
                            <input type="password" id="passwd" name="pwd_db" class="form-control" placeholder="Contraseña de la BD">
                            <br>
                            <label for="table">Nombre de la Tabla</label>
                            <input type="text" id="table" name="name_table_db" class="form-control" placeholder="Indique el nombre de la tabla">
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn-create-conex" type="submit" class="btn btn-default">Crear Conexión</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
            </div><!-- fin body modal -->
        </div>
    </div>
</div>

<!-- Modal Editar Conexión -->
<div class="modal fade" id="EditConexModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Conexión</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form id="formEditConnection" class="form" method="post">
                        <div class="col-xs-6">
                            <label for="conex">Nombre de la Conexión</label>
                            <input type="text" id="conex_edit" name="name_connection" class="form-control" placeholder="Ingrese un nombre para la Conexión">
                            <br>
                            <label for="host">Host de la Base de Datos</label>
                            <input type="text" id="host_edit" name="host_db" class="form-control" placeholder="Indique el host de la BD">
                            <br>
                            <label for="db">Nombre de la Base de Datos</label>
                            <input type="text" id="db_edit" name="name_db" class="form-control" placeholder="Indique el nombre de la BD">
                        </div>
                        <div class="col-xs-6">
                            <label for="user">Nombre de Usuario</label>
                            <input type="text" id="user_edit" name="user_db" class="form-control" placeholder="Usuario de la BD">
                            <br>
                            <label for="passwd">Contraseña de la BD</label>
                            <input type="password" id="passwd_edit" name="pwd_db" class="form-control" placeholder="Contraseña de la BD">
                            <br>
                            <label for="table">Nombre de la Tabla</label>
                            <input type="text" id="table_edit" name="name_table_db" class="form-control" placeholder="Indique el nombre de la tabla">
                            <input id="field_oculto" type="hidden" name="id" value="">
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button id="btn-edit-conex" type="submit" class="btn btn-default">Editar Conexión</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
            </div><!-- fin body modal -->
        </div>
    </div>
</div>


<!-- Conenedor principal -->
<div class="container-fluid content-wrap-big tab-content tab-content-wrap-big">
    <div id='mypopover' class='mypopover' role='tooltip'>
        <div class='arrow'></div>
    <?php if($logged_in) : ?>
        <h3 class='popover-title'>
            <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<strong>Bienvenido, </strong><?php echo $current_user['username']; ?>. <a href="/users/logout" class="btn btn-default">Logout</a>
        </h3>
    <?php endif; ?>
    </div>

    <div class="row-fluid tab-pane" id="tab_menu1">
        <div class="col-xs-12 content-wrap">
            <div id="loaddatasource" class="row">

            </div>
        </div>
    </div>

    <!-- Contenedor de configuración -->

    <div class="row-fluid tab-pane fade" id="tab_menu2">
        <div class="col-xs-12 content-wrap">
            <div class="row-fluid">
                Hola Mundo
            </div>
        </div>
    </div>

    <!-- Contenedor de configuración -->

    <div class="row-fluid tab-pane fade" id="tab_menu3">
        <div class="col-xs-12 content-wrap-config ">
            <div class="row-fluid">
                <div class="col-xs-8 col-config">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-tabs btn-menu-tabs-config" role="tablist">
                        <li class="active"><a href="#list_connections" data-toggle="tab" class="tab_menu"><i class="glyphicon glyphicon-th-list"></i>&nbsp;&nbsp;Lista de DataSources</a></li>
                        <li><a href="#list_users" data-toggle="tab" class="tab_menu"><i class="glyphicon glyphicon-th-list"></i>&nbsp;&nbsp;Lista de Usuarios</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content content-tab-config">
                        <div role="tabpanel fade" class="tab-pane active" id="list_connections">
                            <h4>Lista de Conexiones DataSource</h4>
                            <button class="btn btn-default" id="add_db" data-toggle="modal" data-target="#createNewConexModal">
                                Crear Nueva Conexión
                            </button>
                            <button id="refresh_list" class="btn btn-default">
                                <i class="glyphicon glyphicon-refresh"></i>&nbsp;&nbsp;Refrescar
                            </button>
                            <div id="box-list-connection">
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="list_users">
                            <h4>Lista de Usuarios del Sistema</h4>
                            <button class="btn btn-default" id="add_user" data-toggle="modal" data-target="#addUserModal">
                                Registrar Usuario
                            </button>
                            <button id="refresh_list_users" class="btn btn-default">
                                <i class="glyphicon glyphicon-refresh"></i>&nbsp;&nbsp;Refrescar
                            </button>
                            <div id="box-list-users">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4">
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
</div>
<!--/nocache-->
