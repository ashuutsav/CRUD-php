<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods:PUT");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With");
 
// error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
// echo $data->productName;
include('db.php');

if(isset($data->id)){
    $query2 = "SELECT * FROM products WHERE id= $data->id";
    $run2 = mysqli_query($db,$query2);
    $product = mysqli_fetch_assoc($run2);
    $productName = $product['productName'];
    $productPrice = $product['productPrice'];
    $stock = $product['stock'];
    $discount = $product['discount'];
    if(isset($data->discount)){
        $discount = $data->discount;
    }
    if(isset($data->stock)){
        $stock = $data->stock;
    }
    if(isset($data->productName)){
        $productName = $data->productName;
    }
    if(isset($data->productPrice)){
        $productPrice = $data->productPrice;
    }
    $query = "UPDATE products SET ";
    $query.= "productName = '$productName',";
    $query.= "productPrice = $productPrice,";
    $query.= "stock = $stock,";
    $query.= "discount = $discount WHERE id = $data->id";

    $run = mysqli_query($db,$query);
    if($run){
        echo json_encode(['status'=>'success','message'=>'updation successfull']);
    }else{
        echo json_encode(['status'=>'failure','message'=>'updation failure']);
    }
}else{
    echo json_encode(['status'=>'failure','msg'=>'product id not given']);
}