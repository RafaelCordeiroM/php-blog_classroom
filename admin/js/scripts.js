$(document).ready(function () {

    $(".select-1").click(function (event) {

        if (this.checked) {
            $(".s1").each(function () {
                this.checked = true;
            });
        }
        else {
            $(".s1").each(function () {
                this.checked = false;
            });
        }

    });

});

function loadUsersOnline(){
    $.get("includes/functions.php?request",function(data){
        $(".online_users").text(data);
    });
}

setInterval(function(){
    loadUsersOnline();
},500);