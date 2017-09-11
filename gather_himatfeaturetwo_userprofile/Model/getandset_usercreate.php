<?php


class getandset_usercreate
{
    private $id;
    private $username;
    private $email;
    private $password;
    private $repassword;
    private $password_hash;
    private $password_salt;
    private $firstname;
    private $middlename;
    private $lastname;
    private $location_id;
    private $role_id;


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getUsername()
    {
        return $this->username;
    }


    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getRepassword()
    {
        return $this->repassword;
    }

    public function setRepassword($repassword)
    {
        $this->repassword = $repassword;
    }

    public function getPasswordHash()
    {
        return $this->password_hash;
    }


    public function setPasswordHash($password_hash)
    {
        $this->password_hash = $password_hash;
    }


    public function getPasswordSalt()
    {
        return $this->password_salt;
    }


    public function setPasswordSalt($password_salt)
    {
        $this->password_salt = $password_salt;
    }


    public function getFirstname()
    {
        return $this->firstname;
    }


    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }


    public function getMiddlename()
    {
        return $this->middlename;
    }


    public function setMiddlename($middlename)
    {
        $this->middlename = $middlename;
    }


    public function getLastname()
    {
        return $this->lastname;
    }


    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }


    public function getLocationId()
    {
        return $this->location_id;
    }


    public function setLocationId($location_id)
    {
        $this->location_id = $location_id;
    }


    public function getRoleId()
    {
        return $this->role_id;
    }


    public function setRoleId($role_id)
    {
        $this->role_id = $role_id;
    }
}