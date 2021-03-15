<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';

if (isset($_POST["updateBarberStatus"])) {
    $barber_id = $_POST["barber_id"];

    updateBarberStatus($db, $_SESSION["barbershop_id"], $barber_id);
}

if (isset($_POST["edit_barber"])) {
    $barber_id = $_POST["barber_id"];
    $barber_name = $_POST["barberName"];
    $barber_experience = $_POST["barberExperience"];
    $barber_speciality = $_POST["barberSpeciality"];

    updateBarberDetails($db, $_SESSION["barbershop_id"], $barber_id, $barber_name, $barber_experience, $barber_speciality);
}

if (isset($_POST["remove_barber"])) {
    $barberId = $_POST["barber_id"];

//    echo $barberId;
    removeBarber($db, $barberId);
}

