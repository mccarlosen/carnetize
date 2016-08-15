<script charset="utf-8">
<?php $this->Js->writeBuffer(); ?>
<?php $this->Js->get('#flashMessage'); ?>
<?php echo $this->Js->effect('fadeIn', array('speed' => 'slow')); ?>
setTimeout(function(){
    <?php echo $this->Js->effect('fadeOut'); ?>
}, 2000)
</script>

<h1 id="title_app">Carnetize</h1>

<div class="users-form">
    <h2><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Inicio de Sesión</h2>
    <form action="/login" method="post" id="UserLoginForm" class="form-horizontal" role="form">
        <div style="display:none;"><input type="hidden" name="_method" value="POST"></div>
        <div class="form-group">
            <div class="col-sm-10">
                <label for="inputUsername" class="col-sm-8 control-label">Nombre de usuario</label>
                <input type="text" name="data[User][username]" class="form-control" id="username" placeholder="Usuario" required>
                <label for="inputPassword" class="col-sm-8 control-label">Contraseña</label>
                <input type="password" name="data[User][password]" class="form-control" id="password" placeholder="Contraseña" required>
            </div>
            <div class="form-group">
                <div id="btn-login" class="text-right col-sm-10">
                <button type="submit" class="btn btn-default">Sign in</button>
                </div>
            </div>
        </div>
    </form>
</div>
