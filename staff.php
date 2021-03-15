<?php
session_start();

include_once('inc/header.inc.php');
include_once('inc/dbh.inc.php');
headerOutput('Staff', array("assets/styles/bootstrap.css", "assets/styles/stylesheet.css", "assets/styles/picker.css"));
navigationOutput('Staff');
?>
<div class="staff-container">
    <button onclick="window.location.href='barbers.php'">Barbers</button>
    <button onclick="window.location.href='customers.php'">Customers</button>
</div>
