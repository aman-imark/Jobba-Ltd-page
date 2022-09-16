(function ($) {
    'use strict';

    AOS.init();

    AOS.init({
        disable: function() {
          var maxWidth = 1199.98;
          return window.innerWidth < maxWidth;
        }
      });

    $(window).scroll(function () {
        var scrollHeader = $(window).scrollTop();
        if (scrollHeader >= 10) {
            $("#header").addClass("scrolled");
        } else {
            $("#header").removeClass("scrolled");
        }
    });

    $(document).ready(function () {

        var swiper = new Swiper(".key-option", {
            centeredSlides: true,
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            autoplay: {
                delay: 4000,
            },
            breakpoints: {
                320: {
                  slidesPerView: 1,
                  spaceBetween: 20
                },
                768: {
                  slidesPerView: 1.5,
                  spaceBetween: 80
                },
                992: {
                  slidesPerView: 2,
                  spaceBetween: 100
                },
                1200: {
                    slidesPerView: 2,
                    spaceBetween: 150,
                }
              }
        });

        $('.clickable').click(function(){
            $(this).parent().prev(".readit").toggle();
        });

    });

    $(window).on("load resize", function () {
        var rangeSlider = $('#customRange1');
        var rangeValue = (rangeSlider.attr('value') - rangeSlider.attr('min')) / (rangeSlider.attr('max') - rangeSlider.attr('min')) * 100;

        $('#customRange1').css({
            'background': 'linear-gradient(to right, #041959 ' + rangeValue + '%, #fff ' + rangeValue + '%, white 100%)',
        });

        document.getElementById("customRange1").oninput = function () {
            var value = (this.value - this.min) / (this.max - this.min) * 100;
            this.style.background = 'linear-gradient(to right, #041959 ' + value + '%, #fff ' + value + '%, white 100%)'
        };
    });

})(jQuery)