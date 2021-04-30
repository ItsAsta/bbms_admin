<?php
session_start();

include_once('inc/header.inc.php');
include_once('inc/dbh.inc.php');
headerOutput('Barbershop', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Barbershop');
if (empty($_SESSION["email"])) {
    header("location: login.php");
}
?>
<div class="container-wrapper">
    <div class="container" style="text-align: left">
        <form method="post" action="inc/barbershop.inc.php">
            <?php
            if (!empty($_SESSION["barbershop_id"])) {

                $sql = "SELECT `barbershop`.*, `opening_hours`.* FROM `barbershop` INNER JOIN `opening_hours` ON barbershop.barbershop_id = opening_hours.barbershop_id WHERE barbershop.barbershop_id = " . $_SESSION["barbershop_id"];
                $result = mysqli_query($db, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    $row = mysqli_fetch_assoc($result);
                    ?>
                    <div style="text-align: center">
                        <h5><?php echo $row["barbershop_name"]?> - ID: (<?php echo $row["barbershop_id"] ?>)</h5>
                    </div>
                    <div class="form-row">
                        <div class="col-md-auto">
                            <label>Name
                                <input type="text" name="name" value="<?php echo $row["barbershop_name"] ?>">
                            </label>

                            <label>Branch
                                <input type="text" name="branch" value="<?php echo $row["barbershop_branch"] ?>">
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-auto">
                            <label>Phone Number
                                <input type="text" name="phoneNumber"
                                       value="<?php echo $row["barbershop_phone_number"] ?>">
                            </label>

                            <label>Email
                                <input type="text" name="email"
                                       value="<?php echo $row["barbershop_email"] ?>">
                            </label>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-auto">
                            <label>Address
                                <input type="text" name="address"
                                       value="<?php echo $row["barbershop_address"] ?>">
                            </label>

                            <label>Postcode
                                <input type="text" name="postcode" value="<?php echo $row["barbershop_postcode"] ?>">
                            </label>
                        </div>
                    </div>
                    <div class="col-md-auto">
                        <?php
                    $monday = null;
                    $tuesday = null;
                    $wednesday = null;
                    $thursday = null;
                    $friday = null;
                    $saturday = null;
                    $sunday = null;
                    do {
                        if ($row["opening_hours_weekday"] == 0) {
                            $sunday = array('opening_hours_weekday' => $row["opening_hours_weekday"],
                                'opening_hours_open_time' => $row["opening_hours_open_time"],
                                'opening_hours_close_time' => $row["opening_hours_close_time"],
                                'opening_hours_closed' => $row["opening_hours_closed"]);
                        } elseif ($row["opening_hours_weekday"] == 1) {
                            $monday = array('opening_hours_weekday' => $row["opening_hours_weekday"],
                                'opening_hours_open_time' => $row["opening_hours_open_time"],
                                'opening_hours_close_time' => $row["opening_hours_close_time"],
                                'opening_hours_closed' => $row["opening_hours_closed"]);
                        } elseif ($row["opening_hours_weekday"] == 2) {
                            $tuesday = array('opening_hours_weekday' => $row["opening_hours_weekday"],
                                'opening_hours_open_time' => $row["opening_hours_open_time"],
                                'opening_hours_close_time' => $row["opening_hours_close_time"],
                                'opening_hours_closed' => $row["opening_hours_closed"]);
                        } elseif ($row["opening_hours_weekday"] == 3) {
                            $wednesday = array('opening_hours_weekday' => $row["opening_hours_weekday"],
                                'opening_hours_open_time' => $row["opening_hours_open_time"],
                                'opening_hours_close_time' => $row["opening_hours_close_time"],
                                'opening_hours_closed' => $row["opening_hours_closed"]);
                        } elseif ($row["opening_hours_weekday"] == 4) {
                            $thursday = array('opening_hours_weekday' => $row["opening_hours_weekday"],
                                'opening_hours_open_time' => $row["opening_hours_open_time"],
                                'opening_hours_close_time' => $row["opening_hours_close_time"],
                                'opening_hours_closed' => $row["opening_hours_closed"]);
                        } elseif ($row["opening_hours_weekday"] == 5) {
                            $friday = array('opening_hours_weekday' => $row["opening_hours_weekday"],
                                'opening_hours_open_time' => $row["opening_hours_open_time"],
                                'opening_hours_close_time' => $row["opening_hours_close_time"],
                                'opening_hours_closed' => $row["opening_hours_closed"]);
                        } elseif ($row["opening_hours_weekday"] == 6) {
                            $saturday = array('opening_hours_weekday' => $row["opening_hours_weekday"],
                                'opening_hours_open_time' => $row["opening_hours_open_time"],
                                'opening_hours_close_time' => $row["opening_hours_close_time"],
                                'opening_hours_closed' => $row["opening_hours_closed"]);
                        }
                    } while ($row = mysqli_fetch_assoc($result))?>
                        <div class="checkboxes">
                            <label><span style="font-weight: bold">Monday</span><span>Open</span>
                                <input type="time" step="1800" name="monday_opening_time"
                                       value="<?php echo $monday["opening_hours_open_time"] ?>"/><span>Close</span>
                                <input type="time" step="1800" name="monday_closing_time"
                                       value="<?php echo $monday["opening_hours_close_time"] ?>"/><span>Available?</span>
                                <?php
                                if ($monday["opening_hours_closed"] == 1) {
                                    echo '<input class="input-force-width" type="checkbox" name="monday_avail"/></label>';
                                } else {
                                    echo '<input class="input-force-width" type="checkbox" name="monday_avail" checked/></label>';
                                }
                                ?>

                                <label><span style="font-weight: bold">Tuesday</span><span>Open</span>
                                    <input type="time" step="1800" name="tuesday_opening_time"
                                           value="<?php echo $tuesday["opening_hours_open_time"] ?>"/><span>Close</span>
                                    <input type="time" step="1800" name="tuesday_closing_time"
                                           value="<?php echo $tuesday["opening_hours_close_time"] ?>"/><span>Available?</span>
                                    <?php
                                    if ($tuesday["opening_hours_closed"] == 1) {
                                        echo '<input class="input-force-width" type="checkbox" name="tuesday_avail"/></label>';
                                    } else {
                                        echo '<input class="input-force-width" type="checkbox" name="tuesday_avail" checked/></label>';
                                    }
                                    ?>

                                    <label><span style="font-weight: bold">Wednesday</span><span>Open</span>
                                        <input type="time" step="1800" name="wednesday_opening_time"
                                               value="<?php echo $wednesday["opening_hours_open_time"] ?>"/><span>Close</span>
                                        <input type="time" step="1800" name="wednesday_closing_time"
                                               value="<?php echo $wednesday["opening_hours_close_time"] ?>"/><span>Available?</span>
                                        <?php
                                        if ($wednesday["opening_hours_closed"] == 1) {
                                            echo '<input class="input-force-width" type="checkbox" name="wednesday_avail"/></label>';
                                        } else {
                                            echo '<input class="input-force-width" type="checkbox" name="wednesday_avail" checked/></label>';
                                        }
                                        ?>

                                        <label><span style="font-weight: bold">Thursday</span><span>Open</span>
                                            <input type="time" step="1800" name="thursday_opening_time"
                                                   value="<?php echo $thursday["opening_hours_open_time"] ?>"/><span>Close</span>
                                            <input type="time" step="1800" name="thursday_closing_time"
                                                   value="<?php echo $thursday["opening_hours_close_time"] ?>"/><span>Available?</span>
                                            <?php
                                            if ($thursday["opening_hours_closed"] == 1) {
                                                echo '<input class="input-force-width" type="checkbox" name="thursday_avail"/></label>';
                                            } else {
                                                echo '<input class="input-force-width" type="checkbox" name="thursday_avail" checked/></label>';
                                            }
                                            ?>

                                            <label><span style="font-weight: bold">Friday</span><span>Open</span>
                                                <input type="time" step="1800" name="friday_opening_time"
                                                       value="<?php echo $friday["opening_hours_open_time"] ?>"/><span>Close</span>
                                                <input type="time" step="1800" name="friday_closing_time"
                                                       value="<?php echo $friday["opening_hours_close_time"] ?>"/><span>Available?</span>
                                                <?php
                                                if ($friday["opening_hours_closed"] == 1) {
                                                    echo '<input class="input-force-width" type="checkbox" name="friday_avail"/></label>';
                                                } else {
                                                    echo '<input class="input-force-width" type="checkbox" name="friday_avail" checked/></label>';
                                                }
                                                ?>

                                                <label><span style="font-weight: bold">Saturday</span><span>Open</span>
                                                    <input type="time" step="1800" name="saturday_opening_time"
                                                           value="<?php echo $saturday["opening_hours_open_time"] ?>"/><span>Close</span>
                                                    <input type="time" step="1800" name="saturday_closing_time"
                                                           value="<?php echo $saturday["opening_hours_close_time"] ?>"/><span>Available?</span>
                                                    <?php
                                                    if ($saturday["opening_hours_closed"] == 1) {
                                                        echo '<input class="input-force-width" type="checkbox" name="saturday_avail"/></label>';
                                                    } else {
                                                        echo '<input class="input-force-width" type="checkbox" name="saturday_avail" checked/></label>';
                                                    }
                                                    ?>

                                                    <label><span
                                                                style="font-weight: bold">Sunday</span><span>Open</span>
                                                        <input type="time" step="1800" name="sunday_opening_time"
                                                               value="<?php echo $sunday["opening_hours_open_time"] ?>"/><span>Close</span>
                                                        <input type="time" step="1800" name="sunday_closing_time"
                                                               value="<?php echo $sunday["opening_hours_close_time"] ?>"/><span>Available?</span>
                                                        <?php
                                                        if ($sunday["opening_hours_closed"] == 1) {
                                                            echo '<input class="input-force-width" type="checkbox" name="sunday_avail"/></label>';
                                                        } else {
                                                            echo '<input class="input-force-width" type="checkbox" name="sunday_avail" checked/></label>';
                                                        }
                                                        ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
            <div style="text-align: right">
                <button type="submit"
                        class="btn btn-default modal-close-btn btn-success"
                        name="update_barbershop">Update
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
                        echo "<p class='success'>Successfully updated barbershop!</p>";
                        exit();
                    }
                }
                ?>
            </div>
        </form>
    </div>
</div>