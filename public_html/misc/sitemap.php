<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/global.php');
    $xw = new xmlWriter();
    $xw->openMemory();
   
    $xw->startDocument('1.0','UTF-8');
    $xw->startElement ('urlset');
	$xw->writeAttribute('xmlns','http://www.sitemaps.org/schemas/sitemap/0.9');
	$xw->writeAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');
	$xw->writeAttribute('xsi:schemaLocation','http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd');
	$server_name = 'http://';
	if (strpos($_SERVER["SERVER_NAME"],'.') > 0) $server_name .= 'www.';
	$server_name .= $_SERVER["SERVER_NAME"] . '/';
	$xw->startElement('url');
	$xw->startElement('loc');
	$xw->writeCData($server_name);
	$xw->endElement();
	$xw->writeElement('priority',1);
	$xw->writeElement('changefreq','weekly');
	$xw->endElement();
	
        $tot_arr = metaData::init()->getPagesNames();        
        $tot_arr = array_diff($tot_arr, array('default')); // remove "default"
        
	foreach ($tot_arr as $page_name => $page_info) {
		$xw->startElement('url');
		$xw->startElement('loc');
		$xw->writeCData($server_name . $page_info);
		$xw->endElement();
		$xw->writeElement('priority',1);
		$xw->writeElement('changefreq','weekly');
		$xw->endElement();		
	}
    $xw->endElement();
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	header('Content-type: text/xml');
    print $xw->outputMemory(true);   
?>