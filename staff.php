<?php
session_start();

include_once('inc/header.inc.php');
include_once('inc/dbh.inc.php');
headerOutput('Staff', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Staff');
if (empty($_SESSION["email"])) {
    header("location: login.php");
}
?>

<div class="container-wrapper">
    <div class="container" style="text-align: center">
        <div class="row">
            <div class="col-sm">
                <div class="invis-container">
                    <button onclick="window.location.href='register.php'">Register Staff</button>
                </div>
                <h5 style="margin-top: 15px">Staff</h5>
                <hr>
                <table id="barbersTable" class="custom-table table table-striped table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="th-sm">Email</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Address</th>
                        <th class="th-sm">Postcode</th>
                        <th class="th-sm">Phone Number</th>
                        <th class="th-sm"></th>
                        <th class="th-sm"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT * FROM `staff` WHERE NOT(`staff_email` = '" . $_SESSION["email"] . "') AND `barbershop_id` = " . $_SESSION["barbershop_id"];
                    $result = mysqli_query($db, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<tr><td>" . $row["staff_email"] . "</td>";
                            echo "<td>" . $row["staff_first_name"] . " " . $row["staff_last_name"] . "</td>";
                            echo "<td>" . $row["staff_address"] . "</td>";
                            echo "<td>" . $row["staff_postcode"] . "</td>";
                            echo "<td>" . $row["staff_phone_number"] . "</td>";
                            echo "<form method='post' action='inc/staff.inc.php'><input type='hidden' name='staff_email' value=" . $row["staff_email"] . ">";
                            echo "<td><button type='button' class='view-booking-details btn' data-toggle='modal' data-target='#" . $row["staff_email"] . "'>Update<i class='fas fa-eye' style='padding: 5px'></i>
                            </button></td>";
                            echo "<td><button type='submit' class='view-booking-details btn' name='remove_staff'>Remove<i class='fas fa-window-close' style='padding: 5px'></i>
                            </button></td></form></tr>"
                            ?>

                            <?php
                            if (isset($_GET["error"])) {
                                if ($_GET["error"] == "empty") {
                                    echo "<p class='error'>Can't complete action: One or more fields are empty!</p>";
                                } elseif ($_GET["error"] == "email") {
                                    echo "<p class='error'>Can't complete action: Invalid email format!</p>";
                                } else if ($_GET["error"] == "password") {
                                    echo "<p class='error'>Can't complete action: Passwords are not matching!</p>";
                                } else if ($_GET["error"] == "phoneNumber") {
                                    echo "<p class='error'>Can't complete action: Invalid phone number format!</p>";
                                }
                            }
                            ?>

                            <div class="modal modal-container" id="<?php echo $row['staff_email']; ?>"
                                 role="dialog">
                                <div class="modal-dialog">
                                    <form method="post" action="inc/staff.inc.php">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="modal-title">
                                                    <h5 style="font-weight: bold; text-transform: uppercase;"><?php echo $row['staff_email'] ?></h5>
                                                    <h6 style="font-weight: bold"><?php echo $row['staff_first_name'] . " " . $row["staff_last_name"] ?></h6>
                                                </div>
                                                <a class="btn btn-default modal-close-btn"
                                                   data-dismiss="modal">&times;</a>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row">
                                                    <div class="col-sm-auto">
                                                        <!-- Add modal content here -->
                                                        <label>First Name</label>
                                                        <br>
                                                        <input type="text" name="staff_first_name"
                                                               value="<?php echo $row['staff_first_name'] ?>">

                                                        <br>

                                                        <label>Last Name</label>
                                                        <br>
                                                        <input type="text" name="staff_last_name"
                                                               value="<?php echo $row['staff_last_name'] ?>">

                                                        <br>

                                                        <label>Barbershop ID</label>
                                                        <br>
                                                        <input type="text" name="barbershop_id"
                                                               value="<?php echo $row['barbershop_id'] ?>">

                                                        <br>


                                                        <label>Email</label>
                                                        <br>
                                                        <input type="text" name="staff_email"
                                                               value="<?php echo $row['staff_email'] ?>">
                                                        <input type='hidden' name='staff_current_email'
                                                               value="<?php echo $row["staff_email"] ?>">

                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <!-- Add modal content here -->
                                                        <label>Address</label>
                                                        <br>
                                                        <input type="text" name="staff_address"
                                                               value="<?php echo $row['staff_address'] ?>">

                                                        <br>

                                                        <label>Postcode</label>
                                                        <br>
                                                        <input type="text" name="staff_postcode"
                                                               value="<?php echo $row['staff_postcode'] ?>">

                                                        <br>

                                                        <label>Phone Number</label>
                                                        <br>
                                                        <input type="text" name="staff_phone_number"
                                                               value="<?php echo $row['staff_phone_number'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit"
                                                        class="btn btn-default modal-close-btn btn-success"
                                                        name="update_staff">UPDATE
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                        exit();
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
