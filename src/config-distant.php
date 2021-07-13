<?php
define('DB_HOST','localhost');
define('DB_USER', 'u868520261_ingrwf09');
define('DB_PASS','Ingrwf09');
define('DB_NAME','u868520261_ingrwf09');


$connect = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
echo $connect->error;

if ($connect->connect_error) {
    echo 'Erreur de connexion à la base de données';
    exit;
}
else {
    $connect->set_charset("utf8");
}

session_start();
?>
