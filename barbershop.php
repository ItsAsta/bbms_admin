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
            <div style="text-align: center">
                <h5>Update Barbershop</h5>
            </div>
            <?php
            if (!empty($_SESSION["barbershop_id"])) {

                $sql = "SELECT * FROM `barbershop` WHERE barbershop_id = " . $_SESSION["barbershop_id"];
                $result = mysqli_query($db, $sql);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    $row = mysqli_fetch_assoc($result);
                    ?>
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
                    <div class="form-row" style="display: inline-block">
                        <div class="col-md-auto">
                            <label>Phone Number
                                <input type="text" name="phoneNumber"
                                       value="<?php echo $row["barbershop_phone_number"] ?>">
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
                    <div class="form-row">
                        <div class="col-md-auto">
                            <label>Opening
                                <input type="time" name="opening" step="3600"
                                       value="<?php echo $row["barbershop_opening_time"] ?>">
                            </label>

                            <label>Closing
                                <input type="time" name="closing" step="3600"
                                       value="<?php echo $row["barbershop_closing_time"] ?>">
                            </label>
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
                            echo "<p class='error'>One or more fields are empty!</p>";
                            exit();
                        }

                        if ($_GET["error"] == "stmtFailed") {
                            echo "<p class='error'>Could not update barbershop, please try again!</p>";
                            exit();
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