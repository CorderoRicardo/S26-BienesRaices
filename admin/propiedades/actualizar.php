<?php
require '../../includes/app.php';
autenticacion();

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

//Validad la URL por ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: ../index.php');
}

//Consultar propiedad
$propiedad = Propiedad::find($id);

//consultar valores de la BD: datos de vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);

// arreglo con errores para el formulario
$errores = Propiedad::getErrores();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $args = $_POST['propiedad'];
    
    $propiedad->sincronizar($args);

    $errores = $propiedad->validar();

    // Subida de archivos
    // generar nombre único para la imagen
    $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

    if(empty($errores)){
    // Insertar la query en la base de datos
        if($_FILES['propiedad']['tmp_name']['imagen']){
            $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
            $propiedad->setImage($nombreImagen);
            $image->save(CARPETA_IMAGENES . $nombreImagen);    
       }    
       $propiedad->guardar();
    }
}

incluirTemplate('header');
?>

    <main class="contenedor">
        <h1>Actualizar propiedad</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error?>
            </div>
        <?php endforeach;?>

        <a href="/S26-BienesRaices/admin/index.php" class="boton boton-verde-inline">Volver</a>

        <form class="formulario" method="POST" enctype="multipart/form-data">
            
        <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar propiedad" class="boton boton-verde-inline">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>