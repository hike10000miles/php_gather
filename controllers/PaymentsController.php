
<?php
//require_once "database.php";


class Admin
{
    private $db;


    public function __construct($db)
    {
        $this->db = $db;
    }


    public function getevents()
    {
        $query = "SELECT * FROM  events";
        $pdostmt = $this->db->prepare($query);

        $row = $pdostmt->execute();
        $row = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $row;
    }

    public function insertdata($user_email,$payment_amount,$event_id){

        $query = "INSERT INTO payments 
                  (user_email,payment_amount,event_id)
                  VALUES (:user_email,:payment_amount,:event_id)";

        $pdostmt = $this->db->prepare($query);

        $pdostmt->bindValue('user_email', $user_email, PDO::PARAM_INT);
        $pdostmt->bindValue('payment_amount', $payment_amount, PDO::PARAM_INT);
        $pdostmt->bindValue(':event_id', $event_id, PDO::PARAM_INT);
        $row2 = $pdostmt->execute();

        return $row2;
    }

    public function getpayments()
    {
        $query = "SELECT * FROM  payments";
        $pdostmt = $this->db->prepare($query);

        $row3 = $pdostmt->execute();
        $row3 = $pdostmt->fetchAll(PDO::FETCH_OBJ);
        return $row3;
    }

    public function geteventbyid($id)
    {
        //var_dump($value);
        $query3="SELECT * FROM events WHERE id = :id";
        $pdostmt3 = $this->db->prepare($query3);
        $pdostmt3->bindValue(':id',$id, PDO::PARAM_INT);
        $pdostmt3->execute();
        $row4 = $pdostmt3->fetch(PDO::FETCH_OBJ);
        return $row4;
    }


    public function deletepayment($id)
    {

        $query = "DELETE FROM payments WHERE id= :id";
        $pdostmt1 = $this->db->prepare($query);
        $pdostmt1->bindValue(':id',$id, PDO::PARAM_INT);
        $row5 = $pdostmt1->execute();
        return $row5;

    }

    public function getpaymentsbyid($id)
    {

        $query3="SELECT * FROM payments WHERE id = :id";
        $pdostmt3 = $this->db->prepare($query3);
        $pdostmt3->bindValue(':id',$id, PDO::PARAM_INT);
        $pdostmt3->execute();
        $row6 = $pdostmt3->fetch(PDO::FETCH_OBJ);
        return $row6;
    }

}
