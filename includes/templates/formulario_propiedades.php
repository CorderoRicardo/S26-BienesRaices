<fieldset>
                <legend>Información general</legend>

                <label for="titulo">Titulo:</label>
                <input 
                    type="text" 
                    id="titulo" 
                    name="propiedad[titulo]" 
                    placeholder="Titulo propiedad" 
                    value="<?php echo cleanHTML($propiedad->titulo);?>"
                >

                <label for="precio">Precio:</label>
                <input 
                    type="number" 
                    id="precio" 
                    name="propiedad[precio]" 
                    placeholder="Precio propiedad" 
                    value="<?php echo cleanHTML($propiedad->precio);?>"
                >

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen" name="propiedad[imagen]" accept="image/jpeg, image/png">

                <label for="descripcion">Descripción:</label>
                <?php if($propiedad->imagen): ?>
                    <div class="imagen-small">
                        <img src="/S26-BienesRaices/imagenes/<?php echo $propiedad->imagen; ?>">
                    </div>
                <?php endif; ?>
                <textarea id="descripcion" name="propiedad[descripcion]"><?php echo cleanHTML($propiedad->descripcion);?></textarea>
            </fieldset>

            <fieldset>
                <legend>
                    Información Propiedad
                </legend>

                <label for="habitaciones">Habitaciones:</label>
                <input 
                    type="number" 
                    id="habitaciones" 
                    name="propiedad[habitaciones]" 
                    placeholder="Ej: 3" 
                    min="1" max="9" 
                    value="<?php echo cleanHTML($propiedad->habitaciones);?>"
                >

                <label for="wc">Baños:</label>
                <input type="number" 
                    id="wc" 
                    name="propiedad[wc]" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo cleanHTML($propiedad->wc);?>"
                >

                <label for="estacionamiento">Estacionamiento:</label>
                <input 
                    type="number" 
                    id="estacionamiento" 
                    name="propiedad[estacionamiento]" 
                    placeholder="Ej: 3" 
                    min="1" 
                    max="9" 
                    value="<?php echo cleanHTML($propiedad->estacionamiento);?>"
                >
            </fieldset>

            <fieldset><!-- Codigo a cambiar para el vendedor...-->
                <legend>Vendedor</legend>
                <select name="propiedad[vendedorId]" id="vendedor">
                    <option value="">-- Seleccione --</option>
                    <?php foreach($vendedores as $vendedor): ?>
                        <option 
                            <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' :''?>
                            value="<?php echo cleanHTML($vendedor->id); ?>"    
                        >
                             <?php echo cleanHTML($vendedor->nombre)." ".cleanHTML($vendedor->apellido); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </fieldset>
