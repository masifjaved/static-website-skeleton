<?php
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);
require_once ($_SERVER['DOCUMENT_ROOT'] . '/../core/inc/global.php');
?><!DOCTYPE html>
<!--[if lt IE 7]>      <html class="<?= $page ?> no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="<?= $page ?> no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="<?= $page ?> no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="<?= $page ?> no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?= metaData::init()->getTitle($fullPage) ?> - <?= $siteName ?></title>
        <meta name="keywords" content="<?= metaData::init()->getKeywords($fullPage) ?>" />
        <meta name="description" content="<?= metaData::init()->getDescription($fullPage) ?>" />
        <meta name="viewport" content="width=device-width" />

        <link rel="author" href="humans.txt" />
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="/css/normalize.css" />
        <link rel="stylesheet" href="/css/main.css" />
        <!-- any google fonts here -->

        <link rel="stylesheet" href="/css/global.css" />
        <?php
        if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/css/pages/' . $page . '.css'))
            echo "<link href='/css/pages/" . $page . ".css' rel='stylesheet' type='text/css' />";

        if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/css/pages/' . $page . '/' . $subpage . '.css'))
            echo "<link href='/css/pages/" . $page . '/' . $subpage . ".css' rel='stylesheet' type='text/css' />";
        ?>
        <script src="/js/vendor/modernizr-2.6.2.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    </head>
    <body class="<?= $page; ?>">
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->        


        <?php
        $pagePath = CORE . 'pages/';

        if (!empty($subpage)) {
            if (file_exists($pagePath . $page . '/' . $subpage . '.php'))
                require_once $pagePath . $page . '/' . $subpage . '.php';
        } elseif (file_exists($pagePath . $page . '.php')) {
            require_once $pagePath . $page . '.php';
        }
        ?>

        <!-- Java Script Libraries -->        

        <script src="/js/vendor/jquery.cycle.all.js"></script>
        <script src="/js/vendor/jquery.jcarousel.min.js"></script>
        <script src="/js/vendor/jquery.colorbox-min.js"></script>
        <!--script src="/js/vendor/DD_belatedPNG_0.0.8a-min.js"></script-->
	
	<script src="/js/vendor/jquery.validate.js"></script>
	
	<script>window.jQuery || document.write('<script src="/js/vendor/jquery-1.8.2.min.js"><\/script>')</script>

        <script src="/js/plugins.js"></script>
        <script src="/js/main.js"></script>
        <script src="/js/global.js"></script>
<?php
if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/js/pages/' . $page . '.js'))
    require '/js/pages/' . $page . '.js';

if (file_exists($_SERVER["DOCUMENT_ROOT"] . '/js/pages/' . $page . '/' . $subpage . '.js'))
    require '/js/pages/' . $page . '/' . $subpage . '.js';
?>

        <script>
            var _gaq=[['_setAccount','########'],['_trackPageview']];
            (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
                g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
                s.parentNode.insertBefore(g,s)}(document,'script'));
        </script>

    </body>
</html>

