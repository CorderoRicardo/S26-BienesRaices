<?php
require '../../includes/app.php';
autenticacion();

//Validad la URL por ID
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id){
    header('Location: ../index.php');
}

$db = conectarDB();

//Consultar propiedad
$consulta = "SELECT * FROM propiedades WHERE id = $id";
$resultado = mysqli_query($db, $consulta);
$propiedad = mysqli_fetch_assoc($resultado);

//consultar valores de la BD: datos de vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);

// arreglo con errores para el formulario
$errores = [];

//persistencia de variaables
$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedores_id'];
$imagenPropiedad = $propiedad['imagen'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $titulo = mysqli_real_escape_string($db, $_POST["titulo"]);
    $precio = mysqli_real_escape_string($db, $_POST["precio"]);
    $descripcion = mysqli_real_escape_string($db, $_POST["descripcion"]);
    $habitaciones = mysqli_real_escape_string($db, $_POST["habitaciones"]);
    $wc = mysqli_real_escape_string($db, $_POST["wc"]);
    $estacionamiento = mysqli_real_escape_string($db, $_POST["estacionamiento"]);
    $vendedorId = mysqli_real_escape_string($db, $_POST["vendedor"]);
    $creado = date('Y/m/d');

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
            <fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input 
                    type="text" 
                    id="titulo" 
                    name="titulo" 
                    placeholder="Titulo propiedad" 
                    value="<?php echo $titulo;?>"
                >

                <label for="precio">Precio:</label>
                <input 
                    type="number" 
                    id="precio" 
                    name="precio" 
                    placeholder="Precio propiedad" 
                    value="<?php echo $precio;?>"
                >

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
                <div class="imagen-small">
                    <img src="/S26-BienesRaices/imagenes/<?php echo $imagenPropiedad; ?>">
                </div>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo $descripcion;?></textarea>
            </fieldset>

            <fieldset>
                <legend>
                    Información Propiedad
                </legend>

                <label for="habitaciones">Habitaciones:</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="habitaciones" 
                    placeholder="Ej: 3" 
                    min="1" max="9" 
                    value="<?php echo $habitaciones;?>"
                >

                <label for="wc">Baños:</label>
                <input type="number" 
                    id="wc" 
                    name="wc" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo $wc;?>"
                >

                <label for="estacionamiento">Estacionamiento:</label>
                <input 
                    type="number" 
                    id="estacionamiento" 
                    name="estacionamiento" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo $estacionamiento;?>"
                >
            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>
                <select name="vendedor">
                    <option value="">-- Seleccione --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option 
                            value="<?php echo $vendedor['id'] ?>"
                            <?php echo ($vendedor['id'] === $vendedorId) ? 'selected': '' ?>    
                        >
                            <?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido']?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </fieldset>

            <input type="submit" value="Actualizar propiedad" class="boton boton-verde-inline">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>