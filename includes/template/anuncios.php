<?php
    require 'includes/config/database.php';
    $db = conectardb();

    $query = "SELECT * FROM propiedades LIMIT $limite";

    $resultado = mysqli_query($db, $query);

?>

<div class="contenedor-cards">
    <?php while($propiedad = mysqli_fetch_assoc($resultado)): ?>
    <div class="card">
        <img loading="lazy" class="card__img" src="/imagenes/<?php echo $propiedad['imagen'] ?>">
        <div class="card__contenido">
            <h3><?php echo $propiedad['titulo'] ?></h3>
            <p><?php echo $propiedad['descripcion'] ?></p>
            <p class="precio">$<?php echo $propiedad['precio'] ?></p>
            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono baño">
                    <p><?php echo $propiedad['wc'] ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg"
                        alt="icono estacionamiento">
                    <p><?php echo $propiedad['estacionamiento'] ?></p>
                </li>
                <li>
                    <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg"
                        alt="icono dormitorio">
                    <p><?php echo $propiedad['habitaciones'] ?></p>
                </li>
            </ul>
            <a class="btn btn-amarillo" href="anuncio.php?id=<?php echo $propiedad['id'];?>">Ver Propiedad</a>
        </div>
    </div>
    <?php endwhile; ?>
</div>