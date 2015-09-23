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
  var parallaxElems = [],
      windowProperties = {};

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


/**
 * Detect if a browser supports 3d transforms.
 * https://gist.github.com/lorenzopolidori/3794226
 **/
function supports3dTransforms() {
  if (!window.getComputedStyle) {
      return false;
  }

  var el = document.createElement('p'),
      has3d,
      transforms = {
          'webkitTransform':'-webkit-transform',
          'OTransform':'-o-transform',
          'msTransform':'-ms-transform',
          'MozTransform':'-moz-transform',
          'transform':'transform'
      };

  // Add it to the body to get the computed style
  document.body.insertBefore(el, null);

  for (var t in transforms) {
      if ( el.style[t] !== undefined ) {
          el.style[t] = 'translate3d(1px,1px,1px)';
          has3d = window.getComputedStyle(el).getPropertyValue(transforms[t]);
      }
  }

  document.body.removeChild(el);

  return (has3d !== undefined && has3d.length > 0 && has3d !== 'none');
}


if (typeof jQuery !== 'undefined') {
  jQuery(document).ready(function($) {

    // Initialize parallax scrolling on non-mobile, non-touch devices for
    // optimal performance.
    if (!isMobileSize() && !isTouchDevice() && supports3dTransforms()) {
      parallax();
    }

  });
}
else {
  console.log('jQuery dependency failed to load');
}
