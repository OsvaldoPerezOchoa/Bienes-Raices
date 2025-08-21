<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="build/css/app.css">
    <title>Document</title>
</head>

<body>
    <?php require 'includes/App.php';
    
    incluirTemplate('header')?>

    <main class="contenedor seccion contenido-centrado">
        <h2>Nuestro Blog</h2>

        <article class="entrada-blog">
            <img src="build/img/blog1.webp" alt="imagen-blog">
            <div class="entrada-texto">
                <a href="entrada.php">
                    <h4>Como mantener tu casa siempre limpia</h4>
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
                    <h4>Como mantener tu casa siempre limpia</h4>
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

        <article class="entrada-blog">
            <img src="build/img/blog4.webp" alt="imagen-blog">
            <div class="entrada-texto">
                <a href="entrada.php">
                    <h4>Como mantener tu casa siempre limpia</h4>
                </a>
                <p>Escrito el <span>20/10/2024</span> por: <span>Admin</span></p>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Earum voluptatibus quaerat ut ipsum
                    dicta animi, quia possimus sit.</p>
            </div>
        </article>

    </main>

    <?php incluirTemplate('footer')?>

    <script src="build/js/app.js"></script>
</body>

</html>