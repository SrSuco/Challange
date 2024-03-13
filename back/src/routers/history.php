<?php

header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST, SERVER, DELETEELEMENT, AMOUNTALTER');
header("Access-Control-Allow-Origin: *");

include '../functions/historyFunc.php';

function requestMethodManager(){
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method){
        case 'GET':
            return select();
            break;
    }
};
requestMethodManager()

?>