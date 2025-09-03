<fieldset>
    <legend>Información general</legend>

    <label for="titulo">Titulo:</label>
    <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo htmlspecialchars($propiedad->titulo); ?>">

    <label for="precio">Precio:</label>
    <input type="number" id="precio" name="precio" placeholder="Precio de la Propiedad" required value="<?php echo htmlspecialchars($propiedad->precio); ?>">

    <label for="imagen">Imagen:</label>
    <input type="file" id="imagen" accept="image/jpg" name="imagen">

    <label for="descripcion">Descripcion:</label>
    <textarea id="descripcion" name="descripcion" required><?php echo htmlspecialchars($propiedad->descripcion); ?></textarea>
</fieldset>

<fieldset>
    <legend>Información de la propiedad</legend>

    <label for="habitaciones">Numero de Habitaciones:</label>
    <input type="number" name="habitaciones" id="habitaciones" placeholder="Ej: 3" min="1" max="99" required value="<?php echo htmlspecialchars($propiedad->habitaciones); ?>">

    <label for="wc">Numero de Baños:</label>
    <input type="number" name="wc" id="wc" placeholder="Ej: 3" min="1" max="99" required value="<?php echo htmlspecialchars($propiedad->wc); ?>">

    <label for="estacionamiento">Numero de estacionamientos:</label>
    <input type="number" name="estacionamiento" id="estacionamiento" placeholder="Ej: 3" min="1" max="99" required value="<?php echo htmlspecialchars($propiedad->estacionamiento); ?>">
</fieldset>

<fieldset>
    <legend>Vendedor</legend>
    <label for="vendedor">Vendedor</label>
    <select name="vendedor_id" id="vendedor">
        <?php foreach ($vendedores as $vendedor): ?>
            <option
                value="<?php echo htmlspecialchars($vendedor->id); ?>"
                <?php echo ($vendedor->id === $propiedad->vendedor_id) ? 'selected' : ''; ?>>
                <?php echo htmlspecialchars($vendedor->nombre) . " " . htmlspecialchars($vendedor->apellido); ?>
            </option>
        <?php endforeach ?>
    </select>
</fieldset>