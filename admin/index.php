<?php
    require '../includes/app.php';
    autenticacion();

    use App\Propiedad;
    use App\Vendedor;

    // implementar un metodo para obtener todas las propiedades
    $propiedades = Propiedad::all();
    $vendedores = Vendedor::all();

    //Incluye un template
    incluirTemplate('header');

    //Muestra un mensaje condicional
    $resultado = $_GET['resultado'] ?? null;

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        if($id){
            $tipo = $_POST['tipo'];
            if(validarTipoContenido($tipo)){
                if($tipo === "propiedad"){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }else if($tipo === "vendedor"){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }
            }
        }
    }
?>

        <main class="contenedor">
            <h1>Administrador de Bienes Raices</h1>
            <a href="/S26-BienesRaices/admin/propiedades/crear.php" class="boton boton-verde-inline">Nueva propiedad</a>
            <a href="/S26-BienesRaices/admin/vendedores/crear.php" class="boton boton-amarillo-inline">Nuevo vendedor</a>
            <h2>Propiedades</h2>
            <?php if(intval($resultado) === 1): ?>
                <p class="alerta exito">
                    Creado correctamente
                </p>
            <?php elseif(intval($resultado)=== 2): ?>
                <p class="alerta exito">
                    Actualizado correctamente
                </p>    
            <?php elseif(intval($resultado)=== 3): ?>
                <p class="alerta exito">
                    Eliminado correctamente
                </p>                  
            <?php endif; ?>

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
                                    <input type="hidden" name="tipo" value="propiedad">
                                    <input type="submit" class="boton-rojo" value="Eliminar">
                                </form>
                                <a href="propiedades/actualizar.php?id=<?php echo $propiedad->id ?>" class="boton-amarillo">Actualizar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <h2>Vendedores</h2>
                <table class="propiedades">
                    <thead>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </thead>

                    <tbody><!--Mostrar los resultados-->
                        <?php foreach($vendedores as $vendedor): ?>
                        <tr>
                            <td> <?php echo $vendedor->id; ?></td>
                            <td> <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?></td>
                            <td> <?php echo $vendedor->telefono; ?> </td>
                            <td>
                                <form method="POST" class="w-100">
                                    <input type="hidden" name="id" value="<?php echo $vendedor->id; ?>">
                                    <input type="hidden" name="tipo" value="vendedor">
                                    <input type="submit" class="boton-rojo" value="Eliminar">
                                </form>
                                <a href="vendedores/actualizar.php?id=<?php echo $vendedor->id ?>" class="boton-amarillo">Actualizar</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>                
        </main>

<?php
    incluirTemplate('footer');
?>