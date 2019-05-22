<?php

$dsn = 'mysql:host=localhost;dbname=products';
$username = 'iw3htp';
$password = 'password';

$querySelected = $_POST['query'];

//Creates new PDO object
try {
    $db = new PDO($dsn, $username, $password);

    $query = 'SELECT ' . $querySelected . ' FROM books';
    $statement = $db->prepare($query);
    $statement->execute();

} catch (PDOException $e) {
    $error_message = $e->getMessage();
}
$valuesStored = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Database Query</title>
</head>
<style>
    table {
        border-collapse: collapse;
        border: 1px solid black;
    }
</style>

<body>
    <h3>Results of "
        <?php echo $query; ?>"</h3>
    <table>
        <?php $x = 0;?>
        <?php foreach ($valuesStored as $row): ?>
        <tr>
            <?php foreach ($row as $cell): ?>
            <?php if ($x % 2 != 0) {
    $color = "#ADD8E6";
} else {
    $color = "#FFFFFF";
}

?>
            <?php echo '<td bgcolor="' . $color . '">' . $cell . '</td>'; ?>
            <?php endforeach;?>
            <?php $x++;?>
        </tr>
        <?php endforeach;?>
    </table>
    <p>Your search yielded
        <?php echo count($valuesStored) ?> results</p>
    <p>Thank you for using our database</p>


</body>

</html>