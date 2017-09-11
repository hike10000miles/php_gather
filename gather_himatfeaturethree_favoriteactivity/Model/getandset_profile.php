<?php


class getandset_profile
{
    private $id;
    private $user_id;
    private $user_role;
    private $user_dob;
    private $current_jobtitle;
    private $education_level;
    private $address;
    private $user_description;
    private $pic_likes;
    private $profile_image;



    public function set_id($value) {
        $this->id = $value;
    }

    public function get_id()
    {
        return $this->id;
    }

    public function set_user_id($value) {
        $this->user_id = $value;
    }

    public function get_user_id()
    {
        return $this->user_id;
    }

    public function set_user_role($value) {
        $this->user_role= $value;
    }

    public function get_user_role()
    {
        return $this->user_role;
    }
    public function set_user_dob($value) {
        $this->user_dob = $value;
    }

    public function get_user_dob()
    {
        return $this->user_dob;
    }
    public function set_current_jobtitle($value) {
        $this->current_jobtitle = $value;
    }

    public function get_current_jobtitle()
    {
        return $this->current_jobtitle;
    }

    public function set_education_level($value) {
        $this->education_level = $value;
    }

    public function get_education_level()
    {
        return $this->education_level;
    }

    public function set_address($value) {
        $this->address = $value;
    }

    public function get_address()
    {
        return $this->address;
    }
    public function set_user_description($value) {
        $this->user_description = $value;
    }

    public function get_user_description()
    {
        return $this->user_description;
    }

    public function set_pic_likes($value) {
        $this->pic_likes = $value;
    }

    public function get_pic_likes()
    {
        return $this->pic_likes;
    }

    public function set_profile_image($value) {
        $this->profile_image = $value;
    }

    public function get_profile_image()
    {
        return $this->profile_image;
    }


}