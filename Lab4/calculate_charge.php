<?php

$price = $_POST['price'];
$quantity = $_POST['quantity'];
$discount = $_POST['discount'];
$tax = $_POST['tax'];
$shipping_method = $_POST['shipping_method'];
$payments = $_POST['payments'];

$total = ($quantity * $price) - $discount + $shipping_method;
$total = $total * (1 + ($tax / 100));
$per_month = $total / $payments;

?>

<!DOCTYPE html>
<html>
<head>
    
    <title>Ex-2</title>

</head>
<body>
    <main>
        <p>You have selected to purchase: </p>
        <p><Strong><?php echo $quantity; ?></Strong> widget(s) at</p>
        <p>$<Strong><?php echo $price; ?></Strong> price each plus a</p>
        <p>$<Strong><?php echo $shipping_method; ?></Strong> shipping method and a</p>
        <p><Strong><?php echo $tax; ?></Strong> percent tax rate</p>
        <p>After your $<Strong><?php echo $discount; ?></Strong> discount, the total cost is $<Strong><?php echo $total; ?></Strong> </p>
        <p>Divided over <Strong><?php echo $payments; ?></Strong> monthly payments, that would be $<Strong><?php echo $per_month; ?></Strong> each. </p>

    </main>
    
</body>
</html>