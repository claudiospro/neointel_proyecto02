var idleTime = 0;
$(document).ready(function () {
    var idleInterval = setInterval(function() {timerIncrement()}, 20000);

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
    if (idleTime > 100) {
        window.location.reload();
    }
}
