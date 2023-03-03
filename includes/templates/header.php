<?php 
    if(!isset($_SESSION)){
        session_start();
    }
    $auth = $_SESSION['login'] ?? false;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Bienes Raíces</title>
        <link rel="stylesheet" href="/S26-BienesRaices/build/css/app.css" />
    </head>
    <body>
        <header class="header <?php echo $inicio ? 'inicio' :'' ?>">
            <div class="contenedor contenido-header">
                <div class="barra">
                    <a href="/S26-BienesRaices/index.php">
                        <img
                            src="/S26-BienesRaices/build/img/logo.svg"
                            alt="logotipo de Bienes Raices"
                        />
                    </a>

                    <div class="mobile-menu">
                        <img
                            src="/S26-BienesRaices/build/img/barras.svg"
                            alt="Icono menu responsive"
                        />
                    </div>

                    <div class="derecha">
                        <img
                            src="/S26-BienesRaices/build/img/dark-mode.svg"
                            class="dark-mode-boton"
                        />
                        <nav class="navegacion">
                            <a href="/S26-BienesRaices/nosotros.php">Nosotros</a>
                            <a href="/S26-BienesRaices/anuncios.php">Anuncios</a>
                            <a href="/S26-BienesRaices/blog.php">Blog</a>
                            <a href="/S26-BienesRaices/contacto.php">Contacto</a>
                            <?php if($auth): ?>
                                <a href="/S26-BienesRaices/cerrar-sesion.php">Cerrar sesión</a>    
                            <?php endif; ?>
                        </nav>
                    </div>
                </div>
                <!--fin .barra-->
                <?php if($inicio) { ?>
                    <h1>Venta de Casas y Departamentos Exclusivos de Lujo</h1>
                <?php } ?>
            </div>
        </header>