<?php
session_start();
$con=mysqli_connect("localhost","root","","ecom");
define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/php/ecom/');
// define('SITE_PATH','http://127.0.0.1/php/ecom/');
define('SITE_PATH','http://localhost/The%20Spinster/repo_spinster/The-Spinster/Client%20side/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH','http://localhost/The%20Spinster/repo_spinster/The-Spinster/Client%20side/'.'media/product/');
?>