$(function() {

    $("#logo-ufo,#logo-light-right,#logo-light-left").effect("bounce", "slow");
    /*
    $.each( $.easing, function( name, impl ) {
        //console.log(name);
    });
    */
    var show = true;
    setInterval(function() {

        if(show){
            $("#logo-light-left,#logo-light-right").hide();
            show = false;
        }else if(!show){
            $("#logo-light-left,#logo-light-right").show();
            show = true;
        }

    } , 1000);

});

