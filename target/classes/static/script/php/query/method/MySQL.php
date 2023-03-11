<?php

function queryData($sql, $key, $database)
{
    $conn = mysqli_connect(MySQL::$host, MySQL::$user, MySQL::$password, $database);
    $result = mysqli_query($conn, $sql);
    $res = "";
    while ($row = mysqli_fetch_array($result)) {
        $res = $row[$key];
    }
    $conn->close();
    return $res;
}


function insertData($sql, $database): bool
{
    $conn = mysqli_connect(MySQL::$host, MySQL::$user, MySQL::$password, $database);
    $res = false;
    if ($conn->query($sql) === TRUE) {
        $res = true;
    }
    $conn->close();
    return $res;
}
