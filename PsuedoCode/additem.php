<?php
session_start();

include_once 'config.dbconfig.inc';
if($_SESSION['auhorized'] == false)
    die("No Permissionz");

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
//TODO rewrite this to call a SP
//SP input: username and password
//SP output: boolean, true if the user is authorized, false otherwise

//Get the permission level from the DB
$mainquery = "SELECT * FROM tbl_employees where user_name = '" . $username_post . "' AND password = '" . $password_post ."';";

$result = mysql_query($mainquery);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $mainquery;
    die($message);
}

$db_field = mysql_fetch_assoc($result);


if($db_field['employee_id'] != "")
{
    //Persist the authorization for the session
    $_SESSION['authorized'] = true;

    //Direct the user to the next page
    echo("
        <html>
            <head>
                <script type=\"text/javascript\">
                    window.location = 'inventorydisplay.php'
                </script>
            </head>
        </html>
    ");
}
//If not authenticated, alert the user and direct them back to the login page
else
{
    echo <<< EOT
        <html>
            <head>
                <script type=text/javascript>
                    alert('Username and password cominabtion not found');
                    window.location = 'userlogin.html'
                </script>
            </head>
        <html>
EOT;
    mysql_close($db);

}