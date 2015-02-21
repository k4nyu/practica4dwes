<!DOCTYPE html>
<?php
include 'clases/ModeloFoto.php';
include 'clases/ModeloPlato.php';
include 'clases/Foto.php';
include 'clases/Plato.php';
include 'clases/Paginacion.php';
include 'clases/Configuracion.php';
include 'clases/Leer.php';
include 'clases/BaseDatos.php';
include 'clases/Subir.php';
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}
$bd = new BaseDatos();
$modelo = new ModeloPlato($bd);
$lista = $modelo->getPlatos();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Restaurante</title>
        <link rel="stylesheet" href="css/estilos.css">
    </head>
    <body>
        <div class="container">
            <header>
                <nav>
                    <ul>
                        <a href="#"><li>Inicio</li></a>
                        <a href="admin.php"><li>Administración</li></a>
                    </ul>
                </nav>
            </header>
            <br>
            <?php
                foreach ($lista as $value) {
                    $modelofotos = new ModeloFoto($bd);
                    $fotos = $modelofotos->getFotoIdPlato($value->getIdplato());
                    echo "<div class='plato'>";
                    echo "<div class='nombre'>".$value->getNombre()."</div>";
                    echo "<hr>";
                    echo "<div class='descripcion'>".$value->getDescripcion()."</div>";
                    echo "<hr>";
                    foreach ($fotos as $value) {
                        echo "<img src='fotos/".$value->getUrl()."' width=200>";
                    }
                    echo "</div>";
                }
            ?>
        </div>
    </body>
</html>
