<?php

$con = getConnectionQuery();
/* Check and get Connection */

function getProducts($conn)
{
    $users = mysqli_query($conn,"SELECT productName FROM Products");
    /* Take all product names */

    while($row = mysqli_fetch_array($users,MYSQLI_ASSOC))
    {
        $pName = $row["productName"];
        /* Take rows by name -productName- */

        echo "<option role=\"option\" value=\"$pName\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\">".$pName."</a></option>";
        /* Creating new options dropdowns */
    }
}
function getProductName($conn, $pID)
{
    $users = mysqli_query($conn,"SELECT productName FROM Products WHERE productID='".$pID."'");
    /* Take all product names by productID matching */
    while($row = mysqli_fetch_array($users,MYSQLI_ASSOC))
    {
        $pName = $row["productName"];
        /* Take rows by name -productName- */
    }
    return $pName; /* Return the product name */
}
function getProductPrice($conn, $pID)
{
    $users = mysqli_query($conn,"SELECT productPrice FROM Products WHERE productID='".$pID."'");
    /* Take all productPrices by productID matching */

    while($row = mysqli_fetch_array($users,MYSQLI_ASSOC))
    {
        $price = $row["productPrice"];
        /* Take rows by price -productPrice- */
    }
    return $price; /* Return the price */
}
function getProductID($conn, $pName)
{
    $users = mysqli_query($conn,"SELECT productID FROM Products WHERE productName='".$pName."'");
    /* Take all product IDs by product Name matching */
    while($row = mysqli_fetch_array($users,MYSQLI_ASSOC))
    {
        $proID = $row["productID"];
        /* Take rows by id -productID- */
    }
    return $proID; /* Return the ID */
}
getProducts($con);
?>