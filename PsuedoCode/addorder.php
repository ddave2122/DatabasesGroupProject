<?php
session_start();
$_SESSION['authorized'] = true;
include_once 'config.dbconfig.inc';

$employeeName = $_SESSION['username'];

$r11 = $_POST['1oz1'];
$r12 = $_POST['2oz1'];
$r14 = $_POST['4oz1'];
$r18 = $_POST['8oz1'];
$r116 = $_POST['16oz1'];
$quantity1 = $_POST['quantity1'];
$item_id1 = $_POST['item_id1'];

$r21 = $_POST['1oz2'];
$r22 = $_POST['2oz2'];
$r24 = $_POST['4oz2'];
$r28 = $_POST['8oz2'];
$r216 = $_POST['16oz2'];
$quantity2 = $_POST['quantity2'];
$item_id2 = $_POST['item_id2'];

$r31 = $_POST['1oz3'];
$r32 = $_POST['2oz3'];
$r34 = $_POST['4oz3'];
$r38 = $_POST['8oz3'];
$r316 = $_POST['16oz3'];
$quantity3 = $_POST['quantity3'];
$item_id3 = $_POST['item_id3'];

$r41 = $_POST['1oz4'];
$r42 = $_POST['2oz4'];
$r44 = $_POST['4oz4'];
$r48 = $_POST['8oz4'];
$r416 = $_POST['16oz4'];
$quantity4 = $_POST['quantity4'];
$item_id4 = $_POST['item_id4'];

$r51 = $_POST['1oz5'];
$r52 = $_POST['2oz5'];
$r54 = $_POST['4oz5'];
$r58 = $_POST['8oz5'];
$r516 = $_POST['16oz5'];
$quantity5 = $_POST['quantity5'];
$item_id5 = $_POST['item_id5'];

$r61 = $_POST['1oz6'];
$r62 = $_POST['2oz6'];
$r64 = $_POST['4oz6'];
$r68 = $_POST['8oz6'];
$r616 = $_POST['16oz6'];
$quantity6 = $_POST['quantity6'];
$item_id6 = $_POST['item_id6'];

$r71 = $_POST['1oz7'];
$r72 = $_POST['2oz7'];
$r74 = $_POST['4oz7'];
$r78 = $_POST['8oz7'];
$r716 = $_POST['16oz7'];
$quantity7 = $_POST['quantity7'];
$item_id7 = $_POST['item_id7'];

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

$mainquery = "CALL placing_an_order('$employeeName', '$item_id1', '$quantity1', '$r11', '$r12', '$r14', '$r18', '$r116')";

$result = mysql_query($mainquery);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    die($message);
}

    echo("
        <html>
            <head>
                <script type=\"text/javascript\">
                alert('Order Complete!');
                    window.location = 'createorder.php'
                </script>
            </head>
        </html>
    ");




mysql_close($db);

