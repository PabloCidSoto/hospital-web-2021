<h1><?php echo (isset($datos))? 'Actualizar' : 'Nuevo'; ?> Doctor</h1>
<?php if(isset($datos[0]['fotografia'])): ?>
<img class="rounded-circle" src="archivos/<?php echo $datos[0]['fotografia']; ?>" alt="img paciente" srcset="" width="200px" >
<?php endif; ?>
<form action="doctor.php?action=<?php echo (isset($datos))? 'update' : 'save'; ?>" method="post" enctype="multipart/form-data" >
    <div class="row pt-3">
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" name="doctor[nombre]" class="form-control" id="floatingInput" placeholder="Nombre Nombre" value="<?php echo (isset($datos[0]['nombre']))? $datos[0]['nombre'] : ''; ?>">
                <label for="floatingInput">Nombre(s)</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3">
                <input type="text" name="doctor[apaterno]" class="form-control" id="floatingInput" placeholder="Apellido Paterno" value="<?php echo (isset($datos[0]['apaterno']))? $datos[0]['apaterno'] : ''; ?>">
                <label for="floatingInput">Apellido Paterno</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3">
                <input type="text" name="doctor[amaterno]" class="form-control" id="floatingInput" placeholder="Apellido Materno" value="<?php echo (isset($datos[0]['amaterno']))? $datos[0]['amaterno'] : ''; ?>">
                <label for="floatingInput">Apellido Materno</label>
            </div>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="text" name="doctor[especialidad]" class="form-control" id="floatingInput" placeholder="Especialidad" value="<?php echo (isset($datos[0]['especialidad']))? $datos[0]['especialidad'] : ''; ?>">
        <label for="floatingInput">Especialidad</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" name="doctor[id_usuario]" class="form-control" id="floatingInput" placeholder="id_usuario" value="<?php echo (isset($datos[0]['id_usuario']))? $datos[0]['id_usuario'] : ''; ?>">
        <label for="floatingInput">id_usuario</label>
    </div>      
    <input type="hidden" name="doctor[id_doctor]=<?php echo (isset($datos[0]['id_doctor']))? $datos[0]['id_doctor'] : ''; ?>" value="<?php echo (isset($datos[0]['id_doctor']))? $datos[0]['id_doctor'] : ''; ?>">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary">
</form>