<?php
/*MY DB CONNECTION TO THE SERVER */

class dbconnect
{
    private $dsn= "mysql:host=my03.winhost.com;dbname=mysql_108240_gatheringdb";
    private $username ="gatheradmin";
    private $password = "gather12345678";
    private $db;

    public function getDb(){
        try {
            $this->db = new PDO($this->dsn, $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo $e->getMessage();
        }

        return $this->db;
    }

}

//BELOW IS MY OLD DB CONNECT. THIS PROJECT WAS ORIGINALLY BUILT USING LOCALHOST, BUT NOW WE FINALLY GOT THE DB ONTO THE SERVER, SO I REMADE BUT KEEPING EVERYTHING AS REFRENCE

//class dbconnect
//{
//    private $dsn= "mysql:host=localhost;dbname=gather_himatfeature1_announcements"; //inputted databasename
//    private $username ="root";
//    private $password = "";
//    private $db;
//
//    public function getDb(){
//        try {
//            $this->db = new PDO($this->dsn, $this->username, $this->password);
//            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        } catch (PDOException $e){
//            echo $e->getMessage();
//        }
//
//        return $this->db;
//    }
//
//}
