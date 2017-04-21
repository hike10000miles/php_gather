<?php

/**
 * Created by PhpStorm.
 * User: himatjutla
 * Date: 2017-04-21
 * Time: 2:38 AM
 */
class announcementsController
{

    private $_db;

    public function __construct($dbConnection)
    {
        $this->_db = $dbConnection;
    }

    public function getAnnouncement($db)
    {
        $query = "SELECT * FROM gather_announcements ORDER BY Date DESC;";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->execute(); // now we execute the statement
        $result= $pdostmt2->fetchAll(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        return $result; //return ture because its succesfful
    }

    public function addAnnouncement($db, $userId, $subjectLine, $announcement, $date, $gatherid)
    {

        $query = "INSERT INTO gather_announcements (UsersId, subject, announcement, Date, gatherid) 
        VALUES (:UsersId, :subject, :announcement, :Date, :gatherid)";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(':UsersId', $userId);
        $pdostmt2->bindValue(':subject', $subjectLine);
        $pdostmt2->bindValue(':announcement', $announcement);
        $pdostmt2->bindValue(':Date', $date);
        $pdostmt2->bindValue(':gatherid', $gatherid);
        $row = $pdostmt2->execute();
        $pdostmt2->closeCursor();
        return $row;
    }
    public function deleteAnnouncement($db, $id){

        $query = "DELETE FROM gather_announcements WHERE Id = :Id";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(':Id', $id);
        $pdostmt2->execute();
        $pdostmt2->closeCursor();

    }
}