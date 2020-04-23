var flag = false;
var name = null;

$(document).ready(function(){
    $(".table td").on('click', function(){
        if (flag == false) {
            flag = true;
            $(this).addClass('on');
            name = $(this).text();
            $('.on').css({'background-color':'yellow'});
        } else {
            flag = false;
            $('.on').css({'background-color':'initial'});
            $('.on').removeClass('on').text($(this).text());
            $(this).text(name);
            name = null;
        }
    });  

    $(document).on('click', function(e) {
        if(!$(e.target).is('.table td')) {
            flag = false;
            name = null;
            $('.on').css({'background-color':'initial'});
            $('.on').removeClass('on')
        }
    });

});