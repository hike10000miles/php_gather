<?php

class gatherAndAnnouncements_crud
{
   /* public function getGathering($db, $requiredobject)
    { //first arg is the db connection, second arg is to access the objects in the playerInfo.php that has teh get and set fpr each variable that we wold add to the form

        $query = "INSERT INTO gatherings(id, name, description, startDate, enddate, locationid, userid) 
              VALUES (:id, :name, :description, :startDate, :endDate, :locationid, :userid)";

        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(':id', $requiredobject->getId()); //reqobj with the -> gets the name from the other file playerInfo.php -> were using it's functions
        $pdostmt2->bindValue(':name', $requiredobject->getName());
        $pdostmt2->bindValue(':description', $requiredobject->getdescription());
        $pdostmt2->bindValue(':startDate', $requiredobject->getsetstartDate());
        $pdostmt2->bindValue(':endDate', $requiredobject->getendDate()); //reqobj with the -> gets the name from the other file playerInfo.php -> were using it's functions
        $pdostmt2->bindValue(':locationId', $requiredobject->getlocationid());
        $pdostmt2->bindValue(':usersId', $requiredobject->getuserID());
        //$pdostmt2->bindValue(':announcementId', $requiredobject->getannouncementID());
        $pdostmt2->execute(); // now we execute the statement
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        return true; //return ture because its succesfful
    }*/

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

//class gatherAndAnnouncements_crud
//{
//    public function getEvent($db, $requiredobject)
//    { //first arg is the db connection, second arg is to access the objects in the playerInfo.php that has teh get and set fpr each variable that we wold add to the form
//
//        $query = "INSERT INTO events(Id, Name, Description, StartDate, Duration, AddressId, UsersId, announcementId)
//              VALUES (:Id, :Name, :Description, :StartDate, :Duration, :AddressId, :UsersId, :announcementId)";
//
//        $pdostmt2 = $db->prepare($query);
//        $pdostmt2->bindValue(':Id', $requiredobject->getId()); //reqobj with the -> gets the name from the other file playerInfo.php -> were using it's functions
//        $pdostmt2->bindValue(':Name', $requiredobject->getName());
//        $pdostmt2->bindValue(':Description', $requiredobject->getdescription());
//        $pdostmt2->bindValue(':StartDate', $requiredobject->getsetstartDate());
//        $pdostmt2->bindValue(':Duration', $requiredobject->getduration()); //reqobj with the -> gets the name from the other file playerInfo.php -> were using it's functions
//        $pdostmt2->bindValue(':AddressId', $requiredobject->getaddressID());
//        $pdostmt2->bindValue(':UsersId', $requiredobject->getuserID());
//        $pdostmt2->bindValue(':announcementId', $requiredobject->getannouncementID());
//        $pdostmt2->execute(); // now we execute the statement
//        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
//        return true; //return ture because its succesfful
//    }
//
//    public function getAnnouncement($db)
//    {
//        $query = "SELECT * FROM event_announcements ORDER BY Date DESC;";
//        $pdostmt2 = $db->prepare($query);
//        $pdostmt2->execute(); // now we execute the statement
//        $result= $pdostmt2->fetchAll(PDO::FETCH_ASSOC);
//        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
//        return $result; //return ture because its succesfful
//    }
//
//    public function addAnnouncement($db, $id, $userId, $subjectLine, $announcement, $date)
//    {
//        $query = "INSERT INTO event_announcements (Id, UsersId, subject, announcement, Date)
//        VALUES (:Id, :UsersId, :subject, :announcement, :Date)";
//        $pdostmt2 = $db->prepare($query);
//        $pdostmt2->bindValue(':Id', $id);
//        $pdostmt2->bindValue(':UsersId', $userId);
//        $pdostmt2->bindValue(':subject', $subjectLine);
//        $pdostmt2->bindValue(':announcement', $announcement);
//        $pdostmt2->bindValue(':Date', $date);
//        $row = $pdostmt2->execute();
//        $pdostmt2->closeCursor();
//        return $row;
//}
//    public function deleteAnnouncement($db, $id){
//
//        $query = "DELETE FROM event_announcements WHERE Id = :Id";
//        $pdostmt2 = $db->prepare($query);
//        $pdostmt2->bindValue(':Id', $id);
//        $pdostmt2->execute();
//        $pdostmt2->closeCursor();
//
//    }
//}







