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
            <a href="/S26-BienesRaices/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
        </main>

<?php
    incluirTemplate('footer');
?>