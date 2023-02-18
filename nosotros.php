<?php
    require 'includes/funciones.php';
    incluirTemplate('header');
?>

        <main class="contenedor">
            <h1>Conoce Sobre Nosotros</h1>
            <div class="contenido-nosotros">
                <div class="imagen">
                    <picture>
                        <source
                            srcset="build/img/nosotros.webp"
                            type="image/webp"
                        />
                        <source
                            srcset="build/img/nosotros.jpg"
                            type="image/jpeg"
                        />
                        <img
                            loading="lazy"
                            src="build/img/nosotros.jpg"
                            alt="Imagen nosotros"
                        />
                    </picture>
                </div>
                <div class="texto-nosotros">
                    <blockquote>25 años de experiencia</blockquote>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Natus pariatur est eligendi, voluptatibus
                        explicabo, quia odio minima dicta iusto, necessitatibus
                        repudiandae quis suscipit. Culpa modi laudantium quidem,
                        corrupti quos accusantium! Lorem ipsum, dolor sit amet
                        consectetur adipisicing elit. Dolor corrupti voluptatem
                        deserunt nostrum, molestiae atque unde autem quod
                        ratione soluta accusamus, in dolorum odio neque
                        similique enim consectetur quisquam possimus?
                    </p>
                    <p>
                        Nam molestias in dicta maxime ullam et?Lorem ipsum,
                        dolor sit amet consectetur adipisicing elit. Numquam sit
                        dolorem nemo optio perspiciatis vitae fuga corporis
                        nihil ullam, nesciunt impedit quis minus explicabo quasi
                        quam veritatis et soluta autem?
                    </p>
                </div>
            </div>
        </main>

        <section class="seccion contenedor">
            <h2>Más sobre nosotros</h2>
            <div class="iconos-nosotros">
                <div class="icono">
                    <img
                        src="build/img/icono1.svg"
                        alt="icono seguridad"
                        loading="lazy"
                    />
                    <h3>Seguridad</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Eaque quia optio possimus animi. Fugit placeat
                        autem asperiores molestiae vitae, maxime amet? Natus ad
                        consequatur iste tempora, unde aut eaque quos?
                    </p>
                </div>
                <div class="icono">
                    <img
                        src="build/img/icono2.svg"
                        alt="icono seguridad"
                        loading="lazy"
                    />
                    <h3>Precio</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Eaque quia optio possimus animi. Fugit placeat
                        autem asperiores molestiae vitae, maxime amet? Natus ad
                        consequatur iste tempora, unde aut eaque quos?
                    </p>
                </div>
                <div class="icono">
                    <img
                        src="build/img/icono3.svg"
                        alt="icono seguridad"
                        loading="lazy"
                    />
                    <h3>A tiempo</h3>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing
                        elit. Eaque quia optio possimus animi. Fugit placeat
                        autem asperiores molestiae vitae, maxime amet? Natus ad
                        consequatur iste tempora, unde aut eaque quos?
                    </p>
                </div>
            </div>
        </section>

<?php
    incluirTemplate('footer');
?>
