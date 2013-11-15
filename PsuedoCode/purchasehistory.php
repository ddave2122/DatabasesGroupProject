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

//Generate a table for all of the purchase items

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
	company_revised.tbl_employees e
	, company_revised.tbl_orders o
	, company_revised.tbl_inventory i
	, company_revised.tbl_order_items oi
WHERE
	 i.item_id = oi.item_id
	AND o.order_id = oi.order_id
	AND e.employee_id = o.employee_id
ORDER BY e.user_name, e.first_name, e.last_name, o.order_id;
EOT;

$tableCounter = 0;
$sideTables = array();
$isFirst = true;
$usernames = array();
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
    $message .= 'Whole query: ' . $query;
    die($message);
}
$uname = "";
$orderId = -1;

echo("<h1>Users</h1>");


while($db_field = mysql_fetch_assoc($result)) {
    if($uname != $db_field['user_name'])
    {
        if(!$isFirst)
        {
            echo("</tbody> </table>");
            $isFirst = false;
        }
        $uname = $db_field['user_name'];
        echo <<< EOT

            <table  id="mytable$tableCounter">
            <thead>
                <tr">
                    <td>
                        <a id="anchor$tableCounter" class="expand$tableCounter" href="#anchor$tableCounter" onclick="return false;">$uname</a>
                    </td>
                    <td>
                        <a style="visibility:hidden" id="anchorcollapse$tableCounter" class="collapse$tableCounter" href="#anchor$tableCounter" onclick="return false;">Collapse</a>
                    </td>
                    <td></td>
                </tr>
                <tr id="row1$tableCounter" style="visibility: hidden;" >
                    <td >
                        <b>user name</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    </td>
                    <td align=\"center\" >
                        <b>Name</b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                    </td>
                    <td align=\"center\">
                        <b>Order id</b>
                    </td>
                </tr>
            </thead>
            <tbody >
EOT;
        $tableCounter++;
    }
    if($orderId != $db_field['order_id'])
    {
        $orderId = $db_field['order_id'];
    }
    else
    {
        continue;
    }
    $usernames[$tableCounter] = $db_field['user_name'];
    echo("<tr>");
    echo(
        "<td>&nbsp" . $db_field['user_name'] .  "&nbsp</td>" .
        "<td>&nbsp" . $db_field['first_name'] ." " . $db_field['last_name'] .  "&nbsp</td>" .
        "<td><a onclick=\"\" href=\"orderdetails.php?ordernumber=" .  $db_field['order_id']."\"> &nbsp" . $db_field['order_id'] .  "&nbsp</a></td>"
    );
    echo("</tr>");
$sideTables[$tableCounter] =  <<< EOT
<aside>
<div id="id_$tableCounter" style="visibility:hidden">
    <table>
        <th>
            Order Id
        </th><th>
           Item ID
        </th><th>
            Item Name
        </th><th>
            Quantity
        </th><th>
            1oz
        </th><th>
            2oz
        </th><th>
            4oz
        </th><th>
            8oz
        </th><th>
            16oz
        </th>
    </table>
</div>
</aside>
EOT;

}
echo("</table>");

echo("<script>");
for($i = 0; $i < $tableCounter; $i++)
{
    echo <<< EOT
        $("#mytable$i tbody").hide("fast");

         $(document).ready(function () {
                $(".expand$i").click(function () {
                    $("#mytable$i tbody").show("slow");
                    document.getElementById("anchorcollapse$i").style.visibility="visible";
                    document.getElementById("row1$i").style.visibility="visible";
                });
                $(".collapse$i").click(function () {
                    $("#mytable$i tbody").hide("slow");
                    document.getElementById("anchorcollapse$i").style.visibility="hidden";
                    document.getElementById("row1$i").style.visibility="hidden";
                });
            });
EOT;
}
echo("</script>");


$wrap->createFooter();
?>