<?php
session_start();
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login</title>
</head>

<body>
    <h1>Good Job! <?php echo $firstName . ' ' . $lastName?> Successfully Login!!</h1>

</body>

</html>