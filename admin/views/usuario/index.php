<h1>Lista de Usuarios</h1>
    <?php if(isset($resultado)): ?>
    <div class="alert alert-dark" role="alert">
        <?= $resultado?>
    </div>
    <?php endif; ?>
    <a href="usuario.php?action=create" class="btn btn-success">Nuevo Usuario</a>
    <div class="table-responsive pt-2">
        <table class="table table-dark table-striped align-middle">
            <tr>
                <th>ID Usuario</th>
                <th>Correo</th>
                <th>Contraseña</th>                
                <th>Acciones</th>
            </tr>
            <?php foreach ($datos as $key => $dato) : ?>
                <tr>
                    <td><?= $dato['id_usuario'] ?></td>
                    <td><?= $dato['correo'] ?></td>
                    <td><?= $dato['contrasena'] ?></td>                    
                    <td>
                        <div class="d-flex justify-content-between">
                            <a href="usuario.php?action=delete&id_usuario=<?= $dato['id_usuario'] ?>" class="btn btn-outline-danger">
                                Eliminar
                            </a>
                            <a href="usuarioRol.php?action=show&id_usuario=<?= $dato['id_usuario'] ?>" class="btn btn-outline-success">
                                Permisos
                            </a>
                            <a href="usuario.php?action=show&id_usuario=<?= $dato['id_usuario'] ?>" class="btn btn-outline-secondary">
                                Actualizar
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>