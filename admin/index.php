<?php
    require '../includes/funciones.php';
    incluirTemplate('header');

    $resultado = $_GET['resultado'] ?? null;
?>

        <main class="contenedor">
            <h1>Administrador de Bienes Raices</h1>
            <?php if(intval($resultado) === 1): ?>
                <p class="alerta exito">
                    Anuncio creado correctamente
                </p>
            <?php endif; ?>
            <a href="/S26-BienesRaices/admin/propiedades/crear.php" class="boton boton-verde-inline">Nueva propiedad</a>
                <table class="propiedades">
                    <thead>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </thead>

                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Casa en la playa</td>
                            <td><img src="../imagenes/a3cf6771a517c189b465a483e91d4e4a.jpg" class="imagen-tabla"></td>
                            <td>$1200000</td>
                            <td>
                                <a href="" class="boton-rojo">Eliminar</a>
                                <a href="" class="boton-amarillo">Actualizar</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
        </main>

<?php
    incluirTemplate('footer');
?>