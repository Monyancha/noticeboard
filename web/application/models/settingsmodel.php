<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : settingsmodel.php
 *  Date : 2/2/15 3:55 PM
 *  Description :
 *  
 */

class SettingsModel extends CI_Model {

    const TABLE = "settings";

    function __construct(){
        parent::__construct();
    }


    /**
     * Get a given set of settings
     * @param $name
     * @return array
     */
    public function getSettings($name) {
        $query = $this->db->get_where(self::TABLE, array('name' => $name));
        $res = $query->result();
        return json_decode($res['data']);
    }

    /**
     * Set a set of configs
     * @param $name
     * @param $data
     * @return mixed
     */
    public function setSettings($name, $data) {
        $data = array(
            'name' => $name ,
            'data' => json_encode($data),
        );
        $this->db->insert(self::TABLE, $data);
        return $this->db->insert_id();
    }


    /**
     * Update settings
     * @param $name
     * @param $data
     * @return mixed
     */
    public function updateSettings($name, $data) {
        $data = array(
            'data' => json_encode($data)
        );

        $this->db->where('name', $name);
        $res = $this->db->update(self::TABLE, $data);

        return $res; // TODO: Check Me!!
    }

}