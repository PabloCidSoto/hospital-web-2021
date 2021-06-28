<div class="d-flex flex-column justify-content-center align-items-center pt-3">
    <img class="rounded-circle" src="archivos/<?php echo (isset($datos[0]['fotografia']))? $datos[0]['fotografia']: '/default.png'; ?>" alt="img paciente" srcset="" width="250px" >
    <h3>Nombre: <?php echo $datos[0]['nombre']; ?></h3>
    <h3>Apellido Paterno: <?php echo $datos[0]['apaterno']; ?></h3>
    <h3>Apellido Materno: <?php echo $datos[0]['amaterno']; ?></h3>
    <h3>Edad: <?php echo $datos[0]['edad']; ?></h3>
    <a class="btn btn-primary" href="pacientes.api.php?action=export&id_paciente=<?= $datos[0]['id_paciente'] ?>">Exportar</a>
</div>
<h2>Nueva consulta</h2>
<form action="pacientes.php?action=consulta_nueva" method="post">
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Padecimiento</label>
  <textarea class="form-control" name="consulta[padecimiento]" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
<div class="mb-3">
  <label for="exampleFormControlTextarea1" class="form-label">Tratamiento</label>
  <textarea class="form-control" name="consulta[tratamiento]" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>
<input type="hidden" name="consulta[id_paciente]=<?php echo (isset($datos[0]['id_paciente']))? $datos[0]['id_paciente'] : ''; ?>" value="<?php echo (isset($datos[0]['id_paciente']))? $datos[0]['id_paciente'] : ''; ?>">
<input type="submit" name="enviar" value="Guardar Consulta" class="btn btn-primary">

</form>

<div class="table-responsive pt-2">
        <table class="table table-dark table-striped align-middle">
            <tr>
                <th>ID Consulta</th>
                <th>Fecha</th>
                <th>Padecimiento</th>
                <th>Doctor</th>                
                <th>botones</th>
            </tr>
            <?php foreach ($consultas as $key => $consulta) : ?>
                <tr>
                    <td><?= $consulta['id_consulta'] ?></td>
                    <td><?= $consulta['fecha'] ?></td>
                    <td><?= $consulta['padecimiento'] ?></td>
                    <td><?= $consulta['doctor'] ?></td>                    
                    <td>
                        <div class="d-flex justify-content-between">                            
                            <a href="consulta.report.php?action=receta&id_consulta=<?= $consulta['id_consulta'] ?>&id_paciente=<?= $datos[0]['id_paciente'] ?>" class="btn btn-outline-success">
                                Imprimir Receta 
                                <!-- imprimir nombre nombre doctor fecha y tratamiento -->
                            </a>                            
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

