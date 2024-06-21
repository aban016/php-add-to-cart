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
        <h1 class="my-5 text-center fw-bold">Cart</h1>
        <a href="index.php" class="btn btn-secondary my-5">Back to Products</a>
        <div id="cartItems" class="row"></div>
        <h5 class="mt-5 fw-bold">Total Amount: $<span id="totalAmount">0</span></h5>
        <form id="orderForm" action="order.php" method="post">
            <input type="hidden" name="cartData" id="cartData">
            <input type="hidden" name="totalAmount" id="totalAmountInput">
            <button type="submit" class="btn btn-success mt-3" id="placeOrderButton">Place Order</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let cartItemsDiv = document.getElementById('cartItems');
            let totalAmount = 0;
            if (cart.length === 0) {
                cartItemsDiv.innerHTML = "<p>Your cart is empty.</p>";
                document.getElementById('placeOrderButton').disabled = true;
            } else {
                let cartHtml = '';
                cart.forEach((product, index) => {
                    totalAmount += product.price;
                    cartHtml += `
                        <div class="col-md-4" id="product-${index}">
                            <div class="card border-0 shadow p-2 mb-2">
                                <div class="card-body">
                                    <h5 class="card-title">${product.name}</h5>
                                    <p class="card-text">$${product.price}</p>
                                    <button class="btn btn-danger" onclick="removeFromCart(${index})">Remove</button>
                                </div>
                            </div>
                        </div>
                    `;
                });
                cartItemsDiv.innerHTML = cartHtml;
                document.getElementById('totalAmount').innerText = totalAmount;
                document.getElementById('totalAmountInput').value = totalAmount;
            }

            // Store cart data in a hidden input field
            document.getElementById('cartData').value = JSON.stringify(cart);
        });

        function removeFromCart(index) {
            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            cart.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cart));
            document.getElementById(`product-${index}`).remove();
            if (cart.length === 0) {
                document.getElementById('cartItems').innerHTML = "<p>Your cart is empty.</p>";
                document.getElementById('placeOrderButton').disabled = true;
            }

            // Update total amount and cart data in hidden input field
            let totalAmount = cart.reduce((sum, product) => sum + product.price, 0);
            document.getElementById('totalAmount').innerText = totalAmount;
            document.getElementById('totalAmountInput').value = totalAmount;
            document.getElementById('cartData').value = JSON.stringify(cart);
        }
    </script>

</body>

</html>
