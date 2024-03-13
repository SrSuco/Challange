<?php

header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST, SERVER, DELETEELEMENT');
header("Access-Control-Allow-Origin: *");

include '../functions/categoriesFunc.php';

function requestMethodManager(){
    $method = $_SERVER['REQUEST_METHOD'];
    switch ($method){
        case 'GET':
            return select();
            break;
        case 'POST':
            $categoryName = htmlspecialchars($_POST['categoryName']);
            $categoryTax = $_POST['categoryTax'];
            return insert($categoryName, $categoryTax);
            break;
        case 'DELETEELEMENT':
            $code = $_GET['code'];
            return deleteElement($code);
            break;
    }
};
requestMethodManager()

?>