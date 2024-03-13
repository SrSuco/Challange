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

	$sql = "SELECT * FROM order_item ORDER BY code ASC ";
	$response = $myPDO -> query($sql);
	$dbData = [];
	while($row = $response -> fetch(PDO::FETCH_ASSOC)){
		$dbData[] = $row;
	}
	echo json_encode($dbData);
};

function selectTemporary(){
	$host = "pgsql_desafio";
	$db = "applicationphp";
	$user = "root";
	$pw = "root";

	$myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);

	$sql = "SELECT * FROM cart ORDER BY code ASC ";
	$response = $myPDO -> query($sql);
	$dbData = [];
	while($row = $response -> fetch(PDO::FETCH_ASSOC)){
		$dbData[] = $row;
	}
	echo json_encode($dbData);
};

function insert($taxesTotal, $priceTotal){
	$host = "pgsql_desafio";
	$db = "applicationphp";
	$user = "root";
	$pw = "root";
	
	$myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);

	$insert = $myPDO->prepare("INSERT INTO  orders(total, tax) VALUES ('$taxesTotal', '$priceTotal')");
	$insert->execute();

    $sql = "SELECT code FROM orders ORDER BY code DESC LIMIT 1";
    $response = $myPDO -> query($sql);
    $row = $response->fetch(PDO::FETCH_ASSOC);
    $code = $row['code'];

	$purchaseInfo = $myPDO->prepare("INSERT INTO order_item (order_code, product_code,amount,price,tax) SELECT '$code', product_code,amount,price,tax FROM cart");
	$purchaseInfo->execute();
	echo json_encode($purchaseInfo);
};

function insertCart($amount, $totalTaxes, $totalwTaxes, $productCode){
	$host = "pgsql_desafio";
	$db = "applicationphp";
	$user = "root";
	$pw = "root";
	
	$myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);

	$insert = $myPDO->prepare("INSERT INTO cart (product_code, amount, price, tax) VALUES ('$productCode', $amount, $totalwTaxes, $totalTaxes)");
	$insert->execute();
	echo json_encode($insert);
};

function deleteElement(){
	$host = "pgsql_desafio";
	$db = "applicationphp";
	$user = "root";
	$pw = "root";
	
	$myPDO = new PDO("pgsql:host=$host;dbname=$db", $user, $pw);

	$deleteElement = $myPDO->prepare("DELETE FROM cart");
	$deleteElement->execute();
	echo json_encode($deleteElement);
};
?>