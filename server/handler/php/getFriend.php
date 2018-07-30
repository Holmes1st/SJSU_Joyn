<?php
require_once 'dbConnector.php';

if (!isset($_GET['user'])) {
    die(json_encode(array("status" => 2)));
}

$conn = getConnection();
if ($conn === 1) {   // DB connection error
    die(json_encode(array("status" => 1)));
}
else {
    $user=$_GET['user'];
    $select_sql = "select friends.user2, user.fname, user.lname, user.imgUrl from friends inner join user on friends.user2=user.idx where friends.user1=$user";
    $search = $conn->query($select_sql);

    if (!$search) { // DB connection error
        die(json_encode(array("status" => 1)));
    }
    elseif ($search->num_rows) {    // user exists
        $list = array();
        while($row = $search->fetch_assoc())
        {
            $temp = array();
            $temp['status'] = 0;
            $temp['fidx'] = $row['user2'];
            $temp['fname'] = $row['fname'];
            $temp['lname'] = $row['lname'];
            $temp['imgUrl'] = $row['imgUrl'];

            array_push($list, $temp);
        }

        echo json_encode($list);
    }
    else {  // sports does not exists
        echo json_encode(array("status" => 3));
    }
}
?>
