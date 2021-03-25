<?php

if (isset($_POST["update_user"])) {
    $email = $_POST["user_email"];
    $firstName = $_POST["user_first_name"];
    $lastName = $_POST["user_last_name"];
    $address = $_POST["user_address"];
    $postcode = $_POST["user_postcode"];
    $phoneNumber = $_POST["user_phone_number"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    updateUser($db, $email, $firstName, $lastName, $address, $postcode, $phoneNumber);
}
