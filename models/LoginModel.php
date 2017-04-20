<?php

/**
 * @Author: mindfog
 */
class LoginModel
{
    public $UserId;
    public $BusinessId;
    public $Username;
    public $Status;
    
    /**
     * LoginModel constructor.
     * @param $userid
     * @param $username
     * @param $businessid
     * @param $status
     */
    public function __construct($userid = null, $username = null, $businessid = null, $status = false)
    {
        $this->UserId = $userid;
        $this->BusinessId = $businessid;
        $this->Username = $username;
        $this->Status = $status;
    }
}