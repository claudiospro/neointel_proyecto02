var idleTime = 0;
$(document).ready(function () {
    //Increment the idle time counter every minute.
    var idleInterval = setInterval(function() {timerIncrement()}, 60000);
    // var idleInterval = setInterval(timerIncrement, 60000); // 1 minute

    //Zero the idle timer on mouse movement.
    $(this).mousemove(function (e) {
        idleTime = 0;
        // console.log(idleTime);
    });
    $(this).keypress(function (e) {
        idleTime = 0;
        // console.log(idleTime);
    });
});

function timerIncrement() {
    idleTime = idleTime + 1;
    // console.log(idleTime);
    if (idleTime > 30) { // 20 minutes
        window.location.reload();
    }
}
