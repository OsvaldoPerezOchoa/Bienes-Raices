<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Document</title>
</head>

<body>
    <?php 
    require 'includes/App.php';
    
    incluirTemplate('header')?>

    <section class="contenedor seccion">
        <h1>Contactanos</h1>
        <img src="build/img/destacada2.webp" alt="contacto">

        <h2>Llene el formulario de contacto</h2>

        <form class="formulario">
            <fieldset>
                <legend>Informacion Personal</legend>

                <label for="nombre">Nombre</label>
                <input id="nombre" type="text" placeholder="Tu nombre">

                <label for="email">Email</label>
                <input id="email" type="email" placeholder="Tu email">

                <label for="telefono">Telefono</label>
                <input id="telefono" type="tel" placeholder="Tu telefono">

                <label for="mensaje">Mensaje</label>
                <textarea id="mensaje" placeholder="Tu mensaje"></textarea>
            </fieldset>

            <fieldset>
                <legend>Informacion sobre la propiedad</legend>

                <label for="opciones">Vende o Compra: </label>
                <select id="opciones">
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input id="presupuesto" type="number" placeholder="Tu presupuesto o precio">
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="formulario-radio">
                    <label for="contac-telefono">Télefono</label>
                    <input name="contacto" type="radio" value="telefono" id="contac-telefono">

                    <label for="contac-email">Email</label>
                    <input name="contacto" type="radio" value="email" id="contac-email">
                </div>

                <p>Si elegio telefono selecciona la fecha y hora</p>

                <label for="fecha">Fecha: </label>
                <input id="fecha" type="date">

                <label for="hora">Hora: </label>
                <input id="hora" type="time" min="09:00" max="18:00">
            </fieldset>

            <input type="submit" value="Enviar" class="btn btn-verde">
        </form>
    </section>


    <?php incluirTemplate('footer')?>

    <script src="build/js/app.js"></script>
</body>

</html>