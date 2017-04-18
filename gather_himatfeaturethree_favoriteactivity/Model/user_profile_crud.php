<?php


class user_profile_crud
{
    public function get_user_profile($db)
    {
        $query = "SELECT * FROM user_profile;";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->execute(); // now we execute the statement
        $result= $pdostmt2->fetchAll(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor(); //dont forget this, because it disconnects your connection to db cuz there can only be 1 at a atime
        return $result; //return ture because its succesfful
    }

    public function selectUserProfile($db, $profileid)
    {
        /*insertUser($pdoconnection, $username, $email, $password_hash, $password_salt,
            $firstname, $middlename, $lastname, $location_id, $role_id);*/

        $query = "SELECT * FROM user_profile WHERE id = :profileid";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(":profileid", $profileid);
        /*$result = */$pdostmt2->execute();
        $userFetch = $pdostmt2->fetch(PDO::FETCH_ASSOC);
        $pdostmt2->closeCursor();
        return $userFetch;
    }

//    public function add_user_profile($db, $user_id, $user_role, $user_dob, $current_jobtitle, $education_level, $address, $user_description, $pic_likes, $profile_image)
//    {
//
//        $query = "INSERT INTO user_profile(user_id, user_role, user_dob, current_jobtitle, education_level, address, user_description, pic_likes, profile_image)
//        VALUES (:user_id, :user_role, :user_dob, :current_jobtitle, :education_level, :address, :user_description, :pic_likes, :profile_image)";
//        $pdostmt2 = $db->prepare($query);
//        $pdostmt2->bindValue(':user_id', $user_id);
//        $pdostmt2->bindValue(':user_role', $user_role);
//        $pdostmt2->bindValue(':user_dob', $user_dob);
//        $pdostmt2->bindValue(':current_jobtitle', $current_jobtitle);
//        $pdostmt2->bindValue(':education_level', $education_level);
//        $pdostmt2->bindValue(':address', $address);
//        $pdostmt2->bindValue(':user_description', $user_description);
//        $pdostmt2->bindValue(':pic_likes', $pic_likes);
//        $pdostmt2->bindValue(':profile_image', $profile_image);
//        /*$row = */$pdostmt2->execute();
//        $pdostmt2->closeCursor();
//        //return $row;
//    }
    public function add_user_profile($db, $user_id, $user_role, $user_dob, $current_jobtitle, $education_level, $address, $user_description, $pic_likes, $profile_image)
    {

        $query = "INSERT INTO user_profile(user_id, user_role, user_dob, current_jobtitle, education_level, address, user_description, pic_likes, profile_image) 
        VALUES (:user_id, :user_role, :user_dob, :current_jobtitle, :education_level, :address, :user_description, :pic_likes, :profile_image)";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(':user_id', $user_id);
        $pdostmt2->bindValue(':user_role', $user_role);
        $pdostmt2->bindValue(':user_dob', $user_dob);
        $pdostmt2->bindValue(':current_jobtitle', $current_jobtitle);
        $pdostmt2->bindValue(':education_level', $education_level);
        $pdostmt2->bindValue(':address', $address);
        $pdostmt2->bindValue(':user_description', $user_description);
        $pdostmt2->bindValue(':pic_likes', $pic_likes);
        $pdostmt2->bindValue(':profile_image', $profile_image);
        $row = $pdostmt2->execute();
        $pdostmt2->closeCursor();
        return $row;
    }

    //put update here
    public function delete_userprofile($db, $id){

        $query = "DELETE FROM user_profile WHERE id = :id";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(':id', $id);
        $pdostmt2->execute();
        $pdostmt2->closeCursor();
        header("Location:index.php");
    }

    public function update_profile($db, $id, $user_id, $user_role, $user_dob, $current_jobtitle, $education_level, $address, $user_description, $pic_likes, $profile_image)
    {

//        $query = "UPDATE user_profile(user_id, user_role, user_dob, current_jobtitle, education_level, address, user_description, pic_likes, profile_image)
//        VALUES (:user_id, :user_role, :user_dob, :current_jobtitle, :education_level, :address, :user_description, :pic_likes, :profile_image)";
        $query = "UPDATE user_profile SET user_id = :user_id, user_role = :user_role, user_dob = :user_dob, current_jobtitle = :current_jobtitle, education_level = :education_level, address = :address, user_description = :user_description, pic_likes = :pic_likes, profile_image = :profile_image  WHERE id = :id";
        $pdostmt2 = $db->prepare($query);
        $pdostmt2->bindValue(':id', $id);
        $pdostmt2->bindValue(':user_id', $user_id);
        $pdostmt2->bindValue(':user_role', $user_role);
        $pdostmt2->bindValue(':user_dob', $user_dob);
        $pdostmt2->bindValue(':current_jobtitle', $current_jobtitle);
        $pdostmt2->bindValue(':education_level', $education_level);
        $pdostmt2->bindValue(':address', $address);
        $pdostmt2->bindValue(':user_description', $user_description);
        $pdostmt2->bindValue(':pic_likes', $pic_likes);
        $pdostmt2->bindValue(':profile_image', $profile_image);
        $row = $pdostmt2->execute();
        $pdostmt2->closeCursor();
        return $row;
        header("Location:user_profile_pageupdate.php");
    }


}