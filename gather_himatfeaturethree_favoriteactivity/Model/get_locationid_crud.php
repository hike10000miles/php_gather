<?php


class get_locationid_crud
{
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

}