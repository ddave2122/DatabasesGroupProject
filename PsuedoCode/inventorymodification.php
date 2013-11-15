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

$wrap->createTopMenu(3, "Inventory Modification Options");

//$wrap->createMainPageBody();

echo <<< EOT

<p>
    <ul>
        <li><a href="editinventoryquantities.php">Edit Inventory Quantities</a></li>
        <li><a href="edititemprices.php">Edit Item Prices</a></li>
    </ul>
    <br /> <br />
</p>

EOT;


$wrap->createFooter();
?>