<?php
require '../../includes/app.php';
autenticacion();

use App\Propiedad;

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
$errores = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $args = $_POST['propiedad'];
    
    $propiedad->sincronizar($args);

    $imagen = $_FILES['imagen'];

    if(!$titulo){
        $errores[] = 'El Titulo es obligatorio';
    }

    if(!$precio){
        $errores[] = 'El Precio es obligatorio';
    }    
    if(strlen($descripcion) < 50){
        $errores[] = 'La Descripción es obligatoria y debe tener al menos 50 caracteres';
    }    
    if(!$habitaciones){
        $errores[] = 'El número de Habitaciones es obligatorio';
    }
    if(!$wc){
        $errores[] = 'El número de Baños es obligatorio';
    }
    if(!$estacionamiento){
        $errores[] = 'El número de lugares de Estacionamiento es obligatorio';
    }
    if(!$vendedorId){
        $errores[] = 'Elige un vendedor';
    }

    // Validar por tamaño - 1MB máx
    $medida = 1000*1000;
    if($imagen['size'] > $medida){
        $errores[] = 'El Peso máximo de la imagen es 1MB';
    }
    // echo "<pre>";
    // var_dump($errores);
    // echo "</pre>";
    
    if(empty($errores)){
    /*subida de archivos*/
        $carpetaImagenes = '../../imagenes/';
        //Crear carpeta si no existe previamente
        if(!is_dir($carpetaImagenes)){
            mkdir($carpetaImagenes);
        }

        $nombreImagen = '';

        // Eliminar imagen previa
        if($imagen['name']){
            unlink($carpetaImagenes . $propiedad['imagen']);

            // generar nombre único para la imagen
            $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

            //Subir la imagen
            move_uploaded_file($imagen['tmp_name'],$carpetaImagenes . $nombreImagen);            
        } else{
            $nombreImagen = $propiedad['imagen'];
        }
        
    // Crear la query del INSERT
        $query = "UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, wc = $wc, estacionamiento = $estacionamiento, vendedores_id = $vendedorId WHERE id = $id";

    // Insertar la query en la base de datos
        $resultadoInsert = mysqli_query($db, $query);

        if($resultadoInsert){
            // 
            header('Location: /S26-BienesRaices/admin/index.php?resultado=2');
        }

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