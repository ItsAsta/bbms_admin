<?php
require __DIR__ . '/vendor/autoload.php';

include_once('inc/header.inc.php');
headerOutput('Login', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Login');
?>
<div class="container-wrapper">
    <div class="container">
        <div class="form-wrapper">
            <!-- LOGIN FORM -->
            <form method="post" action="inc/login.inc.php">
                <h3>Login</h3>
                <hr style="background-color: white">
                <div class="form-row">
                    <div class="col-md-auto">
                        <div class="form-group">
                            <label for="userLoginEmail">Email</label>
                            <input id="userLoginEmail" type="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="userPassword">Password</label>
                            <input id="userPassword" type="password" name="password">
                        </div>
                    </div>
                </div>
                <div class="button-wrapper">
                    <button name="login" type="submit" id="loginBtn">LOGIN</button>
                </div>
                <p>Not Registered? <b onclick="window.location.href='register_barbershop.php'">Register!</b></p>
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
                        echo "<p class='error' style='text-align: center'>Can't complete action: Database Error, please try again!</p>";
                    } elseif ($_GET["error"] == "wronglogin") {
                        echo "<p class='error'>Can't complete action: Incorrect details, please try again!</p>";
                    } elseif ($_GET["error"] == "nonexistent") {
                        echo "<p class='error'>Can't complete action: Email does not exist!</p>";
                    }
                } elseif (isset($_GET["success"])) {
                    if ($_GET["success"] == "yes") {
                        echo "<p class='success'>Your account has been registered!</p>";
                        exit();
                    }
                }
                ?>
            </form>
        </div>
    </div>
</div>
