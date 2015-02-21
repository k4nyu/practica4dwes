<?php
include '../clases/ModeloFoto.php';
include '../clases/ModeloPlato.php';
include '../clases/Foto.php';
include '../clases/Plato.php';
include '../clases/Paginacion.php';
include '../clases/Configuracion.php';
include '../clases/Leer.php';
include '../clases/BaseDatos.php';
include '../clases/Subir.php';
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}
$bd = new BaseDatos();
$user = Leer::post("user");
$password = Leer::post("password");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <script src="../js/jquery-1.11.2.min.js"></script>
        <link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <script src="../js/bootstrap.js"></script>
        <script src="../toast/toastr.js"></script>
        <script src="script/codigo.js"></script>
        <link href="../toast/toastr.css" rel="stylesheet">
        
        <title>usuarios</title>
    </head>
    <body>
        <a href="../index.php">Volver al inicio</a>
        <?php if($user == "admin" && $password == "admin"){ ?>
        <div class="container">
            <div id="divajax"></div>
            <button id="insertar">Insertar Plato</button>
        </div>
        
        <?php include "modales.php"; ?>
        <?php }
        else{?>
        <h1>No te has autentificado, lo siento</h1>
        <?php }?>
    </body>
</html>