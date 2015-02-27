<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : logmodel.php
 *  Date : 2/23/15 10:36 AM
 *  Description :
 *  
 */

class LogModel extends CI_Model {

    const TABLE = "logs";

    function __construct() {
        parent::__construct();
    }

    /**
     * Get a given set of logs
     * @param $name
     * @return array
     */
    public function getLog($name) {
        $query = $this->db->get_where(self::TABLE, array('name' => $name));
        $res = $query->result();
        if(count($res) === 1) {
            return json_decode($res[0]->data);
        } else {
            return null;
        }

    }

    /**
     * Set a set of logs
     * @param $name
     * @param $data
     * @return mixed
     */
    public function setLog($name, $data) {
        $data = array(
            'name' => $name ,
            'data' => json_encode($data),
        );
        $this->db->insert(self::TABLE, $data);
        return $this->db->insert_id();
    }

}