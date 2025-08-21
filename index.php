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
    require 'includes/app.php';

    incluirTemplate('header', $inicio = true) ?>

    <main class="contenedor">
        <h2>Más Sobre Nosotros</h2>
        <section class="icono-contenedor">
            <div class="icono">
                <img loading="lazy" src="build/img/icono1.svg" alt="icono">
                <h3>Seguridad</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum eligendi
                    laborum in quasi! Quam
                    magni maxime cumque exercitationem, fugiat, dolor, placeat nemo quibusdam molestiae ea quo!
                    Enim, amet voluptatem? Quibusdam!</p>
            </div>
            <div class="icono">
                <img loading="lazy" src="build/img/icono2.svg" alt="icono">
                <h3>Precio</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum eligendi
                    laborum in quasi! Quam
                    magni maxime cumque exercitationem, fugiat, dolor, placeat nemo quibusdam molestiae ea quo!
                    Enim, amet voluptatem? Quibusdam!</p>
            </div>
            <div class="icono">
                <img loading="lazy" src="build/img/icono3.svg" alt="icono">
                <h3>A tiempo</h3>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Earum eligendi
                    laborum in quasi! Quam
                    magni maxime cumque exercitationem, fugiat, dolor, placeat nemo quibusdam molestiae ea quo!
                    Enim, amet voluptatem? Quibusdam!</p>
            </div>
        </section>
    </main>

    <section class="seccion contenedor">
        <h2>Casas y Departamentos en Venta</h2>
        <?php
            $limite = 3;
            include 'includes/template/anuncios.php';
        ?>
        <div class="alinear-derecha">
            <a class="btn btn-verde" href="anuncios.php">Ver Todas</a>
        </div>
    </section>

    <section class="contacto">
        <h2>Encuentra la casa de tus sueños.</h2>
        <p>Llena el formulario de contacto y un asesor se pondra en comunicación contigo a la brevedad</p>
        <a class="btn btn-amarillo">Contáctanos</a>
    </section>

    <div class="contenedor seccion blog-testimonial">
        <section class="blog">
            <h3>Nuestro blog</h3>
            <article class="entrada-blog">
                <img src="build/img/blog1.webp" alt="imagen-blog">
                <div class="entrada-texto">
                    <a href="entrada.php">
                        <h4>Terraza en el techo de tu casa</h4>
                    </a>
                    <p>Escrito el <span>20/10/2024</span> por: <span>Admin</span></p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum voluptatibus quaerat ut ipsum
                        dicta animi, quia possimus sit.</p>
                </div>
            </article>
            <article class="entrada-blog">
                <img src="build/img/blog2.webp" alt="imagen-blog">
                <div class="entrada-texto">
                    <a href="entrada.php">
                        <h4>Guia para decorar tu casa</h4>
                    </a>
                    <p>Escrito el <span>20/10/2024</span> por: <span>Admin</span></p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum voluptatibus quaerat ut ipsum
                        dicta animi, quia possimus sit.</p>
                </div>
            </article>
            <article class="entrada-blog">
                <img src="build/img/blog3.webp" alt="imagen-blog">
                <div class="entrada-texto">
                    <a href="entrada.php">
                        <h4>Como mantener tu casa siempre limpia</h4>
                    </a>
                    <p>Escrito el <span>20/10/2024</span> por: <span>Admin</span></p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum voluptatibus quaerat ut ipsum
                        dicta animi, quia possimus sit.</p>
                </div>
            </article>
        </section>

        <section class="testimoniales">
            <h3>Testimoniales</h3>
            <div class="testimonial">
                <blockquote>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit aut voluptas itaque doloribus
                    totam cupiditate. Provident possimus nihil quos non distinctio, dolor, ea dolores sapiente obcaecati
                    nesciunt suscipit, beatae optio.
                </blockquote>
                <p>- Osvaldo Pérez Ochoa</p>
            </div>
        </section>
    </div>

    <?php incluirTemplate('footer') ?>

    <script src="build/js/app.js"></script>
</body>

</html>