<fieldset>
    <legend>Información general</legend>

    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" placeholder="Nombre vendedor" value="<?php echo htmlspecialchars($vendedor->nombre); ?>">

    <label for="apellido">Apellido:</label>
    <input type="text" id="apellido" name="apellido" placeholder="Apellido del  vendedor" required value="<?php echo htmlspecialchars($vendedor->apellido); ?>">

    <label for="telefono">Telefono:</label>
    <input type="number" id="telefono" name="telefono" placeholder="Telefono del  vendedor" required value="<?php echo htmlspecialchars($vendedor->telefono); ?>">

</fieldset>
