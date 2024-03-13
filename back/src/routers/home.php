<?php

header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST, SERVER, DELETEELEMENT, AMOUNTALTER');
header("Access-Control-Allow-Origin: *");

include '../functions/homeFunc.php';

function requestMethodManager(){
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method){
        case 'GET':
            return select();
            break;
        case 'POST':
            $dataReceived = json_decode(file_get_contents('php://input'), true);
            error_log(print_r($dataReceived, true));
            $taxesTotal = $dataReceived['taxesTotal'];
            $priceTotal = $dataReceived['priceTotal'];
            return insert($taxesTotal, $priceTotal);
            break;
    }
};
requestMethodManager()

?>