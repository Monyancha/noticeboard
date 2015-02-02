<?php
/**
 *  Copyright (c) 2015 Salama AB
 *  All rights reserved
 *  Contact: aksalj@aksalj.me
 *  Website: http://www.aksalj.me
 *  
 *  Project : web
 *  File : usermodel.php
 *  Date : 2/2/15 3:52 PM
 *  Description :
 *  
 */

class UserModel extends CI_Model {

    const TABLE = "users";

    function __construct() {
        parent::__construct();
    }

    /**
     * Check user's email and password
     * @param $email
     * @param $pwd
     * @return bool
     */
    public function validCredentials($email, $pwd) {
        $this->db->select('pwd');
        $query = $this->db->get_where(self::TABLE, array('email' => $email));
        $res = $query->result();
        if(count($res) === 1) {
            return strcmp($res[0]->pwd, sha1($pwd)) === 0;
        } else {
            return false;
        }
    }

    /**
     * Get user's details
     * @param $email
     * @return array
     */
    public function getUser($email) {
        // TODO: DO NOT RETURN PASSWORD
        $this->db->select('id, name, email');
        $query = $this->db->get_where(self::TABLE,array('email' => $email));
        $result = $query->result();
        if(count($result) === 1) {
            return $result[0];
        }
        return null;
    }

    /**
     * Add a new user
     * @param $name
     * @param $email
     * @param $pwd
     */
    public function addUser($name, $email, $pwd) {
        $data = array(
            'name' => $name ,
            'email' => $email ,
            'pwd' => sha1($pwd)
        );
        $this->db->insert(self::TABLE, $data);
        return $this->db->insert_id();

    }

    /**
     * Update a user's name
     * @param $id
     * @param $name
     * @return bool
     */
    public function updateUser($id, $name) {
        $data = array(
            'name' => $name
        );

        $this->db->where('id', $id);
        return $this->db->update(self::TABLE, $data);

    }

    /**
     * Update a user's password
     * @param $email
     * @param $oldPwd
     * @param $newPwd
     * @return bool
     */
    public function updatePassword($email, $oldPwd, $newPwd) {
        if($this->validCredentials($email, $oldPwd)) {

            $data = array(
                'pwd' => sha1($newPwd)
            );
            $usr = $this->getUser($email);
            $this->db->where('id', $usr['id']);
            return $this->db->update(self::TABLE, $data);

        } else {
            return false;
        }
    }

}