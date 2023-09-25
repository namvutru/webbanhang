
(function ($, root, undefined) {
    $(function () {
        var image, content, imgheight, imgwidth, xcount = 0,cx;
        var col, row = 1,
            imgwidth = 640;
        var width_sc = $(window).width();
        content = $('#presentation .preview-inner');
        content.css({
            'top': 0,
            'left': 0
        });
        $('#owl-5-sp-header').owlCarousel({
            slideSpeed: 300,
            pagination: false,
            singleItem: true,
            autoPlay: true
        });
        $('#presentation .preview .prev').bind('click', function (event) {
            image = content.find('img');
            imgwidth_full = image.width();
            imgheight_full = image.height();
            col = parseInt(imgwidth_full / imgwidth);
            forward(event);
        });
        $('#presentation .preview .next').bind('click', function (event) {
            image = content.find('img');
            imgwidth_full = image.width();
            imgheight_full = image.height();
            col = parseInt(imgwidth_full / imgwidth);
            backward(event);
        });
        $("form#subcribe_box").submit(function () {
            $('#modal-success-subrice').modal({
                show: true
            });
            delay(1000);
            location.reload();
        });
        $("#camket").click(function () {
            $(this).toggleClass('camket-ative');
            $(".wrap-camket").slideToggle();
        });
        $("a.page-scroll").bind("click", function (a) {
            var offset = $($(this).attr('href')).offset().top;
            $("html, body").stop().animate({
                scrollTop: offset - 60
            }, 1000), a.preventDefault()
        }) 
        $('.slider-kinhnghiemhay').bxSlider({
            mode: 'vertical',
            auto: true,
            controls: false,
            pager: false,
            stopAutoOnClick: true
        });

        function forward(event) {
            if (xcount == (col - 1)) {
                xcount = 0;
                content.css('left', 0);
            } else {
                xcount++;
                cx = imgwidth * xcount;
                content.css('left', -cx);
            }
        }

        function backward(event) {
            if (xcount == 0) {
                xcount = col - 1;
                cx = imgwidth * xcount;
                content.css('left', -cx);
            } else {
                xcount--;
                cx = imgwidth * xcount;
                content.css('left', -cx);
            }
        }
        function formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
        }
        $('#search-btn').click(function (event) {
            event.preventDefault();
            $('.form-search').slideToggle();
        });
        $('#presentation .control a.color').click(function (event) {
            event.preventDefault();
            var src = $(this).attr('img');
            var left = $('#presentation .preview-inner').attr('left');
            var html = '<img src="' + src + '" alt="" >';
            $('#presentation .preview-inner').text('').append(html);
            $('#presentation .preview-inner').css('left', left);
        });
        var getHeightVideoHome = $('.tintucnoibat').height();
        $('#video_top').css({
            'height': getHeightVideoHome,
            'min-height': 323
        });
        $('.title_video').click(function () {
            $(this).toggleClass('p_play');
        });
        $(".chat_fb").click(function () {
            $(this).parent().find("#fchat").stop().slideToggle(400);
        });
        $('.m-nav-menu').click(function () {
            $("#mainnav").stop().slideToggle(300);
        });

       

        $('#owl-acquy-2019, #owl-phutung-2019').owlCarousel({
            loop: false,
            margin: 10,
            nav: false,
            responsive: {
                0: {
                    items: 2
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 6
                }
            }
        });




    });

    let tabMapBottom = $(".tab-map-bottom");
    let tabMapBottomItem = tabMapBottom.find("li.bold");

    tabMapBottomItem.on("mouseover", (e) => {
        let target = $(e.target);

        if (target.parents("li.bold").length > 0) {
            target = target.parents("li.bold");
        }

        if (!target.hasClass("active")) {
            $("li.bold.active").removeClass("active");
            target.addClass("active");

            let targetID = target.data("target");
            $(".tab-pane.fade").removeClass("active");
            $(".tab-pane.fade").removeClass("in");
            $(`#phone-${targetID}`).addClass("active");
            $(`#phone-${targetID}`).addClass("in");
            $(`#${targetID}`).addClass("active");
            $(`#${targetID}`).addClass("in");

            setTimeout(() => {
            this.IndustryIsAnimated = false;
            }, 0);
        } else {
            this.IndustryIsAnimated = false;
        }
    });

   

})(jQuery, this);
//andy