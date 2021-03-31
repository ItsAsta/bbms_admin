<?php
session_start();

// Registration
if (isset($_POST["register"])) {
    $staffFirstName = $_POST["staff_first_name"];
    $staffLastName = $_POST["staff_last_name"];
    $staffAddress = $_POST["staff_address"];
    $staffPostcode = $_POST["staff_postcode"];
    $staffEmail = $_POST["staff_email"];
    $staffPhoneNumber = $_POST["staff_phone_number"];
    $staffPassword = $_POST["staff_password"];
    $staffConfirmPassword = $_POST["staff_confirm_password"];


    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $values = array($staffFirstName, $staffLastName, $staffAddress, $staffPostcode, $staffEmail, $staffPhoneNumber, $staffPassword, $staffConfirmPassword);

    if (emptyInput($values)) {
        header("location: ../register.php?error=empty");
        exit();
    }

    if (!filter_var($staffEmail, FILTER_VALIDATE_EMAIL)) {
        header("location: ../register.php?error=email");
        exit();
    }

    if (staffExists($db, $staffEmail) !== false) {
        header("location: ../register.php?error=alreadyRegistered");
        exit();
    }

    if ($staffPassword != $staffConfirmPassword) {
        header("location: ../register.php?error=password");
        exit();
    }

    if (!ctype_digit($staffPhoneNumber)) {
        header("location: ../register.php?error=phoneNumber");
        exit();
    }

    registerStaff($db, $staffEmail, $staffPassword, $staffFirstName, $staffLastName, $staffAddress, $staffPostcode, $staffPhoneNumber, $_SESSION["barbershop_id"]);
}