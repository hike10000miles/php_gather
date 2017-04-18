/*BELOW IS MY JS VALIDATION FOR THE ANNOUNCEMENT FORM. ALTHOUGH I'VE ALREADY VALIDATED WITH PHP, I'VE INCLUDEd JS VALIDATION
IN ORDER TO MAKE THE USER EXPERIENCE BETTER AS THIS VALIDATION BEGINS BEFORE PHP BECAUSE THE PHP REQUEST NEVER GETS SENT TO THE
SERVER IF IT DOESN'T PASS THIS VALIDATION, MAKING IT SO THAT THE PAGE DOESNT RFRESH  */

window.onload = startScript;
function startScript(){


    $('#addAnnouncement').click(function(){
        var userNameValidation = document.getElementById('userID').value;
        if (userNameValidation === '' || userNameValidation === null){
            userNameMessage = document.getElementById('userID');
            userNameMessage.style.background = 'red';
            userNameMessage.innerHTML = 'Please enter your User Id';
            userNameMessage.style.color = 'white';
            userNameMessage.focus();
            return false;

        }
        var subjectLineValidation = document.getElementById('subjectLine').value;
        if (subjectLineValidation === '' || subjectLineValidation === null){
            subjectLineMessage = document.getElementById('subjectLine');
            subjectLineMessage.style.background = 'red';
            subjectLineMessage.innerHTML = 'Please enter a title for your announcement';
            subjectLineMessage.style.color = 'white';
            subjectLineMessage.focus();
            return false;
        }
        var announcementValidation = document.getElementById('announcement').value;
        if (announcementValidation === '' || announcementValidation === null){
            announcementMessage = document.getElementById('announcement')
            announcementMessage.style.background = 'red';
            announcementMessage.innerHTML = 'Please type an announcement';
            announcementMessage.style.color = 'white';
            announcementMessage.focus();
            return false;
        }

        //return false;

    });

    // function validateForm(){
    //     var userNameValidation = document.getElementById('userID').value;
    //     if (userNameValidation === '' || userNameValidation === null){
    //         userNameMessage = document.getElementById('userID');
    //         userNameMessage.style.background = 'red';
    //         userNameMessage.innerHTML = 'Please enter your User Id';
    //         userNameMessage.style.color = 'white';
    //         userNameMessage.focus();
    //         return false;
    //     }
    //     var subjectLineValidation = document.getElementById('subjectLine').value;
    //     if (subjectLineValidation === '' || subjectLineValidation === null){
    //         subjectLineMessage = document.getElementById('subjectLine');
    //         subjectLineMessage.style.background = 'red';
    //         subjectLineMessage.innerHTML = 'Please enter a title for your announcement';
    //         subjectLineMessage.style.color = 'white';
    //         subjectLineMessage.focus();
    //         return false;
    //     }
    //     var announcementValidation = document.getElementById('announcement').value;
    //     if (announcementValidation === '' || announcementValidation === null){
    //         announcementMessage = document.getElementById('subjectLine')
    //         announcementMessage.style.background = 'red';
    //         announcementMessage.innerHTML = 'Please type an announcement';
    //         announcementMessage.style.color = 'white';
    //         announcementMessage.focus();
    //         return false;
    //     }
    //
    //    return false;
    // }
}
