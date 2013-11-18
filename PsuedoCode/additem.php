<?php
session_start();
$_SESSION['authorized'] = true;
include_once 'config.dbconfig.inc';


$r1 = $_POST['r1oz'];
$r2 = $_POST['r2oz'];
$r4 = $_POST['r4oz'];
$r8 = $_POST['r8oz'];
$r16 = $_POST['r16oz'];
$e1 = $_POST['e1oz'];
$e2 = $_POST['e2oz'];
$e4 = $_POST['e4oz'];
$e8 = $_POST['e8oz'];
$e16 = $_POST['e16oz'];
$costPerPound = $_POST['cost_per_pound'];

$itemName = $_POST['name'];
$distributor = $_POST['distributor_id'];
$itemNumber = $_POST['item_number'];
$amountBags = $_POST['amount_bags'];

//Set the authorization to false by default for the session
$_SESSION['authorized'] = false;

//Connect to the database
$db = mysql_connect($host, $username, $password);
if (!$db) {
    die("Internal Server Error");
}

//select the database
$er = mysql_select_db($database);
if(!$er) {
    exit("<div style = \"text-align: center\"><b style=\"font-size: 25px\">Internal server error</b><br /><br />  But here is a picture<br /><img src='img/codeon.png' />");
}

$query = "CALL add_to_pricing('$r1','$r2','$r4','$r8','$r16','$e1','$e2','$e4','$e8','$e16','$costPerPound');";

$secondQuery = "CALL add_to_inventory('$itemName', '$distributor','$itemNumber', '$amountBags');";

$result = mysql_query($query);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    die($message);
}
$result = mysql_query($secondQuery);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    die($message);
}

echo("
        <html>
            <head>
                <script type=\"text/javascript\">
                    alert(\"Item Created\");
                    window.location = 'createnewitem.php'
                </script>
            </head>
        </html>
    ");

    mysql_close($db);

