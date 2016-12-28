/* ========================================================================
* DOM-based Routing
* Based on http://goo.gl/EUTi53 by Paul Irish
*
* Only fires on body classes that match. If a body class contains a dash,
* replace the dash with an underscore when adding it to the object below.
*
* .noConflict()
* The routing is enclosed within an anonymous function so that you can
* always reference jQuery with $, even when in .noConflict() mode.
* ======================================================================== */

(function($) {

    // Use this variable to set up the common and page specific functions. If you
    // rename this variable, you will also need to rename the namespace below.
    var Sage = {
        // All pages
        'common': {
            init: function() {
                // JavaScript to be fired on all pages


                var sticky_header = function() {
                    // https://iamsteve.me/blog/entry/stop-headroom.js-hiding-when-your-navigation-is-open
                    function isNavVisible(nav) {
                        return ( nav.classList.contains('in') ? true : false );
                    }

                    var header = document.getElementById('main_header');
                    var nav = document.getElementById('navbar');

                    var options = {
                        "offset": 0,
                        "tolerance": 10,
                        "classes": {
                            "initial": "animated",
                            "pinned": "swingInX",
                            "unpinned": "swingOutX",
                            // "pinned": "slideDown",
                            // "unpinned": "slideUp",
                        },

                        onUnpin: function() {
                            if ( $(window).width() <= 992 ) {
                                if ( isNavVisible(nav) ) {
                                    this.elem.classList.remove(this.classes.unpinned);
                                    this.elem.classList.add(this.classes.pinned);
                                }
                                else {
                                    this.elem.classList.add(this.classes.unpinned);
                                    this.elem.classList.remove(this.classes.pinned);
                                }
                            }
                        }
                    };

                    var headroom = new Headroom(header, options);
                    headroom.init();
                };


                /* Back to Top */
                $('.ct-btn').on('click', function() {
                    verticalOffset = typeof(verticalOffset) !== 'undefined' ? verticalOffset : 0;
                    element = $('html');
                    offset = element.offset();
                    offsetTop = offset.top;
                    $('html, body').animate({
                        scrollTop: offsetTop
                    }, 1200
                );
            });

            //
            // Hover Dropdown
            var navbarToggle = '.navbar-toggler'; // name of navbar toggle, BS3 = '.navbar-toggle', BS4 = '.navbar-toggler'
            $('.dropdown, .dropup').each(function() {
                var dropdown = $(this),
                dropdownToggle = $('[data-toggle="dropdown"]', dropdown),
                dropdownHoverAll = dropdownToggle.data('dropdown-hover-all') || false;

                // Mouseover
                dropdown.hover(function(){
                    var notMobileMenu = $(navbarToggle).size() > 0 && $(navbarToggle).css('display') === 'none';
                    if ((dropdownHoverAll === true || (dropdownHoverAll === false && notMobileMenu))) {
                        dropdownToggle.trigger('click');
                    }
                });
            });


            var isotope = function() {

                var $container = $('#isotope-list'); //The ID for the list with all the blog posts
                $container.isotope({ //Isotope options, 'item' matches the class in the PHP
                itemSelector : '.item',
                  layoutMode : 'masonry'
                });

                //Add the class selected to the item that is clicked, and remove from the others
                var $optionSets = $('#filters'),
                $optionLinks = $optionSets.find('a');

                $optionLinks.click(function(){
                var $this = $(this);
                // don't proceed if already selected
                if ( $this.hasClass('selected') ) {
                  return false;
                }
                var $optionSet = $this.parents('#filters');
                $optionSets.find('.selected').removeClass('selected');
                $this.addClass('selected');

                //When an item is clicked, sort the items.
                var selector = $(this).attr('data-filter');
                $container.isotope({ filter: selector });

                return false;
                });

            }


            // Function Declaration
            sticky_header();
            isotope();

        },
        finalize: function() {
            // JavaScript to be fired on all pages, after page specific JS is fired

        }
    },
    // Home page
    'home': {
        init: function() {
            // JavaScript to be fired on the home page
        },
        finalize: function() {
            // JavaScript to be fired on the home page, after the init JS
        }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
        init: function() {
            // JavaScript to be fired on the about us page
        }
    }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
    fire: function(func, funcname, args) {
        var fire;
        var namespace = Sage;
        funcname = (funcname === undefined) ? 'init' : funcname;
        fire = func !== '';
        fire = fire && namespace[func];
        fire = fire && typeof namespace[func][funcname] === 'function';

        if (fire) {
            namespace[func][funcname](args);
        }
    },
    loadEvents: function() {
        // Fire common init JS
        UTIL.fire('common');

        // Fire page-specific init JS, and then finalize JS
        $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
            UTIL.fire(classnm);
            UTIL.fire(classnm, 'finalize');
        });

        // Fire common finalize JS
        UTIL.fire('common', 'finalize');
    }
};

// Load Events
$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
