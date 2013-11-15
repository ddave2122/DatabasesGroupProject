<?php
session_start();
include('config.dbconfig.inc');
include('php/wrappers.php');

//Create a wrapper object
$wrap = new Wrappers();

//Check for a verified user
if($wrap->checkUserVerification() == false)
    die("No permissionz!");

//write the page header
$wrap->createHeader();

$wrap->createTopMenu(2, "Inventory Display Options");

//$wrap->createMainPageBody();

echo <<< EOT

<p>
    <ul>
        <li><a href="purchasehistory.php">View Purchase History </a></li>
        <li><a href="inventorymodificationhistory.php">View Inventory Modification History</a></li>
        <li><a href="viewdistributors.php">View Distributors</a></li>
        <li><a href="viewinventoryitems.php">View Inventory Items</a></li>
    </ul>
    <br /> <br />
</p>

EOT;


$wrap->createFooter();
?>