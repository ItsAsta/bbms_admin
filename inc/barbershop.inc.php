<?php

if (isset($_POST["update_barbershop"])) {
    $name = $_POST["name"];
    $branch = $_POST["branch"];
    $address = $_POST["address"];
    $postcode = $_POST["postcode"];
    $opening = $_POST["opening"];
    $closing = $_POST["closing"];
    $phoneNumber = $_POST["phoneNumber"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInput(array($name, $branch, $address, $postcode, $opening, $closing, $phoneNumber))) {
        header("location: ../barbershop.php?error=empty");
        exit();
    }

    updateBarbershop($db, $_SESSION["barbershop_id"], $name, $branch, $address, $postcode, $opening . ":00", $closing . ":00", $phoneNumber);
}
