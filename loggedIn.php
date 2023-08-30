<html>
    <body>
        <h5>Welcome to the log-in page!</h5>
        <br>

<?php
session_start();
require_once 'C:\Users\Lunkm\Reward System Test\dataBaseConnect.php';

function priceCheck($productName, $conn){
    $name = $_SESSION['userName'];
    $price = 30;//intval($conn->query("SELECT price FROM products WHERE name = '$productName'")[0]);
    $balance = 40;//intval($conn->query("SELECT points FROM users WHERE username = '$name'")[0]);
    if($balance > $price){
        $newBal = $balance - $price;
        $conn->query("UPDATE users SET points = $newBal WHERE username = '$name");
        echo("Redeemed!");
        return true;
    } else {
        echo("YOU HAVE NO MONEY!!!");
        return false; 
    }
}
?>




<?php
$name = $_SESSION['userName'];
echo("Weclome $name");


?>

    <br>
    <form method="post">
        <input type="submit" name="test" id="test" value="RUN" /><br/>
    </form>

<?php
if(array_key_exists('test', $_POST)){
    priceCheck('Huge blanket', $conn);
}

?>
    </body>
</html>