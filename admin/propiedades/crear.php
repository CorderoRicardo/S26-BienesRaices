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

//persistencia de variables
$titulo = '';
$precio = '';
$descripcion = '';
$habitaciones = '';
$wc = '';
$estacionamiento = '';
$vendedorId = '';
$imagen = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $propiedad = new Propiedad($_POST);
    
    $titulo = $propiedad->titulo;
    $precio = $propiedad->precio;
    $descripcion = $propiedad->descripcion;
    $habitaciones = $propiedad->habitaciones;
    $wc = $propiedad->wc;
    $estacionamiento = $propiedad->estacionamiento;
    $vendedorId = $propiedad->vendedorId;
    $imagen = $propiedad->imagen;
    
    /*subida de archivos*/
    // generar nombre único para la imagen
    $nombreImagen = md5( uniqid( rand(), true ) ) . '.jpg';

    // Agregar la imagen
    // Realiza un resize a la imagen
    if($_FILES['imagen']['tmp_name']){
        $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800,600);
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
        $resultadoInsert = $propiedad->guardar();
        if($resultadoInsert){
            // 
            header('Location: /S26-BienesRaices/admin/index.php?resultado=1');
        }
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
                <select name="vendedorId">
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