<?php 
use App\Propiedad;

if($_SERVER['SCRIPT_NAME'] === '/S26-BienesRaices/anuncios.php'){
    $propiedades = Propiedad::all();
}else{
    $propiedades = Propiedad::getRows(3);
}

?>

    <div class="contenedor-anuncios">
        <?php foreach($propiedades as $propiedad): ?>
        <div class="anuncio">
            <!-- <picture>
                <source
                    srcset="build/img/anuncio1.webp"
                    type="image/webp"
                />
                <source
                    srcset="build/img/anuncio1.jpg"
                    type="image/jpeg"
                />
                <img
                    loading="lazy"
                    src="build/img/anuncio1.jpg"
                    alt="anuncio"
                />
            </picture> -->
                <img 
                    loading="lazy"
                    src="imagenes/<?php echo $propiedad->imagen; ?>"
                    alt="anuncio"
                />
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p>
                    <?php echo $propiedad->descripcion; ?>
                </p>
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

                <a href="anuncio.php?id=<?php echo $propiedad->id; ?>" class="boton boton-amarillo">
                    Ver propiedad
                </a>
            </div>
        </div>
        <!--Fin .anuncio-->
    <?php endforeach; ?>
    </div>

<?php 

?>