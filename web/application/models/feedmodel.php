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
     * Get a given feed from database
     * @param $id
     * @return array
     */
    public function getFeed($id) {
        $query = $this->db->get_where(self::TABLE, array('id' => $id));
        $result = $query->result();
        if(count($result) === 1) {
            return $result[0];
        }
        return null;
    }

    /**
     * Add new feed to database
     * @param $title
     * @param $description
     * @param $url
     * @return int Feed id
     */
    public function addFeed($title, $description, $url) {
        $data = array(
            'title' => $title ,
            'description' => $description ,
            'url' => $url // TODO: Validate URL
        );
        $this->db->insert(self::TABLE, $data);
        return $this->db->insert_id();
    }

    /**
     * Update a given feed.
     * @param $id
     * @param $title
     * @param $description
     * @param $url
     * @return bool True if feed updated, false otherwise
     */
    public function updateFeed($id, $title, $description, $url) {
        $data = array(
            'title' => $title ,
            'description' => $description ,
            'url' => $url
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

}