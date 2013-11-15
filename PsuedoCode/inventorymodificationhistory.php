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

$wrap->createTopMenu(2, "Inventory Modification History");

//$wrap->createMainPageBody();

echo <<< EOT

<p>Body goes here</p>

EOT;


$wrap->createFooter();
?>