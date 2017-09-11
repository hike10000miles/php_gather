<?php


class getandset_Announcements
{
    private $id;
    private $userId;
    private $subjectLine;
    private $announcement;
    private $date;
    private $gatherid;

    /*public function __construct($id, $userId, $subjectLine, $announcement){
        $this->id = $id;
        $this->userId = $userId;
        $this->subjectLine = $subjectLine;
        $this->anouncement = $announcement;
    }*/
    public function setId($value) {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setUsersId($value) {
        $this->userId = $value;
    }
    public function getUsersId()
    {
        return $this->userId;
    }
    public function setSubjectline($value) {
        $this->subjectLine = $value;
    }
    public function getSubjectline()
    {
        return $this->subjectLine;
    }

    public function setAnnouncement($value) {
        $this->announcement = $value;
    }

    public function getAnnouncement()
    {
        return $this->announcement;
    }

    public function setDate($value) {
        $this->date = $value;
    }

    public function getDate()
    {
        return $this->date;
    }
    public function setgatherID($value) {
        $this->gatherid = $value;
    }

    public function getgatherID()
    {
        return $this->gatherid;
    }



}




//class getandset_Announcements
//{
//    private $id;
//    private $userId;
//    private $subjectLine;
//    private $announcement;
//    private $date;
//
//    /*public function __construct($id, $userId, $subjectLine, $announcement){
//        $this->id = $id;
//        $this->userId = $userId;
//        $this->subjectLine = $subjectLine;
//        $this->anouncement = $announcement;
//    }*/
//    public function setId($value) {
//        $this->id = $value;
//    }
//
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    public function setUsersId($value) {
//        $this->userId = $value;
//    }
//    public function getUsersId()
//    {
//        return $this->userId;
//    }
//    public function setSubjectline($value) {
//        $this->subjectLine = $value;
//    }
//    public function getSubjectline()
//    {
//        return $this->subjectLine;
//    }
//
//    public function setAnnouncement($value) {
//        $this->announcement = $value;
//    }
//
//    public function getAnnouncement()
//    {
//        return $this->announcement;
//    }
//
//    public function setDate($value) {
//        $this->date = $value;
//    }
//
//    public function getDate()
//    {
//        return $this->date;
//    }
//
//
//
//}