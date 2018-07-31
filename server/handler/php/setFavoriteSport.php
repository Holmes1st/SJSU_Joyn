<?php
require_once 'dbConnector.php';

if ( isset($_GET['user']) ) {
    $uidx = $_GET['user'];

    if (isset($_GET['sports'])) {
        $sports = json_decode($_GET['sports']);
    }
    else {
        $sports = array();
    }

    $conn = getConnection();
    if ($conn === 1) {   // DB connection error
        echo "{\"status\": 1}";
    }
    else {
        $select_sql = "select idx from user where idx=$uidx";
        $delete_sql = "delete from whatsportuserwant where uidx=$uidx";
        $success_sql = "select COUNT(DISTINCT sidx) from whatsportuserwant where uidx=$uidx";

        $search = $conn->query($select_sql);

        if (!$search) { // DB connection error
            echo "{\"status\": 1}";
        }
        elseif ($search->num_rows) {    // user exists
            // remove current sports
            $result = $conn->query($delete_sql);
            if (!$result) {
                die( json_encode(array("status" => 1)) );
            }

            $count = 0;
            // Add favorite sports
            foreach ($sports as $sport) {
                $insert_sql = "insert into whatsportuserwant (uidx, sidx) values ($uidx, $sport)";
                $result = $conn->query($insert_sql);
                if (!$result) { // DB connect error
                    die( json_encode(array("status" => 1)) );
                }
                else {
                    $count += 1;
                }
            }

            // Check for entry
            $search = $conn->query($success_sql);
            if (!$search) { // DB connection error
                echo "{\"status\": 1}". $conn->error;
            }
            elseif ($search->num_rows) {
                $row = $search->fetch_array(MYSQLI_NUM);
                if ($row[0] == $count) {
                    echo json_encode(array("status" => 0));
                }
                else {
                    echo json_encode(array("status" => 1));
                }
            }
        }
        else {  // user does not exists
            echo json_encode(array("status" => 4));
        }
    }
}
else {
    echo "{\"status\": 2}"; // parameter missing
}
?>
