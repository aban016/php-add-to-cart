<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartData = json_decode($_POST['cartData'], true);
    $totalAmount = $_POST['totalAmount'];

    foreach ($cartData as $product) {
        $p_id = $product['id'];
        $p_price = $product['price'];

        $query = "INSERT INTO `tbl_orders`(`o_package_id`, `o_total_price`) VALUES ('$p_id','$p_price')";
        mysqli_query($con, $query);
    }

    echo "<script>
        localStorage.removeItem('cart');
        alert('Order placed successfully!');
        window.location.href = 'index.php';
    </script>";
}

?>
