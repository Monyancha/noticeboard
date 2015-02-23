<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : feed_form.php
 *  Date : 2/23/15 12:25 PM
 *  Description :
 *  
 */
$feedId = $this->input->get("feed");
$feed = ($feedId >= 0) ? $this->FeedModel->getFeed($feedId) : null;
$feedTitle = null;
$feedUrl = null;
$feedDescription = null;

if($feed) {
    $feedTitle = $feed->title;
    $feedUrl = $feed->url;
    $feedDescription = $feed->description;
}

?>
<form id="feedForm">
    <? if($feedId) {?>
        <input type="hidden" name="id" value="<?=$feedId;?>">
    <? } ?>

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter feed title" value="<?=$feedTitle;?>" required>
    </div>
    <div class="form-group">
        <label for="url">URL</label>
        <input type="url" class="form-control" name="url" placeholder="Enter feed url" value="<?=$feedUrl;?>" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" placeholder="Enter feed description" required><?=$feedDescription;?></textarea>
    </div>
</form>