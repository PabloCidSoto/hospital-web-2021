<h1><?php echo (isset($datos))? 'Actualizar' : 'Nuevo'; ?> Tipo de Producto</h1>
<form action="tipoProducto.php?action=<?php echo (isset($datos))? 'update' : 'save'; ?>" method="post">
    <div class="row pt-3">
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" name="producto[tipo_producto]" class="form-control" id="floatingInput" placeholder="Tipo Producto" value="<?php echo (isset($datos[0]['tipo_producto']))? $datos[0]['tipo_producto'] : ''; ?>">
                <label for="floatingInput">Tipo Producto</label>
            </div>
        </div>       
    <input type="hidden" name="producto[id_tipo_producto]=<?php echo (isset($datos[0]['id_tipo_producto']))? $datos[0]['id_tipo_producto'] : ''; ?>" value="<?php echo (isset($datos[0]['id_tipo_producto']))? $datos[0]['id_tipo_producto'] : ''; ?>">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary">
</form>