<h1><?php echo (isset($datos))? 'Actualizar' : 'Nuevo'; ?>Permiso</h1>
<form action="permiso.php?action=<?php echo (isset($datos))? 'update' : 'save'; ?>" method="post">
    <div class="row pt-3">
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" name="permiso[permiso]" class="form-control" id="floatingInput" placeholder="Permiso" value="<?php echo (isset($datos[0]['permiso']))? $datos[0]['permiso'] : ''; ?>">
                <label for="floatingInput">Permiso</label>
            </div>
        </div>       
    <input type="hidden" name="permiso[id_permiso]=<?php echo (isset($datos[0]['id_permiso']))? $datos[0]['id_permiso'] : ''; ?>" value="<?php echo (isset($datos[0]['id_permiso']))? $datos[0]['id_permiso'] : ''; ?>">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary">
</form>