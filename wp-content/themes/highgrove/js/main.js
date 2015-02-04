/**
 * Theme functions file
 *
 * Contains handlers for elements, components and effects.
 *
 * @package Highgrove
 * @since Highgrove 1.0
 */
(function( $ ) {

    var	$window     = $( window ),
        $document   = $( document ),
        $body       = $( 'body' ),
        $header     = $( '.site-header' ),
        $footer     = $( '.site-footer' );

    var rtl         = $body.css( 'direction' ) == 'rtl';

    $window.on( 'load', function() {

        $body.removeClass( 'loading' );

        var $navbar = $header.find( '.navbar' );

        var rel = $navbar.data( 'affix-rel' ),
            inverse = $navbar.is( '.navbar-inverse' );

        $navbar
            .affix({
                offset: {
                    top: function() {
                        return ( $( rel ).length > 0 ) ? $( rel ).offset().top : 0;
                    }
                }
            })
            .on( 'affix.bs.affix', function() {
                if ( inverse === true ) {
                    $( this ).removeClass( 'navbar-inverse' ).addClass( 'navbar-default' );
                }
            })
            .on( 'affix-top.bs.affix', function() {
                if ( inverse === true ) {
                    $( this ).removeClass( 'navbar-default' ).addClass( 'navbar-inverse' );
                }
            });

        $(document).off('tap', '.button');

        if ( $navbar.is( '.affix' ) ) {
            $navbar.removeClass( 'navbar-inverse' ).addClass( 'navbar-default' );
        }

        smoothScroll();
    });

    $( 'a[href*=#]:not(a[href=#])' ).click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });

    $( '*[data-effect]' ).each(function() {

        var $this = $( this ),
            $rel;

        // show the effect only if it's touch device
        if ( Modernizr.touch ) {
            $this.css( 'opacity', '1' );
            return;
        }

        var on,
            rel;

        on = ( $this.data( 'effect-on' ) ) ? $this.data( 'effect-on' ) : 'appear';
        rel = $this.data( 'effect-rel' );

        $rel = ( rel ) ? $this.closest( rel ) : $this;

        if ( on == 'appear' ) {
            $rel.appear();
        }

        $rel.on( on, function() {
            $this
                .addClass( 'animated' )
                .addClass( $this.data( 'effect' ) )
                .addClass( $this.data( 'effect-iteration' ) );
        });
    });

    $( '*[data-effect-delay]' ).each(function() {
        $( this )
            .css( 'animation-delay', function() {
                return $( this ).data( 'effect-delay' ) + 's';
            })
            .css( '-webkit-animation-delay', function() {
                return $( this ).data( 'effect-delay' ) + 's';
            });
    });

    $.force_appear();

    $( '*[data-toggle="tooltip"]' ).tooltip();

    $( 'input[type="date"]' ).prop( 'required', true );

    $( '.nav-isotope' ).on( 'click', 'a', function(e) {
        e.preventDefault();
        $( this ).closest( 'ul' ).find( '> .active' ).removeClass( 'active' );
        $( this ).parent().addClass( 'active' );
    });

    $( '.reel' ).each(function() {

        var	$this = $( this ),
            $left = $this.children( '.reel-left' ),
            $right = $this.children( '.reel-right' ),
            $body = $this.children( '.reel-body' ),
            $items = $body.children( '.item' );

        var	pos = 0,
            leftLimit,
            rightLimit,
            itemWidth,
            bodyWidth,
            timerId;

        // Main.
        $this._update = function() {
            pos = 0;
            leftLimit = rtl ? bodyWidth - $window.width() : 0;
            rightLimit = rtl ? 0 : $window.width() - bodyWidth;
            $this._updatePos();
        };

        $this._updatePos = function() {
            $body.css( 'transform', 'translate(' + pos + 'px, 0)' );
        };

        // Backward.
        $left
            .appendTo( $this )
            .hide()
            .mouseenter(function( e ) {
                timerId = window.setInterval(function() {
                    pos += 5;

                    if ( pos >= leftLimit ) {

                        window.clearInterval( timerId );
                        pos = leftLimit;

                    }

                    $this._updatePos();
                }, 10 );
            })
            .mouseleave(function( e ) {
                window.clearInterval( timerId );
            });

        // Forward.
        $right
            .appendTo( $this )
            .hide()
            .mouseenter(function( e ) {
                timerId = window.setInterval(function() {
                    pos -= 5;

                    if ( pos <= rightLimit ) {
                        window.clearInterval( timerId );
                        pos = rightLimit;
                    }

                    $this._updatePos();
                }, 10 );
            })
            .mouseleave(function( e ) {
                window.clearInterval( timerId );
            });

        // Init.
        $window.load(function() {
            bodyWidth = $body[0].scrollWidth;
            if ( Modernizr.touch ) {
                $body
                    .css( 'overflow-x', 'scroll' )
                    .css( 'overflow-y', 'visible' )
                    .scrollLeft( 0 );
                $left.hide();
                $right.hide();
            }
            else {
                $body
                    .css( 'overflow', 'visible' )
                    .scrollLeft( 0 );
                $left.show();
                $right.show();
            }
            $this._update();
        });

        $window.resize(function() {
            bodyWidth = $body[0].scrollWidth;
            $this._update();
        }).trigger( 'resize' );

    });

    $( '.isotope' ).each(function() {
        var $isotope = $( this ).imagesLoaded(function() {
            $isotope.isotope({
                masonry: {
                    columnWidth: '.column-sizer',
                    gutter: '.gutter-sizer'
                },
                itemSelector: '.item',
                isOriginLeft: ! rtl
            });
            $isotope.prev( '.nav-isotope' ).on( 'click', 'a', function() {
                $isotope.isotope({ filter: $( this ).data( 'filter' ) });
            });
        });
    });

})( jQuery );