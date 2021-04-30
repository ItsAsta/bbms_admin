<?php
include_once('inc/header.inc.php');
headerOutput('Register Barbershop', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Register Barbershop');
?>
<div class="container-wrapper">
    <div class="container" style="text-align: left">
        <form method="post" action="inc/register_barbershop.inc.php">
            <div class="form-wrapper">
                <div style="text-align: center">
                    <h5>Admin Details</h5>
                    <hr style="background-color: white">
                </div>
                <div class="form-row">
                    <div class="col-md-auto">
                        <label>First Name
                            <input type="text" name="admin_first_name">
                        </label>

                        <label>Last Name
                            <input type="text" name="admin_last_name">
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-auto">
                        <label>Address
                            <input type="text" name="admin_address">
                        </label>

                        <label>Postcode
                            <input type="text" name="admin_postcode">
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-auto">
                        <label>Email
                            <input type="email" name="admin_email">
                        </label>

                        <label>Phone Number
                            <input type="tel" name="admin_phone_number">
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-auto">
                        <label>Password
                            <input type="password" name="admin_password">
                        </label>

                        <label>Confirm Password
                            <input type="password" name="admin_confirm_password">
                        </label>
                    </div>
                </div>

                <div style="text-align: center; margin-top: 20px">
                    <h5>Barbershop Details</h5>
                    <hr style="background-color: white">
                </div>
                <div class="form-row">
                    <div class="col-md-auto">
                        <label>Name
                            <input type="text" name="barbershop_name">
                        </label>

                        <label>Branch
                            <input type="text" name="barbershop_branch">
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-auto">
                        <label>Address
                            <input type="text" name="barbershop_address">
                        </label>

                        <label>Postcode
                            <input type="text" name="barbershop_postcode">
                        </label>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-auto">
                        <label>Email
                            <input type="email" name="barbershop_email">
                        </label>

                        <label>Phone Number
                            <input type="tel" name="barbershop_phone_number">
                        </label>
                    </div>
                </div>

<!--                <hr>-->

                <!--                    <label>Monday-->
                <!--                        <input type="time" name="staff_confirm_password">-->
                <!--                    </label>-->
                <div class="col-md-auto">
                    <div class="checkboxes">
                        <label><span style="font-weight: bold">Monday</span><span>Open</span><input type="time"
                                                                                                    step="1800"
                                                                                                    name="monday_opening_time"/><span>Close</span><input
                                    type="time" step="1800" name="monday_closing_time"/><span>Available?</span><input
                                    class="input-force-width"
                                    type="checkbox" name="monday_avail"/></label>

                        <label><span style="font-weight: bold">Tuesday</span><span>Open</span><input type="time"
                                                                                                     step="1800"
                                                                                                     name="tuesday_opening_time"/><span>Close</span><input
                                    type="time" step="1800" name="tuesday_closing_time"/><span>Available?</span><input
                                    class="input-force-width"
                                    type="checkbox" name="tuesday_avail"/></label>

                        <label><span style="font-weight: bold">Wednesday</span><span>Open</span><input type="time"
                                                                                                       step="1800"
                                                                                                       name="wednesday_opening_time"/><span>Close</span><input
                                    type="time" step="1800" name="wednesday_closing_time"/><span>Available?</span><input
                                    class="input-force-width"
                                    type="checkbox" name="wednesday_avail"/></label>

                        <label><span style="font-weight: bold">Thursday</span><span>Open</span><input type="time"
                                                                                                      step="1800"
                                                                                                      name="thursday_opening_time"/><span>Close</span><input
                                    type="time" step="1800" name="thursday_closing_time"/><span>Available?</span><input
                                    class="input-force-width"
                                    type="checkbox" name="thursday_avail"/></label>

                        <label><span style="font-weight: bold">Friday</span><span>Open</span><input type="time"
                                                                                                    step="1800"
                                                                                                    name="friday_opening_time"/><span>Close</span><input
                                    type="time" step="1800" name="friday_closing_time"/><span>Available?</span><input
                                    class="input-force-width"
                                    type="checkbox" name="friday_avail"/></label>

                        <label><span style="font-weight: bold">Saturday</span><span>Open</span><input type="time"
                                                                                                      step="1800"
                                                                                                      name="saturday_opening_time"/><span>Close</span><input
                                    type="time" step="1800" name="saturday_closing_time"/><span>Available?</span><input
                                    class="input-force-width"
                                    type="checkbox" name="saturday_avail"/></label>

                        <label><span style="font-weight: bold">Sunday</span><span>Open</span><input type="time"
                                                                                                    step="1800"
                                                                                                    name="sunday_opening_time"/><span>Close</span><input
                                    type="time" step="1800" name="sunday_closing_time"/><span>Available?</span><input
                                    class="input-force-width"
                                    type="checkbox" name="sunday_avail"/></label>
                    </div>
                </div>

                <!--                        <div class="col-md-auto">-->
                <!--                            <div class="checkboxes">-->
                <!--                                <label><span>Wednesday</span><input type="time" step="1800"/><input class="input-force-width"-->
                <!--                                                                                                    type="checkbox"/></label>-->
                <!--                            </div>-->
                <!--                        </div>-->

                <hr>
                <div style="text-align: right">
                    <button type="submit"
                            class="btn btn-default modal-close-btn btn-success"
                            name="register">Register
                    </button>
                </div>
                <p>Already Registered? <b onclick="window.location.href='login.php'">Login!</b></p>
                <div style="text-align: center">
                    <?php
                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "empty") {
                            echo "<p class='error'>Can't complete action: One or more fields are empty!</p>";
                        } elseif ($_GET["error"] == "email") {
                            echo "<p class='error'>Can't complete action: Invalid email format!</p>";
                        } elseif ($_GET["error"] == "staffExist") {
                            echo "<p class='error'>Can't complete action: Email already registered!</p>";
                        } elseif ($_GET["error"] == "password") {
                            echo "<p class='error'>Can't complete action: Passwords are not matching!</p>";
                        } elseif ($_GET["error"] == "phoneNumber") {
                            echo "<p class='error'>Can't complete action: Invalid phone number format!</p>";
                        } elseif ($_GET["error"] == "stmtfailed") {
                            echo "<p class='error'>Can't complete action: Database Error, please try again!</p>";
                        } elseif ($_GET["error"] == "wronglogin") {
                            echo "<p class='error'>Can't complete action: Incorrect details, please try again!</p>";
                        } elseif ($_GET["error"] == "barbershopExist") {
                            echo "<p class='error'>Can't complete action: This barbershop already exists!</p>";
                        }
                    } else if (isset($_GET["success"])) {
                        if ($_GET["success"] == "yes") {
                            echo "<p class='success'>Successfully Registered Barbershop!</p>";
                            exit();
                        }
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</div>
