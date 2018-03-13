<?php

include "connect.php";

$con = getConnectionQuery();
/* Check connection and get query */

function addNewOrder($user, $product, $quantity , $conn)
{
    $userID = mysqli_query($conn, "SELECT id FROM Users WHERE name='".$user."'");
    /* Get user Id by matching user name */
    if (!$userID) {
        $message  = 'Invalid query: ' . mysqli_error() . "\n";
        die($message); /* Check query error */
    }
    else
        $row = mysqli_fetch_assoc($userID);
        $idm = $row['id']; /* $idm for userID shorter version */
        $userID->close();
        $productID = mysqli_query($conn, "SELECT productID FROM Products WHERE productName='".$product."'");
        if (!$productID) {
            $message  = 'Invalid query: ' . mysqli_error() . "\n";
            die($message); /* Check query error */
        }
        else
            $row = mysqli_fetch_assoc($productID);
            $prm = $row['productID']; /* $prm for productID shorter version */
            $productID->close();
            $productPrice = mysqli_query($conn, "SELECT productPrice FROM  Products WHERE productID='".$prm."'");
            if (!$productPrice) {
                $message  = 'Invalid query: ' . mysqli_error() . "\n";
                die($message); /* Check query error */
            }
            else
                $row = mysqli_fetch_assoc($productPrice);
                $prc = $row['productPrice'];  /* $prc for productPrice shorter version */
                $productPrice->close();
                date_default_timezone_set('Europe/Tallinn'); /* set time zone */
                $date = date('Y-m-d H:i:s'); /* set time format */
                if($product=="Pepsi"&&$quantity>=3)
                {
                    $tAmount = ($quantity * $prc) * 0.8; /* special Discount for 'Pepsi' */
                }
                else
                {
                    $tAmount = ($quantity * $prc); /* totalAmount calculation under normal prices */
                }
                echo "<p>Total Cost is: " .$tAmount ."</p>"; /* Print Total Cost */

                $newOrderAddingQuery = mysqli_query($conn,"INSERT INTO OrderedProducts(productID,quantity, userID, totalAmount, regDate) VALUES('$prm','$quantity','$idm','$tAmount','$date')");
                if($newOrderAddingQuery)
                {
                    $message = "An Order was added succesfully!" ;
                    echo "<script type='text/javascript'>alert('$message');</script>";
                    /* Give a confirmation message to user */
                }
}
addNewOrder($_POST['user'], $_POST['product'],$_POST['quantity'],$con);
$con->close();
?>