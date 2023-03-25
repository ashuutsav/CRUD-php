<?php
header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json");
header("Access-Control-Allow-Methods:DELETE");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Request-With");
 
// error_reporting(0);
$data = json_decode(file_get_contents("php://input"));
// echo $data->productName;
include('db.php');

if(isset($data->id)){
    $query = "DELETE FROM products WHERE id= $data->id";
    $run = mysqli_query($db,$query);   
    
    if($run){
        echo json_encode(['status'=>'success','message'=>'deletion successfull']);
    }else{
        echo json_encode(['status'=>'failure','message'=>'deletion failure']);
    }
}else{
    echo json_encode(['status'=>'failure','msg'=>'product id not given']);
}