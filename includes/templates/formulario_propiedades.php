<fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input 
                    type="text" 
                    id="titulo" 
                    name="titulo" 
                    placeholder="Titulo propiedad" 
                    value="<?php echo cleanHTML($propiedad->titulo);?>"
                >

                <label for="precio">Precio:</label>
                <input 
                    type="number" 
                    id="precio" 
                    name="precio" 
                    placeholder="Precio propiedad" 
                    value="<?php echo cleanHTML($propiedad->precio);?>"
                >

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion"><?php echo cleanHTML($propiedad->descripcion);?></textarea>
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
                    value="<?php echo cleanHTML($propiedad->habitaciones);?>"
                >

                <label for="wc">Baños:</label>
                <input type="number" 
                    id="wc" 
                    name="wc" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo cleanHTML($propiedad->wc);?>"
                >

                <label for="estacionamiento">Estacionamiento:</label>
                <input 
                    type="number" 
                    id="estacionamiento" 
                    name="estacionamiento" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo cleanHTML($propiedad->estacionamiento);?>"
                >
            </fieldset>

            <fieldset><!-- Codigo a cambiar para el vendedor...-->
                <legend>Vendedor</legend>
                <select name="vendedorId">
                    <option value="">-- Seleccione --</option>
                    <?php while($vendedor = mysqli_fetch_assoc($resultado)): ?>
                        <option 
                            value="<?php echo cleanHTML($vendedor['id']) ?>"
                            <?php echo ($vendedor['id'] === $vendedorId) ? 'selected': '' ?>    
                        >
                            <?php echo $vendedor['nombre'] . ' ' . $vendedor['apellido']?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </fieldset>
