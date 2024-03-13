<?php

header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST, SERVER, DELETEELEMENT, AMOUNTALTER');
header("Access-Control-Allow-Origin: *");

include '../functions/productsFunc.php';

function requestMethodManager(){
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method){
            case 'POST':
                $dataReceived = json_decode(file_get_contents('php://input'), true);
                error_log(print_r($dataReceived, true));
                $code = $dataReceived['id'];
                $amount = $dataReceived['value'];
                return update($code, $amount);
                break;
    }
};
requestMethodManager();