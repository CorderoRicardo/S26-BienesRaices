<?php
require '../../includes/app.php';

use App\Propiedad;
use Intervention\Image\ImageManagerStatic as Image;

autenticacion();

$db = conectarDB();

//consultar valores de la BD: datos de vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);

// arreglo con errores para el formulario
$errores = Propiedad::getErrores();

$propiedad = new Propiedad();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $propiedad = new Propiedad($_POST['propiedad']);
    
    /*subida de archivos*/
    // generar nombre único para la imagen
    $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

    // Agregar la imagen
    // Realiza un resize a la imagen
    if($_FILES['propiedad']['tmp_name']['imagen']){
        $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
        $propiedad->setImage($nombreImagen);
    }

    // Validar -error por aqui 
    $errores = $propiedad->validar();
    
    if(empty($errores)){
        //Crear la carpeta para subir imagenes
        if(!is_dir(!is_dir(CARPETA_IMAGENES))){
            mkdir(CARPETA_IMAGENES);
        }        

        //Guarda la imagen en el servidor
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        //Guarda en la BD
        $propiedad->guardar();
    }  
}

incluirTemplate('header');
?>

    <main class="contenedor">
        <h1>Crear</h1>

        <?php foreach($errores as $error): ?>
            <div class="alerta error">
                <?php echo $error?>
            </div>
        <?php endforeach;?>

        <a href="/S26-BienesRaices/admin/index.php" class="boton boton-verde-inline">Volver</a>

        <form class="formulario" method="POST" action="/S26-BienesRaices/admin/propiedades/crear.php" enctype="multipart/form-data">
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>
            <input type="submit" value="Crear propiedad" class="boton boton-verde-inline">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>