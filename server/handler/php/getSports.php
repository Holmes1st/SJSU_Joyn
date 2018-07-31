<?php
require_once 'dbConnector.php';

$conn = getConnection();
if ($conn === 1) {   // DB connection error
    echo "{\"status\": 1}";
}
else {
    $select_sql = "select idx, name from sport";
    $search = $conn->query($select_sql);

    if (!$search) { // DB connection error
        echo "{\"status\": 1}";
    }
    elseif ($search->num_rows) {    // user exists
        $list = array();
        while($row = $search->fetch_assoc())
        {
            $list[$row["name"]] = (int)$row["idx"];
        }

        echo json_encode($list);
    }
    else {  // sports does not exists
        echo json_encode(array("status" => 5));
    }
}
?>
