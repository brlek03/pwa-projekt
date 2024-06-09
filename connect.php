<?php 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vijesti";

    $dbc = new mysqli($servername, $username, $password, $dbname);
    if ($dbc->connect_error) {
        die("Connection failed: " . $dbc->connect_error);
    }
?>