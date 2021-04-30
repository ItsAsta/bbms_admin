<?php

if (isset($_POST["register"])) {
    $adminFirstName = $_POST["admin_first_name"];
    $adminLastName = $_POST["admin_last_name"];
    $adminAddress = $_POST["admin_address"];
    $adminPostcode = $_POST["admin_postcode"];
    $adminEmail = $_POST["admin_email"];
    $adminPhoneNumber = $_POST["admin_phone_number"];
    $adminPassword = $_POST["admin_password"];
    $adminConfirmPassword = $_POST["admin_confirm_password"];


    $barbershopName = $_POST["barbershop_name"];
    $barbershopBranch = $_POST["barbershop_branch"];
    $barbershopAddress = $_POST["barbershop_address"];
    $barbershopPostcode = $_POST["barbershop_postcode"];
    $barbershopEmail = $_POST["barbershop_email"];
    $barbershopPhoneNumber = $_POST["barbershop_phone_number"];

    $mondayOpen = $_POST["monday_opening_time"];
    $mondayClose = $_POST["monday_closing_time"];
    $mondayAvail = 1;

    $tuesdayOpen = $_POST["tuesday_opening_time"];
    $tuesdayClose = $_POST["tuesday_closing_time"];
    $tuesdayAvail = 1;

    $wednesdayOpen = $_POST["wednesday_opening_time"];
    $wednesdayClose = $_POST["wednesday_closing_time"];
    $wednesdayAvail = 1;

    $thursdayOpen = $_POST["thursday_opening_time"];
    $thursdayClose = $_POST["thursday_closing_time"];
    $thursdayAvail = 1;

    $fridayOpen = $_POST["friday_opening_time"];
    $fridayClose = $_POST["friday_closing_time"];
    $fridayAvail = 1;

    $saturdayOpen = $_POST["saturday_opening_time"];
    $saturdayClose = $_POST["saturday_closing_time"];
    $saturdayAvail = 1;

    $sundayOpen = $_POST["sunday_opening_time"];
    $sundayClose = $_POST["sunday_closing_time"];
    $sundayAvail = 1;

    if (isset($_POST["monday_avail"])) {
        $mondayAvail = 0;
    }

    if (isset($_POST["tuesday_avail"])) {
        $tuesdayAvail = 0;
    }

    if (isset($_POST["wednesday_avail"])) {
        $wednesdayAvail = 0;
    }

    if (isset($_POST["thursday_avail"])) {
        $thursdayAvail = 0;
    }

    if (isset($_POST["friday_avail"])) {
        $fridayAvail = 0;
    }

    if (isset($_POST["saturday_avail"])) {
        $saturdayAvail = 0;
    }

    if (isset($_POST["sunday_avail"])) {
        $sundayAvail = 0;
    }

    $paramArray = array($adminFirstName, $adminLastName, $adminAddress, $adminPostcode, $adminEmail, $adminPhoneNumber, $adminPassword, $adminConfirmPassword, //0-7
        $barbershopName, $barbershopBranch, $barbershopAddress, $barbershopPostcode, $barbershopEmail, $barbershopPhoneNumber, //8-13
        $sundayOpen, $sundayClose, $sundayAvail, $tuesdayOpen, $tuesdayClose, $tuesdayAvail, $wednesdayOpen, //14-20
        $wednesdayClose, $wednesdayAvail, $thursdayOpen, $thursdayClose, $thursdayAvail, $fridayOpen, $fridayClose, $fridayAvail, //21-28
        $saturdayOpen, $saturdayClose, $saturdayAvail, $mondayOpen, $mondayClose, $mondayAvail); //29-34

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInput($paramArray)) {
        header("location: ../register_barbershop.php?error=empty");
        exit();
    }

    if (!filter_var($adminEmail, FILTER_VALIDATE_EMAIL) || !filter_var($barbershopEmail, FILTER_VALIDATE_EMAIL)) {
        header("location: ../register_barbershop.php?error=email");
        exit();
    }

    if ($adminPassword != $adminConfirmPassword) {
        header("location: ../register_barbershop.php?error=password");
        exit();
    }

    if (!ctype_digit($adminPhoneNumber) || !ctype_digit($barbershopPhoneNumber)) {
        header("location: ../register_barbershop.php?error=phoneNumber");
        exit();
    }

    if (barbershopExists($db, $barbershopName, $barbershopBranch, $barbershopEmail) !== false) {
        header("location: ../register_barbershop.php?error=barbershopExist");
        exit();
    }

    if (staffExists($db, $adminEmail) !== false) {
        header("location: ../register_barbershop.php?error=staffExist");
        exit();
    }

    registerBarbershop($db, $paramArray);
}