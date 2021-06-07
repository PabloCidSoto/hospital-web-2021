<h1>Agregar Rol</h1>
<form action="usuarioRol.php?action=save" method="post" enctype="multipart/form-data" >
    <div class="row pt-3">
        <div class="col-md-6">
            <h3><?php echo (isset($datos[0]['correo']))? $datos[0]['correo'] : ''; ?></h3>            
        </div>        
        <div class="col-md-3">
            <div class="form-floating mb-3">
                <select name="usuario[id_rol]" class="form-control">
                <?php
                foreach ($roles as $key => $rol){                                                                                 
                    if(!in_array($rol['rol'], $rolesDeUsuario)){
                        echo '<option value="'.$rol['id_rol'].'">'.$rol['rol'].'</option>';
                    }
                }                                        
                ?>               
                </select>                
                <label for="floatingInput">Roles</label>
            </div>
        </div>
    </div>    
    <input type="hidden" name="usuario[id_usuario]=<?php echo (isset($datos[0]['id_usuario']))? $datos[0]['id_usuario'] : ''; ?>" value="<?php echo (isset($datos[0]['id_usuario']))? $datos[0]['id_usuario'] : ''; ?>">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary">
</form>
