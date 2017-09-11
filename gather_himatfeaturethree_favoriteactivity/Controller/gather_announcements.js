/*JAVASCRIPT PAGE FOR ANNOUNCEMENT FEATURE*/

//TASK 1 - CREATING A HIDDEN FIELD FOR ANNOUNCEMENTS SO THAT ON CLICK, ANNOUNCEMENTS CAN BE DISPLAYED

//Step 1 - Ready Function
$(document).ready(function(){

//Step 2 - AutoHide Elements

//2.1 - Hidden Announcement Postings and hidden "Close Announcements" Button
    $('.AnnouncementResults').hide();
    $('.viewAnnouncementsButtonhidden').hide();



//Step 3 - Onclick function to show announcements
        $('.viewAnnouncementsButton').click(
            function() {
                $('.AnnouncementResults').slideToggle(1000);
                $('.viewAnnouncementsButton').hide();
                $('.viewAnnouncementsButtonhidden').show();
            })
    $('.viewAnnouncementsButtonhidden').click(
        function(){
            $('.AnnouncementResults').slideToggle(1000);
            $('.viewAnnouncementsButtonhidden').hide();
            $('.viewAnnouncementsButton').show();
        }
    );

        /* BELOW WILL BE IMPLEMENTED IN THE FUTURE WHEN ALL PAGE ARE PUT TOGETHER. THE ENTIRE SITE WILL RUN ON AJAX AND JSON SO WE WON'T HAVE TO REFRESH ANYTHING */

//TASK 2 - AJAX JQUERY TO SUBMIT ANNOUNCEMENTS AND DELETE ANNOUNCEMENTS WITHOUT REFRESHING THE PAGE

    //Step 1 - Select Submit Button
    //$('input#addAnnouncement').on('click', function(){
    //
    //     //Step 2 - Create AJAX Request
    //     $.post("results.php",
    //         {userID : $('#userID').val(),
    //             subjectLine : $('#subjectLine').val(),
    //             announcement : $('#announcement').val()},
    //         function(data){
    //             $("#AnnouncementResults").html(data);
    //
    //    })

   //  $('input#addAnnouncement').on('click', function chk(){
   //      var userID = document.getElementById('userID').value;
   //      var subjectLine = document.getElementById('subjectLine').value;
   //      var announcement = document.getElementById('announcement').value;
   //      var data = userID + subjectLine + announcement;
   //      $.ajax({
   //          type: "post",
   //          url: "results.php",
   //          data: data,
   //          cache: false,
   //          success: function(html){
   //              $('#results').html(html)
   //          }
   //      });
   //      return false;
   //  })

   //  $('input#deletebutton').on('click', function chk(){
   //      //      var userID = document.getElementById('userID').value;
   //      //      var subjectLine = document.getElementById('subjectLine').value;
   //      //      var announcement = document.getElementById('announcement').value;
   //      //      var data = userID + subjectLine + announcement;
   //      //      $.ajax({
   //      //          type: "post",
   //      //          url: "results.php",
   //      //          data: data,
   //      //          cache: false,
   //      //          success: function(html){
   //      //              $('#results').html(html)
   //      //          }
   //      //      });
   //      //      return false;
   //      //  })
   // //
   // //})
   //
   //  //Step 2 - Select Submit Button
   //  // $('input#deletebutton').on('click', function(){
   //  //
   //  //     //Step 2 - Create AJAX Request
   //  //     $.post('',
   //  //         {userID : $('#userID').val(),
   //  //             subjectLine : $('#subjectLine').val(),
   //  //             announcement : $('#announcement').val()},
    //         function(data){
    //             $('#results').html(data);
    //
    //         })
    //
    //})

});
