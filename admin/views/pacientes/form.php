<h1><?php echo (isset($datos))? 'Actualizar' : 'Nuevo'; ?> Paciente</h1>
<?php if(isset($datos[0]['fotografia'])): ?>
<img class="rounded-circle" src="archivos/<?php echo $datos[0]['fotografia']; ?>" alt="img paciente" srcset="" width="200px" >
<?php endif; ?>
<form action="pacientes.php?action=<?php echo (isset($datos))? 'update' : 'save'; ?>" method="post" enctype="multipart/form-data" >
    <div class="row pt-3">
        <div class="col-6">
            <div class="form-floating mb-3">
                <input type="text" name="paciente[nombre]" class="form-control" id="floatingInput" placeholder="Nombre Nombre" value="<?php echo (isset($datos[0]['nombre']))? $datos[0]['nombre'] : ''; ?>">
                <label for="floatingInput">Nombre(s)</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3">
                <input type="text" name="paciente[apaterno]" class="form-control" id="floatingInput" placeholder="Apellido Paterno" value="<?php echo (isset($datos[0]['apaterno']))? $datos[0]['apaterno'] : ''; ?>">
                <label for="floatingInput">Apellido Paterno</label>
            </div>
        </div>
        <div class="col-3">
            <div class="form-floating mb-3">
                <input type="text" name="paciente[amaterno]" class="form-control" id="floatingInput" placeholder="Apellido Materno" value="<?php echo (isset($datos[0]['amaterno']))? $datos[0]['amaterno'] : ''; ?>">
                <label for="floatingInput">Apellido Materno</label>
            </div>
        </div>
    </div>
    <div class="form-floating mb-3">
        <input type="date" name="paciente[nacimiento]" class="form-control" id="floatingInput" placeholder="Domicilio" value="<?php echo (isset($datos[0]['nacimiento']))? $datos[0]['nacimiento'] : ''; ?>">
        <label for="floatingInput">Fecha nacimiento</label>
    </div>    
    <div class="mb-3">
        <label for="domicilio" class="form-label">Domicilio</label>
        <textarea class="form-control" name="paciente[domicilio]" id="domicilio" rows="3" value=""><?php echo (isset($datos[0]['domicilio']))? $datos[0]['domicilio'] : ''; ?></textarea>
    </div>
    <div class="mb-3">
        <label for="fotografia" class="form-label">Fotografia</label>
        <input type="file" class="form-control" name="fotografia" id="fotografia">
    </div>
    <input type="hidden" name="paciente[id_paciente]=<?php echo (isset($datos[0]['id_paciente']))? $datos[0]['id_paciente'] : ''; ?>" value="<?php echo (isset($datos[0]['id_paciente']))? $datos[0]['id_paciente'] : ''; ?>">
    <input type="submit" name="enviar" value="Guardar" class="btn btn-primary">
</form>