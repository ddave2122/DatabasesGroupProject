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
<h1>
Add Item
</h1>
<form name="createorder" action="additem.php" method="post">
        <table>
        <tr>
            <th>Name</th>
            <th>Distributor_id</th>
            <th>Item Number</th>
            <th>Amount Tins</th>
        </tr>
        <tr>
            <td><input type="text" name="name" id="name"/></td>
            <td><input type="text" name="distributor_id" id="distributor_id"/></td>
            <td><input type="text" name="item_number" id="item_number"/></td>
            <td><input type="text" name="amount_bags" id="amount_bags"/></td>
        </tr>
        <tr>
            <td><b>Retail Priing</b></td>
        </tr>
        <tr>
            <th>Price 1oz</th>
            <th>Price 2oz</th>
            <th>Price 4oz</th>
            <th>Price 8oz</th>
            <th>Price 16oz</th>
        </tr>
        <tr>
            <td><input type="text" name="r1oz" id="r1oz"/></td>
            <td><input type="text" name="r2oz" id="r2oz"/></td>
            <td><input type="text" name="r4oz" id="r4oz"/></td>
            <td><input type="text" name="r8oz" id="r8oz"/></td>
            <td><input type="text" name="r16oz" id="r16oz"/></td>
        </tr>
                <tr>
            <td><b>Employee Priing</b></td>
        </tr>
        <tr>
            <th>Price 1oz</th>
            <th>Price 2oz</th>
            <th>Price 4oz</th>
            <th>Price 8oz</th>
            <th>Price 16oz</th>
        </tr>
        <tr>
            <td><input type="text" name="e1oz" id="e1oz"/></td>
            <td><input type="text" name="e2oz" id="e2oz"/></td>
            <td><input type="text" name="e4oz" id="e4oz"/></td>
            <td><input type="text" name="e8oz" id="e8oz"/></td>
            <td><input type="text" name="e16oz" id="e16oz"/></td>
        </tr>
        <tr>
            <td>&nbsp</td>
        </tr>
        <tr>
            <td><b>Item Cost Per Pound:</b></td>
            <td><input type="text" name="cost_per_pound" id="cost_per_pound"/></td>
        </tr>
  </table>
    <input type="submit" id="button" value="Create Item" />
</form>

EOT;


$wrap->createFooter();
?>