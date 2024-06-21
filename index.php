<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Shopping Cart</title>
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto">
                    <a class="nav-link active mx3" aria-current="page" href="index.php">Home</a>
                    <a class="nav-link mx-3 btn btn-primary text-white" href="cart.php">Cart</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h1 class="my-5 text-center fw-bold">Shopping Cart</h1>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <?php
            $package_query = "SELECT * FROM `tbl_packages`";
            $package_result = mysqli_query($con, $package_query);

            if (mysqli_num_rows($package_result) > 0) {
                while ($package_row = mysqli_fetch_assoc($package_result)) {
            ?>
                <div class="col-md-4">
                    <div class="card border-0 shadow p-2">
                        <div class="card-body">
                            <h5 class="card-title"><?= $package_row['p_name'] ?></h5>
                            <p class="card-text">$<?= $package_row['p_price'] ?></p>
                            <button class="btn btn-primary" onclick="addToCart(<?= $package_row['p_id'] ?>, '<?= $package_row['p_name'] ?>', <?= $package_row['p_price'] ?>)">Add to cart</button>
                        </div>
                    </div>
                </div>
            <?php
                }
            } else {
                echo "No packages found.";
            }
            ?>
        </div>
    </div>

    <script>
        function addToCart(id, name, price) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let product = { id, name, price };
            cart.push(product);
            localStorage.setItem('cart', JSON.stringify(cart));
            alert(name + " has been added to your cart!");
        }
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.0/js/bootstrap.min.js"></script>
</body>

</html>