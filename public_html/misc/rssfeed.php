<?php
  
  define(SITE_ID, 1);
  require_once($_SERVER['DOCUMENT_ROOT'].'/../core/inc/global.php');
  
  include(CORE . "/modules/feeds/FeedWriter.php");
  
  $TestFeed = new FeedWriter(RSS1);
  $TestFeed->setTitle($e_site . ' - RSS News Feed');
  $TestFeed->setLink('http://' . $_SERVER['HTTP_HOST']);
  $TestFeed->setDescription('All the latest news from ' . $e_site);
  $TestFeed->setChannelAbout('http://' . $_SERVER['HTTP_HOST'] . '/');
  
  $db->execute('SELECT * FROM news_data n LEFT JOIN main_images m ON (n.image_id = m.image_id) ORDER BY n.date_added ASC');

  while ($a = $db->get_row()) {	
	$newItem = $TestFeed->createNewItem();
	$newItem->setTitle($a['article_title']);
	$newItem->setLink('http://' . $_SERVER['HTTP_HOST'] . '/news/' . $a['url_title']);
	$newItem->setDate(strtotime($a['date_added']));
	$txt = '';

	if (file_exists('../images/converted/thumb_normal_' . $a['image_id'] . '_' . $a['name']))
	 $txt .= htmlspecialchars('<img src="http://' . $_SERVER['HTTP_HOST'] . '/images/converted/thumb_normal_' .  $a['image_id'] . '_' . $a['name'] . '" width="120" height="80" alt="" />');
	 
	$txt .= '<![CDATA[<div>' . $a['article'] . '</div>]]>';
	$newItem->addElement('description',$txt);
	$TestFeed->addItem($newItem);
  }
  $TestFeed->genarateFeed();

?>