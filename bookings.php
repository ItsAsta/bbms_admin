<?php
session_start();

include_once('inc/header.inc.php');
include_once('inc/dbh.inc.php');
headerOutput('Bookings', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Bookings');
if (empty($_SESSION["email"])) {
    header("location: login.php");
}
?>

<div id="bookingTableContent" class="col-sm" style="background-color: #1e1e1e">
    <table id="bookingTable" class="custom-table table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th class="th-sm">Booking Reference</th>
            <th class="th-sm">Email</th>
            <th class="th-sm">Date/Time Booked</th>
            <th class="th-sm">Barber</th>
            <th class="th-sm">Status</th>
            <th class="th-sm">Details</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if (isset($_SESSION["email"])) {
            $sql = "SELECT `booking`.*, `barbershop`.*, `user`.*, `barber`.* FROM `booking` INNER JOIN `barbershop` ON booking.barbershop_id = barbershop.barbershop_id INNER JOIN `user` ON booking.booking_email = user.user_email INNER JOIN `barber` ON booking.barber_id = barber.barber_id WHERE booking.barbershop_id = '" . $_SESSION["barbershop_id"] . "'";
            $result = mysqli_query($db, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>

                    <?php
                    echo "<tr><td>" . $row["booking_reference"] . "</td>";
                    echo "<td>" . $row["booking_email"] . "</td>";
                    echo "<td>" . date("d-m-Y g:i A", strtotime($row["booking_date_time_booked"])) . "</td>";
                    echo "<td>" . $row["barber_name"] . "</td>";
                    if (intval($row["booking_status"]) == 1) {
                        echo "<td style='color: red'>";
                        echo "Cancelled";
                    } else {
                        echo "<td style='color: green'>";
                        echo "Active";
                    }
                    echo "</td><td>
                <button type='button' class='view-booking-details btn' data-toggle='modal' data-target='#" . $row["booking_reference"] . "'>VIEW<i class='fas fa-eye' style='padding: 5px'></i>
                </button></td></tr>";

                    ?>
                    <!-- View Booking Details Modal -->
                    <div class="modal modal-container" id="<?php echo $row['booking_reference']; ?>" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title">
                                        <h5 style="font-weight: bold">Booking
                                            No. <?php echo $row['booking_reference']; ?></h5>
                                        <h6 style="font-weight: bold"><?php echo $row['user_first_name'];
                                            echo ' ';
                                            echo $row['user_last_name'] ?></h6>

                                        <?php if (intval($row["booking_status"]) == 1) {
                                            echo "<h6 style='color: red'>";
                                            echo "Cancelled </h6>";
                                        } else {
                                            echo "<h6 style='color: green'>";
                                            echo "Active </h6>";
                                        } ?>

                                    </div>
                                    <a class="btn btn-default modal-close-btn" data-dismiss="modal">&times;</a>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row">
                                        <div class="col-sm-auto">
                                            <!-- Add modal content here -->
                                            <h6 style="font-weight: bold">Barbershop</h6>
                                            <h6><?php echo $row['barbershop_name']; ?></h6>
                                            <h6 style="font-weight: bold">Barber</h6>
                                            <h6><?php echo $row['barber_name']; ?></h6>
                                        </div>
                                        <div class="col-sm-auto">
                                            <!-- Add modal content here -->
                                            <h6 style="font-weight: bold">Branch</h6>
                                            <h6><?php echo $row['barbershop_branch']; ?></h6>
                                            <h6 style="font-weight: bold">Date & Time</h6>
                                            <h6><?php echo date("d-m-Y g:i A", strtotime($row['booking_date_time_booked'])); ?></h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <?php
                                    if ($row["booking_status"] == 0) {
                                        echo '<button type="submit" class="btn btn-default modal-close-btn btn-danger"
                                            data-toggle="modal"
                                            data-target="#' . $row['booking_reference'] . 'Cancel">Cancel Booking
                                    </button>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Cancel Booking Modal -->
                    <div class="modal modal-container" id="<?php echo $row['booking_reference']; ?>Cancel"
                         role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title">
                                        <h5>CANCELLING BOOKING</h5>
                                    </div>
                                </div>
                                <div class="modal-body p-4">
                                    <div class="row">
                                        <div class="col-sm-auto">
                                            <!-- Add modal content here -->
                                            <p>Are you sure you want to cancel booking number
                                                <b><?php echo $row['booking_reference'] ?></b>?</p>
                                            <b>The customer must rebook again!</b>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <form method="post" action="inc/cancel_booking.inc.php">
                                        <input type="hidden" name="booking_ref"
                                               value="<?php echo $row["booking_reference"] ?>">
                                        <button type="submit" class="btn btn-default modal-close-btn btn-success"
                                                name="cancel_booking">YES
                                        </button>
                                        <button class="btn btn-default modal-close-btn btn-danger"
                                                data-dismiss="modal">
                                            NO
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                } exit();
            } else {
                echo "No data";
                exit();
            }
        }
        ?>
        </tbody>
        <tfoot>
        <tr>
            <th class="th-sm">Booking Reference</th>
            <th class="th-sm">Email</th>
            <th class="th-sm">Date/Time Booked</th>
            <th class="th-sm">Barber</th>
            <th class="th-sm">Status</th>
            <th class="th-sm">Details</th>
        </tr>
        </tfoot>
    </table>
</div>
