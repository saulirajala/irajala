export default {
  init() {
    // JavaScript to be fired on the home page
  },
  finalize() {

    // Add tooltipster to .rotatory__object, when in desktop
    if ($('.rotatory__outline-wrap').is(':visible')) {
      $('.rotatory__object').tooltipster({
        theme: 'tooltipster-noir',
        arrow: false,
        animationDuration: 10,
        delay: 10,
        distance: 3,
        // triggerOpen: 'click',
        // trigger: 'click',
      });
    }

    //Play border-animation, when scoll reaches archive-link in mobile
    $(window).scroll(function () {
      if (!$('.rotatory__outline-wrap').is(':visible')) {
        var elementPosition = $('.rotatory__archive').offset().top, //missä elementti on
          elementHeight = $('.rotatory__archive').outerHeight(), //elementin korkeus
          windowHeight = $(window).height(), //ikkunan korkeus
          scrollPosition = $(this).scrollTop(), //paljonko on scrollattu
          padding = 20;
        if (scrollPosition > (elementPosition + elementHeight - windowHeight + padding)) {
          $('.rotatory__archive').addClass('border-hover--play');
        }
      }
    });


    /**
     * Add hide-hero-text to header, when reached scrollDistance by scrolling
     *
     * @param scrollDistance
     */
    function makeHeaderSticky(scrollDistance) {
      $(window).scroll(function () {
        if ($(this).scrollTop() > scrollDistance) {
          $('html').addClass('hide-hero-text');
        } else {
          $('html').removeClass('hide-hero-text');
        }
      });
      if ($(this).scrollTop() > scrollDistance) {
        $('html').addClass('hide-hero-text');
      }
    }

    makeHeaderSticky(200);

    // Add Scroll animation, if link is anchor-link
    $('a[href*=#]').on('click', function (e) {
      e.preventDefault();
      $('html, body').animate({scrollTop: $($(this).attr('href')).offset().top}, 900, 'linear');
    });
  },
};
