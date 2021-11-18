<?php

function comprobarRenovarSesion(){
    return isset($_SESSION["id"]);
}