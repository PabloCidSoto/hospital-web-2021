<h1>Lista de Roles de <?php echo $datos[0]['correo'];?></h1>
    <?php if(isset($resultado)): ?>
    <div class="alert alert-dark" role="alert">
        <?= $resultado?>
    </div>
    <?php endif; ?>
    <a href="usuarioRol.php?action=create&id_usuario=<?php echo $datos[0]['id_usuario'];?>" class="btn btn-success">Agregar Rol</a>
    <div class="d-flex flex-row-reverse">
        <form action="producto.php" method="get">
            <input class="input-group-text" style="display:inline-block;" type="text" name="busqueda">
            <input class="btn btn-outline-secondary" type="submit" name="buscar">
        </form>
    </div>
    <div class="table-responsive pt-2">
        <table class="table table-dark table-striped align-middle">
            <tr>
                <th>Rol</th>                
                <th>Acciones</th>
            </tr>
            <?php foreach ($datos as $key => $dato) : ?>
                <?php if(isset($dato['rol'])) : ?>
                <tr>
                    <td><?= $dato['rol'] ?></td>                                        
                    <td>
                        <div class="d-flex justify-content-between">
                            <a href="usuarioRol.php?action=delete&id_rol=<?= $dato['id_rol'] ?>&id_usuario=<?= $dato['id_usuario'] ?>" class="btn btn-outline-danger">
                                <svg height="12pt" viewBox="0 0 512 512" width="12pt" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m256 0c-141.164062 0-256 114.835938-256 256s114.835938 256 256 256 256-114.835938 256-256-114.835938-256-256-256zm0 0" fill="#f44336" />
                                    <path d="m350.273438 320.105469c8.339843 8.34375 8.339843 21.824219 0 30.167969-4.160157 4.160156-9.621094 6.25-15.085938 6.25-5.460938 0-10.921875-2.089844-15.082031-6.25l-64.105469-64.109376-64.105469 64.109376c-4.160156 4.160156-9.621093 6.25-15.082031 6.25-5.464844 0-10.925781-2.089844-15.085938-6.25-8.339843-8.34375-8.339843-21.824219 0-30.167969l64.109376-64.105469-64.109376-64.105469c-8.339843-8.34375-8.339843-21.824219 0-30.167969 8.34375-8.339843 21.824219-8.339843 30.167969 0l64.105469 64.109376 64.105469-64.109376c8.34375-8.339843 21.824219-8.339843 30.167969 0 8.339843 8.34375 8.339843 21.824219 0 30.167969l-64.109376 64.105469zm0 0" fill="#fafafa" />
                                </svg>
                            </a>                            
                        </div>
                    </td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>        
    </div>

    