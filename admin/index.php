<?php
    require '../includes/app.php';
    autenticacion();

    use App\Propiedad;

    // implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();

    //Incluye un template
    incluirTemplate('header');

    //Muestra un mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            //Eliminar la imagen
            $query = "SELECT imagen FROM propiedades WHERE id = $id";
            $resQuery = mysqli_query($db,$query);
            $prop = mysqli_fetch_assoc($resQuery);

            unlink('../imagenes/' . $prop['imagen']);

            //Eliminar propiedad
            $query = "DELETE FROM propiedades WHERE id = $id";
            $resQuery = mysqli_query($db, $query);

            if($resQuery){
                header('location: /S26-BienesRaices/admin/index.php?resultado=3');
            }
        }
    }
?>

        <main class="contenedor">
            <h1>Administrador de Bienes Raices</h1>
            <?php if(intval($resultado) === 1): ?>
                <p class="alerta exito">
                    Anuncio creado correctamente
                </p>
            <?php elseif(intval($resultado)=== 2): ?>
                <p class="alerta exito">
                    Anuncio actualizado correctamente
                </p>    
            <?php elseif(intval($resultado)=== 3): ?>
                <p class="alerta exito">
                    Anuncio eliminado correctamente
                </p>                  
            <?php endif; ?>
            <a href="/S26-BienesRaices/admin/propiedades/crear.php" class="boton boton-verde-inline">Nueva propiedad</a>
                <table class="propiedades">
                    <thead>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Imagen</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </thead>

                    <tbody><!--Mostrar los resultados-->
                        <?php foreach($propiedades as $propiedad): ?>
                        <tr>
                            <td> <?php echo $propiedad->id; ?></td>
                            <td> <?php echo $propiedad->titulo ?></td>
                            <td class=" tdImage"><img src="../imagenes/<?php echo $propiedad->imagen ?>" class="imagen-tabla"></td>
                            <td> <?php echo '$' . $propiedad->precio ?> </td>
                            <td>
                                <form method="POST" class="w-100">
                                    <input type="hidden" name="id" value="<?php echo $propiedad->id; ?>">
                                    <input type="submit" class="boton-rojo" value="Eliminar">
                                </form>
                                <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id ?>" class="boton-amarillo">Actualizar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </main>

<?php
    //Cerrar la conexion a la DB
    mysqli_close($db);

    incluirTemplate('footer');
?>