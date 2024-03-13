<?php
header("Access-Control-Allow-Headers: Content-Type");
header('Access-Control-Allow-Methods: GET, POST, SERVER, DELETEELEMENT');
header("Access-Control-Allow-Origin: *");

function select(){
    $host = "pgsql_desafio";
    $db = "applicationphp";
    $user = "root";
    $pw = "root";

    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);

    $sql = "SELECT * FROM categories ORDER BY code ASC ";
    $response = $myPDO -> query($sql);
    $dbData = [];
    while($row = $response -> fetch(PDO::FETCH_ASSOC)){
        $dbData[] = $row;
    }
    echo json_encode($dbData);
};

function insert($categoryName, $categoryTax){
    $host = "pgsql_desafio";
    $db = "applicationphp";
    $user = "root";
    $pw = "root";
    
    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);

    $statement = $myPDO->prepare("INSERT INTO categories (name, tax) VALUES ('$categoryName', $categoryTax)");
    $statement->execute();
    echo json_encode($statement);
};

function deleteElement($code){
    $host = "pgsql_desafio";
    $db = "applicationphp";
    $user = "root";
    $pw = "root";
    
    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);

    $deleteElement = $myPDO->prepare("DELETE FROM categories WHERE code='$code'");
    $deleteElement->execute();
    echo json_encode($deleteElement);
};
?>