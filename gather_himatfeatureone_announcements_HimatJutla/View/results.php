<!--
BELOW IS CODE THAT WILL EVENTUALLY BE IMPLEMETED ONCE ALL OTHER FEATURES AND COMPONENTS ARE PUT TOGETHER O THAT THE ENTIRE SITE CAN BE RUN WITHOUT REFRESHING USING AJAX AND JSON-->

<?php

require_once ('../Model/dbconnect.php');
require_once ('../Model/getandset_Announcements.php');
require_once ('../Model/gatherAndAnnouncements_crud.php');
require_once ('../Controller/notificationClass.php');
?>

<p class="viewAnnouncementsButton">CLICK TO VIEW ANNOUNCEMENTS</p>
        <p class="viewAnnouncementsButtonhidden">CLICK TO CLOSE</p>
        <section class="AnnouncementResults">
            <div class="results" id="results">
                <?php
                $id = filter_input(INPUT_POST, 'userID');
                $userId = filter_input(INPUT_POST, 'userID');
                $subjectLine = filter_input(INPUT_POST, 'subjectLine');
                $announcement = filter_input(INPUT_POST, 'announcement');

                $crud = new gatherAndAnnouncements_crud();
                $result = $crud->getAnnouncement($pdoconnection);

                if (isset($_POST['delete'])){
                    if (!empty ($_POST['id'])) {
                        $crud->deleteAnnouncement($pdoconnection, $_POST['id']);
                        //header("Refresh:0");
                    }
                }
                foreach ($result as $key) {

                    echo "<div class='eachPost'>";
                    echo "<span class='subjectandUser'>";
                    echo "<label class='userLabel'>Posted By:&nbsp</label>";
                    echo ($key['UsersId']);
                    echo  " <label class='subjectLabel'>&nbsp&nbspSubject:&nbsp</label>";
                    echo ($key['subject']);
                    echo "<span class='dateClass'>";
                    echo  "<label class='dateLabel'>&nbsp&nbsp&nbspDate Posted:&nbsp</label> ";
                    echo ($key['Date']) ."</span></span><br>";
                    echo  "<label class='announcementLabel'>Announcement: </label><br> ";
                    echo ($key['announcement']) ."<br>";
                    echo "<form method='post' action='gather_grouppage.php'>";
                    echo "<input type='hidden' name='id' value='".$key['Id']."' />";
                    echo "<input type='submit' name='delete' class='deletebutton' value='Delete Announcement'/>";
                    echo "</form>";
                    echo "</div>";
                }
                ?>
</div>
</section>