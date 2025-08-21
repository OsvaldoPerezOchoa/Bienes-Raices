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
        <h2>Conoce Sobre Nosotros</h2>

        <div class="contenido-nosotros">
            <img src="build/img/nosotros.webp">
            <div class="nosotros-texto">
                <blockquote>30 Años de Experiencia</blockquote>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero id temporibus rem. At iste
                    perferendis rem blanditiis iure deleniti deserunt sunt totam placeat optio quis, ad recusandae
                    maiores dolorum. Minima. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos
                    libero distinctio iusto sed rem enim perspiciatis recusandae sequi similique! Voluptas dolorum,
                    velit ea dolore assumenda omnis harum praesentium consectetur ipsum? lorem Lorem ipsum dolor sit
                    amet consectetur, adipisicing elit. Quam harum beatae non eos dicta corporis, dolorem placeat
                    consequuntur quo accusamus totam atque maxime odit ut. Ratione ex amet itaque voluptatem? Lorem
                    ipsum dolor sit amet consectetur adipisicing elit. Vero, quis. Obcaecati odit officia quo, sapiente
                    unde eius exercitationem odio voluptates asperiores modi cumque quibusdam maiores incidunt
                    laboriosam, minus voluptate sint!</p>

                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero id temporibus rem. At iste
                    perferendis rem blanditiis iure deleniti deserunt sunt totam placeat optio quis, ad recusandae
                    maiores dolorum. Minima. Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos
                    libero distinctio iusto sed rem enim perspiciatis recusandae sequi similique! Voluptas dolorum,
                    velit ea dolore assumenda omnis harum praesentium consectetur ipsum? lorem Lorem ipsum dolor sit
                    amet consectetur, adipisicing elit.</p>
            </div>
        </div>
    </section>

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

    <?php incluirTemplate('footer')?>

    <script src="build/js/app.js"></script>
</body>

</html>