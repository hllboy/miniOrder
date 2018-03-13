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
            <div class="panel-heading">Add New Order</div>
            <table class="table">
                <form target="transFrame" action="AddNewOrder.php" method="post" id="orderForm">
                    <tr>
                        <td>User</td>
                        <td>
                            <select role="menu" name="user" aria-labelledby="menu1">
                                <?php
                                    include "getUsers.php"; /* Getting users from database*/
                                ?>
                            </select>
                       </td>
                    </tr>
                    <tr>
                        <td>Product</td>
                        <td>
                            <select  role="menu" name="product" aria-labelledby="menu1">
                                <?php
                                    include "getProducts.php"; /* Getting products from database*/
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
                                        /* Creating quantity options*/
                                        echo "<option role=\"option\" value=".$i."><a role=\"menuitem\" tabindex=\"-1\" href=\"#\">".$i."</a></option>";
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                </form>
                    <tr>
                        <td>
                            <div class="col-sm-4">
                                <button type="submit" form="orderForm" value="Add" class="btn btn-primary btn-md btn-block" >Add</button>
                                <!-- Trigger button for submitting add new order form -->
                            </div>
                        </td>
                        <td>
                            <iframe style="" frameborder="0" border="0" padding="0" width="300" height="30" name="transFrame" id="transFrame"></iframe>
                            <!-- iframe total cost printing -->
                        </td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div>
    <!-- Search Box -->
    <div class="container">
        <div class="panel panel-warning">
            <div class="panel-heading">Search</div>
                <table class="table">
                    <form action="searchInList.php" method="post" target="results">
                    <thead>
                        <tr>
                            <td>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="dropdown">
                                            <select  role="menu" name="interval" aria-labelledby="menu1">
                                                <option role="option" value="Today"><a role="menuitem" tabindex="-1" href="#">Today</a></option>;
                                                <option role="option" value="Week"><a role="menuitem" tabindex="-1" href="#">7 Days</a></option>;
                                                <option role="option" value="Month"><a role="menuitem" tabindex="-1" href="#">1 Month</a></option>;
                                                <option role="option" value="All"><a role="menuitem" tabindex="-1" href="#">All Time</a></option>;
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-sm-12">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="key" placeholder="Search">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-default" type="submit" >
                                                        <i class="glyphicon glyphicon-search"></i>
                                                    </button>
                                                    <!-- Trigger button for searching orders by date, user names or product names-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </thead>
                    </form>
                </table>
            </div>
        </div>
    </div>
    <div id="frame">
        <iframe src="http://www.w3schools.com" onload="this.width=screen.width;this.height=screen.height;" frameborder="0" border="0" padding="0" height="100%" width="100%" name="results">
        </iframe>
    </div>

</body>
</html>
