<?php

require('top.php');

if (!isset($_SESSION['USER_LOGIN'])) {
    echo "<script>window.location.href='index.php';</script>";
    exit();
}



$uid = $_SESSION['USER_ID']; // Now it is safe to use
?>


<?php
require_once('top.php');
if (!isset($_SESSION['USER_LOGIN'])) {
    ?>
    <script>
        window.location.href = 'index.php';
    </script>
    <?php
}
?>
<div class="ht__bradcaump__area"
    style="background: rgba(0, 0, 0, 0) url(images/bg/4.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Thank You</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="wishlist-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">
                    <form action="#">
                        <div class="wishlist-table table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Order ID</th>
                                        <th class="product-name"><span class="nobr">Order Date</span></th>
                                        <th class="product-price"><span class="nobr"> Address </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment Type </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Payment Status </span></th>
                                        <th class="product-stock-stauts"><span class="nobr"> Order Status </span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // echo "<pre>";
                                    // print_r($_SESSION);
                                    // echo "</pre>";

                                    $uid = $_SESSION['USER_ID'];
                                    $res = mysqli_query($con, "SELECT `order`.*, order_status.name AS order_status_str 
                                                            FROM `order` 
                                                            INNER JOIN order_status ON `order`.order_status = order_status.id 
                                                            WHERE `order`.user_id = '$uid' 
                                                            ORDER BY `order`.id DESC;
                                                            ");
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                        <tr>
                                            <td class="product-add-to-cart"><a
                                                    href="my_order_details.php?id=<?php echo $row['id'] ?>">
                                                    <?php echo $row['id'] ?></a>
                                                <br />
                                            </td>
                                            <td class="product-name"><?php echo $row['added_on'] ?></td>
                                            <td class="product-name">
                                                <?php echo $row['address'] ?><br />
                                                <?php echo $row['city'] ?><br />
                                                <?php echo $row['pincode'] ?>
                                            </td>
                                            <td class="product-name"><?php echo $row['payment_type'] ?></td>
                                            <td class="product-name"><?php echo ucfirst($row['payment_status']) ?></td>
                                            <td class="product-name"><?php echo $row['order_status_str'] ?></td>

                                        </tr>
                                    <?php } ?>
                                </tbody>

                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require('footer.php') ?>