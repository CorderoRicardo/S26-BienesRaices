<?php
    //Obtener y validar el ID
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('location: index.php');
    }

    //importar la conexion a la base datos
    require 'includes/config/database.php';
    $db = conectarDB();

    //Escribir la consulta
    $query = "SELECT * FROM propiedades WHERE id = $id";

    //Obtener resultados
    $resultado = mysqli_query($db, $query);

    //validar que el ID existe
    if(!$resultado->num_rows){
        header('location: index.php');
    }

    $propiedad = mysqli_fetch_assoc($resultado);

    require 'includes/funciones.php';
    incluirTemplate('header');
?>

        <main class="contenedor seccion contenido-centrado">
            <h1><?php echo $propiedad['titulo']; ?></h1>
            <!-- <picture>
                <source srcset="build/img/destacada.webp" type="image/webp" />
                <source srcset="build/img/destacada.jpg" type="image/jpeg" />
                <img
                    loading="lazy"
                    src="build/img/destacada.jpg"
                    alt="Imagen anuncio"
                />
            </picture> -->
                <img
                    loading="lazy"
                    src="imagenes/<?php echo $propiedad['imagen']; ?>"
                    alt="Imagen anuncio"
                />
            <div class="resumen-propiedad">
                <p class="precio">$<?php echo $propiedad['precio']; ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="build/img/icono_wc.svg"
                            alt="icono wc"
                        />
                        <p><?php echo $propiedad['wc']; ?></p>
                    </li>
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="build/img/icono_dormitorio.svg"
                            alt="icono dormitorio"
                        />
                        <p><?php echo $propiedad['habitaciones']; ?></p>
                    </li>
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="build/img/icono_estacionamiento.svg"
                            alt="icono estacionamiento"
                        />
                        <p><?php echo $propiedad['estacionamiento']; ?></p>
                    </li>
                </ul>
                <p>
                    <?php echo $propiedad['descripcion']; ?>
                </p>

            </div>
        </main>

<?php
    incluirTemplate('footer');
    mysqli_close($db);
?>
