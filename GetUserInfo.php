<?php

session_start();

header('Content-Type: application/json');

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Credentials: true');


print_r(json_encode($_SESSION));


exit();
?>
