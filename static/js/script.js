// Define globals for JSHint validation:
/* global console */


if (typeof jQuery !== 'undefined'){
  (function() {

    /**
     * Parallax plugin, borrowed from the Materialize framework.
     * http://materializecss.com/parallax.html
     **/
    $.fn.parallax = function () {
      var window_width = $(window).width();
      // Parallax Scripts
      return this.each(function(i) {
        var $this = $(this);
        $this.addClass('parallax');

        function updateParallax(initial) {
          var container_height;
          if (window_width < 601) {
            container_height = ($this.height() > 0) ? $this.height() : $this.children("img").height();
          }
          else {
            container_height = ($this.height() > 0) ? $this.height() : 500;
          }
          var $img = $this.children("img").first();
          var img_height = $img.height();
          var parallax_dist = img_height - container_height;
          var bottom = $this.offset().top + container_height;
          var top = $this.offset().top;
          var scrollTop = $(window).scrollTop();
          var windowHeight = window.innerHeight;
          var windowBottom = scrollTop + windowHeight;
          var percentScrolled = (windowBottom - top) / (container_height + windowHeight);
          var parallax = Math.round((parallax_dist * percentScrolled));

          if (initial) {
            $img.css('display', 'block');
          }
          if ((bottom > scrollTop) && (top < (scrollTop + windowHeight))) {
            $img.css('transform', "translate3D(-50%," + parallax + "px, 0)");
          }

        }

        // Wait for image load
        $this.children("img").one("load", function() {
          updateParallax(true);
        }).each(function() {
          if(this.complete) $(this).load();
        });

        $(window).scroll(function() {
          window_width = $(window).width();
          updateParallax(false);
        });

        $(window).resize(function() {
          window_width = $(window).width();
          updateParallax(false);
        });

      });

    };


    // Guess whether or not this is a mobile device based on window size.
    // Definitely not perfect, but should catch most smartphones at least.
    function isMobileSize() {
      if ($(window).width() <= 768) {
        return true;
      }
      return false;
    }

    // Detect touch-enabled browsers, sort of.  (Modernizr check)
    function isTouchDevice() {
      return ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;
    }

    // Initialize parallax scrolling on non-mobile, non-touch devices for
    // optimal performance.
    function parallaxInit() {
      if (!isMobileSize() && !isTouchDevice()) {
        $('.parallax').parallax();
      }
    }


    $(document).ready(function() {
      parallaxInit();
    });

  })(jQuery);
}
else {
  console.log('jQuery dependency failed to load');
}
