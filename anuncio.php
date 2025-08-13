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
    require 'includes/funciones.php';
    
    incluirTemplate('header')?>

    <section class="contenedor seccion contenido-centrado">
        <h2>Casa frente al bosque</h2>

        <img src="build/img/destacada.webp">

        <div class="resumen-propiedad">
            <p class="precio">3,000,000.00</p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono baño">
                    <p>3</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                    <p>2</p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono dormitorio">
                    <p>4</p>
                </li>
            </ul>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean semper, nibh vel consequat maximus, purus
                diam efficitur neque, sit amet lacinia lectus quam a nulla. Vivamus condimentum lectus et nisi pretium,
                faucibus venenatis sem pulvinar. Integer et laoreet dolor, et suscipit augue. Pellentesque sodales dolor
                id massa pellentesque blandit. Nunc eu lacus nulla. Aenean facilisis eros lobortis lectus luctus dictum.
                Fusce lacinia viverra dolor, ut blandit tellus laoreet ac. Nulla suscipit elementum neque, ac auctor est
                aliquam eget. Phasellus eleifend cursus quam, at posuere libero pellentesque vel. Morbi non cursus diam,
                id vehicula tellus. Morbi at posuere ipsum, eget sagittis nisi. Cras a tristique neque. Fusce tempor,
                lacus ut bibendum euismod, nisl purus elementum metus, sed finibus lectus dui in purus. Aenean pulvinar
                quis purus a fringilla.
                <br>
                <br>
                Proin non mattis risus. Mauris mattis enim vel ante volutpat, ac tempus eros ornare. Aenean nisl metus,
                facilisis quis tincidunt eu, pretium vel leo. Aenean finibus ultrices volutpat. Quisque ullamcorper
                magna at volutpat feugiat. Quisque iaculis iaculis turpis, ac vestibulum ipsum rhoncus vel. Aenean
                maximus mi eu rhoncus vulputate. Mauris a nulla ipsum. Class aptent taciti sociosqu ad litora torquent
                per conubia nostra, per inceptos himenaeos. Donec id dolor in risus rutrum vestibulum eget at orci.
                Donec dapibus facilisis accumsan. Pellentesque quis ipsum lacus. Mauris bibendum tortor ligula, et
                finibus nisi ullamcorper ut. Cras tempor vel turpis ac bibendum.
            </p>
        </div>

    </section>

    <?php incluirTemplate('footer')?>

    <script src="build/js/app.js"></script>
</body>

</html>