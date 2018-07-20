<?php
require_once 'dbConnector.php';

if (isset($_GET['flag'])) {
    if ($_GET['flag'] == 'local') {
        if (isset($_GET['email']) && isset($_GET['pw'])
        ) {
            $email = $_GET['email'];
            $pw    = $_GET['pw'];

            $conn = getConnection();
            if ($conn === 1) {   // DB connection error
                echo "{\"status\": 1}";
            }
            else {
                $select_sql = "select idx from user where email='$email' and pw='$pw'";

                $search = $conn->query($select_sql);
                if (!$search) { // DB connection error
                    echo "{\"status\": 1}";
                }
                elseif ($search->num_rows) {  // user already exists
                    $row = $search->fetch_array(MYSQLI_NUM);
                    echo "{\"status\": 0, \"user\": " . $row[0] . "}";
                }
                else {
                    echo "{\"status\": 4}"; // no user data
                }
            }
        }
        else {
            echo "{\"status\": 2}"; // parameter missing
        }
    }

    // if ($_GET['flag'] == 'facebook') {
    //
    // }
}
?>
