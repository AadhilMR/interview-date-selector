<?php
require_once "Database.php";

$error;
$response = array();

if(!isset($_POST["email"]) || !isset($_POST["date"]) || !isset($_POST["time"])) {
    $error = "Something went wrong! Please try again later.";
} else if(empty($_POST["email"]) || empty($_POST["date"]) || empty($_POST["time"])) {
    $error = "Something went wrong! Please try again later.";
} else {
    $email = $_POST["email"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $datetime = convertToDateTimeFormat($date, $time);

    if($datetime == false) {
        $error = "Something went wrong! Please try again later.";
    } else {
        // Check the email is already registered
        $rs_user = Database::s("SELECT * FROM `user` WHERE `email`='". $email ."';");

        // Check the date and time is already registered
        $rs_timeslot = Database::s("SELECT * FROM `timeslot` WHERE `datetime`='". $date ."';");

        if($rs_user->num_rows == 0) {
            $error = "Your email is not registered. Please reply to the email you received to register.";
        } else if($rs_timeslot->num_rows > 0) {
            $error = "This date and time is already selected by another user. Please select another date and time.";
        } else {
            $userId = $rs_user->fetch_assoc()["id"];
            
            // Check the user already assigned to a timeslot
            $rs_assigned = Database::s("SELECT * FROM `timeslot` WHERE `user_id`='". $userId ."';");

            if($rs_assigned->num_rows > 0) {
                $error = "You are already assigned to a timeslot. You can't select another timeslot.";
            } else {
                // Insert the date and time to the timeslot table
                Database::iud("INSERT INTO `timeslot`(`user_id`,`datetime`) VALUES ('". $userId ."','". $datetime ."');");
                
                if(Database::getAffectedRows() == 0) {
                    $error = "Something went wrong! Please try again later.";
                }
            }
        }
    }
}

if(isset($error)) {
    $response["responseCode"] = "400";
    $response["message"] = $error;
} else {
    $response["responseCode"] = "200";
    $response["message"] = "success";
}

echo json_encode($response);

function convertToDateTimeFormat($date, $time) : string {
    $dateTimeString = $date . ' ' . $time;
    $datetime = DateTime::createFromFormat('Y-m-d h A', $dateTimeString);

    if($datetime == false) {
        return false;
    }

    return $datetime->format('Y-m-d H:i:s');
}
?>