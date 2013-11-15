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

$id = $_GET['ordernumber'];


$query = <<< EOT
SELECT
	e.user_name
	,e.first_name
	, e.last_name
	, o.order_id
	, oi.item_id
	, i.item_name
	, oi.quantity
	, oi.number_of_1oz
	, oi.number_of_2oz
	, oi.number_of_4oz
	, oi.number_of_8oz
	, oi.number_of_16oz
FROM
	tbl_employees e
	, tbl_orders o
	, tbl_inventory i
	, tbl_order_items oi
WHERE
	 i.item_id = oi.item_id
	AND o.order_id = oi.order_id
	AND e.employee_id = o.employee_id
	AND o.order_id = $id
ORDER BY e.user_name, e.first_name, e.last_name, o.order_id
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




$db_field = mysql_fetch_assoc($result);
echo ("
    <p> Order detaisl for: "
        .  $db_field['first_name'] . " "
        . $db_field['last_name'] . " Order Number: "
        . $db_field['order_id']
);

echo <<< EOT
<table>
    <tr>
        <th><b>Item Id &nbsp</b></th>
        <th><b>Item Name &nbsp</b></th>
        <th><b>Quantity &nbsp&nbsp</b></th>
        <th><b>1oz &nbsp&nbsp</b></th>
        <th><b>2oz &nbsp&nbsp</b></th>
        <th><b>4oz &nbsp&nbsp</b></th>
        <th><b>8oz &nbsp&nbsp</b></th>
        <th><b>16oz &nbsp&nbsp</b></th>
        <th><b>Total</b></th>
    </tr>
EOT;
$completeTotal = 0;
do {
    $completeTotal += $total =
        $db_field["number_of_1oz"]
        + ($db_field["number_of_2oz"] * 2)
        + ($db_field["number_of_4oz"] *4)
        + ($db_field["number_of_8oz"] * 8)
        + ($db_field["number_of_16oz"] *16);
    echo("<tr>");
    echo( "<td>&nbsp" . $db_field['item_id'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['item_name'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['quantity'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['number_of_1oz'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['number_of_2oz'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['number_of_4oz'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['number_of_8oz'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['number_of_16oz'] .  "&nbsp</td>" .
        "<td><u>&nbsp" . $total .  "&nbsp</u></td>"

    );
    echo("</tr>");
} while($db_field = mysql_fetch_assoc($result));
echo("<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td><b>SUM</b></td><td><b><u>$completeTotal</u></b></td>");
echo("</table><br /><br /><br /><br />");


$wrap->createFooter();
?>