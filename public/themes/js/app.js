/**
 * Created by HIEUTRIEU on 10/27/2015.
 */
(function($){
    $(document).ready(function() {
        $('.pgwSlideshow').pgwSlideshow();
        $('#slideshow').fadeSlideShow();
        $("#owl-demo").owlCarousel({
            afterInit : function(elem){
                var that = this
                that.owlControls.prependTo(elem)
            }
        });
        $('#top_menu').onePageNav({
            currentClass: 'current',
            changeHash: true,
            scrollSpeed: 750
        });
        var index = 2, refreshId;
        var member_counter = Math.round($('#list_member').find('table tr').length/4);
        window.clearInterval(refreshId);
        refreshId = window.setInterval(function() {
            //108
            if(index > member_counter) index = 1;
            //$("#list_member").animate({scrollTop: (431*index)}, 2000);
            $.ajax({
                url: '/website/getmember',
                data: {page: index},
                beforeSend: function() {
                    $('#list_member').fadeOut(500);
                },
                success: function($result) {
                    $("#list_member").fadeOut('slow',function(){
                        $(this).html($result)
                    }).fadeIn("slow");
                }
            });
            index++;
        }, 5000);
        $(window).bind('scroll', function() {
            var navHeight = 110;
            ($(window).scrollTop() > navHeight) ? $('#nav_top').addClass('fixed-top') : $('#nav_top').removeClass('fixed-top');
        });

        $('.project_tuya').hover(
            function() {
                $('.project_tuya_info').animate({top: 98}, 300);
            },
            function() {
                $('.project_tuya_info').animate({top: '100%'}, 300);
            }
        )
        $('.project_teleme').hover(
            function() {
                $('.project_teleme_info').animate({top: 82}, 300);
            },
            function() {
                $('.project_teleme_info').animate({top: '100%'}, 300);
            }
        )
        if(typeof freewall !== 'undefined') {
            var wall = new freewall("#blog_container");
            wall.fitWidth();
            wall.reset({
                selector: '.blog_item',
                animate: true,
                cellH: 'auto',
                onResize: function () {
                    wall.fitWidth();
                }
            });
            wall.container.find('.blog_item img').load(function () {
                wall.fitWidth();
            });
            //$(window).trigger("resize");
        }
    });
})(jQuery);

function initMap() {
    var cinnamon = { lat: 21.036337, lng: 105.845147 };
    var map = new google.maps.Map(document.getElementById('map'), {
        center: cinnamon,
        zoom: 12,
        mapTypeControl: false
    });
    var marker = new google.maps.Marker({
        position: cinnamon,
        label: "Cinnamon Lab",
        map: map
    });
}
