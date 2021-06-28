    <h1>Lista de Pacientes</h1>
    <?php if(isset($resultado)): ?>
    <div class="alert alert-dark" role="alert">
        <?= $resultado?>
    </div>
    <?php endif; ?>
    <a href="pacientes.php?action=create" class="btn btn-success">Nuevo Paciente</a>
    <a href="pacientes.report.php" class="btn btn-dark">Reporte</a>
    <div class="table-responsive pt-2">
        <table class="table table-dark table-striped align-middle">
            <tr>
                <th>ID Paciente</th>
                <th>Fotografía</th>
                <th>Nombre</th>
                <th>Apellido Paterno</th>
                <th>Apellido Materno</th>
                <th>Fecha de Nacimiento</th>
                <th>Domicilio</th>
                <th>botones</th>
            </tr>
            <?php foreach ($datos as $key => $dato) : ?>
                <tr>
                    <td><?= $dato['id_paciente'] ?></td>
                    <td><img src="<?php echo (isset($dato['fotografia']))? 'archivos/'.$dato['fotografia']: 'archivos/default.png'; ?>" alt="foto paciente" class="rounded-circle img-fluid" width="50px"></td>
                    <td><?= $dato['nombre'] ?></td>
                    <td><?= $dato['apaterno'] ?></td>
                    <td><?= $dato['amaterno'] ?></td>
                    <td><?= $dato['nacimiento'] ?></td>
                    <td><?= $dato['domicilio'] ?></td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <a href="pacientes.php?action=delete&id_paciente=<?= $dato['id_paciente'] ?>" class="btn btn-outline-danger">
                                <svg height="12pt" viewBox="0 0 512 512" width="12pt" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m256 0c-141.164062 0-256 114.835938-256 256s114.835938 256 256 256 256-114.835938 256-256-114.835938-256-256-256zm0 0" fill="#f44336" />
                                    <path d="m350.273438 320.105469c8.339843 8.34375 8.339843 21.824219 0 30.167969-4.160157 4.160156-9.621094 6.25-15.085938 6.25-5.460938 0-10.921875-2.089844-15.082031-6.25l-64.105469-64.109376-64.105469 64.109376c-4.160156 4.160156-9.621093 6.25-15.082031 6.25-5.464844 0-10.925781-2.089844-15.085938-6.25-8.339843-8.34375-8.339843-21.824219 0-30.167969l64.109376-64.105469-64.109376-64.105469c-8.339843-8.34375-8.339843-21.824219 0-30.167969 8.34375-8.339843 21.824219-8.339843 30.167969 0l64.105469 64.109376 64.105469-64.109376c8.34375-8.339843 21.824219-8.339843 30.167969 0 8.339843 8.34375 8.339843 21.824219 0 30.167969l-64.109376 64.105469zm0 0" fill="#fafafa" />
                                </svg>
                            </a>
                            <a href="pacientes.php?action=consulta&id_paciente=<?= $dato['id_paciente'] ?>" class="btn btn-outline-success">
                                info
                            </a>
                            <a href="pacientes.php?action=show&id_paciente=<?= $dato['id_paciente'] ?>" class="btn btn-outline-secondary">
                                <svg height="12pt" viewBox="0 0 512 512" width="12pt" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m453.332031 0h-394.664062c-32.363281 0-58.667969 26.304688-58.667969 58.667969v394.664062c0 32.363281 26.304688 58.667969 58.667969 58.667969h394.664062c32.363281 0 58.667969-26.304688 58.667969-58.667969v-394.664062c0-32.363281-26.304688-58.667969-58.667969-58.667969zm0 0" fill="#607d8b" />
                                    <g fill="#fafafa">
                                        <path d="m170.667969 256c0 29.457031-23.878907 53.332031-53.335938 53.332031-29.453125 0-53.332031-23.875-53.332031-53.332031s23.878906-53.332031 53.332031-53.332031c29.457031 0 53.335938 23.875 53.335938 53.332031zm0 0" />
                                        <path d="m309.332031 256c0 29.457031-23.875 53.332031-53.332031 53.332031s-53.332031-23.875-53.332031-53.332031 23.875-53.332031 53.332031-53.332031 53.332031 23.875 53.332031 53.332031zm0 0" />
                                        <path d="m448 256c0 29.457031-23.878906 53.332031-53.332031 53.332031-29.457031 0-53.335938-23.875-53.335938-53.332031s23.878907-53.332031 53.335938-53.332031c29.453125 0 53.332031 23.875 53.332031 53.332031zm0 0" />
                                    </g>
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    