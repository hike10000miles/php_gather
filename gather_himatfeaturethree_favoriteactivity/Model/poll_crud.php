<?php


class poll_crud
{
    public function create_poll($db, $poll_question_string, $start_date, $end_date, $gather_id)
    {
        $query = "INSERT INTO topfiveactivities_poll(poll_question_string, start_date, end_date, gather_id)
VALUES (:poll_question_string, :start_date, :end_date, :gather_id)";
$pdostmt2 = $db->prepare($query);
$pdostmt2->bindValue(":poll_question_string", $poll_question_string);
$pdostmt2->bindValue(":start_date", $start_date);
$pdostmt2->bindValue(":end_date", $end_date);
$pdostmt2->bindValue(":gather_id", $gather_id);
/*$result = */$pdostmt2->execute();
$pdostmt2->closeCursor();
    //return $result;
    }

    public function create_poll_choices($db, $poll_id, $poll_choiceoption)
    {
        $query = "INSERT INTO topfiveactivities_poll_choices(poll_id,  poll_choiceoption)
VALUES (:poll_id, :poll_choiceoption)";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(":poll_id", $poll_id);
        $pdostmt2->bindValue(":poll_choiceoption", $poll_choiceoption);
        /*$result = */$pdostmt2->execute();
        $pdostmt2->closeCursor();
        //return $result;
    }

//    public function select_poll ($db, $id, $poll_question_string){
//        $query = "SELECT id, poll_question_string FROM topfiveactivities_poll
//WHERE DATE(NOW()) BETWEEN start_date AND end_date";
//    }
}