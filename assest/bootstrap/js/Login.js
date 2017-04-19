$(document).ready(function () {
    "use strict";
    $("#login").click(login);

    function login() {
        var username = $("#username").val();
        var password = $("#password").val();

        if ((username === "") || (password === "")) {
            // TODO(batuhan): ༼ つ ◕_◕ ༽つ Giff error div
            console.log("Error");
        } else {
            $.ajax({
                type: "POST",
                url: "checklogin.php",
                data: "identifier=" + username + "&password=" + password,
                dataType: 'JSON',
                success: function (data) {
                    console.log(data.response + "-" + data.userid + "-" + data.username);
                    switch (data.response) {
                        case 'loggedin':
                            location.reload();
                            return data.username;
                            break;
                        case 'invalid':
                            // TODO(batuhan): What do?
                            break;
                    }
                },
                error: function (status, error) {
                    console.log(status);
                    console.log(error);
                }
            });
        }
        return false;
    }
});