<?php

/**
 * @return mysqli
 */
function getConnectionQuery()
{
    $servername = "localhost";
    $username = "root";
    $password = "root1234";
    $dbname = "miniOrder";

    $con = mysqli_connect($servername, $username, $password, $dbname);
    if (!$con)
    {
        die("Connection error: " . mysqli_connect_error());
    }
    else
    {
        return $con;
    }
}

?>