<?php
include "getUsers.php";
include "getProducts.php";

$con = getConnectionQuery();
/* Check connection and get query */
function deleteOrder($orderID, $conn)
{
    $lineDelete = mysqli_query($conn,"DELETE FROM OrderedProducts WHERE orderedID ='".$orderID."'");
    /* Delete query was ran */
    if($lineDelete)
    {
        $message = "The Order was deleted succesfully!" ;
        echo "<script type='text/javascript'>alert('$message');</script>";
        /* Give a confirmation message to user */
    }
}
function editOrder($orderID,$userName, $productName, $quantity, $conn)
{
    $userID = getUserID($conn, $userName);
    $productID = getProductID($conn, $productName);

    $prc = getProductPrice($conn, $productID);
    if($productName=="Pepsi"&&$quantity>=3)
    {
        $tAmount = ($quantity * $prc) * 0.8;
    }
    else
    {
        $tAmount = ($quantity * $prc);
    }
    $lineEdit = mysqli_query($conn,"UPDATE OrderedProducts SET productID='".$productID."' ,quantity='".$quantity."', userID='".$userID."', totalAmount='".$tAmount."' WHERE orderedID ='".$orderID."'");
    /* Update query was ran */
    if($lineEdit)
    {
        $message = "The Order was edited succesfully!";
        echo "<script type='text/javascript'>alert('$message');</script>";
        /* Give a confirmation message to user */
    }
}
if (isset($_GET['edit'])) {
    editOrder($_GET['id'], $_POST['user'], $_POST['product'],$_POST['quantity'],$con);
    /* Call edit function by GET */
}
else if(isset($_GET['delete']))
{
    deleteOrder($_GET['id'],$con);
    /* Call delete function by GET */
}

?>