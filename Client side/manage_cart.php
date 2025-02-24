<?php
require_once('connection.inc.php');
require_once('functions.inc.php');
require_once('add_to_cart.inc.php');

$pid=get_safe_value($con,$_POST['pid']);
$qty=get_safe_value($con,$_POST['qty']);
$type=get_safe_value($con,$_POST['type']);

$productSoldQtyByProductId=productSoldQtyByProductId($con,$pid);
$productQty=productQty($con,$pid);

$pending_qty=$productQty-$productSoldQtyByProductId;

if($qty>$pending_qty){
	echo "not_avaliable";
	die();
}

$obj=new add_to_cart();

if($type=='add'){
	$obj->addProduct($pid,$qty);
}

if($type=='remove'){
	$obj->removeProduct($pid);
}

if($type == 'update'){
    $obj->updateProduct($pid, $qty);
    
    // Get updated subtotal
    $productArr = get_product($con, '', '', $pid);
    $price = $productArr[0]['price'];
    $subtotal = $price * $qty;

    // Return JSON response
    echo json_encode([
        "totalProducts" => $obj->totalProducts(), // Corrected variable
        "subtotal" => $subtotal
    ]);
    die();
}

echo $obj->totalProducts();
?>