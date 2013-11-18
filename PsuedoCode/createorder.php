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

echo <<< EOT

<h1>
Create order
</h1>
<form name="createItem" action="addorder.php" method="post">
        <table>
        <tr>
            <th>Item Id</th>
            <th>Quantity</th>
            <th>1oz</th>
        </tr>
        <tr>
            <td><input type="text" name="item_id1" id="item_id1"/></td>
            <td><input type="text" name="quantity1" id="quantity1"/></td>
            <td><input type="text" name="1oz1" id="1oz1"/></td>

        </tr>
        <tr>
            <th>2oz</th>
            <th>4oz</th>
            <th>8oz</th>
            <th>16oz</th>
        </tr>
        <tr>
            <td><input type="text" name="2oz1" id="2oz1"/></td>
            <td><input type="text" name="4oz1" id="4oz1"/></td>
            <td><input type="text" name="8oz1" id="8oz1"/></td>
            <td><input type="text" name="16oz1" id="16oz1"/></td>
        </tr>
        <tr>
            <th>Item Id</th>
            <th>Quantity</th>
            <th>1oz</th>
        </tr>
        <tr>
            <td><input type="text" name="item_id2" id="item_id2"/></td>
            <td><input type="text" name="quantity2" id="quantity2"/></td>
            <td><input type="text" name="1oz2" id="1oz2"/></td>

        </tr>
        <tr>
            <th>2oz</th>
            <th>4oz</th>
            <th>8oz</th>
            <th>16oz</th>
        </tr>
        <tr>
            <td><input type="text" name="2oz2" id="2oz2"/></td>
            <td><input type="text" name="4oz2" id="4oz2"/></td>
            <td><input type="text" name="8oz2" id="8oz2"/></td>
            <td><input type="text" name="16oz2" id="16oz2"/></td>
        </tr>
        <tr>
            <th>Item Id</th>
            <th>Quantity</th>
            <th>1oz</th>
        </tr>
        <tr>
            <td><input type="text" name="item_id3" id="item_id3"/></td>
            <td><input type="text" name="quantity3" id="quantity3"/></td>
            <td><input type="text" name="1oz3" id="1oz3"/></td>

        </tr>
        <tr>
            <th>2oz</th>
            <th>4oz</th>
            <th>8oz</th>
            <th>16oz</th>
        </tr>
        <tr>
            <td><input type="text" name="2oz3" id="2oz3"/></td>
            <td><input type="text" name="4oz3" id="4oz3"/></td>
            <td><input type="text" name="8oz3" id="8oz3"/></td>
            <td><input type="text" name="16oz3" id="16oz3"/></td>
        </tr>
        <tr>
            <th>Item Id</th>
            <th>Quantity</th>
            <th>1oz</th>
        </tr>
        <tr>
            <td><input type="text" name="item_id4" id="item_id4"/></td>
            <td><input type="text" name="quantity4" id="quantity4"/></td>
            <td><input type="text" name="1oz4" id="1oz4"/></td>

        </tr>
        <tr>
            <th>2oz</th>
            <th>4oz</th>
            <th>8oz</th>
            <th>16oz</th>
        </tr>
        <tr>
            <td><input type="text" name="2oz4" id="2oz4"/></td>
            <td><input type="text" name="4oz4" id="4oz4"/></td>
            <td><input type="text" name="8oz4" id="8oz4"/></td>
            <td><input type="text" name="16oz4" id="16oz4"/></td>
        </tr>
        <tr>
            <th>Item Id</th>
            <th>Quantity</th>
            <th>1oz</th>
        </tr>
        <tr>
            <td><input type="text" name="item_id5" id="item_id5"/></td>
            <td><input type="text" name="quantity5" id="quantity5"/></td>
            <td><input type="text" name="1oz5" id="1oz5"/></td>

        </tr>
        <tr>
            <th>2oz</th>
            <th>4oz</th>
            <th>8oz</th>
            <th>16oz</th>
        </tr>
        <tr>
            <td><input type="text" name="2oz5" id="2oz5"/></td>
            <td><input type="text" name="4oz5" id="4oz5"/></td>
            <td><input type="text" name="8oz5" id="8oz5"/></td>
            <td><input type="text" name="16oz5" id="16oz5"/></td>
        </tr>
        <tr>
            <th>Item Id</th>
            <th>Quantity</th>
            <th>1oz</th>
        </tr>
        <tr>
            <td><input type="text" name="item_id6" id="item_id6"/></td>
            <td><input type="text" name="quantity6" id="quantity6"/></td>
            <td><input type="text" name="1oz6" id="1oz6"/></td>

        </tr>
        <tr>
            <th>2oz</th>
            <th>4oz</th>
            <th>8oz</th>
            <th>16oz</th>
        </tr>
        <tr>
            <td><input type="text" name="2oz6" id="2oz6"/></td>
            <td><input type="text" name="4oz6" id="4oz6"/></td>
            <td><input type="text" name="8oz6" id="8oz6"/></td>
            <td><input type="text" name="16oz6" id="16oz6"/></td>
        </tr>
        <tr>
            <th>Item Id</th>
            <th>Quantity</th>
            <th>1oz</th>
        </tr>
        <tr>
            <td><input type="text" name="item_id7" id="item_id7"/></td>
            <td><input type="text" name="quantity7" id="quantity7"/></td>
            <td><input type="text" name="1oz7" id="1oz7"/></td>

        </tr>
        <tr>
            <th>2oz</th>
            <th>4oz</th>
            <th>8oz</th>
            <th>16oz</th>
        </tr>
        <tr>
            <td><input type="text" name="2oz7" id="2oz7"/></td>
            <td><input type="text" name="4oz7" id="4oz7"/></td>
            <td><input type="text" name="8oz7" id="8oz7"/></td>
            <td><input type="text" name="16oz7" id="16oz7"/></td>
        </tr>
        </table>
    <input type="submit" id="button" value="Create Order" />
</form>
EOT;

$wrap->createFooter();
?>