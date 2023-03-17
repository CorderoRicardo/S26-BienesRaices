<?php 

require '../../includes/app.php';

use App\Vendedor;

autenticacion();

$vendedor = new Vendedor;

$errores = Vendedor::getErrores();

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
    //Crear una instancia de vendedor
    $vendedor = new Vendedor($_POST['vendedor']);

    // Validar que no haya campos vacios
    $errores = $vendedor->validar();

    //no hay errores
    if(empty($errores)){
        $vendedor->guardar();
    }
}

incluirTemplate('header');
?>
    <main class="contenedor">
        <h1>Registrar vendedor</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error?>
            </div>
        <?php endforeach;?>

        <a href="/S26-BienesRaices/admin/index.php" class="boton boton-verde-inline">Volver</a>

        <form class="formulario" method="POST" action="/S26-BienesRaices/admin/vendedores/crear.php">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            <input type="submit" value="Registrar vendedor" class="boton boton-verde-inline">
        </form>
    </main>

<?php 
incluirTemplate('footer');
?>