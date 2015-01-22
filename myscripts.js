// Parallax stuff
var $window = $(window);
var velocity = 0.6;

function update(){
    var pos = $window.scrollTop();
    

    $('.background_container').each(function() {
        var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
        
        if (pos < 550 && width > 767) {
            var $element = $(this);
            var height = $element.height();
        
        
            var fade = height - pos*2  
            fade = fade / height // convert fade to a decimal
            fade = parseFloat(2*fade.toFixed(2)); // round to 2dp and double fade speed
            if (fade < 0) {fade = 0;}
            else if (fade > 1) {fade = 1}
            
            //console.log(fade);
            $('.homepage_quote').css('opacity',fade);    

            $(this).css('backgroundPosition', '50% ' + (pos * velocity) + 'px');
        }
        
    });
};

$window.bind('scroll DOMMouseScroll', update);

// Fire for all touch movements
$(window).on('touchstart touchend touchmove mousewheel touchcancel gesturestart gestureend gesturechange orientationchange', function(){
        //alert($(window).scrollTop());
        $(window).trigger('scroll');
    });
    
$(document).ready(function(){
    if ($('#page-contents').length > 0) {
        $('.pagetitle .nav-pills').hide();
        $('#toc_container').before('<hr>');
        $('#page-contents .dropdown-menu').removeClass('dropdown-menu').appendTo('#toc_container');
    }
    
    $('#lqt_sort_select').addClass('form-control');
    $('.ns-talk .lqt_toc').removeClass('table-bordered');
})