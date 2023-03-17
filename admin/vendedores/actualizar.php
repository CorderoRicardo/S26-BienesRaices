<?php 

require '../../includes/app.php';

use App\Vendedor;

autenticacion();

//Validar la URL por ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: ../index.php');
}

//consultar al vendedor
$vendedor = Vendedor::find($id);

$errores = Vendedor::getErrores();

if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
    $args = $_POST['vendedor'];

    $vendedor->sincronizar($args);

    $errores = $vendedor->validar();

    if(empty($errores)){
        $vendedor->guardar();
    }

}

incluirTemplate('header');
?>
    <main class="contenedor">
        <h1>Actualizar vendedor</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error?>
            </div>
        <?php endforeach;?>

        <a href="/S26-BienesRaices/admin/index.php" class="boton boton-verde-inline">Volver</a>

        <form class="formulario" method="POST">
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>
            <input type="submit" value="Guardar cambios" class="boton boton-verde-inline">
        </form>
    </main>

<?php 
incluirTemplate('footer');
?>