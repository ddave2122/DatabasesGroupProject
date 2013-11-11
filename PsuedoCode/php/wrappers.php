<?php

class Wrappers
{
    private $redirectPage = 'google.com';  //!!Need to change before production!!//
    private $isDevelopment = true;  //!!should come from the config page in the future!!//
    private $inventoryModificationOptions = "";
    private $inventoryDisplayOptions = "";
    private $orderOptions = "";

    public function checkUserVerification()
    {
        if($this->isDevelopment)
            return true;
        else
        {
            if($_SESSION['authorized'] == false)
                return false;
        }
    }

    public function createHeader()
    {
        echo <<< EOT

            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">

                <title>Tech Literacy Consortium</title>
                <link rel="stylesheet" href="css/default.css">
                <link rel="stylesheet" href="css/body.css">
                <script type="text/javascript" src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
                <!--[if IE]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
            </head>
            <body onload="cookieMonsterEat('userName')">
                <header id="mast">
                    <h1>Psuedo Code</h1>
                </header>
EOT;

    }//End crateHeader function

    //Create the top menu and highlight the button for the current page
    public function createTopMenu($menuSelection = 0, $title)
    {
        $menuItem = null;
        switch($menuSelection)
        {
            case(0):
                echo <<< EOT
                <nav id="global">
                    <ul>
                        <li><a class="selected"  href="index.html">Home</a></li>
                        <li><a href="userlogin.html">User Login</a></li>
                        <li><a href="contact.html">Inventory Display</a></li>
                        <li><a href="contact.html">Inventory Modification</a></li>
                    </ul>
                </nav>
EOT;
            break;

            case(1):
                echo <<< EOT
                <nav id="global">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a class="selected"  href="userlogin.html">User Login</a></li>
                        <li><a href="contact.html">Inventory Display</a></li>
                        <li><a href="contact.html">Inventory Modification</a></li>
                    </ul>
                </nav>
EOT;
                break;
            case(2):
                echo <<< EOT
                <nav id="global">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="userlogin.html">User Login</a></li>
                        <li><a class="selected"  href="contact.html">Inventory Display</a></li>
                        <li><a  href="contact.html">Inventory Modification</a></li>
                    </ul>
                </nav>
EOT;
                break;
            case(3):
                echo <<< EOT
                <nav id="global">
                    <ul>
                        <li><a  href="index.html">Home</a></li>
                        <li><a href="userlogin.html">User Login</a></li>
                        <li><a href="contact.html">Inventory Display</a></li>
                        <li><a class="selected"  href="contact.html">Inventory Modification</a></li>
                    </ul>
                </nav>
EOT;
                break;
        }
        echo <<< EOT

            <section id="intro">
                <header>
                    <h2>$title<div id="userName"></div></h2>
                </header>
            </section>

EOT;
    }

    public function createMainPageBody()
    {
        echo <<< EOT

        <p>Once logged in, you can modify inventory, place orders, view inventory stats, and more!</p>
        <a href="userlogin.html">Log in here</a>
        <div id="photo">
        	<div><img src="img/frontpage.jpg" width="390" height="275" alt="" border="1">

            </div>
        </div>
    </section>
    <div id="main" class="clear">
        <section id="articles">

        </section>
        <aside>
            <section>

            </section>
        </aside>
    </div>
EOT;
    }

    public function createFooter()
    {
        echo <<< EOT
            <footer>
                <div class="clear">
                    <section id="about">
                        <header>
                            <h3>Contact Us</h3>
                        </header>
                        <p><a href="mailto:dgibbs7@student.gsu.edu">email</a> </p>
                    </section>

                    <section>
                        <header>
                            <h3>Site Map</h3>
                        </header>
                        <nav id="siteMap">
                        <ul>
                            <li><a class="selected" href="index.html">Home</a></li>
                            <li><a href="userlogin.html">User Login</a></li>
                            <li><a href="contact.html">Inventory Display</a></li>
                            <li><a href="contact.html">Inventory Modification</a></li>
                        </ul>
                        </nav>
                    </section>
                </div>
            </footer>
        </body>
        </html>

EOT;

    }

}//End class


//Redirect code -not currently used
//                 <html>
//                    <head>
//                        <script type="text/javascript">
//                            window.location = " . $this->redirectPage . "
//                        </script>
//                    </head>
//                </html>