<?php

$name = $_POST['name'];
$prefix = $_POST["prefix"];
$email_address = $_POST['email_address'];
$phone_number = $_POST['phone_number'];
$rating = $_POST['rating'];
$comments = $_POST['comments'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Ex-1</title>
</head>
<body>
    <main>
        <p>Thank you, <span><?php echo $prefix . ' ' . $name; ?></span>, for your comments</p>
        <p>Your email address is <span><?php echo $email_address; ?></span> and your phone number is <span><?php echo $phone_number; ?> </span></p>
        <p>You state that you found this example to be<span> <?php echo $rating; ?></span>
        and added: <span> <?php echo $comments; ?> </span> </p>
    </main>
    
</body>
</html>