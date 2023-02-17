<?php
include './includes/templates/header.php';
?>

        <main class="contenedor seccion contenido-centrado">
            <h1>Casa en Venta frente al bosque</h1>
            <picture>
                <source srcset="build/img/destacada.webp" type="image/webp" />
                <source srcset="build/img/destacada.jpg" type="image/jpeg" />
                <img
                    loading="lazy"
                    src="build/img/destacada.jpg"
                    alt="Imagen anuncio"
                />
            </picture>
            <div class="resumen-propiedad">
                <p class="precio">$3,000,000.00</p>
                <ul class="iconos-caracteristicas">
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="build/img/icono_wc.svg"
                            alt="icono wc"
                        />
                        <p>3</p>
                    </li>
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="build/img/icono_dormitorio.svg"
                            alt="icono dormitorio"
                        />
                        <p>3</p>
                    </li>
                    <li>
                        <img
                            class="icono"
                            loading="lazy"
                            src="build/img/icono_estacionamiento.svg"
                            alt="icono estacionamiento"
                        />
                        <p>3</p>
                    </li>
                </ul>
                <p>
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                    Expedita repellat omnis veritatis nostrum nihil, fuga maxime
                    itaque eos repudiandae quas sunt ipsam debitis fugit
                    accusantium ullam sequi perferendis suscipit quis! Lorem
                    ipsum dolor sit amet consectetur adipisicing elit. Ullam
                    modi voluptas error temporibus nemo neque voluptatum autem,
                    odio necessitatibus! Quod, velit laborum? Saepe similique
                    magni pariatur rerum unde quod earum. Lorem ipsum dolor sit,
                    amet consectetur adipisicing elit. Velit id facilis eum est
                    ducimus autem quibusdam accusantium iure modi! Consequatur
                    hic magnam cumque corporis iste enim illum adipisci eum
                    debitis!
                </p>
                <p>
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                    Doloribus est reprehenderit quo cumque ipsum tenetur
                    voluptas mollitia culpa aliquid obcaecati ab consequatur
                    deserunt ex itaque architecto, minima aliquam! Enim, qui.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Et
                    molestias quis earum doloremque ipsum architecto quisquam,
                    rerum nulla rem, quos, vel nostrum ex. Illum, sed earum
                    molestias veniam amet tenetur.
                </p>
            </div>
        </main>

        <footer class="footer seccion">
            <div class="contenedor contenedor-footer">
                <nav class="navegacion">
                    <a href="nosotros.php">Nosotros</a>
                    <a href="anuncios.php">Anuncios</a>
                    <a href="blog.php">Blog</a>
                    <a href="contacto.php">Contacto</a>
                </nav>
            </div>
            <p class="copyright">Todos los derechos reservados 2023 &copy;</p>
        </footer>
        <script src="build/js/bundle.min.js"></script>
    </body>
</html>
