<?php
session_start();

//if the user doesn't have access to view this page, redirect them without displaying anything
if($_SESSION['authorized'] != true)
    echo <<< EOT
        <html>
            <head>
                <script type="text/javascript">
                    window.location = " . $redirectPage . "
                </script>
            </head>
        </html>
EOT;
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>PC</title>
    <link rel="stylesheet" href="css/style.css">
    <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
<div id="header" class="header">
    Pseudo Code
</div>
<?php

//TODO  convert the drop down list into an inline list at the top of the page.  This will function as a toolbar
//TODO Create the content for this page



if($_SESSION['authorized'] == true) {
    echo <<< EOT
        <br/>
        <div class="companyname">
            Pseudo Code
            </div>
        <label class="readable">
            Options
        </label><br/>
        <div>
            <br/>
            <ul>
                <li> &#149 <a href="$inventoryModificationOptions">Modify Inventory</a></li>
                <li> &#149 <a href="$inventoryDisplayOptions">Inventory Display Options</a><li>
                <li> &#149 <a href="$orderOptions">Order Options</a><li>
            </ul>
        </div>
EOT;
}
//If the user doesn't have access
else
    echo("<p>You do not have permission to view this page</p>");
?>

</body>
</html>
