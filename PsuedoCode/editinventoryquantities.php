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

$query = <<< EOT
SELECT
    distinct
	i.item_id
	, i.item_name
	, d.distributor_name
	, i.amount_tins
	, i.amount_bags
	, i.minimum_amount
	, d.name
FROM
    company_revised.tbl_inventory i
    , company_revised.tbl_distributor_inventory di
    , company_revised.tbl_distributors d
WHERE
	i.distributor_id = d.distributor_id
ORDER BY item_id;
EOT;

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
        <th>Amount in Tins(lbs) &nbsp&nbsp</th>
        <th>Amount in bags(lbs) &nbsp&nbsp</th>
        <th>Minimum Amount  &nbsp&nbsp</th>
        <th><i>Quick Edit</i></th>
    </tr>
EOT;

$counter = 1;
while($db_field = mysql_fetch_assoc($result)) {
    echo("<tr>");
    $id = $db_field['item_id'];
    echo( "<td>&nbsp" . $db_field['item_id'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['item_name'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['distributor_name'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['amount_tins'] .  "&nbsp</td>" .
        "<td><div id=\"t$counter\">" . $db_field['amount_bags'] .  "</div></td>" .
        "<td>&nbsp" . $db_field['minimum_amount'] .  "&nbsp</td>" .
        "<td><input type='text' style='width:115px '   id='" . $id . "' value=''></td>" .
        "<td><input type='button' value='Add' onclick='addItem(" . $id . ")' " .
        "<td><input type='button' value='Remove' onclick='removeItem(" . $id . ")' "
    );
    $counter++;
    echo("</tr>");
}
echo("</table><br /><br /><br /><br />");

$wrap->createFooter();
?>