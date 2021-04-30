<?php
session_start();

include_once('inc/header.inc.php');
include_once('inc/dbh.inc.php');
headerOutput('Barbers', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Barbers');
if (empty($_SESSION["email"])) {
    header("location: login.php");
}
?>
<div class="container-wrapper">
    <div class="container add-barber-form">
        <form method="post" action="inc/register_barber.inc.php">
            <h5>REGISTER BARBER</h5>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <label>Name</label>
                    <input type="text" name="barber_name">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label>Experience (YEARS)</label>
                    <input type="text" name="barber_experience">
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <label>Speciality</label>
                    <textarea name="barber_speciality"></textarea>
                </div>
            </div>

            <hr>

            <div style="text-align: right">
                <button type="submit"
                        class="btn btn-default btn-success"
                        name="add_barber">Register Barber
                </button>
            </div>
            <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "empty") {
                    echo "<p class='error'>Can't complete action: One or more fields are empty!</p>";
                } elseif ($_GET["error"] == "email") {
                    echo "<p class='error'>Can't complete action: Invalid email format!</p>";
                } elseif ($_GET["error"] == "alreadyRegistered") {
                    echo "<p class='error'>Can't complete action: Email already registered!</p>";
                } elseif ($_GET["error"] == "password") {
                    echo "<p class='error'>Can't complete action: Passwords are not matching!</p>";
                } elseif ($_GET["error"] == "phoneNumber") {
                    echo "<p class='error'>Can't complete action: Invalid phone number format!</p>";
                } elseif ($_GET["error"] == "stmtfailed") {
                    echo "<p class='error'>Can't complete action: Database Error, please try again!</p>";
                } elseif ($_GET["error"] == "wronglogin") {
                    echo "<p class='error'>Can't complete action: Incorrect details, please try again!</p>";
                }
            }
            ?>
        </form>
    </div>
</div>
