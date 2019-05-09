<?php

if (!defined("HOST")) {
    define('HOST', '127.0.0.1');
}
if (!defined("USER")) {
    define('USER', 'root');
}
if (!defined("PASSWORD")) {
    define('PASSWORD', '');
}
if (!defined("DB")) {
    define('DB', 'ouvidoria_teste');
}


$conexao = mysqli_connect(HOST, USER, PASSWORD, DB) or die ('Não foi possível conectar');
mysqli_query($conexao, "SET NAMES utf8");
mysqli_query($conexao, "SET CHARACTER_SET utf8");
?>