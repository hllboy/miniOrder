<?php
/**
 * Created by PhpStorm.
 * User: utku
 * Date: 09/03/2018
 * Time: 20:17
 */

include "getUsers.php";
include "getProducts.php";

$con = getConnectionQuery();
/* Check connection and get query */

function resultPrinterInHTML($user, $product, $price, $quantity, $total, $date, $orderID)
{
    /* Results are being printed row by row and inside a bootstrap panel */
    echo "<head>";
    echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>";
    echo "</head>";
    echo "<div class='row'>";
    echo "<div class='col-sm-12'>";
    echo "<div class='container'>";
    echo "<div class='panel panel-primary'>";
    echo "<div class='panel-heading'>Order</div>";
    echo "<table class='table'>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>User</th>";
    echo "<th>Product</th>";
    echo "<th>Price</th>";
    echo "<th>Quantity</th>";
    echo "<th>Total</th>";
    echo "<th>Date</th>";
    echo "<th>Actions</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    echo "<tr class='success'>";
    echo "<td>$user</td>";
    echo "<td>$product</td>";
    echo "<td>$price</td>";
    echo "<td>$quantity</td>";
    echo "<td>$total</td>";
    echo "<td>$date</td>";
    echo "<td>";
    echo "<a href='editOrder.php?id=".$orderID."&name=".$user."'><button type='button' class='btn btn-warning'>Edit</button></a>";
    echo "<a href='orderChanges.php?delete=true&id=".$orderID."'><button type='button' class='btn btn-danger'>Delete</button></a>";
    /* Delete and Edit buttons are created for trigger other php pages and added GET methods to urls */
    echo "</td>";
    echo "</tr>";
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}

function search( $pDate, $sKey, $conn)
{
    if($sKey==null) {
        if ($pDate == "Today") {
            $today = date("Y-m-d");
            $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE regDate='".$today."' ORDER BY regDate DESC");

            /* Take Today's Orders */
            if(mysqli_num_rows($results) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                $uID = $row["userID"];
                $userName = getUserName($conn, $uID);
                $pID = $row["productID"];
                $productName = getProductName($conn, $pID);
                $price = getProductPrice($conn, $pID);
                $quantity = $row["quantity"];
                $total = $row["totalAmount"];
                $rDate = $row["regDate"];

                resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
            }
        } else if ($pDate == "Week") {
            $now = new DateTime();
            $computeDate = $now->modify('-7 day')->format('Y-m-d'); /* Today's date is modified by 7 days ago*/

            $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE regDate>'".$computeDate."' ORDER BY regDate DESC");
            /* Take 7 Day's Orders */
            if(mysqli_num_rows($results) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                $uID = $row["userID"];
                $userName = getUserName($conn, $uID);
                $pID = $row["productID"];
                $productName = getProductName($conn, $pID);
                $price = getProductPrice($conn, $pID);
                $quantity = $row["quantity"];
                $total = $row["totalAmount"];
                $rDate = $row["regDate"];

                resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
            }
        } else if ($pDate == "Month") {
            $now = new DateTime();
            $computeDate = $now->modify('-1 month')->format('Y-m-d'); /* Today's date is modified by 1 month ago*/

            $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE regDate>'".$computeDate."' ORDER BY regDate DESC");
            /* Take Month's Orders */
            if(mysqli_num_rows($results) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                $uID = $row["userID"];
                $userName = getUserName($conn, $uID);
                $pID = $row["productID"];
                $productName = getProductName($conn, $pID);
                $price = getProductPrice($conn, $pID);
                $quantity = $row["quantity"];
                $total = $row["totalAmount"];
                $rDate = $row["regDate"];

                resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
            }
        } else if ($pDate == "All") {
            $results = mysqli_query($conn, "SELECT * FROM OrderedProducts ORDER BY regDate DESC");
            /* Take All Orders */
            if(mysqli_num_rows($results) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                $uID = $row["userID"];
                $userName = getUserName($conn, $uID);
                $pID = $row["productID"];
                $productName = getProductName($conn, $pID);
                $price = getProductPrice($conn, $pID);
                $quantity = $row["quantity"];
                $total = $row["totalAmount"];
                $rDate = $row["regDate"];

                resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
            }
        }
    }
    else{
        /* If user searches by product name or user name */
        if ($pDate == "Today") {
            $today = date("Y-m-d");
            $checker = mysqli_query($conn, "SELECT name FROM Users INNER JOIN OrderedProducts ON Users.id = OrderedProducts.userID");
            if(mysqli_num_rows($checker) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while($row = mysqli_fetch_array($checker, MYSQLI_ASSOC))
            {
                if($sKey==$row["name"])
                {
                    $usersID = getUserID($conn,$row["name"]);
                    $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE regDate='".$today."' AND userID='".$usersID."' ORDER BY regDate DESC");
                    /* Take Today's Orders by user name match */
                    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {

                        $uID = $row["userID"];
                        $userName = getUserName($conn, $uID);
                        $pID = $row["productID"];
                        $productName = getProductName($conn, $pID);
                        $price = getProductPrice($conn, $pID);
                        $quantity = $row["quantity"];
                        $total = $row["totalAmount"];
                        $rDate = $row["regDate"];

                        resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
                    }
                }
            }
            $checker = mysqli_query($conn, "SELECT productName FROM Products INNER JOIN OrderedProducts ON Products.productID = OrderedProducts.productID");
            if(mysqli_num_rows($checker) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while($row = mysqli_fetch_array($checker, MYSQLI_ASSOC))
            {
                if($sKey==$row["productName"])
                {
                    $productsID = getProductID($conn,$row["productName"]);
                    $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE regDate='".$today."' AND productID='".$productsID."' ORDER BY regDate DESC");
                    /* Take Today's Orders by product name match */
                    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                        $uID = $row["userID"];
                        $userName = getUserName($conn, $uID);
                        $pID = $row["productID"];
                        $productName = getProductName($conn, $pID);
                        $price = getProductPrice($conn, $pID);
                        $quantity = $row["quantity"];
                        $total = $row["totalAmount"];
                        $rDate = $row["regDate"];

                        resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
                    }
                }
            }

        } else if ($pDate == "Week") {
            $now = new DateTime();
            $computeDate = $now->modify('-7 day')->format('Y-m-d');

            $checker = mysqli_query($conn, "SELECT name FROM Users INNER JOIN OrderedProducts ON Users.id = OrderedProducts.userID");
            if(mysqli_num_rows($checker) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while($row = mysqli_fetch_array($checker, MYSQLI_ASSOC))
            {
                if($sKey==$row["name"])
                {
                    $usersID = getUserID($conn,$row["name"]);
                    $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE regDate>'".$computeDate."' AND userID='".$usersID."' ORDER BY regDate DESC");
                    /* Take 7 Days' Orders by user name match */
                    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                        $uID = $row["userID"];
                        $userName = getUserName($conn, $uID);
                        $pID = $row["productID"];
                        $productName = getProductName($conn, $pID);
                        $price = getProductPrice($conn, $pID);
                        $quantity = $row["quantity"];
                        $total = $row["totalAmount"];
                        $rDate = $row["regDate"];

                        resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
                    }
                }
            }
            $checker = mysqli_query($conn, "SELECT productName FROM Products INNER JOIN OrderedProducts ON Products.productID = OrderedProducts.productID");
            if(mysqli_num_rows($checker) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while($row = mysqli_fetch_array($checker, MYSQLI_ASSOC))
            {
                if($sKey==$row["productName"])
                {
                    $productsID = getProductID($conn,$row["productName"]);
                    $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE regDate>'".$computeDate."' AND productID='".$productsID."' ORDER BY regDate DESC");
                    /* Take 7 Days' Orders by product name match */
                    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                        $uID = $row["userID"];
                        $userName = getUserName($conn, $uID);
                        $pID = $row["productID"];
                        $productName = getProductName($conn, $pID);
                        $price = getProductPrice($conn, $pID);
                        $quantity = $row["quantity"];
                        $total = $row["totalAmount"];
                        $rDate = $row["regDate"];

                        resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
                    }
                }
            }
        } else if ($pDate == "Month") {
            $now = new DateTime();
            $computeDate = $now->modify('-1 month')->format('Y-m-d');

            $checker = mysqli_query($conn, "SELECT name FROM Users INNER JOIN OrderedProducts ON Users.id = OrderedProducts.userID");
            if(mysqli_num_rows($checker) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while($row = mysqli_fetch_array($checker, MYSQLI_ASSOC))
            {
                if($sKey==$row["name"])
                {
                    $usersID = getUserID($conn,$row["name"]);
                    $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE regDate>'".$computeDate."' AND userID='".$usersID."' ORDER BY regDate DESC");
                    /* Take 1 Month's Orders by user name match */
                    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                        $uID = $row["userID"];
                        $userName = getUserName($conn, $uID);
                        $pID = $row["productID"];
                        $productName = getProductName($conn, $pID);
                        $price = getProductPrice($conn, $pID);
                        $quantity = $row["quantity"];
                        $total = $row["totalAmount"];
                        $rDate = $row["regDate"];

                        resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
                    }
                }
            }
            $checker = mysqli_query($conn, "SELECT productName FROM Products INNER JOIN OrderedProducts ON Products.productID = OrderedProducts.productID");
            if(mysqli_num_rows($checker) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while($row = mysqli_fetch_array($checker, MYSQLI_ASSOC))
            {
                if($sKey==$row["productName"])
                {
                    $productsID = getProductID($conn,$row["productName"]);
                    $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE regDate>'" .$computeDate."' AND productID='".$productsID."' ORDER BY regDate DESC");
                    /* Take 1 Month's Orders by product name match */
                    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                        $uID = $row["userID"];
                        $userName = getUserName($conn, $uID);
                        $pID = $row["productID"];
                        $productName = getProductName($conn, $pID);
                        $price = getProductPrice($conn, $pID);
                        $quantity = $row["quantity"];
                        $total = $row["totalAmount"];
                        $rDate = $row["regDate"];

                        resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
                    }
                }
            }
        } else if ($pDate == "All") {
            $checker = mysqli_query($conn, "SELECT name FROM Users INNER JOIN OrderedProducts ON Users.id = OrderedProducts.userID");
            if(mysqli_num_rows($checker) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while($row = mysqli_fetch_array($checker, MYSQLI_ASSOC))
            {
                if($sKey==$row["name"])
                {
                    $usersID = getUserID($conn,$row["name"]);
                    $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE userID='".$usersID."' ORDER BY regDate DESC");
                    /* Take All Orders by user name match */
                    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                        $uID = $row["userID"];
                        $userName = getUserName($conn, $uID);
                        $pID = $row["productID"];
                        $productName = getProductName($conn, $pID);
                        $price = getProductPrice($conn, $pID);
                        $quantity = $row["quantity"];
                        $total = $row["totalAmount"];
                        $rDate = $row["regDate"];

                        resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
                    }
                }
            }
            $checker = mysqli_query($conn, "SELECT productName FROM Products INNER JOIN OrderedProducts ON Products.productID = OrderedProducts.productID");
            if(mysqli_num_rows($checker) ==0)
            {
                $message = "Your search criteria did not match any orders";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
            while($row = mysqli_fetch_array($checker, MYSQLI_ASSOC))
            {
                if($sKey==$row["productName"])
                {
                    $productsID = getProductID($conn,$row["productName"]);
                    $results = mysqli_query($conn, "SELECT * FROM OrderedProducts WHERE productID='".$productsID."' ORDER BY regDate DESC");
                    /* Take All Orders by product name match */
                    while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
                        $uID = $row["userID"];
                        $userName = getUserName($conn, $uID);
                        $pID = $row["productID"];
                        $productName = getProductName($conn, $pID);
                        $price = getProductPrice($conn, $pID);
                        $quantity = $row["quantity"];
                        $total = $row["totalAmount"];
                        $rDate = $row["regDate"];

                        resultPrinterInHTML($userName,$productName,$price,$quantity,$total,$rDate,$row["orderedID"]);
                    }
                }
            }
        }
    }
}
search($_POST['interval'],$_POST['key'], $con);

$con->close();
?>