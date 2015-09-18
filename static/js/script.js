// Define globals for JSHint validation:
/* global console */


/**
 * Enable parallax scrolling on images contained within elements with
 * class .parallax.
 *
 * Expects markup like:
 * <div class="parallax-container"><div class="parallax"><img src="..."></div></div>
 *
 * Adapted from:
 * http://materializecss.com/parallax.html
 **/
function parallax() {
  var parallaxElems = [];
  var windowProperties = {};

  // Store references to each .parallax element and their images
  function setParallaxElems() {
    $('.parallax').each(function() {
      var parallaxElem = {};

      parallaxElem.element = $(this);
      parallaxElem.image = parallaxElem.element.children('img').first();

      parallaxElems.push(parallaxElem);
    });
  }

  // Store window properties outside of parallaxElems loops to reduce
  // number of calls to $(window) and its properties
  function setWindowProperties() {
    var win = $(window);
    windowProperties.top = win.scrollTop();
    windowProperties.width = win.width();
    windowProperties.height = win.height();
    windowProperties.bottom = windowProperties.top + windowProperties.height;
  }

  // Performs the actual positioning logic for parallax images
  function updateParallax(parallaxElem, initial) {
    var imageHeight = parallaxElem.image.height(),
        elemHeight = parallaxElem.element.height() > 0 ? parallaxElem.element.height() : imageHeight,
        parallaxDistance = imageHeight - elemHeight,
        top = parallaxElem.element.offset().top,
        bottom = top + elemHeight,
        percentScrolled = (windowProperties.bottom - top) / (elemHeight + windowProperties.height).toFixed(2),
        parallax = Math.round((parallaxDistance * percentScrolled));


    if (initial) {
      parallaxElem.image.addClass('visible');
    }

    if ((bottom > windowProperties.top) && (top < (windowProperties.top + windowProperties.height))) {
      parallaxElem.image.css('transform', 'translate3D(-50%,' + parallax + 'px, 0)');
    }
  }

  function parallaxUpdateHandler() {
    setWindowProperties();

    $.each(parallaxElems, function(index, parallaxElem) {
      updateParallax(parallaxElem, false);
    });
  }

  function setupEventHandlers() {
    $(window).on('scroll resize', parallaxUpdateHandler);
  }

  function initParallax() {
    setParallaxElems();
    setWindowProperties();

    // Wait for image load (requires imagesloaded.js)
    $.each(parallaxElems, function(index, parallaxElem) {
      parallaxElem.element.imagesLoaded().done(function() {
        updateParallax(parallaxElem, true);
      });
    });

    setupEventHandlers();
  }


  initParallax();
}


/**
 * Guess whether or not this is a mobile device based on window size.
 * Definitely not perfect, but should catch most smartphones at least.
 **/
function isMobileSize() {
  if ($(window).width() <= 768) {
    return true;
  }
  return false;
}


/**
 * Detect touch-enabled browsers, for the most part.  (Modernizr check)
 **/
function isTouchDevice() {
  return ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;
}


if (typeof jQuery !== 'undefined') {
  jQuery(document).ready(function($) {

    // Initialize parallax scrolling on non-mobile, non-touch devices for
    // optimal performance.
    if (!isMobileSize() && !isTouchDevice()) {
      parallax();
    }

  });
}
else {
  console.log('jQuery dependency failed to load');
}
