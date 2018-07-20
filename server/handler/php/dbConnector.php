<?php
    require_once './dbconf.php';

    function getConnection()
    {
        global $dbhost, $dbuser, $dbpass, $db;
        $connection = new mysqli($dbhost, $dbuser, $dbpass, $db);
        if ($connection->connect_error) {
            return 1;
        } else {
            return $connection;
        }
    }
?>
