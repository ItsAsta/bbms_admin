<?php

if (isset($_POST["update_barbershop"])) {
    $name = $_POST["name"];
    $branch = $_POST["branch"];
    $address = $_POST["address"];
    $postcode = $_POST["postcode"];
    $email = $_POST["email"];
    $phoneNumber = $_POST["phoneNumber"];

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

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $paramArray = array($_SESSION["barbershop_id"], $name, $branch, $address, $postcode, $phoneNumber, $email, //0-6
        $sundayOpen, $sundayClose, $sundayAvail, $tuesdayOpen, $tuesdayClose, $tuesdayAvail, $wednesdayOpen, //7-13
        $wednesdayClose, $wednesdayAvail, $thursdayOpen, $thursdayClose, $thursdayAvail, $fridayOpen, $fridayClose, $fridayAvail, //14-21
        $saturdayOpen, $saturdayClose, $saturdayAvail, $mondayOpen, $mondayClose, $mondayAvail); //22-27

    if (emptyInput($paramArray)) {
        header("location: ../barbershop.php?error=empty");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("location: ../barbershop.php?error=email");
        exit();
    }

    if (!ctype_digit($phoneNumber)) {
        header("location: ../barbershop.php?error=phoneNumber");
        exit();
    }

    updateBarbershop($db, $paramArray);
}
