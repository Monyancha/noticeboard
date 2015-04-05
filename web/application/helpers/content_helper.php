<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : content_helper.php
 *  Date : 2/2/15 5:59 PM
 *  Description :
 *  
 */


/**
 * Check if a feed has new content and return it
 * @param $id int Feed registration ID
 * @param $feed \PicoFeed\Parser\Feed
 * @deprecated deprecated
 * @return bool
 */
function getNewContent($id, $feed) {

    $CI=&get_instance();
    $key = 'feed_'.$id;

    $items = $feed->getItems();
    $latest = $CI->cache->get($key);
    $latestIdx = -1;
    for($i = 0; $i < count($items); $i++) {
        $item = $items[$i];
        $date = $item->getDate();

        if ($date <= strtotime('-72 hours')) { // Ignore content older than 72 hours
            continue;
        }

        if($date > $latest) {
            $latest = $date;
            $latestIdx = $i;
        }
    }

    if($latestIdx >= 0) { // New Latest content
        $CI->cache->save($key, $latest, 259200); // Cached it for 72 hours
        return $items[$latestIdx];
    }

    return null;

}

/**
 * Clear notification cache. This may cause old notifications to be resent!!
 */
function clearContentCache() {
    $CI=&get_instance();
    $CI->cache->clean();
}


/**
 * @return array
 */
function getAllItems() {
    $CI=&get_instance();
    $feeds = $CI->FeedModel->getFeeds();
    $items = array();
    foreach($feeds as $feed) {
        $feedItems = $CI->ItemModel->getFeedItems($feed->id);
        foreach($feedItems as $item) {
            $item->feed = $feed->title;
            $item->date =  strtotime($item->date);//date("D, d M Y H:i:s T", strtotime($item->date));
            array_push($items, $item);
        }
    }
    return $items;
}

/**
 * @param int $limit
 * @return array
 */
function getLatestItems($limit = 10) {
    $CI=&get_instance();
    $items = $CI->ItemModel->getItems($limit);
    $result = array();
    foreach($items as $item) {
        $feed = $CI->FeedModel->getFeed($item->feed);
        $item->feed = $feed->title;
        $item->date = strtotime($item->date);//date("D, d M Y H:i:s T", strtotime($item->date));
        array_push($result, $item);
    }
    return $result;
}

/**
 * @param $query
 * @return array
 */
function searchItems($query) {
    $CI=&get_instance();
    $items = $CI->ItemModel->searchItems($query);
    $result = array();
    foreach($items as $item) {
        $feed = $CI->FeedModel->getFeed($item->feed);
        $item->feed = $feed->title;
        $item->date = strtotime($item->date);//date("D, d M Y H:i:s T", strtotime($item->date));
        array_push($result, $item);
    }
    return $result;
}