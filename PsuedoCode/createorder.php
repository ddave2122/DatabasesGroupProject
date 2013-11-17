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

</p>
EOT;

$wrap->createFooter();
?>