<?php

$con = new mysqli("localhost", "root", "", "db_cart");

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>