<fieldset>
    <legend>Información general</legend>

    <label for="nombre">nombre:</label>
    <input 
        type="text" 
        id="nombre" 
        name="vendedor[nombre]" 
        placeholder="Nombre vendedor" 
        value="<?php echo cleanHTML($vendedor->nombre);?>"
    >

    <label for="apellido">apellido:</label>
    <input 
        type="text" 
        id="apellido" 
        name="vendedor[apellido]" 
        placeholder="Apellido vendedor" 
        value="<?php echo cleanHTML($vendedor->apellido);?>"
    >    
</fieldset>

<fieldset>
    <legend>Información adicional</legend>
    <label for="telefono">teléfono:</label>
    <input 
        type="text" 
        id="telefono" 
        name="vendedor[telefono]" 
        placeholder="Teléfono vendedor" 
        value="<?php echo cleanHTML($vendedor->telefono);?>"
    >    
</fieldset>