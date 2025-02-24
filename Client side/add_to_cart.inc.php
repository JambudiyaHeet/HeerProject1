<?php
class add_to_cart {
    function addProduct($pid, $qty) {
        $_SESSION['cart'][$pid]['qty'] = $qty;
    }

    function updateProduct($pid, $qty) {
        if (!empty($_SESSION['cart'][$pid])) {
            $_SESSION['cart'][$pid]['qty'] = $qty;
        }
    }

    function removeProduct($pid) {
        if(isset($_SESSION['cart'][$pid])) {
            unset($_SESSION['cart'][$pid]);
            error_log("Product $pid removed from cart");
        } else {
            error_log("Product $pid not found in cart");
        }
    }
    

    function emptyCart() {
        $_SESSION['cart'] = [];
    }

    function totalProducts() {
        if(isset($_SESSION['cart'])){
        return count($_SESSION['cart'] ?? []);
    }
    else{
        return 0;
    }
}
}
?>
