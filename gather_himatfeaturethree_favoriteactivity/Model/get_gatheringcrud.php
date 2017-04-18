<?php


class get_gatheringcrud
{
    public function get_testGathering($db)
    {
        $query = "SELECT * FROM gatherings WHERE id = 1;";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->execute(); // now we execute the statement
        $gatherresult= $pdostmt2->fetch(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        return $gatherresult; //return ture because its succesfful
    }

    public function get_testGatheringusers($db)
    {
        $query = "SELECT * FROM gatherings_users WHERE Gatheringid = 1;";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->execute(); // now we execute the statement
        $gatherresult= $pdostmt2->fetchall(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        return $gatherresult; //return ture because its succesfful
    }

}