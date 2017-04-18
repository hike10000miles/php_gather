/**
 * Created by pritpal on 14-04-2017.
 */

window.onload = function() {
    var input1 = document.getElementById("para");
    input1.style.display = "none";
    var output = document.getElementById("readmore");
    output.onclick = processform;

    function processform() {
        var input1 = document.getElementById("para");
        input1.style.display = "block";
        var input3 = document.getElementById("readmore");
        input3.style.display = "none";
    }
}