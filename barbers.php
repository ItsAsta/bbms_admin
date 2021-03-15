<?php
session_start();

include_once('inc/header.inc.php');
include_once('inc/dbh.inc.php');
headerOutput('Barbers', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Barbers');
?>

<div class="container-wrapper">
    <div class="container" style="min-width: 70%;">
        <div class="row">
            <div class="col-sm">
                <div class="invis-container">
                    <button onclick="window.location.href='add_barber.php'">Add Barber</button>
                </div>
                <h5 style="margin-top: 15px">Barbers</h5>
                <hr>
                <table id="barbersTable" class="custom-table table table-striped table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="th-sm">Barber ID</th>
                        <th class="th-sm">Name</th>
                        <th class="th-sm">Experience (Years)</th>
                        <th class="th-sm">Speciality</th>
                        <th class="th-sm">Status</th>
                        <th class="th-sm"></th>
                        <th class="th-sm"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_SESSION["barbershop_id"])) {

                        $sql = "SELECT * FROM `barber` WHERE barbershop_id = " . $_SESSION["barbershop_id"];
                        $result = mysqli_query($db, $sql);
                        $resultCheck = mysqli_num_rows($result);

                        if ($resultCheck > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr><td>" . $row["barber_id"] . "</td>";
                                echo "<td>" . $row["barber_name"] . "</td>";
                                echo "<td>" . $row["barber_experience"] . " YEARS</td>";
                                echo "<td>" . $row["barber_speciality"] . "</td>";
                                if (intval($row["barber_status"]) == 1) {
                                    echo "<td style='color: red'> HOLIDAY </td>";
                                } else {
                                    echo "<td style='color: green'> ON </td>";
                                }
                                echo "<form method='post' action='inc/barbers.inc.php'><input type='hidden' name='barber_id' value=" . $row["barber_id"] . ">";

                                echo "<td><button type='button' class='view-booking-details btn' data-toggle='modal' data-target='#" . $row["barber_id"] . "'>Edit<i class='fas fa-eye' style='padding: 5px'></i>
                </button></td>";
                                echo "<td><button type='submit' class='view-booking-details btn' name='updateBarberStatus'>Status<i class='fas fa-eye' style='padding: 5px'></i>
                </button></td></form></tr>";
                                ?>

                                <!--        EDIT BARBER DETAILS            -->
                                <div class="modal modal-container" id="<?php echo $row['barber_id']; ?>"
                                     role="dialog">
                                    <div class="modal-dialog">
                                        <form method="post" action="inc/barbers.inc.php">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="modal-title">
                                                        <h5 style="font-weight: bold">Barber
                                                            ID: <?php echo $row['barber_id'] ?></h5>
                                                        <h6 style="font-weight: bold"><?php echo $row['barber_name'] ?></h6>

                                                        <?php if (intval($row["barber_status"]) == 1) {
                                                            echo "<h6 style='color: red'>";
                                                            echo "Holiday </h6>";
                                                        } else {
                                                            echo "<h6 style='color: green'>";
                                                            echo "ON </h6>";
                                                        } ?>
                                                    </div>
                                                    <a class="btn btn-default modal-close-btn" data-dismiss="modal">&times;</a>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-sm-auto">
                                                            <!-- Add modal content here -->
                                                            <label>Name</label>
                                                            <br>
                                                            <input type="text" name="barberName"
                                                                   value="<?php echo $row['barber_name'] ?>">

                                                            <br>

                                                            <label>Experience (YEARS)</label>
                                                            <br>
                                                            <input type="text" name="barberExperience"
                                                                   value="<?php echo $row['barber_experience'] ?>">

                                                        </div>
                                                        <div class="col-sm-auto">
                                                            <!-- Add modal content here -->
                                                            <label>Speciality</label>
                                                            <br>
                                                            <textarea
                                                                    name="barberSpeciality"><?php echo $row['barber_speciality'] ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <?php echo "<input type='hidden' name='barber_id' value=" . $row["barber_id"] . ">"; ?>
                                                    <button type="submit"
                                                            class="btn btn-default modal-close-btn btn-danger"
                                                            name="remove_barber">Remove
                                                    </button>
                                                    <button type="submit"
                                                            class="btn btn-default modal-close-btn btn-success"
                                                            name="edit_barber">Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                        }
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
