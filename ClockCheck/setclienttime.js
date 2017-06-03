$(document).ready(function() {
    clienttime();
});
function clienttime(){
    var  ClientTimeSec = Math.round(((new Date()).valueOf())/1000);
    var some = new Date();
    some.setTime(some.getTime() + (30*24*60*60*1000));
    var expires = "expires="+ some.toUTCString();
    document.cookie = "clienttime=" + ClientTimeSec + ";" + expires + "; path=/";
}
