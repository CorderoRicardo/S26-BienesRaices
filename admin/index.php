<?php
    //Importar la conexión de la BD
    require '../includes/config/database.php';
    $db = conectarDB();

    //Escribir el query
    $query = "SELECT * FROM propiedades;";

    //Consultar la DB
    $res = mysqli_query($db, $query);

    //Incluye un template
    require '../includes/funciones.php';
    incluirTemplate('header');

    //Muestra un mensaje condicional
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

                    <tbody><!--Mostrar los resultados-->
                        <?php while( $propiedad = mysqli_fetch_assoc($res) ): ?>
                        <tr>
                            <td> <?php echo $propiedad['id'] ?></td>
                            <td> <?php echo $propiedad['titulo'] ?></td>
                            <td><img src="../imagenes/<?php echo $propiedad['imagen'] ?>" class="imagen-tabla"></td>
                            <td> <?php echo '$' . $propiedad['precio'] ?> </td>
                            <td>
                                <a href="" class="boton-rojo">Eliminar</a>
                                <a href="" class="boton-amarillo">Actualizar</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
        </main>

<?php
    //Cerrar la conexion a la DB
    mysqli_close($db);

    incluirTemplate('footer');
?>