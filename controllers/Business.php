<?php


class BusinessDAO

{
    public function getBusinessInfo($db, $id){
        $query = "SELECT b.*, l.* FROM business b LEFT JOIN locations l ON b.locationid = l.id WHERE b.id  = :id";
        $pdostmt = $db->prepare($query);
        $pdostmt->bindValue(':id',$id);
        $pdostmt->execute();

        $businessinfo = $pdostmt->fetchall();
        return $businessinfo;
    }

    public function getEventList($db,$id){
        $query = "SELECT e.id,e.EventName,e.EventDescription,d.discount FROM events e LEFT JOIN discounts d ON e.id = d.eventid WHERE businessid = :id";

        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(':id',$id);
        $pdostmt2->execute();

        $events = $pdostmt2->fetchAll();
        return $events;
    }

 /*   public function updatePromotion($db, $title, $discount,$eventid, $datestart, $expiry, $id){
        $query3 = "UPDATE discounts SET title = :title, discount = :discount, eventid = :eventid,
                   datestart = :datestart, expiry = :expiry WHERE id = :id";
        $pdostmt3 = $db->prepare($query3);

        $pdostmt3->bindValue(':title',$title);
        $pdostmt3->bindValue(':discount',$discount);
        $pdostmt3->bindValue(':eventid',$eventid);
        $pdostmt3->bindValue(':datestart',$datestart);
        $pdostmt3->bindValue(':expiry',$expiry);
        $pdostmt3->bindValue(':id',$id);

        $pdostmt3->execute();

    }

    public function deletePromotion($db, $id){
        $query4 = "DELETE FROM discounts WHERE id = :id";

        $pdostmt4 = $db->prepare($query4);
        $pdostmt4->bindValue(':id',$id);

        $pdostmt4->execute();

    }

    public function addPromotion($db, $eventid, $title, $discount, $datestart, $expiry)
    {
        $query5 = "INSERT INTO discounts (eventid, title, discount, datestart, expiry) VALUES (:eventid, :title, :discount, :datestart, :expiry)";

        $pdostmt5 = $db->prepare($query5);
        $pdostmt5->bindValue(':eventid', $eventid);
        $pdostmt5->bindValue(':title', $title);
        $pdostmt5->bindValue(':discount', $discount);
        $pdostmt5->bindValue(':datestart', $datestart);
        $pdostmt5->bindValue(':expiry', $expiry);

        $pdostmt5->execute();
    }*/

}
