<?php


class get_roleid_crud
{
    public function get_user_role($db)
    {
        $query = "SELECT * FROM user_roles;";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->execute(); // now we execute the statement
        $roleResult= $pdostmt2->fetchAll(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        return $roleResult; //return ture because its succesfful
    }
}