<h1><?php echo (isset($datos))? 'Actualizar' : 'Nuevo'; ?>Rol</h1>
<form action="rol.php?action=<?php echo (isset($datos))? 'update' : 'save'; ?>" method="post">
    <div class="row pt-3">
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" name="rol[rol]" class="form-control" id="floatingInput" placeholder="rol" value="<?php echo (isset($datos[0]['rol']))? $datos[0]['rol'] : ''; ?>">
                <label for="floatingInput">rol</label>
            </div>
        </div>       
    <input type="hidden" name="rol[id_rol]=<?php echo (isset($datos[0]['id_rol']))? $datos[0]['id_rol'] : ''; ?>" value="<?php echo (isset($datos[0]['id_rol']))? $datos[0]['id_rol'] : ''; ?>">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary">
</form>