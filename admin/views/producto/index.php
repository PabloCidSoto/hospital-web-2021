<h1>Lista de Productos</h1>
    <?php if(isset($resultado)): ?>
    <div class="alert alert-dark" role="alert">
        <?= $resultado?>
    </div>
    <?php endif; ?>
    <a href="producto.php?action=create" class="btn btn-success">Nuevo Producto</a>
    <div class="d-flex flex-row-reverse">
        <form action="producto.php" method="get">
            <input class="input-group-text" style="display:inline-block;" type="text" name="busqueda">
            <input class="btn btn-outline-secondary" type="submit" name="buscar">
        </form>
    </div>
    <div class="table-responsive pt-2">
        <table class="table table-dark table-striped align-middle">
            <tr>
                <th>ID Producto</th>
                <th><a href="producto.php?ordenamiento=p.producto">Producto</a></th>
                <th><a href="producto.php?ordenamiento=p.precio">Precio</a></th>
                <th>tipo producto</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($datos as $key => $dato) : ?>
                <tr>
                    <td><?= $dato['id_producto'] ?></td>
                    <td><?= $dato['producto'] ?></td>
                    <td><?= $dato['precio'] ?></td>
                    <td><?= $dato['tipo_producto'] ?></td>                    
                    <td>
                        <div class="d-flex justify-content-between">
                            <a href="producto.php?action=delete&id_producto=<?= $dato['id_producto'] ?>" class="btn btn-outline-danger">
                                <svg height="12pt" viewBox="0 0 512 512" width="12pt" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m256 0c-141.164062 0-256 114.835938-256 256s114.835938 256 256 256 256-114.835938 256-256-114.835938-256-256-256zm0 0" fill="#f44336" />
                                    <path d="m350.273438 320.105469c8.339843 8.34375 8.339843 21.824219 0 30.167969-4.160157 4.160156-9.621094 6.25-15.085938 6.25-5.460938 0-10.921875-2.089844-15.082031-6.25l-64.105469-64.109376-64.105469 64.109376c-4.160156 4.160156-9.621093 6.25-15.082031 6.25-5.464844 0-10.925781-2.089844-15.085938-6.25-8.339843-8.34375-8.339843-21.824219 0-30.167969l64.109376-64.105469-64.109376-64.105469c-8.339843-8.34375-8.339843-21.824219 0-30.167969 8.34375-8.339843 21.824219-8.339843 30.167969 0l64.105469 64.109376 64.105469-64.109376c8.34375-8.339843 21.824219-8.339843 30.167969 0 8.339843 8.34375 8.339843 21.824219 0 30.167969l-64.109376 64.105469zm0 0" fill="#fafafa" />
                                </svg>
                            </a>
                            <a href="producto.php?action=show&id_producto=<?= $dato['id_producto'] ?>" class="btn btn-outline-success">
                                <svg height="12pt" viewBox="0 0 512 512" width="12pt" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m453.332031 0h-394.664062c-32.363281 0-58.667969 26.304688-58.667969 58.667969v394.664062c0 32.363281 26.304688 58.667969 58.667969 58.667969h394.664062c32.363281 0 58.667969-26.304688 58.667969-58.667969v-394.664062c0-32.363281-26.304688-58.667969-58.667969-58.667969zm0 0" fill="#4caf50" />
                                    <g fill="#fafafa">
                                        <path d="m277.332031 128c0 11.78125-9.550781 21.332031-21.332031 21.332031s-21.332031-9.550781-21.332031-21.332031 9.550781-21.332031 21.332031-21.332031 21.332031 9.550781 21.332031 21.332031zm0 0" />
                                        <path d="m304 405.332031h-96c-11.777344 0-21.332031-9.554687-21.332031-21.332031s9.554687-21.332031 21.332031-21.332031h26.667969v-128h-16c-11.777344 0-21.335938-9.558594-21.335938-21.335938 0-11.773437 9.558594-21.332031 21.335938-21.332031h37.332031c11.777344 0 21.332031 9.558594 21.332031 21.332031v149.335938h26.667969c11.777344 0 21.332031 9.554687 21.332031 21.332031s-9.554687 21.332031-21.332031 21.332031zm0 0" />
                                    </g>
                                </svg>
                            </a>
                            <a href="producto.php?action=show&id_producto=<?= $dato['id_producto'] ?>" class="btn btn-outline-secondary">
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
        <div class="d-flex flex-row-reverse">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for($i = 0; $i < $producto->total(); $i+=5): ?>
            <li class="page-item"><a class="page-link" href="producto.php?<?php echo (isset($_GET['busqueda']))?'busqueda='.$_GET['busqueda'].'&':'';?>&desde=<?php echo $i;?>&limite=5"><?php echo $i/5 ?></a></li>
            <?php endfor; ?>
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
            </ul>
        </nav>
        </div>
    </div>

    <?php echo "Filtrando ".count($datos)." de un total de ".$producto->total()." productos"; ?>