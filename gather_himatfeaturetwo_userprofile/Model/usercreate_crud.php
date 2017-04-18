<?php


class usercreate_crud
{
//    public function insertUser($db, $username, $email, $password, $repassword, $firstname, $middlename, $lastname, $location_id, $role_id)
//    {
//
//        $query = "INSERT INTO users (username, email, passwordhash, passwordsalt, firstname, middlename, lastname, locationid, roleid)
//        VALUES (:uname, :email, :pw, :repw, :fname, :mname, :lname, :locid, :roleid)";
//        $pdostmt2 = $db->prepare($query);
//        $pdostmt2->bindValue(":uname", $username);
//        $pdostmt2->bindValue(":email", $email);
//        $pdostmt2->bindValue(":pw", $password);
//        $pdostmt2->bindValue(":repw", $repassword);
//        $pdostmt2->bindValue(":fname", $firstname);
//        $pdostmt2->bindValue(":mname", $middlename);
//        $pdostmt2->bindValue(":lname", $lastname );
//        $pdostmt2->bindValue(":locid", $location_id);
//        $pdostmt2->bindValue(":roleid", $role_id);
//        $row = $pdostmt2->execute();
//        $pdostmt2->closeCursor();
//        return $row;
//    }

    public function insertUser($db, $username, $email, $password_salt, $password_hash, $firstname, $middlename, $lastname, $location_id, $role_id)
    {
        /*insertUser($pdoconnection, $username, $email, $password_hash, $password_salt,
            $firstname, $middlename, $lastname, $location_id, $role_id);*/

        $query = "INSERT INTO users (username, email, passwordsalt, passwordhash, firstname, middlename, lastname, locationid, roleid) 
        VALUES (:uname, :email, :psalt, :phash, :fname, :mname, :lname, :locid, :roleid)";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(":uname", $username);
        $pdostmt2->bindValue(":email", $email);
        $pdostmt2->bindValue(":psalt", $password_salt);
        $pdostmt2->bindValue(":phash", $password_hash);
        $pdostmt2->bindValue(":fname", $firstname);
        $pdostmt2->bindValue(":mname", $middlename);
        $pdostmt2->bindValue(":lname", $lastname );
        $pdostmt2->bindValue(":locid", $location_id);
        $pdostmt2->bindValue(":roleid", $role_id);
        /*$result = */$pdostmt2->execute();
        $pdostmt2->closeCursor();
        //return $result;
    }

    public function selectUserDetails($db, $id)
{
    /*insertUser($pdoconnection, $username, $email, $password_hash, $password_salt,
        $firstname, $middlename, $lastname, $location_id, $role_id);*/

    $query = "SELECT * FROM users WHERE id = :userid";
    $pdostmt2 = $db->prepare($query);
    $pdostmt2->bindValue(":userid", $id);
    /*$result = */$pdostmt2->execute();
    $userFetch = $pdostmt2->fetch(PDO::FETCH_ASSOC);
    $pdostmt2->closeCursor();
    return $userFetch;
}

    public function getUser($db, $username,  $id)
    {
        /*insertUser($pdoconnection, $username, $email, $password_hash, $password_salt,
            $firstname, $middlename, $lastname, $location_id, $role_id);*/

        $query = "SELECT username FROM users WHERE id = :userid";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(":userid", $id);
        $pdostmt2->bindValue(":username", $username);
        /*$result = */$pdostmt2->execute();
        $userFetch = $pdostmt2->fetch(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor();
        return $userFetch;
    }
//$query = "INSERT INTO users (username, email, passwordhash, passwordsalt, firstname, middlename, lastname) VALUES
//                                    (:uname, :email, :phash, :psalt, :fname, :mname, :lname)";
//$statement = $this->mPDO->prepare($query);
//$statement->bindValue(":uname", $userModel->getUsername());
//$statement->bindValue(":email", $userModel->getEmail());
//$statement->bindValue(":phash", $userModel->getPasswordHash());
//$statement->bindValue(":psalt", $userModel->getPasswordSalt());
//$statement->bindValue(":fname", $userModel->getFirstname());
//$statement->bindValue(":mname", $userModel->getMiddlename());
//$statement->bindValue(":lname", $userModel->getLastname());
//$statement->execute();
//}

}