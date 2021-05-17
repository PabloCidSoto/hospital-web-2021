<h1><?php echo (isset($datos))? 'Actualizar' : 'Nuevo'; ?> Producto</h1>
<form action="producto.php?action=<?php echo (isset($datos))? 'update' : 'save'; ?>" method="post" enctype="multipart/form-data" >
    <div class="row pt-3">
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" name="producto[producto]" class="form-control" id="floatingInput" placeholder="Producto Producto" value="<?php echo (isset($datos[0]['producto']))? $datos[0]['producto'] : ''; ?>">
                <label for="floatingInput">Producto</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3">
                <input type="text" name="producto[precio]" class="form-control" id="floatingInput" placeholder="Precio Precio" value="<?php echo (isset($datos[0]['precio']))? $datos[0]['precio'] : ''; ?>">
                <label for="floatingInput">Precio</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3">
                <input type="text" name="producto[id_tipo_producto]" class="form-control" id="floatingInput" placeholder="id_tipo_producto" value="<?php echo (isset($datos[0]['id_tipo_producto']))? $datos[0]['id_tipo_producto'] : ''; ?>">
                <label for="floatingInput">id Tipo Producto</label>
            </div>
        </div>
    </div>    
    <input type="hidden" name="producto[id_producto]=<?php echo (isset($datos[0]['id_producto']))? $datos[0]['id_producto'] : ''; ?>" value="<?php echo (isset($datos[0]['id_producto']))? $datos[0]['id_producto'] : ''; ?>">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary">
</form>