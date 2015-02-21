<?php
//Esta clase implementa las clases que sean necesarias. Se usa haciendo un rquire de esta clase.
    function autoload($clase) {
    if (file_exists('clases/' . $clase . '.php')) {
        require 'clases/' . $clase . '.php';
    } else {
        require '../clases/' . $clase . '.php';
    }
}
spl_autoload_register('autoload');
$sesion= SesionSingleton::getSesion();