<?php

include "connect.php";

$con = getConnectionQuery();
/* Check connection and get query */

function getUsers($conn)
{
    $users = mysqli_query($conn,"SELECT name FROM Users");
    /* Take all user names */

    while($row = mysqli_fetch_array($users,MYSQLI_ASSOC))
    {
        $name = $row["name"];
        /* Take rows by name -name- */
        echo "<option role=\"option\" value=\"$name\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\">".$name."</a></option>";
        /* Creating new option dropdowns */
    }
}
function getUserName($conn, $id)
{
    $users = mysqli_query($conn,"SELECT name FROM Users WHERE id='".$id."'");
    /* Take all user names by userID matching */
    while($row = mysqli_fetch_array($users,MYSQLI_ASSOC))
    {
        $name = $row["name"];
        /* Take rows by name -name- */
    }
    return $name;    /* return the name */
}
function getUserID($conn, $name)
{
    $users = mysqli_query($conn,"SELECT id FROM Users WHERE name='".$name."'");
    /* Take all user IDs by product Name matching */
    while($row = mysqli_fetch_array($users,MYSQLI_ASSOC))
    {
        $id = $row["id"];
        /* Take rows by id -id- */
    }
    return $id;  /* return the id */
}
getUsers($con);
?>