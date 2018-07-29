<?php
require_once 'dbConnector.php';

if ( !isset($_GET['user1']) ) {
    echo json_encode(array("status" => 2));
} elseif (!isset($_GET['user2'])) {
    echo json_encode(array("status" => 2));
} else {
    $select_sql = "select idx from user where idx=";
    $select_sql2 = "select * from friends where user1=" . $_GET['user1'] . " and user2=" . $_GET['user2'];
    $insert_sql = "insert into friends values (" . $_GET['user1'] . "," . $_GET['user2'] . ")";
    $insert_sql2 = "insert into friends values (" . $_GET['user2'] . "," . $_GET['user1'] . ")";

    $conn = getConnection();
    if ($conn === 1) {
        die(json_encode(array("status" => 1, "ErrMsg"=>"" . $conn->error)));
    }

    $select = $conn->query($select_sql . $_GET['user1']);
    if (!$select) {
        die(json_encode(array("status" => 1, "ErrMsg"=>"" . $conn->error)));
    } elseif ($select->num_rows) {
        // pass
    } else {
        die(json_encode(array("status" => 4)));
    }

    $select = $conn->query($select_sql . $_GET['user2']);
    if (!$select) {
        die(json_encode(array("status" => 1, "ErrMsg"=>"" . $conn->error)));
    } elseif ($select->num_rows) {
        // pass
    } else {
        die(json_encode(array("status" => 4)));
    }

    $select = $conn->query($select_sql2);
    if (!$select) {
        die(json_encode(array("status" => 1, "ErrMsg"=>"" . $conn->error)));
    } elseif ($select->num_rows) {
        die(json_encode(array("status" => 3)));
    } else {
        $insert = $conn->query($insert_sql);
        if (!$insert) {
            die(json_encode(array("status" => 1, "ErrMsg"=>"" . $conn->error)));
        } else {
            $insert = $conn->query($insert_sql2);
            if (!$insert) {
                die(json_encode(array("status" => 1, "ErrMsg"=>"" . $conn->error)));
            } else {
                die(json_encode(array("status" => 0)));
            }
        }
    }
}
