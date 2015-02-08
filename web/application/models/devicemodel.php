<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : devicemodel.php
 *  Date : 2/2/15 3:53 PM
 *  Description :
 *  
 */

class DeviceModel extends CI_Model {

    const TABLE = 'devices';

    function __construct() {
        parent::__construct();
    }

    /**
     * Get all registered devices
     * @return mixed
     */
    public function getDevices() {
        $query = $this->db->get(self::TABLE);
        return $query->result();
    }

    /**
     * Register a device
     * @param $uuid
     * @param $phone
     * @return mixed
     */
    public function addDevice($uuid, $phone) {
        // Check if device already exists
        $query = $this->db->get_where(self::TABLE, array('uuid' => $uuid));
        if(count($query->result()) > 0) {
            // TODO: update phone number only?
            return 1;
        } else {
            $data = array(
                'uuid' => $uuid ,
                'phone' => $phone
            );
            $this->db->insert(self::TABLE, $data);
            return $this->db->insert_id();
        }
    }

    /**
     * Remove a device from database
     * @param $uuid
     * @return mixed
     */
    public function removeDevice($uuid) {
        return $this->db->delete(self::TABLE, array('uuid' => $uuid));
    }

}