<?php

  define(SITE_ID, 1);
  require_once($_SERVER['DOCUMENT_ROOT'].'/../core/inc/global.php');
  include(CORE . "/feeds/FeedWriter.php");
  $TestFeed = new FeedWriter(RSS1);
  $TestFeed->setTitle('OneFunction - RSS News Feed');
  $TestFeed->setLink('http://' . $_SERVER['HTTP_HOST']);
  $TestFeed->setDescription('All the latest news');
  $TestFeed->setChannelAbout('http://' . $_SERVER['HTTP_HOST'] . '/');
  
  $db->execute('SELECT * FROM news ORDER BY created ASC');

  while ($a = $db->get_row()) {	
	$newItem = $TestFeed->createNewItem();
	$newItem->setTitle($a['title']);
	$newItem->setLink('http://' . $_SERVER['HTTP_HOST'] . '/news/' . $a['id']);
	$newItem->setDate(strtotime($a['created']));
	$txt = '';
	if (file_exists('images/news/' . $a['image']))
	 $txt .= htmlspecialchars('<img src="http://' . $_SERVER['HTTP_HOST'] . '/images/news/' . $a['image'] . '" width="120" height="80" alt="" />');
	$txt .= '<![CDATA[<div>' . $a['news'] . '</div>]]>';
	$newItem->addElement('description',$txt);
	$TestFeed->addItem($newItem);
  }
  $TestFeed->genarateFeed();

?>