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
        company_revised.tbl_distributors d;';

$result = mysql_query($query);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    die($message);
}




echo <<< EOT
<table>
    <tr>
        <th>Distributor ID &nbsp</th>
        <th>Name &nbsp&nbsp</th>
        <th>Location&nbsp&nbsp</th>
        <th>Phone&nbsp&nbsp</th>
        <th>Contact Name&nbsp&nbsp</th>
        <th>Avg. Shipping Time&nbsp&nbsp</th>
    </tr>
EOT;


while($db_field = mysql_fetch_assoc($result)) {
    echo("<tr>");
    echo( "<td>&nbsp" . $db_field['distributor_id'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['name'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['location'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['phone'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['contact_name'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['average_shipping_time'] .  "&nbsp</td>"
    );
    echo("</tr>");
}
echo("</table><br /><br /><br /><br />");

$wrap->createFooter();
?>