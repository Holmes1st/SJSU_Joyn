<?php
require_once 'dbConnector.php';

if (isset($_GET['flag'])) {
    if ($_GET['flag'] == 'local') {
        if (isset($_GET['fname']) && isset($_GET['lname'])  &&
            isset($_GET['email']) && isset($_GET['pw'])     &&
            isset($_GET['birth'])
        ) {
            $fname = $_GET['fname'];
            $lname = $_GET['lname'];
            $email = $_GET['email'];
            $pw    = $_GET['pw'];
            $birth = $_GET['birth'];

            $conn = getConnection();
            if ($conn === 1) {   // DB connection error
                // var_dump($conn);
                echo "<br>{\"status\": 1, 1}";
            }
            else {
                $select_sql = "select registerdate from user where email='$email'";
                $insert_sql = "insert into user (fname, lname, email, pw, birth, registerdate) values ('$fname', '$lname', '$email', '$pw', '$birth', NOW())";
                $success_sql = "select idx from user where email='$email'";

                $search = $conn->query($select_sql);
                if (!$search) { // DB connection error
                    echo "{\"status\": 1, 2}";
                }
                elseif ($search->num_rows) {  // user already exists
                    $row = $search->fetch_array(MYSQLI_NUM);
                    echo "{\"status\": 3, \"registerdate\": \"" . $row[0] . "\"}";
                }
                else {
                    $result = $conn->query($insert_sql);
                    if (!$result) {// DB connection error
                        echo "{\"status\": 1, 3}";
                    }
                    else {
                        $search = $conn->query($success_sql);
                        if (!$search) { // DB connection error
                            echo "{\"status\": 1, 4}";
                        }
                        else {
                            $row = $search->fetch_array(MYSQLI_NUM);
                            echo "{\"user\": " . $row[0] . "}";
                        }
                    }
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
