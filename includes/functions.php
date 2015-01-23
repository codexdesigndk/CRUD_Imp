<?php

include_once 'db_connection.php';


/**
 * @param $table_name (Fetches tablename)
 * @param $content  (Fetches content to insert)
 */
function CreateItem($table_name, $content)
{
    global $connection;

    // build query...
    $sql  = "INSERT INTO " . $table_name . "";

    // implode keys of array ($content) for column names...
    $sql .= " (".implode(", ", array_keys($content)).")";

    // implode values of array ($content) for column values...
    $sql .= " VALUES ('".implode("', '", $content)."') ";

    // execute query...
    mysqli_query($connection, $sql);
}




