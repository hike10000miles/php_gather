<?php


class gatheringsController
{

    private $_db;

    public function __construct($dbConnection)
    {
        $this->_db = $dbConnection;
    }


    function createGathering($db, $gatheringName, $gatheringDescription, $creationDate, $locationid, $userid){

            $query = "INSERT INTO gatherings(gatheringName, gatheringDescription, creationDate, locationid, userid) 
        VALUES (:gatheringName, :gatheringDescription, :creationDate, :locationid, :userid)";
            $pdostmt2 = $db->prepare($query);
            $pdostmt2->bindValue(':gatheringName', $gatheringName);
            $pdostmt2->bindValue(':gatheringDescription', $gatheringDescription);
            $pdostmt2->bindValue(':creationDate', $creationDate);
            $pdostmt2->bindValue(':locationid', $locationid);
            $pdostmt2->bindValue(':userid', $userid);
            $row = $pdostmt2->execute();
            $pdostmt2->closeCursor();
            return $row;

    }

    public function selectUserDetails($db, $id)
    {
        /*insertUser($pdoconnection, $username, $email, $password_hash, $password_salt,
            $firstname, $middlename, $lastname, $location_id, $role_id);*/

        $query = "SELECT * FROM users WHERE id = :userid";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(":userid", $id);
        /*$result = */$pdostmt2->execute();
        $userFetch = $pdostmt2->fetch(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor();
        return $userFetch;
    }

    public function getUser($db, $username,  $id)
    {
        /*insertUser($pdoconnection, $username, $email, $password_hash, $password_salt,
            $firstname, $middlename, $lastname, $location_id, $role_id);*/

        $query = "SELECT username FROM users WHERE id = :userid";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(":userid", $id);
        $pdostmt2->bindValue(":username", $username);
        /*$result = */$pdostmt2->execute();
        $userFetch = $pdostmt2->fetch(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor();
        return $userFetch;
    }

    public function get_location_id($db)
    {
        $query = "SELECT * FROM locations;";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->execute(); // now we execute the statement
        $locationResult= $pdostmt2->fetchAll(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        // var_dump($locationResult);
        return $locationResult; //return ture because its succesfful
    }

    public function get_testGathering($db)
    {
        $query = "SELECT * FROM gatherings WHERE id = 1;";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->execute(); // now we execute the statement
        $gatherresult= $pdostmt2->fetch(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        return $gatherresult; //return ture because its succesfful
    }

    public function selectGathering($db, $gatheringid)
    {
        /*insertUser($pdoconnection, $username, $email, $password_hash, $password_salt,
            $firstname, $middlename, $lastname, $location_id, $role_id);*/

        $query = "SELECT * FROM gatherings WHERE id = :gatheringid";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(":gatheringid", $gatheringid);
        /*$result = */$pdostmt2->execute();
        $userFetch = $pdostmt2->fetch(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor();
        return $userFetch;
    }

    public function get_Gatheringusers($db, $gatheringid)
    {
        $query = "SELECT * FROM gatherings_users WHERE GatheringId=4;";
        $pdostmt2 = $db->prepare($query);
//        $pdostmt2->bindValue(":GatheringId", $gatheringid);
        $pdostmt2->execute(); // now we execute the statement
        $gatherresult= $pdostmt2->fetchall(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        return $gatherresult; //return ture because its succesfful
    }

    public function get_GatheringusersModified($db, $gatheringid)
    {
        $query = "SELECT * FROM gatherings_users WHERE GatheringId = :gatheringid";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(":gatheringid", $gatheringid);
        $pdostmt2->execute(); // now we execute the statement
        $gatherresult= $pdostmt2->fetchall(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        return $gatherresult; //return ture because its succesfful
    }

//    public function get_testGatheringusers($db)
//    {
//        $query = "SELECT * FROM gatherings_users WHERE Gatheringid = 1;";
//        $pdostmt2 = $db->prepare($query);
//        $pdostmt2->execute(); // now we execute the statement
//        $gatherresult= $pdostmt2->fetchall(PDO::FETCH_ASSOC);
//        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
//        return $gatherresult; //return ture because its succesfful
//    }


    public function getBusinessInfo($db, $id){
        $query = "SELECT b.*, l.* FROM business b LEFT JOIN locations l ON b.locationid = l.id WHERE b.id  = :id";
        $pdostmt = $db->prepare($query);
        $pdostmt->bindValue(':id',$id);
        $pdostmt->execute();

        $businessinfo = $pdostmt->fetchall();
        return $businessinfo;
    }
    public function getGathering($db)
    {
        $query = "SELECT * FROM gatherings WHERE id = 1;";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->execute(); // now we execute the statement
        $gatherresult= $pdostmt2->fetch(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        return $gatherresult; //return ture because its succesfful
    }

    public function getEventList($db,$id){
        $query = "SELECT e.id,e.EventName,e.EventDescription,d.discount FROM events e LEFT JOIN discounts d ON e.id = d.eventid WHERE businessid = :id";

        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(':id',$id);
        $pdostmt2->execute();

        $events = $pdostmt2->fetchAll();
        return $events;
    }

   public function getgatheringsEvents($db){
      $query = "SELECT * FROM gatheringevents";
       $pdostmt2 = $db->prepare($query);
       $pdostmt2->execute();

       $events = $pdostmt2->fetchAll(PDO::FETCH_OBJ);
       return $events;
   }



}