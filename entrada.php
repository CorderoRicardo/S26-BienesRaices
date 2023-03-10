<?php
    require 'includes/app.php';
    incluirTemplate('header');
?>

        <main class="contenedor seccion contenido-centrado">
            <h1>Guía para la decoración de tu hogar</h1>
            <picture>
                <source srcset="build/img/destacada2.webp" type="image/webp" />
                <source srcset="build/img/destacada2.jpg" type="image/jpeg" />
                <img
                    loading="lazy"
                    src="build/img/destacada2.jpg"
                    alt="Imagen anuncio"
                />
            </picture>
            <div class="resumen-propiedad">
                <p class="informacion-meta">
                    Escrito el: <span>20/10/2022</span> por: <span>Admin</span>
                </p>
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

<?php
    incluirTemplate('footer');
?>
