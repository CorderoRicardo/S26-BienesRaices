<?php
require '../../includes/config/database.php';
$db = conectarDB();

//consultar valores de la BD: datos de vendedores
$consulta = "SELECT * FROM vendedores;";
$resultado = mysqli_query($db, $consulta);

// arreglo con errores para el formulario
$errores = [];

//persistencia de variaables
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';
$imagen = '';

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
    if(!$imagen['name'] || $imagen['error']){
        $errores[] = 'La imagen es obligatoria';
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

        // generar nombre único para la imagen
        $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

        //Subir la imagen
        move_uploaded_file($imagen['tmp_name'],$carpetaImagenes . $nombreImagen);
        
    // Crear la query del INSERT
        $query = "INSERT INTO propiedades (titulo, precio, imagen, descripcion, habitaciones, wc, estacionamiento, creado, vendedores_Id) VALUES 
        ('$titulo', '$precio', '$nombreImagen', '$descripcion', '$habitaciones', '$wc', '$estacionamiento', '$creado', '$vendedorId');";

    // Insertar la query en la base de datos
        $resultadoInsert = mysqli_query($db, $query);

        if($resultadoInsert){
            // 
            header('Location: /S26-BienesRaices/admin/index.php?resultado=1');
        }

    }

}

require '../../includes/funciones.php';
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

            <input type="submit" value="Crear propiedad" class="boton boton-verde-inline">
        </form>
    </main>

<?php
    incluirTemplate('footer');
?>