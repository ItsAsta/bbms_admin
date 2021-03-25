<?php
session_start();

function userExists($db, $email) {
    $sql = "SELECT * FROM staff WHERE staff_email = ?;";
    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.inc.php?error=stmtFailed");
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

function registerStaff($db, $email, $password, $firstName, $lastName, $address, $postcode, $phoneNumber) {
    $sql = "INSERT INTO staff (staff_email, staff_password, staff_first_name, staff_last_name, staff_address, staff_postcode, staff_phone_number) VALUES
                            (?, ?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../register.inc.php?error=stmtFailed");
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssss", $email, $hashedPassword, $firstName, $lastName, $address, $postcode, $phoneNumber);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../register.php?success=yes");
}

function emptyInput($array) {
    $result = null;
    foreach ($array as $value) {
        if (empty($value)) {
            $result = true;
        } else {
            $result = false;
        }
    }

    return $result;
}

function loginStaff($db, $email, $password) {
    $emailExists = userExists($db, $email);

    if ($emailExists === false) {
        header("location: ../login.php?error=nonexistent");
        exit();
    }

    $passwordHashed = $emailExists["staff_password"];
    $checkPassword = password_verify($password, $passwordHashed);

    if ($checkPassword === false) {
        header("location: ../login.php?error=wronglogin");
    } else {
        session_start();
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
        header("location: ../barbers.inc.php?error=stmtFailed");
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
            header("location: ../barbers.inc.php?error=stmtFailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "sss", $barber_status, $barbershop_id, $barber_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../barbers.php");
    }
}

function updateBarberDetails($db, $barbershop_id, $barber_id, $barber_name, $barber_experience, $barber_speciality) {
    $sql = "UPDATE `barber` SET `barber_name`= ?, `barber_experience` = ?, `barber_speciality` = ? WHERE barbershop_id = ? AND barber_id = ?";

    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../barbers.inc.php?error=stmtFailed");
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
        header("location: ../barbers.inc.php?error=stmtFailed");
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
        header("location: ../barbers.inc.php?error=stmtFailed");
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
        header("location: ../users.inc.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $firstName, $lastName, $address, $postcode, $phoneNumber, $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../users.php");
}

function updateBarbershop($db, $barbershopId, $name, $branch, $address, $postcode, $opening, $closing, $phoneNumber) {
    $sql = "UPDATE `barbershop` SET `barbershop_name` = ?, `barbershop_branch` = ?, `barbershop_address` = ?, `barbershop_postcode` = ?, `barbershop_opening_time` = ?, `barbershop_closing_time` = ?, `barbershop_phone_number` = ? WHERE `barbershop_id` = ?";

    $stmt = mysqli_stmt_init($db);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../barbershop.inc.php?error=stmtFailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssssss", $name, $branch, $address, $postcode, $opening, $closing, $phoneNumber, $barbershopId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../barbershop.php?success=yes");
}