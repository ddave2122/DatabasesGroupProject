<?php
session_start();

include_once 'config.php';

//If the user is already logged in
if($_SESSION['authorized'] == true)
    //Direct the user to the next page
    echo("
        <html>
            <head>
                <script type=\"text/javascript\">
                    window.location = " . $redirectPage . "
                </script>
            </head>
        </html>
    ");

//TODO need to redirect the user to the login page is they did not previously come from that page or are currently logged in
//Retrieve the username and password
$password = $_POST['password'];
$username = $_POST['login'];

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
$mainquery = "SELECT * FROM website_users where userid = '" . $username . "' AND password = '" . $password ."';";
$result = mysql_query($mainquery);
if (!$result) {
    $message  = 'Invalid query: ' . mysql_error() . "\n";
    $message .= 'Whole query: ' . $mainquery;
    die($message);
}

$db_field = mysql_fetch_assoc($result);

//Clean up
mysql_close($db);

if($db_field['authorized'] == true)
{
    //Persist the authorization for the session
    $_SESSION['authorized'] = true;

    //Direct the user to the next page
    echo("
        <html>
            <head>
                <script type=\"text/javascript\">
                    window.location = " . $redirectPage . "
                </script>
            </head>
        </html>
    ");
}
//If not authenticated, alert the user and direct them back to the login page
else
{
    echo("
        <html>
            <head>
                <script type=\"text/javascript\">
                    alert('Username and passrod cominabtion not found');
                    window.location = " . $userLogin . "
                </script>
            </head>
        <html>
    ");
}