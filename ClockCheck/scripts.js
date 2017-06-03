
$(document).ready(function() {
    setInterval(refresh_servertime, 1000);
    setInterval(refresh_clienttime, 1000);
    setInterval(timecheck, 1000);


});

function refresh_servertime() {
    $.ajax({
        url:'http://enos.itcollege.ee/~pratsep/ClockCheck/clock.php',
        type:'POST',
        success:function(results) {
            $("#container_servertime").html(results);
        }
    });
}
function refresh_clienttime(){
    var clientTime = new Date();
    var hours = clientTime.getHours();
    var minutes = clientTime.getMinutes();
    var seconds = clientTime.getSeconds();
    minutes = (minutes < 10 ? "0" : "") + minutes;
    seconds = (seconds < 10 ? "0" : "") + seconds;
    hours = (hours < 10 ? "0" : "") + hours;
    var finalClientTime = "Client time is: " + hours + ":" + minutes + ":" + seconds;
    $("#container_clienttime").html(finalClientTime);
}
function timecheck(){
    $.ajax({
        url:'http://enos.itcollege.ee/~pratsep/ClockCheck/timediff.php',
        type:'POST',
        success:function(results) {
            $("#container_timecheck").html(results);
        }
    });
}