<?php

/*BELOW I MADE A CLASS WITH FUNCTIONs THAT WILL SEND NOTIFICATIOSN WHENEVER A POST IS MADE. FOR NOW, I EXCLUDED IT BECAUSE THE ACTUAL GATHERING PAGE IS BEING WORKED ON BY CHEN.
ONCE HE I FINISHED, I WILL CONNECT THIS TO IT SO THAT NOTIFICATIONS CAN BE MADE TO THE GATHERING WHNEVER AN ANNOUNCEMENT IS POSTED */

require_once ('../View/gather_grouppage.php');
require_once ('../Model/dbconnect.php');
require_once ('../Model/getandset_Announcements.php');
require_once ('../Model/gatherAndAnnouncements_crud.php');

//session_start();

class notificationClass {

    function notify($type = 'neutral', $message = 'Notification'){
        $_SESSION['notifier']['type'] = $type;
        $_SESSION['notifier']['message'] = $message;
    }

    function submitFormNotification()
    {
        if (isset($_POST['addAnnouncement'])) {
            self::notify('newAnnouncement', $_POST['userID'] . ' posted an announcement');
            //return '';

        }
    }



    function notificationCreator()
    {
        if (isset($_SESSION['notifier'])) {
            $type = $_SESSION['notifier']['type'];
            $message = $_SESSION['notifier']['message'];

            $html = '<div class="notifier ' . $type . '">' . $message . '</div>';
            unset($_SESSION['notifier']);
            return $html;
        }
    }
}

