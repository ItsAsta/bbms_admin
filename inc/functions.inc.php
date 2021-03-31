<?php
session_start();

function staffExists($db, $email) {
    $sql = "SELECT * FROM staff WHERE staff_email = ?;";
    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return $result = false;
    }

    mysqli_stmt_close($stmt);
}

function registerStaff($db, $staff_email, $staff_password, $staff_first_name, $staff_last_name, $staff_address, $staff_postcode, $staff_phone_number, $barbershop_id) {
    $staffSql = "INSERT INTO `staff` (`staff_email`, `staff_password`, `staff_first_name`, `staff_last_name`, `staff_address`, `staff_postcode`, `staff_phone_number`, `barbershop_id`) VALUES
                            (?, ?, ?, ?, ?, ?, ?, ?);";
    $staffStmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($staffStmt, $staffSql)) {
        header("location: ../register.php?error=stmtfailed");
        exit();
    }

    $staffHashedPassword = password_hash($staff_password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($staffStmt, "ssssssss", $staff_email, $staffHashedPassword, $staff_first_name, $staff_last_name, $staff_address, $staff_postcode, $staff_phone_number, $barbershop_id);
    mysqli_stmt_execute($staffStmt);
    mysqli_stmt_close($staffStmt);
    header("location: ../staff.php");
}

function emptyInput($array) {
    $result = null;
    foreach ($array as $value) {
        if ($value === 0) {
            $value = "Open";
        }
        if (empty($value) || !isset($value)) {
            return true;
        } else {
            $result = false;
        }
    }

    return $result;
}

function loginStaff($db, $email, $password) {
    $emailExists = staffExists($db, $email);

    if ($emailExists === false) {
        header("location: ../login.php?error=nonexistent");
        exit();
    }

    $passwordHashed = $emailExists["staff_password"];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false) {
        header("location: ../login.php?error=wronglogin");
    } else {
        $_SESSION["email"] = $emailExists["staff_email"];
        $_SESSION["barbershop_id"] = $emailExists["barbershop_id"];
        header("location: ../index.php");
        exit();
    }
}

function updateBarberStatus($db, $barbershop_id, $barber_id) {
    $barber_status = null;

    $sql = "SELECT * FROM barber WHERE barbershop_id = ? AND barber_id = ?";
    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../barbers.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $barbershop_id, $barber_id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        if ($row["barber_status"] == 1) {
            $barber_status = 0;
        } else {
            $barber_status = 1;
        }

        $sql = "UPDATE `barber` SET `barber_status`= ? WHERE barbershop_id = ? AND barber_id = ?";

        $stmt = mysqli_stmt_init($db);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../barbers.php?error=stmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $barber_status, $barbershop_id, $barber_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../barbers.php");
    }
}

function cancelBooking($db, $booking_reference) {
    $sql = "UPDATE `booking` SET `booking_status`=1 WHERE booking_reference = ?;";

    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../bookings.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $booking_reference);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../bookings.php");
}

function updateBarberDetails($db, $barbershop_id, $barber_id, $barber_name, $barber_experience, $barber_speciality) {
    $sql = "UPDATE `barber` SET `barber_name`= ?, `barber_experience` = ?, `barber_speciality` = ? WHERE barbershop_id = ? AND barber_id = ?";

    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../barbers.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssss", $barber_name, $barber_experience, $barber_speciality, $barbershop_id, $barber_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../barbers.php");
}

function addBarber($db, $barber_name, $barber_experience, $barber_speciality, $barbershop_id) {
    $sql = "INSERT INTO `barber` (`barber_name`, `barber_experience`, `barber_speciality`, `barbershop_id`) VALUES
           (?, ?, ?, ?)";

    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../barbers.php?error=stmtFailed");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "ssss", $barber_name, $barber_experience, $barber_speciality, $barbershop_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../barbers.php");
}

function removeBarber($db, $barber_id) {
    $sql = "DELETE FROM `barber` WHERE barber_id = ?";

    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../barbers.php?error=stmtFailed");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "s", $barber_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../barbers.php");
}

function updateUser($db, $email, $firstName, $lastName, $address, $postcode, $phoneNumber) {
    $sql = "UPDATE `user` SET `user_first_name` = ?, `user_last_name` = ?, `user_address` = ?, `user_postcode` = ?, `user_phone_number` = ? WHERE `user_email` = ?";

    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../users.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $address, $postcode, $phoneNumber, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../users.php");
}

function updateBarbershop($db, $paramArray) {
    $db->autocommit(false);

    $barbershopSql = $db -> prepare("UPDATE `barbershop` SET `barbershop_name` = ?, `barbershop_branch` = ?, `barbershop_address` = ?,
                        `barbershop_postcode` = ?, `barbershop_phone_number` = ?, `barbershop_email` = ? WHERE `barbershop_id` = ?");
    $mondaySql = $db -> prepare("UPDATE `opening_hours` SET `opening_hours_open_time` = ?, `opening_hours_close_time` = ?, `opening_hours_closed` = ? WHERE `opening_hours_weekday` = 1");
    $tuesdaySql = $db -> prepare("UPDATE `opening_hours` SET `opening_hours_open_time` = ?, `opening_hours_close_time` = ?, `opening_hours_closed` = ? WHERE `opening_hours_weekday` = 2");
    $wednesdaySql = $db -> prepare("UPDATE `opening_hours` SET `opening_hours_open_time` = ?, `opening_hours_close_time` = ?, `opening_hours_closed` = ? WHERE `opening_hours_weekday` = 3");
    $thursdaySql = $db -> prepare("UPDATE `opening_hours` SET `opening_hours_open_time` = ?, `opening_hours_close_time` = ?, `opening_hours_closed` = ? WHERE `opening_hours_weekday` = 4");
    $fridaySql = $db -> prepare("UPDATE `opening_hours` SET `opening_hours_open_time` = ?, `opening_hours_close_time` = ?, `opening_hours_closed` = ? WHERE `opening_hours_weekday` = 5");
    $saturdaySql = $db -> prepare("UPDATE `opening_hours` SET `opening_hours_open_time` = ?, `opening_hours_close_time` = ?, `opening_hours_closed` = ? WHERE `opening_hours_weekday` = 6");
    $sundaySql = $db -> prepare("UPDATE `opening_hours` SET `opening_hours_open_time` = ?, `opening_hours_close_time` = ?, `opening_hours_closed` = ? WHERE `opening_hours_weekday` = 0");

    $barbershopSql -> bind_param("sssssss", $paramArray[1], $paramArray[2], $paramArray[3], $paramArray[4], $paramArray[5], $paramArray[6], $paramArray[0]);
    $mondaySql -> bind_param("sss", $paramArray[25], $paramArray[26], $paramArray[27]);
    $tuesdaySql -> bind_param("sss", $paramArray[10], $paramArray[11], $paramArray[12]);
    $wednesdaySql -> bind_param("sss", $paramArray[13], $paramArray[14], $paramArray[15]);
    $thursdaySql -> bind_param("sss", $paramArray[16], $paramArray[17], $paramArray[18]);
    $fridaySql -> bind_param("sss", $paramArray[19], $paramArray[20], $paramArray[21]);
    $saturdaySql -> bind_param("sss", $paramArray[22], $paramArray[23], $paramArray[24]);
    $sundaySql -> bind_param("sss", $paramArray[7], $paramArray[8], $paramArray[9]);

    $barbershopSql -> execute();
    $mondaySql -> execute();
    $tuesdaySql -> execute();
    $wednesdaySql -> execute();
    $thursdaySql -> execute();
    $fridaySql -> execute();
    $saturdaySql -> execute();
    $sundaySql -> execute();

    $db -> autocommit(true);
    header("location: ../barbershop.php?success=yes");
}

function removeStaff($db, $staffEmail) {
    $sql = "DELETE FROM `staff` WHERE staff_email = ?";

    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../staff.php?error=stmtFailed");
        exit();
    }


    mysqli_stmt_bind_param($stmt, "s", $staffEmail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../staff.php");
}

function updateStaff($db, $email, $firstName, $lastName, $address, $postcode, $phoneNumber, $barbershopId, $currEmail) {
    $sql = "UPDATE `staff` SET `staff_email` = ?, `staff_first_name` = ?, `staff_last_name` = ?, `staff_address` = ?, `staff_postcode` = ?, `staff_phone_number` = ?, `barbershop_id` = ? WHERE `staff_email` = ?";

    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../staff.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssss", $email, $firstName, $lastName, $address, $postcode, $phoneNumber, $barbershopId, $currEmail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../staff.php");
}

function barbershopExists($db, $name, $branch, $email) {
    $sql = "SELECT * FROM `barbershop` WHERE `barbershop_name` = ? AND `barbershop_branch` = ? AND `barbershop_email` = ?";
    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register_barbershop.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $name, $branch, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        return $result = false;
    }
}

function registerBarbershop($db, $paramArray) {
    $db->autocommit(false);

    $barbershopStmt = $db->prepare("INSERT INTO `barbershop` (`barbershop_name`, `barbershop_branch`, `barbershop_postcode`, `barbershop_address`, `barbershop_email`, `barbershop_phone_number`) VALUES (?, ?, ?, ?, ?, ?)");
    $staffStmt = $db->prepare("INSERT INTO `staff` (`staff_first_name`, `staff_last_name`, `staff_address`, `staff_postcode`, `staff_email`, `staff_phone_number`, `staff_password`, `barbershop_id`) VALUES (?, ?, ?, ?, ?, ?, ?, 1)");
    $updateStmt = $db->prepare("UPDATE `staff` SET `barbershop_id` = (SELECT `barbershop_id` FROM `barbershop` WHERE `barbershop_name` = ? AND `barbershop_branch` = ? AND `barbershop_email` = ?) WHERE `staff_email` = ?");

    $hashedPassword = password_hash($paramArray[6], PASSWORD_DEFAULT);

    $barbershopStmt -> bind_param("ssssss",
        $paramArray[8], $paramArray[9], $paramArray[11], $paramArray[10], $paramArray[12], $paramArray[13]);

    $staffStmt -> bind_param("sssssss",
        $paramArray[0], $paramArray[1], $paramArray[2], $paramArray[3], $paramArray[4], $paramArray[5], $hashedPassword);

    $updateStmt -> bind_param("ssss",
        $paramArray[8], $paramArray[9], $paramArray[12], $paramArray[4]);

    for($i = 0; $i <= 7; $i++) {
        $db->query("INSERT INTO `opening_hours` (`barbershop_id`, `opening_hours_weekday`, `opening_hours_open_time`, `opening_hours_close_time`, `opening_hours_closed`) VALUES
             (" . $i . "," . $paramArray[14 + $i] . "," . $paramArray[15 + $i] . "," . $paramArray[16 + $i] . ") WHERE
             barbershop_id = (SELECT `barbershop_id` FROM `barbershop` WHERE `barbershop_name` = '" . $paramArray[8] . "' AND `barbershop_branch` = '" . $paramArray[9] . "' AND `barbershop_email` = '" . $paramArray[12] . "')");
    }


    $barbershopStmt->execute();
    $staffStmt->execute();
    $updateStmt->execute();
    $db->autocommit(true);

    $sql = "SELECT `barbershop_id` FROM `barbershop` WHERE `barbershop_name` = '" . $paramArray[8] . "' AND `barbershop_branch` = '" . $paramArray[9] . "' AND `barbershop_email` = '" . $paramArray[12] . "' LIMIT 1";
    $result = mysqli_query($db, $sql);
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $getWeekday = 0;
            $getOpeningTime = 14;
            $getClosingTime = 15;
            $getClosed = 16;

            for($i = 1; $i <= 7; $i++) {

                $db->query("INSERT INTO `opening_hours` (`barbershop_id`, `opening_hours_weekday`, `opening_hours_open_time`, `opening_hours_close_time`, `opening_hours_closed`) VALUES
                 (" . $row["barbershop_id"] . ", " . $getWeekday . ", '" . $paramArray[$getOpeningTime] . "', '" . $paramArray[$getClosingTime] . "', " . $paramArray[$getClosed] . ")");
                $getOpeningTime += 3;
                $getClosingTime += 3;
                $getClosed += 3;
                if ($getWeekday < 6) {
                    $getWeekday += 1;
                }
            }

        }
    }
    header("location: ../register_barbershop.php?success=yes");
}