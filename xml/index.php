<?php

include('XmlReader.php'); 

$xml = new FeedReader('http://www.rssboard.org/files/sample-rss-091.xml'); 
 
$xml->iterateOverNodes(); 
  
$titles = ($xml->title); 

?>