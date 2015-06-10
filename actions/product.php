<?php
if(!array_key_exists('p', $_GET)) {
    // index of products
    header('Location /products');
    return;
}

// we checked above, assume $_GET['p'] exists.
$productId = $_GET['p'];

$productSql = "SELECT * FROM products WHERE `id`='$productId'";
$productQuery = $db->query($productSql);
if(!$productQuery) {
    echo urldecode($_GET['p']) . ": That product doesn't exist";
    return;
}

$product = $productQuery->fetch_assoc();

foreach($product as $field=>$value) {
    //  A VERY crude display method.... there's no <style> in this whatsoever!
    //                                              ^^^^^ punny     <(-.-)>
    // crude catch for currency:
    if($field=='price') {
        $value = '$'.money_format('%.2n', $value/100);
    }
    ?>
    <p>
        <h4><?=$field;?></h4>
        <span><?=$value;?></span>
    </p>
    <?php
}
?>

<form action="/cart" method="post">
    <label for="quantty">Quantity:</label>
    <input type="text" name="quantity" />
    <input type="hidden" name="add" value="<?=$product['id'];?>" />
    <input type="submit" name="product" value="Add to cart">
</form>

<br>
<br>
<br>
<br>
<!-- please don't judge me! -->