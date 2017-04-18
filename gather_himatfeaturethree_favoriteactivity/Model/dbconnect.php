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


