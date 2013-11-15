<?php session_start();

require '../config.dbconfig.inc';

//Connect to the DB
$db = mysql_connect($host, $username, $password);

if (!$db) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
}

$er = mysql_select_db($database);
if(!$er) {
    exit("Couldn't find the DB!!!!");
}

$id = $_GET['id'];
$quantity = $_GET['quantity'];
$mainquery = "UPDATE company_revised.tbl_inventory set amount_bags = $quantity WHERE item_id = $id";

$result = mysql_query($mainquery);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $mainquery;
    die($message);
}

echo($quantity);

mysql_close($db);
