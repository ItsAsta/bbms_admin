<?php
session_start();

include_once('inc/header.inc.php');
include_once('inc/dbh.inc.php');
headerOutput('Users', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Users');
?>

<div class="container-wrapper">
    <div class="container" style="text-align: center">
        <div class="row">
            <div class="col-sm">
                <h5 style="margin-top: 15px">Users</h5>
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
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = "SELECT DISTINCT `booking_email`, `user`.* FROM `booking` INNER JOIN `user` ON booking.booking_email = user.user_email WHERE `barbershop_id` = " . $_SESSION["barbershop_id"];
                    $result = mysqli_query($db, $sql);
                    $resultCheck = mysqli_num_rows($result);
                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            echo "<tr><td>" . $row["user_email"] . "</td>";
                            echo "<td>" . $row["user_first_name"] . " " . $row["user_last_name"] . "</td>";
                            echo "<td>" . $row["user_address"] . "</td>";
                            echo "<td>" . $row["user_postcode"] . "</td>";
                            echo "<td>" . $row["user_phone_number"] . "</td>";
                            echo "<td><button type='button' class='view-booking-details btn' data-toggle='modal' data-target='#" . $row["user_email"] . "'>Update<i class='fas fa-eye' style='padding: 5px'></i>
                            </button></td></tr>"
                            ?>

                            <!--        EDIT BARBER DETAILS            -->
                            <div class="modal modal-container" id="<?php echo $row['user_email']; ?>"
                                 role="dialog">
                                <div class="modal-dialog">
                                    <form method="post" action="inc/update_user.inc.php">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="modal-title">
                                                    <h5 style="font-weight: bold; text-transform: uppercase;"><?php echo $row['user_email'] ?></h5>
                                                    <h6 style="font-weight: bold"><?php echo $row['user_first_name'] . " " . $row["user_last_name"] ?></h6>
                                                </div>
                                                <a class="btn btn-default modal-close-btn"
                                                   data-dismiss="modal">&times;</a>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="row">
                                                    <div class="col-sm-auto">
                                                        <!-- Add modal content here -->

                                                        <input type="hidden" name="user_email"
                                                               value="<?php echo $row['user_email'] ?>">

<!--                                                        <label>Email</label>-->
<!--                                                        <br>-->
<!--                                                        <input type="text" name="user_email"-->
<!--                                                               value="--><?php //echo $row['user_email'] ?><!--">-->
<!---->
<!--                                                        <br>-->

                                                        <label>First Name</label>
                                                        <br>
                                                        <input type="text" name="user_first_name"
                                                               value="<?php echo $row['user_first_name'] ?>">

                                                        <br>

                                                        <label>Last Name</label>
                                                        <br>
                                                        <input type="text" name="user_last_name"
                                                               value="<?php echo $row['user_last_name'] ?>">



                                                    </div>
                                                    <div class="col-sm-auto">
                                                        <!-- Add modal content here -->
                                                        <label>Address</label>
                                                        <br>
                                                        <input type="text" name="user_address"
                                                               value="<?php echo $row['user_address'] ?>">

                                                        <br>

                                                        <label>Postcode</label>
                                                        <br>
                                                        <input type="text" name="user_postcode"
                                                               value="<?php echo $row['user_postcode'] ?>">

                                                        <br>

                                                        <label>Phone Number</label>
                                                        <br>
                                                        <input type="text" name="user_phone_number"
                                                               value="<?php echo $row['user_phone_number'] ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit"
                                                        class="btn btn-default modal-close-btn btn-success"
                                                        name="update_user">UPDATE
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
