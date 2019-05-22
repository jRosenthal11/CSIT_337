<?php
session_start();
require 'config.php';
//session_destroy();

$productIDs = array();


if(isset($_POST['add_to_cart'])){
    if(isset($_SESSION['cart'])){
        $count = count($_SESSION['cart']);
        $productIDs = array_column($_SESSION['cart'], 'id');

        if(!in_array($_POST['id'], $productIDs)){
            $_SESSION['cart'][$count] = array(
                'id' => $_POST['id'],
                'name' => $_POST['name'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity']
            );
        }else{
            for ($i = 0; $i < count($productIDs); $i++){
                if($productIDs[$i] == $_POST['id']){
                    $_SESSION['cart'][$i]['quantity'] += $_POST['quantity'];
                }
            }
        }
    }else{
        $_SESSION['cart'][0] = array(
            'id' => $_POST['id'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity']
        );
    }
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpassword);
} catch(PDOException $pe){
    die("Could not connect to the database: ". $pe->getMessage());
}
$line = 'fishing line';
$HP = 'Hard Plastics';
$SP = 'Soft Plastics';
$hook = 'Hooks';
$weight = 'Weights';


$product_code = filter_input(INPUT_GET, 'product_code');
if ($product_code == NULL || $product_code == FALSE) {
    $product_code = $line;
}

$queryCode = 'SELECT * FROM products
					WHERE productCode = :product_code';

$Stmt = $pdo->prepare($queryCode);;
$Stmt->bindvalue(':product_code',$product_code);
$Stmt->execute();
$name = $Stmt->fetch();
$code_name = $name['productCode'];
$Stmt->closeCursor(); 

$queryCode2 = 'SELECT * FROM products
					WHERE productCode = :product_code';

$Stmt2 = $pdo->prepare($queryCode2);;
$Stmt2->bindvalue(':product_code',$product_code);
$Stmt2->execute();
$name2 = $Stmt2->fetchAll(PDO::FETCH_ASSOC);
$Stmt2->closeCursor(); 





?>
<!DOCTYPE html>
<html>

<head>
    <title>Hooked In</title>
    <h2>
        Welcome!
    </h2>

</html>
<style type="text/css">
    aside {
        float: left;
        width: 150px;
    }

    nav ul {
        list-style-type: none;
    }
</style>
</head>

<body>
    <h1>Hooked In</h1>
    <a href="logout.php"><button>Sign Out</button></a>
    <br>
    <br>
    <aside>
        <h2>Categories</h2>
        <nav>
            <ul>

                <li>
                    <a href="?product_code=<?php echo $line ?> ">
                        Fishing Line
                    </a>

                <li>
                    <a href="?product_code=<?php echo $HP?> ">
                        Hard Plastics
                    </a>

                <li>
                    <a href="?product_code=<?php echo $SP?> ">
                        Soft Plastics
                    </a>

                <li>
                    <a href="?product_code=<?php echo $hook?> ">
                        Hooks
                    </a>

                <li>
                    <a href="?product_code=<?php echo $weight?> ">
                        Weights
                    </a>
                </li>

            </ul>
        </nav>
    </aside>

    <h3>Products</h3>
    <h2>
        <?php echo $code_name; ?>
    </h2>
    <table>
        <tr>
            <td><strong>Item</strong></td>
            <td><strong>Price</strong></td>
            <td><strong>Quantity</strong></td>
            <td><strong>Add To Cart</strong></td>

        </tr>
        <?php foreach($name2 as $product){ ?>
        <form method="POST">
            <tr>
                <td>
                    <?php echo $product['itemName'];?>
                    <input type="hidden" name="name" value="<?php echo $product['itemName']; ?>"></input>
                </td>
                <td>$
                    <?php echo $product['price'];?>
                    <input type="hidden" name="price" value="<?php echo $product['price']; ?>"></input>
                    <input type="hidden" name="id" value="<?php echo $product['itemNum'];?>"></input>
                </td>
                <td>
                    <select name="quantity">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                </td>
                <td>
                    <button name="add_to_cart">Add to Cart</button>
                </td>
                <?php if($_SESSION['level']==2) {
                    echo'<td><a name="edit" href="modifyItem.php?edit="' .$product[' itemNum'] .'">Edit</a></td>';
                    }
                echo'
            </tr>';
            ?>
                <?php }?>
    </table>
    </form>
    <br><br>
    <?php if($_SESSION['level'] == 1){
             echo '<a href="insertuser.php"><button>Insert User</button></a><a href="insertitems.php"><button>Insert Items</button></a>';
             echo '<a href="deleteuser.php"><button>Delete User</button></a><a href="deleteitem.php"><button>Delete Items</button></a>';
            
        }
        if($_SESSION['level'] == 2){
            echo '<a href="employees.php"><button>Modify User</button></a>';

        }
        if($_SESSION['level'] == 3){
            echo '<a href="editItems.php"><button>Edit Items</button></a>';
        }
        ?>
    <?php

if(!empty($_SESSION['cart'])){ 
    $total = 0;
    ?>
    <h2>Cart</h2>
    <table>
        <tr>
            <td>Product Name</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Total</td>
            <td>Action</td>
        </tr>
        <?php foreach($_SESSION['cart'] as $key => $product){ ?>
        <td>
            <?php echo $product['name'];?>
        </td>
        <td>
            <?php echo $product['quantity']; ?>
        </td>
        <td>$
            <?php echo $product['price']; ?>
        </td>
        <td>$
            <?php echo number_format($product['quantity'] * $product['price'], 2); ?>
        </td>
        <td>
            <a href="home.php?action=delete&id=<?php echo $product['id']; ?>"><button>Remove</button></a>
        </td>
        <?php $total = $total + ($product['quantity'] * $product['price']);?>
        <?php }?>
    </table>
    <?php  }?>
</body>

</html>