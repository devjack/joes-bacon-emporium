<?php

// If we're adding to the cart (and it's actually an ID);
if(array_key_exists('add', $_REQUEST) && is_numeric($_REQUEST['add'])
  && array_key_exists('quantity', $_REQUEST) && is_numeric($_REQUEST['quantity'])) {
    $productToAdd = (int) $_REQUEST['add'];
    $quantityToAdd = (int) $_REQUEST['quantity'];
    // add a product to the cart;
    $cart = [];
    if(array_key_exists('cart', $_SESSION)) {
        // persist the current cart.
        $cart = $_SESSION['cart'];
    }

    // format:  id => quantity;

    if(array_key_exists($productToAdd, $cart)){
        // there's already some of that in the cart, just add more.
        $message = "Increased quantity to ".$cart[$productToAdd];
        $cart[$productToAdd] += $quantityToAdd;
    }
    else {
        // make sure its an actual product;
        $productSql = "SELECT * FROM products WHERE id='$productToAdd'";
        $productQuery = $db->query($productSql);
        if(!$productQuery || $productQuery->num_rows < 1) {
            // product wasn't in the database;
            $message = "That product doesn't exist";
        }

        // we keep going, since its a legitimate product;
        $cart[$productToAdd] = $quantityToAdd;
    }

    // Make sure we save any updates to the cart.
    $_SESSION['cart'] = $cart;
}

/**
 * If we're trying to remove from cart
 */
if(array_key_exists('remove', $_GET) && is_numeric($_GET['remove'])) {
    // try and remove it from the cart.
    if(array_key_exists('cart', $_SESSION)) {
        unset($_SESSION['cart'][$_GET['remove']]);
    }
}


if(!array_key_exists('cart', $_SESSION)) {
    // no shopping cart.
    echo "<h2>You don't have any items in the cart yet.</h2>";
    return;
}


/**
 * Now process the cart for displaying, including the various product metadata
 */

$productIdsInCart = array_keys($_SESSION['cart']);
$productDataSql = "SELECT * FROM products WHERE id IN('".implode("', '", $productIdsInCart)."')";
$productDataQuery = $db->query($productDataSql);

$runningTotal = 0;
$cart = [];

while($productDataFromCart = $productDataQuery->fetch_assoc()) {
    // Bring DB metadata and quantity into one entity to display.
    $mergedProductData = array_merge(['quantity'=>$_SESSION['cart'][$productDataFromCart['id']]], $productDataFromCart);
    $cart[$productDataFromCart['id']] = $mergedProductData;

    $runningTotal += $mergedProductData['price']/100 * $mergedProductData['quantity'];
}

if(empty($cart)) {
    echo "<h3>There are no items in the cart</h3>";
    return;
}

foreach($cart as $item): ?>
    <li>
        <h4><?=$item['title'];?></h4>
        <span>$<?=sprintf('%.2f', $item['price']*$item['quantity']/100);?> per unit.</span>
        <span><?=$item['quantity'];?>x in cart.</span>
        <a href="cart?remove=<?=$item['id'];?>">Remove from cart.</a>
    </li>
<?php endforeach;?>


<h3> TOTAL: $<?=sprintf('%.2f', $runningTotal);?></h3>

