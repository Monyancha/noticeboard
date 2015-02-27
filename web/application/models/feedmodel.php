<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : feedmodel.php
 *  Date : 2/2/15 3:54 PM
 *  Description :
 *  
 */

class FeedModel extends CI_Model {

    const TABLE = "feeds";

    function __construct() {
        parent::__construct();
    }

    /**
     * Get all feeds from database
     * @return array
     */
    public function getFeeds() {
        $query = $this->db->get(self::TABLE);
        return $query->result();
    }

    /**
     * Get single feed by key
     * @param $key
     * @param $value
     * @return array | null
     */
    private function _getSingleFeed($key, $value) {
        $arr = array();
        $arr[$key] = $value;
        $query = $this->db->get_where(self::TABLE, $arr);
        $result = $query->result();
        if(count($result) === 1) {
            return $result[0];
        }
        return null;
    }


    /**
     * Get a given feed from database
     * @param $id
     * @return array | null
     */
    public function getFeed($id) {
        return $this->_getSingleFeed('id', $id);
    }

    /**
     * @param $slug
     * @return null
     */
    public function getFeedBySlug($slug) {
        return $this->_getSingleFeed('slug', $slug);
    }

    /**
     * Add new feed to database
     * @param $title
     * @param $description
     * @param $slug
     * @param $url string DEPRECATED
     * @return int Feed id
     */
    public function addFeed($title, $description, $slug, $url) {
        $slug = isNullOrEmpty($slug) ? url_title($title, 'dash', TRUE) : $slug;
        $data = array(
            'slug' => $slug,
            'title' => $title ,
            'description' => $description ,
            'url' => isNullOrEmpty($url) ? site_url('/feed/'.$slug) : $url
        );
        $this->db->insert(self::TABLE, $data);
        return $this->db->insert_id();
    }

    /**
     * Update a given feed.
     * @param $id
     * @param $title
     * @param $description
     * @param $slug
     * @param $url
     * @return bool True if feed updated, false otherwise
     */
    public function updateFeed($id, $title, $description, $slug, $url) {
        $slug = isNullOrEmpty($slug) ? url_title($title, 'dash', TRUE) : $slug;
        $data = array(
            'title' => $title ,
            'slug' => $slug,
            'description' => $description ,
            'url' => isNullOrEmpty($url) ? site_url('/feed/'.$slug) : $url
        );

        $this->db->where('id', $id);
        return $this->db->update(self::TABLE, $data);
    }

    /**
     * Remove a feed from the database
     * @param $id Feed id
     * @return bool True if feed deleted, false otherwise
     */
    public function removeFeed($id) {
        return $this->db->delete(self::TABLE, array('id' => $id));
    }

    /**
     * Count registered feeds
     * @return mixed
     */
    public function countFeeds() {
        return $this->db->count_all_results(self::TABLE);
    }

    /**
     * Count feeds items
     * @return mixed
     */
    public function countFeedsItems() {
        return 7876;
    }

}