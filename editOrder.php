<html>
<head>
    <meta charset="utf-8">
    <title>Order Assignment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-light bg-light">
    <span class="navbar-brand mb-0 h1"></span>
</nav>
<!-- New Order-->
<div class="container" script="position: absolute; top: 50%; left: 50%; transform: translateX(-50%) translateY(-50%);">
    <div class="panel panel-info">
        <div class="panel-heading">Edit Order</div>
        <table class="table">
            <form target="transFrame" action="<?php $id=$_GET['id']; echo "orderChanges.php?edit=true&id=$id"; ?>" method="post" id="orderForm">
                <!-- Edit form action sender also send GET data to orderChanges.php -->
                <tr>
                    <td>The order owner</td>
                    <td>
                        <?php echo $_GET['name']; ?>
                    </td>
                </tr>
                <tr>
                    <td>User</td>
                    <td>
                        <select role="menu" name="user" aria-labelledby="menu1">
                            <?php
                            include "getUsers.php";
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Product</td>
                    <td>
                        <select  role="menu" name="product" aria-labelledby="menu1">
                            <?php
                            include "getProducts.php";
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>
                        <select role="menu" name="quantity" aria-labelledby="menu1">
                            <?php
                                for($i=1;$i<21;$i++)
                                {
                                    echo "<option role=\"option\" value=".$i."><a role=\"menuitem\" tabindex=\"-1\" href=\"#\">".$i."</a></option>";
                                    /* Option creator for quantity */
                                }
                            ?>
                        </select>
                    </td>
                </tr>
            </form>
            <tr>
                <td>
                    <div class="col-sm-4">
                       <button type='submit' form='orderForm' value='Edit' class='btn btn-primary btn-md btn-block'>Edit</button>
                    </div>
                </td>
                <td>
                    <iframe style="" frameborder="0" border="0" padding="0" width="300" height="30" name="transFrame" id="transFrame">

                    </iframe>
                </td>
            </tr>
            </thead>
        </table>
    </div>
</div>
</body>
</html>

