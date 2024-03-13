<?php

header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST, SERVER, DELETEELEMENT, AMOUNTALTER');
header("Access-Control-Allow-Origin: *");

include '../functions/productsFunc.php';

function requestMethodManager(){
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method){
        case 'GET':
            return select();
            break;
        case 'POST':
            $productName = htmlspecialchars($_POST['ProductName']);
            $amount = $_POST['Amount'];
            $unitPrice = $_POST['UnitPrice'];
            $categoryName = htmlspecialchars($_POST['categorySelect']);
            return insert($productName, $amount, $unitPrice, $categoryName);
            break;
        case 'DELETEELEMENT':
            $code = $_GET['code'];
            return deleteElement($code);
            break;
    }
};
requestMethodManager()

?>