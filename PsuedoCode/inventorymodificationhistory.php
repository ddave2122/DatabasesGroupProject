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

$query = <<< EOT
SELECT
	e.user_name
	, i.item_name
	, im.modification_date
	, im.quantity_changed
	, im.item_id
FROM
	company_revised.tbl_employees e
	, company_revised.tbl_inventory i
	, company_revised.tbl_inventory_modifications im
WHERE
	e.employee_id = im.employee_id
	AND i.item_id = im.item_id
ORDER BY im.modification_date DESC
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
    $message .= 'Whole query: ' . $mainquery;
    die($message);
}


echo <<< EOT
<table class="linetable">
    <tr class="linetable">
        <th><b>User Name&nbsp</b></th>
        <th><b>Item&nbsp</b></th>
        <th><b>Modification Date&nbsp</b></th>
        <th><b>Quantity Changed&nbsp</b></th>
        <th><b>Item Id&nbsp</b></th>
    </tr>
EOT;
while($db_field = mysql_fetch_assoc($result)) {
    echo("<tr class=\"linetable\">");
    echo(
        "<td >&nbsp" . $db_field['user_name'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['item_name'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['modification_date'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['quantity_changed'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['item_id'] .  "&nbsp</td>"
    );
    echo("</tr>");
}
echo("</table><br /><br /><br /><br />");



$wrap->createFooter();
?>