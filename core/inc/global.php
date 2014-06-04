<?php

session_start();

if ($_SERVER['SERVER_ADDR'] == '192.168.1.77') {
    $dbServer = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "";

    define('CORE', $_SERVER['DOCUMENT_ROOT'] . '/../core/');
} else if ($_SERVER['SERVER_ADDR'] == '192.168.1.33') {

    $dbServer = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "";

    define('CORE', '/home/websites/webapp/core/');
} else {
    $dbServer = "localhost";
    $dbUser = "root";
    $dbPass = "";
    $dbName = "";

    define('CORE', '/var/www/vhosts/websitename.co.uk/core/');
}

function __autoload($class_name) {
    include CORE . 'classes/class.' . $class_name . '.php';
}

//require_once(CORE . 'classes/class.db.php');
// use this line on those pages where database connection is required
//$db = new db($dbServer,$dbUser,$dbPass,$dbName);		

$siteName = 'Site Name';
$siteEmail = 'asif@';


if (isset($_REQUEST['page'])) {
    if (file_exists(CORE . 'pages/' . $_REQUEST['page'] . '.php'))
        $page = $_REQUEST['page'];
    else
        $page = 'page-not-found';
} elseif (!isset($_REQUEST['page'])) {
    $page = 'home';
}


if (isset($_REQUEST['subpage'])) {
    if (file_exists(CORE . 'pages/' . $page . '/' . $_REQUEST['subpage'] . '.php'))
        $subpage = $_REQUEST['subpage'];
    //disabled so subpage can also be used as items on main page
    //else
    //    $page = 'page-not-found';
} 
