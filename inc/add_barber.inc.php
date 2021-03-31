<?php

if (isset($_POST["add_barber"])) {
    $barberName = $_POST["barber_name"];
    $barberExperience = $_POST["barber_experience"];
    $barberSpeciality = $_POST["barber_speciality"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if (emptyInput(array($barberName, $barberExperience, $barberSpeciality))) {
        header("location: ../add_barber.php?error=empty");
        exit();
    }
    addBarber($db, $barberName, $barberExperience, $barberSpeciality, $_SESSION["barbershop_id"]);
}