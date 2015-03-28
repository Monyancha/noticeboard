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
     * @param $type
     * @return mixed
     */
    public function addDevice($uuid, $phone, $type) {
        // Check if uuid or phone already exists
        $queryUuid = $this->db->get_where(self::TABLE, array('uuid' => $uuid));
        $queryPhone = $this->db->get_where(self::TABLE, array('phone' => $phone));
        if(count($queryUuid->result()) > 0) {
            // TODO: update phone only?
            return 1;
        } else if(count($queryPhone->result()) > 0) {
            // TODO: update uuid only?
            return 1;
        } else {

            // TODO: Fix hard coding types?
            $type = ($type !== "gcm" || $type !== "apns") ? null : $type;

            $data = array(
                'uuid' => $uuid ,
                'phone' => $phone,
                'type' => $type
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

    /**
     * Count registered devices
     * @return mixed
     */
    public function countDevices() {
        return $this->db->count_all_results(self::TABLE);
    }

}