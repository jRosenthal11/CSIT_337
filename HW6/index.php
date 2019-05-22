<?php

//$dsn = 'mysql:host=localhost;dbname=csit101';
$username = 'super';
$password = 'super';

$db = new PDO('mysql:host=localhost;dbname=csit101', $username, $password);

if (isset($_POST['submit'])) {

    session_start();
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $isValidAccount = false;

    $query = 'SELECT * FROM administrators';
    $statement = $db->prepare($query);
    $statement->execute();

    $accounts = $statement->fetchAll(PDO::FETCH_ASSOC);

    foreach ($accounts as $account) {

        if ($email == $account['email'] && $pass == $account['password']) {

            $_SESSION['firstName'] = $account['firstName'];
            $_SESSION['lastName'] = $account['lastName'];
            $isValidAccount = true;
        }
    }
    if ($isValidAccount) {
        header("Location: login.php");
    } else {
        echo "<p>Error: Invalid credential, you must correctly login to view this site</p>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Ex-1</title>
</head>

<body>
    <form action="index.php" method="POST">
        <h1>Welcome to CSIT web site</h1>
        <h1>Please Login</h1>
        <table>
            <tr>
                <td>Email:</td>
                <td><input type="text" name="email" placeholder="youremail@email.com"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><input type="password" name="password" placeholder="password"></td>
            </tr>

        </table>
        <button type="submit" name="submit">Login</button> <br>

    </form>
</body>

</html>
<?php
echo "<p>You must login to view this site</p>";
?>