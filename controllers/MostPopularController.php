<?php


//require_once "database.php";


class Admin
{
    private $db;


    public function __construct($db)
    {
        $this->db = $db;
    }


    public function getmostpopular()
    {
        $query = "SELECT b.businessName, ROUND(AVG(r.rating),2) as Average_Rating FROM rating r JOIN business b ON b.id = r.business_id GROUP BY b.businessName ORDER BY AVG(r.rating) DESC;";
        $pdostmt = $this->db->prepare($query);

        $row = $pdostmt->execute();
        $row = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $row;
    }

    }