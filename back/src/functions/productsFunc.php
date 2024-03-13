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

    $sql = "SELECT * FROM products ORDER BY code ASC ";
    $response = $myPDO -> query($sql);
    $dbData = [];
    while($row = $response -> fetch(PDO::FETCH_ASSOC)){
        $dbData[] = $row;
    }
    echo json_encode($dbData);
};

function insert($productName, $amount, $unitPrice, $categoryName){
    $host = "pgsql_desafio";
    $db = "applicationphp";
    $user = "root";
    $pw = "root";
    
    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);

    $sql = "SELECT code FROM categories WHERE name='$categoryName'";
    $response = $myPDO -> query($sql);
    $row = $response->fetch(PDO::FETCH_ASSOC);
    $code = $row['code'];

    $insert = $myPDO->prepare("INSERT INTO products (name, amount, price, category_code) VALUES ('$productName', $amount, $unitPrice, '$code')");
    $insert->execute();
    echo json_encode($insert);
};

function update($code, $amount){
    $host = "pgsql_desafio";
    $db = "applicationphp";
    $user = "root";
    $pw = "root";
    
    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);

    $update = $myPDO->prepare("UPDATE products SET amount='$amount' WHERE code='$code'");
    $update->execute();

    $response = ['status' => 'success', 'message' => 'amount uptadated successfully'];
    echo json_encode($response);
}

function deleteElement($code){
    $host = "pgsql_desafio";
    $db = "applicationphp";
    $user = "root";
    $pw = "root";
    
    $myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);

    $deleteElement = $myPDO->prepare("DELETE FROM products WHERE code='$code'");
    $deleteElement->execute();
    echo json_encode($deleteElement);
};
?>