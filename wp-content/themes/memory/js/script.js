/**
 * Main script
 *
 * @package Memory.
 */

jQuery( function ( $ ) {

	var $window = $( window ),
	$body       = $( 'body' ),
	clickEvent  = 'ontouchstart' in window ? 'touchstart' : 'click';

	// Slider Gallery.
	function slickSlider() {

		$( '.featured-posts-1 .featured-post__content' ).slick( {
			dots: true,
			infinite: true,
			speed: 600,
			centerMode: true,
			variableWidth: true,
			slidesToShow: 1,
			autoplay: true,
			autoplaySpeed: 4000,
			nextArrow:'',
			prevArrow: '',
			rtl: $body.hasClass( 'rtl' ),
			responsive: [{
				breakpoint: 574,
				settings: {
					centerMode: false,
					variableWidth: false,
				}
			}]
		} ); // slick.
	}

	// Slider Gallery.
	function slickGallery() {
		$( '.grid-gallery' ).slick( {
			rtl: $body.hasClass( 'rtl' ) ? true : false,
			nextArrow: '<button type="button" class="slick-next slick-nav"><i class="icofont-rounded-right"></i></button>',
			prevArrow: '<button type="button" class="slick-prev slick-nav"><i class="icofont-rounded-left"></i></button>',
		} );
	}

	/**
	* Move tag html in subscription form.
	*/
	function moveTagSubscriptionForm() {

		$( ".footer-subscription form" ).before( $( ".footer-subscription #subscribe-text" ) );

	}

	/**
	 * Scroll to top
	 */
	function scrollToTop() {
		var $button = $( '.scroll-to-top' );
		$button.on( 'click', function ( e ) {
			e.preventDefault();
			$( 'body, html' ).animate( {
				scrollTop: 0
			}, 500 );
		} );
	}

	function displaySliders() {
		$( '.is-hidden' ).removeClass( 'is-hidden' );
	}

	/**
	* Resize videos to fit the container.
	*/
	function responsiveIframe() {
		$( window ).on( 'resize', function () {

			// List layout.
			if ( $window.width() <= 767 ) {
				$( '.blog-list iframe, .blog-grid-sidebar iframe' ).each( function () {
					var $video = $( this ),
					$container = $video.parent(),
					containerWidth = $container.width(),
					$post = $video.closest( 'article' );

					if ( ! $video.data( 'origwidth' ) ) {
						$video.data( 'origwidth', $video.attr( 'width' ) );
						$video.data( 'origheight', $video.attr( 'height' ) );
					}
					var ratio = containerWidth / $video.data( 'origwidth' );

					// Only resize height for non-audio post format.
					if ( ! $post.hasClass( 'format-audio' ) ) {
						$video.css( 'height', $video.data( 'origheight' ) * ratio + 'px' );
					}
				} );
			} else {
				$( '.blog-list iframe, .blog-grid-sidebar iframe' ).each( function () {
					var $video = $( this );
					$video.attr( "style", "" );
				} );
			}
		} );
	}

	/**
	 * Add 'scrolling' CSS class when scrolling down.
	 */
	 function addScrollingClass() {
		var bodyClass = document.body.classList;

		if ( window.scrollY > 0 ) {
			bodyClass.add( 'scrolling' );
		} else {
			bodyClass.remove( 'scrolling' );
		}
		window.addEventListener( 'scroll', function ( event ) {
			requestAnimationFrame( function() {
				if ( window.scrollY > 0 ) {
					bodyClass.add( 'scrolling' );
				} else {
					bodyClass.remove( 'scrolling' );
				}
			} );
		} );
	 }

	 function stickyHeader() {
		var offset     = document.getElementById( 'header-top' ).offsetTop,
		headerTop      = $( '.header-top' ),
		headerBranding = $( '.header-branding' );
		if ( window.pageYOffset >= offset ) {
			headerTop.addClass( 'is-sticky' );
			headerBranding.css( "padding-top", "67px" );
		} else {
			headerTop.removeClass( 'is-sticky' );
			headerBranding.css( "padding-top", "0" );
		}
	}

	if ( $().slick ) {
		displaySliders();
		slickSlider();
		slickGallery();
	}

	stickyHeader();
	moveTagSubscriptionForm();
	scrollToTop();
	responsiveIframe();
	addScrollingClass();
} );
