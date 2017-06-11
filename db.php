<?php

define('HOST_NAME', 'localhost');
define('DATABASE_NAME', 'calendar');
define('DATABASE_USER_NAME', 'root');
define('DATABASE_PASSWORD', '');

//Open a new connection to the MySQL server
$conn = new mysqli(HOST_NAME, DATABASE_USER_NAME, DATABASE_PASSWORD, DATABASE_NAME);
//Output any connection error
if ($conn->connect_error) {
    die('Error : (' . $conn->connect_errno . ') ' . $conn->connect_error);
}
?>
