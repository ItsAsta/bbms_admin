<?php

if (isset($_POST["remove_staff"])) {

    $staffEmail = $_POST["staff_email"];

    include_once("dbh.inc.php");
    include_once("functions.inc.php");

    removeStaff($db, $staffEmail);
}

if (isset($_POST["update_staff"])) {
    $staffFirstName = $_POST["staff_first_name"];
    $staffLastName = $_POST["staff_last_name"];
    $staffCurrEmail = $_POST["staff_current_email"];
    $staffEmail = $_POST["staff_email"];
    $staffAddress = $_POST["staff_address"];
    $staffPostcode = $_POST["staff_postcode"];
    $staffPhoneNumber = $_POST["staff_phone_number"];
    $staffBarbershopId = $_POST["barbershop_id"];

    include_once("dbh.inc.php");
    include_once("functions.inc.php");

    if (emptyInput(array($staffFirstName, $staffLastName, $staffCurrEmail, $staffEmail, $staffAddress, $staffPostcode, $staffPhoneNumber, $staffBarbershopId))) {
        header("location: ../staff.php?error=empty");
        exit();
    }

    if (!filter_var($staffEmail, FILTER_VALIDATE_EMAIL)) {
        header("location: ../staff.php?error=email");
        exit();
    }

    if (!ctype_digit($staffPhoneNumber)) {
        header("location: ../staff.php?error=phoneNumber");
        exit();
    }

    updateStaff($db, $staffEmail, $staffFirstName, $staffLastName, $staffAddress, $staffPostcode, $staffPhoneNumber, $staffBarbershopId, $staffCurrEmail);
}