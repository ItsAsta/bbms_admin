<?php
session_start();

include_once('inc/header.inc.php');
include_once('inc/dbh.inc.php');
headerOutput('Home', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Home');
if (empty($_SESSION["email"])) {
    header("location: login.php");
}
?>
<div class="container-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <h5 style="margin-top: 20px">Upcoming Bookings</h5>
                <hr>
                <table id="upcomingBookingsTable" class="custom-table table table-striped table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="th-sm">Booking Reference</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Date & Time Booked</th>
                        <th class="th-sm">Barber</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($_SESSION["barbershop_id"])) {
                        $iniSql = "UPDATE `booking` set `booking_status` = 1 WHERE `barbershop_id` = " . $_SESSION["barbershop_id"] . " AND cast(booking_date_time_booked as date) <= cast(NOW() as date) AND cast(booking_date_time_booked as time(0)) < cast(NOW() as time(0))";
                        $iniResult = mysqli_query($db, $iniSql);

                        $sql = "SELECT `booking`.*, `user`.*, `barber`.* FROM `booking` INNER JOIN `user` ON booking.booking_email = user.user_email INNER JOIN `barber` ON booking.barber_id = barber.barber_id WHERE booking.barbershop_id = " . $_SESSION["barbershop_id"] . " AND `booking_status` = 0 ORDER BY CAST(booking_date_time_booked AS DATE) ASC LIMIT 7";
                        $result = mysqli_query($db, $sql);
                        $resultCheck = mysqli_num_rows($result);

                        if ($resultCheck > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>" . $row["booking_reference"] . "</td>";
                                echo "<td>" . $row["user_first_name"] . " " . $row["user_last_name"] . "</td>";
                                echo "<td>" . date("d-m-Y g:i A", strtotime($row["booking_date_time_booked"])) . "</td>";
                                echo "<td>" . $row["barber_name"] . "</td></tr>";
                            }
                        }
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php if (!empty($_SESSION["barbershop_id"])) { ?>
    <div class="container" id="overviewContainer" style="padding: 0 10px 5px 10px">
        <?php
            $todaysBookingsSql = "SELECT * FROM `booking` WHERE barbershop_id = " . $_SESSION["barbershop_id"] . " AND cast(`booking_date_time_booked` as date) = cast(NOW() as date)";
            $todaysBookingsResult = mysqli_query($db, $todaysBookingsSql);
            $todaysBookingsResultCheck = mysqli_num_rows($todaysBookingsResult);

            $activeBookingsSql = "SELECT * FROM `booking` WHERE barbershop_id = " . $_SESSION["barbershop_id"] . " AND booking_status = 0";
            $activeBookingsSqlResult = mysqli_query($db, $activeBookingsSql);
            $activeBookingsSqlResultCheck = mysqli_num_rows($activeBookingsSqlResult);

            $bookingsSql = "SELECT * FROM booking WHERE barbershop_id = " . $_SESSION["barbershop_id"];
            $bookingsResult = mysqli_query($db, $bookingsSql);
            $bookingsResultCheck = mysqli_num_rows($bookingsResult);

            $customersSql = "SELECT DISTINCT `booking_email` FROM `booking` WHERE `barbershop_id` = " . $_SESSION["barbershop_id"];
            $customersResult = mysqli_query($db, $customersSql);
            $customersResultCheck = mysqli_num_rows($customersResult);
        ?>
        <h5 style="margin-top: 10px">Overview</h5>

        <hr>

        <div class="col-sm overview-col-sm" style="background-color: #00446e">
            <div class="col-sm-title">
                <h5 class="col-sm-title"><?php echo $todaysBookingsResultCheck?></h5>
                <p>Total Bookings Today</p>
            </div>
        </div>

        <div class="col-sm overview-col-sm" style="background-color: #00446e">
            <div class="col-sm-title">
                <h5 class="col-sm-title"><?php echo $activeBookingsSqlResultCheck?></h5>
                <p>Active Bookings</p>
            </div>
        </div>

        <div class="col-sm overview-col-sm" style="background-color: #00446e">
            <div class="col-sm-title">
                <h5 class="col-sm-title"><?php echo $bookingsResultCheck ?></h5>
                <p>Overall Bookings</p>
            </div>
        </div>

        <div class="col-sm overview-col-sm" style="background-color: #00446e">
            <div class="col-sm-title">
                <h5 class="col-sm-title"><?php echo $customersResultCheck ?></h5>
                <p>Customers</p>
            </div>
        </div>
        <?php } exit();?>
    </div>
</div>