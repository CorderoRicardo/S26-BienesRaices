<?php
    //Obtener y validar el ID
    require 'includes/app.php';
    use App\Propiedad;

    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if(!$id){
        header('location: index.php');
    }

    $propiedad = Propiedad::find($id);

    incluirTemplate('header');
?>

        <main class="contenedor seccion contenido-centrado">
            <h1><?php echo $propiedad->titulo; ?></h1>
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
                    src="imagenes/<?php echo $propiedad->imagen; ?>"
                    alt="Imagen anuncio"
                />
            <div class="resumen-propiedad">
                <p class="precio">$<?php echo number_format($propiedad->precio); ?></p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="build/img/icono_wc.svg"
                            alt="icono wc"
                        />
                        <p><?php echo $propiedad->wc; ?></p>
                    </li>
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="build/img/icono_dormitorio.svg"
                            alt="icono dormitorio"
                        />
                        <p><?php echo $propiedad->habitaciones; ?></p>
                    </li>
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="build/img/icono_estacionamiento.svg"
                            alt="icono estacionamiento"
                        />
                        <p><?php echo $propiedad->estacionamiento; ?></p>
                    </li>
                </ul>
                <p>
                    <?php echo $propiedad->descripcion; ?>
                </p>

            </div>
        </main>

<?php
    incluirTemplate('footer');
?>
