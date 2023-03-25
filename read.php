<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods:GET");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requeste-With");
 
// error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
// echo $data->productName;
include('db.php');
$query = "SELECT * FROM products";

if(isset($_GET['id'])){
    $query = "SELECT * FROM products WHERE id='".$_GET['id']."'";
}
$run = mysqli_query($db,$query);
$products = mysqli_fetch_all($run,MYSQLI_ASSOC);
echo json_encode($products);
