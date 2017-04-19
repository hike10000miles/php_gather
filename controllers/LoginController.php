<?php

/**
 * @Author: mindfog
 */
class LoginController
{
    private $db;
    
    /**
     * LoginController constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }
    
    /**
     * $username can be username or email
     * $password should be plain password from input field.
     * @param $username
     * @param $password
     * @param $rememberme bool
     * @return bool
     */
    public function login($username, $password, $rememberme = false)
    {
        if ($username == null || $password == null) {
            return false;
        }
        
        $sql = "SELECT u.id UserId,
                       u.passwordhash, 
                       u.passwordsalt,
                       b.id BusinessId
                       FROM users u
                       LEFT JOIN business b
                       ON u.id = b.userid
                       WHERE 
                       (u.username = :uname OR u.email = :email)";
        try {
            $statement = $this->db->prepare($sql);
            $statement->bindValue(':uname', $username);
            $statement->bindValue(':email', $username);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            
            $hash_result = \Util\CryptoEngine::hashPassword($password, $result['passwordsalt']);
            if ($hash_result['hash'] == $result['passwordhash']) {
                $_SESSION['LoggedIn']['UserId'] = $result['UserId'];
                $_SESSION['LoggedIn']['BusinessId'] = $result['BusinessId'];
                
                // DEBUG(batuhan): Not tested.
                if ($rememberme && !isset($_COOKIE['UserId'])) {
                    $expire = 60 * 60 * 24 * 30;
                    setcookie('UserId', $result['UserId'], $expire);
                }
                
                return $result['UserId'];
            }
        } catch (PDOException $PDOException) {
            // TODO(batuhan): Redirect to error page.
            echo("Something went horribly wrong.");
            die;
        }
        return false;
    }
    
    public function logout()
    {
        // NOTE(batuhan): lol
        session_start();
        session_destroy();
    }
    
    public function getLoginModel($id)
    {
        $sql = "SELECT u.username, 
                       b.id BusinessId
                       FROM users u
                       LEFT JOIN business b
                       ON u.id = b.userid
                       WHERE 
                       u.id = :uid";
        try {
            $statement = $this->db->prepare($sql);
            $statement->bindValue(':uid', $id);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $model = new LoginModel($id, $result['username'], $result['BusinessId'], true);
            return $model;
        } catch (PDOException $PDOException) {
            // TODO(batuhan): Redirect to error page.
            echo ("Something went horribly wrong.");
            die;
        }
    }
}