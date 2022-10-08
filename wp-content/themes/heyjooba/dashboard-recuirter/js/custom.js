(function (jQuery) {
  AOS.init();

  $('.button_nav').click(function () {
    $(this).toggleClass('active');
    $('#overlay').toggleClass('open');
  });
  /** On Scroll Fixed Header **/
  $(window).scroll(function () {
    if ($(window).scrollTop() >= 300) {
      $('#header').addClass('fixed-header');
    } else {
      $('#header').removeClass('fixed-header');
    }
  }); /** On Scroll Fixed Header End **/

  /* Jquery-Accordion */
  // $("#accordionBistro").on("hide.bs.collapse show.bs.collapse", e => {
  //   $(e.target)
  //     .prev()
  //     .find("i:last-child")
  //     .toggleClass("fa-minus fa-plus");
  // });

  // number count for stats, using jQuery animate
  $('.counting').each(function () {
    var $this = $(this),
      countTo = $this.attr('data-count');
    $({
      countNum: $this.text()
    }).animate({
      countNum: countTo
    }, {
      duration: 3000,
      easing: 'linear',
      step: function () {
        $this.text(Math.floor(this.countNum));
      },
      complete: function () {
        $this.text(this.countNum);
      }
    });
  });

  $(document).ready(function () {
    $('.befefit-ctnt').click(function () {
      $('.befefit-ctnt').removeClass("active");
      $(this).addClass("active");
    });

    $(".ipad-screen .ipad-logo .icon-bar").click(function(){
      $("body").toggleClass("active");
      $(this).children("i").toggleClass("fa-bars fa-times");
    })


    
  });

  $('.member-slide').slick({
    dots: false,
    arrows: false,
    autoplay: true,
    speed: 200,
    slidesToShow: 1,
    infinite: false,
    loop: false,
    slidesToScroll: 1,
  });

  $('.work-main').on('init', function (event, slick) {
    var dots = $('.slick-dots li');
    console.log('SRANZAN VEE');
    dots.each(function (k, v) {
      $(this).find('button').addClass('heading' + k);
    });
    var items = slick.$slides;
    items.each(function (k, v) {
      var text = $(this).find('span').text();
      $('.heading' + k).text(text);
    });
  });

  $('.work-main').slick({
    dots: true,
    arrows: true,
    autoplay: true,
    speed: 200,
    slidesToShow: 1,
    infinite: false,
    loop: false,
    slidesToScroll: 1,
  });

  $('.wrap-list').slick({
    dots: true,
    arrows: false,
    autoplay: true,
    speed: 200,
    slidesToShow: 1,
    infinite: false,
    loop: false,
    slidesToScroll: 1,
  });
  // $('a[data-slide]').click(function(e) {
  //   e.preventDefault();
  //   var slideno = $(this).data('slide');
  //   $('.work-main').slick('slickGoTo', slideno - 1);
  // });

  // $(".toggle-password").click(function () {
  //   $(this).toggleClass("fa-eye fa-eye-slash");
  //   var input = $($(this).attr("toggle"));
  //   if (input.attr("type") == "password") {
  //     input.attr("type", "text");
  //   } else {
  //     input.attr("type", "password");
  //   }
  // });

  /* Scroll-Bar */
  $(window).on("load", function () {
    $(".scroll-progress").mCustomScrollbar({
      theme: "minimal",
      autoHideScrollbar: false,
      axis: "x"
    });
  });
  // $(window).on("load", function () {
  //   $(".category-thumb, .full-menu-tumb").mCustomScrollbar({
  //     theme: "minimal"
  //   });
  // });

  /* Jquery-Accordion */
  $("#accordion").on("hide.bs.collapse show.bs.collapse", e => {
    $(e.target)
      .prev()
      .find("i:last-child")
      .toggleClass("fa-minus fa-plus");
  });


  // jquery dashboard profile options
  $('.profile-name-arrow').on('click', function () {
    $(this).siblings('ul').toggleClass('show');
  });

  $('.drop-arrow').on('click', function () {
    $(this).toggleClass('rotate');
    $(this).siblings('.submenu').slideToggle();
    $(this).parents('li').addClass('active').siblings().removeClass('active').children('.drop-arrow').removeClass('rotate').siblings('.submenu').slideUp();
  });

  $('.sidebar-wrap ul li a').on('click', function () {
    $(this).parents('li').addClass('active').siblings().removeClass('active');
  });

  $('.files').change(function (e) {
    var file = e.target.files[0].name;
    $(this).siblings('.file-upload-filename').text(file);
  });

  $('.select-all-check input[type=checkbox]').on('change', function () {
    $('this').parents('.csm-job-table').find('.select-check').children('input[type=checkbox]').attr('checked');
  });

  $(".select-all-check input[type=checkbox]").click(function () {
    $(".select-check input[type=checkbox]").prop("checked", $(this).prop("checked"));
  });

  $(".select-check input[type=checkbox]").change(function () {
    if (!$(this).prop("checked")) {
      $(".select-all-check input[type=checkbox]").prop("checked", false);
    }
  });

  $("form").on("change", ".attach-file-wrap label input[type='file']", function () {
    $(this).parents("label").siblings(".attach-file-name").append($(this).val());
  });

  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
        $('#imagePreview').hide();
        $('#imagePreview').fadeIn(650);
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
  $("#imageUpload").change(function () {
    readURL(this);
  });

  //Avoid pinch zoom on iOS
  document.addEventListener('touchmove', function (event) {
    if (event.scale !== 1) {
      event.preventDefault();
    }
  }, false);
})(jQuery)