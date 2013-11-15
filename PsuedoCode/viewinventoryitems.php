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

$query = '
    SELECT *
    FROM
        company_revised.tbl_inventory i
        , company_revised.tbl_distributors d
    where
    i.distributor_id = d.distributor_id;';

$result = mysql_query($query);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    die($message);
}




echo <<< EOT
<table>
    <tr>
        <th>ID &nbsp</th>
        <th>Name &nbsp&nbsp</th>
        <th>Distributor&nbsp&nbsp</th>
        <th>Item Number&nbsp&nbsp</th>
        <th>Amount in Tins(lbs) &nbsp&nbsp</th>
        <th>Amount in bags(lbs) &nbsp&nbsp</th>
        <th>Minimum Amount  &nbsp&nbsp</th>
    </tr>
EOT;


while($db_field = mysql_fetch_assoc($result)) {
    echo("<tr>");
    echo( "<td>&nbsp" . $db_field['item_id'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['item_name'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['distributor_name'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['item_number'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['amount_tins'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['amount_bags'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['minimum_amount'] .  "&nbsp</td>"
    );
    echo("</tr>");
}
echo("</table><br /><br /><br /><br />");

$wrap->createFooter();
?>