<?php
session_start();

include_once('inc/header.inc.php');
headerOutput('Register Staff', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Register Staff');
if (empty($_SESSION["email"])) {
    header("location: login.php");
}
?>
<div class="container-wrapper">
    <div class="container" style="text-align: left">
        <form method="post" action="inc/register.inc.php">
            <div style="text-align: center">
                <h5>Staff Details</h5>
                <hr style="background-color: white">
            </div>
            <div class="form-row">
                <div class="col-md-auto">
                    <label>First Name
                        <input type="text" name="staff_first_name">
                    </label>

                    <label>Last Name
                        <input type="text" name="staff_last_name">
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-auto">
                    <label>Address
                        <input type="text" name="staff_address">
                    </label>

                    <label>Postcode
                        <input type="text" name="staff_postcode">
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-auto">
                    <label>Email
                        <input type="email" name="staff_email">
                    </label>

                    <label>Phone Number
                        <input type="tel" name="staff_phone_number">
                    </label>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-auto">
                    <label>Password
                        <input type="password" name="staff_password">
                    </label>

                    <label>Confirm Password
                        <input type="password" name="staff_confirm_password">
                    </label>
                </div>
            </div>
            <div style="text-align: right">
                <button type="submit"
                        class="btn btn-default modal-close-btn btn-success"
                        name="register">Register
                </button>
            </div>
            <div style="text-align: center">
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
                } else if (isset($_GET["success"])) {
                    if ($_GET["success"] == "yes") {
                        echo "<p class='success'>Successfully registered staff!</p>";
                        exit();
                    }
                }
                ?>
            </div>
        </form>
    </div>
</div>
