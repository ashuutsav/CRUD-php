<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requeste-With");
 
// error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
// echo $data->productName;
include('db.php');

if($data->productName==""){
    echo json_encode(['status'=>'failure','msg'=>'name not provided']);
}elseif($data->productPrice==''){
    echo json_encode(['status'=>'failure','msg'=>'price not provided']);
}elseif($data->stock==''){
    echo json_encode(['status'=>'failure','msg'=>'stock not provided']);
}elseif($data->discount==''){
    echo json_encode(['status'=>'failure','msg'=>'discount not provided']);
}else{
    $query = "INSERT INTO products(productName,productPrice,stock,discount)
VALUES('$data->productName',$data->productPrice,$data->stock,$data->discount)";
$run = mysqli_query($db,$query);
if($run){
    echo json_encode(['status'=>'success','msg'=>'product added']);
}else{
    echo json_encode(['status'=>'failure','msg'=>'product not added']);
}
}


