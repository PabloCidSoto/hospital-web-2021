<h1><?php echo (isset($datos))? 'Actualizar' : 'Nuevo'; ?> Usuario</h1>
<form action="usuario.php?action=<?php echo (isset($datos))? 'update' : 'save'; ?>" method="post">
    <div class="row pt-3">
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="email" name="usuario[correo]" class="form-control" id="floatingInput" placeholder="Correo" value="<?php echo (isset($datos[0]['correo']))? $datos[0]['correo'] : ''; ?>">
                <label for="floatingInput">Correo</label>
            </div>
        </div>
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" name="usuario[contrasena]" class="form-control" id="floatingInput" placeholder="Correo" value="<?php echo (isset($datos[0]['contrasena']))? $datos[0]['contrasena'] : ''; ?>">
                <label for="floatingInput">Contraseña</label>
            </div>
        </div>       
    <input type="hidden" name="usuario[id_usuario]=<?php echo (isset($datos[0]['id_usuario']))? $datos[0]['id_usuario'] : ''; ?>" value="<?php echo (isset($datos[0]['id_usuario']))? $datos[0]['id_usuario'] : ''; ?>">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary">
</form>