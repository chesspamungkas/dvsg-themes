jQuery( document ).ready( function() {
    
    // scroll to top button
    var windowHeight = jQuery( window ).height();
    var topHeaderHeight = jQuery( '#main-header' ).height();

    if( isHome == 'yes' ) {
        var params = location.search;
        var queryString = new URLSearchParams( params );
        
        if( queryString.has( 'hash' ) ) {
            console.log( queryString.get( 'hash' ) );
            var hash = '#'+queryString.get( 'hash' );
            jQuery( 'html, body' ).animate( {
                scrollTop: jQuery( hash ).offset().top,
            }, 500 );
        }
    }

    if( jQuery( "#wpadminbar" ).length != 0 ) {
        topHeaderHeight = topHeaderHeight + jQuery( "#wpadminbar" ).height();
    }

    // console.log( windowHeight );

    jQuery( window ).on("scroll", function () {
        if ( jQuery( this ).scrollTop() > ( windowHeight - topHeaderHeight ) ) {
            jQuery( '.scroll-to-top' ).fadeIn();
        } else if ( jQuery( this ).scrollTop() < ( windowHeight - topHeaderHeight ) ) {
            jQuery( '.scroll-to-top' ).fadeOut();
        }
    });

    jQuery( '.product-img' ).hover( function() {
        jQuery( this ).find( '.product-testimonial' ).fadeIn();
    }, function() {
        jQuery( this ).find( '.product-testimonial' ).fadeOut();
    } );

    jQuery( '.promo-btn' ).on( 'click', function() {
        var btnID = this.id.split( '-' );

        if( baseURL ) {
            // alert( baseURL );
            // window.location.replace( baseURL + '/promotion?term_id=' + btnID[1] );
            window.open( baseURL + '/promotion?term_id=' + btnID[1], "_blank" );
        }
    } );
        
    jQuery( '.slider' ).slick( {
        centerMode: true,
        centerPadding: '15px',
        // initialSlide: 3,
        // infinite: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        arrows: true,
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-arrow-right"></i></button>',
        speed: 500,
        swipe: true,
        swipeToSlide: true,
        touchMove: true,
        dots: false,
        responsive: [
          {
            breakpoint: 481,
            settings: {
              centerPadding: '10px',
              fade: true,
              cssEase: 'linear',
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 415,
            settings: {
              centerPadding: '30px',
              fade: true,
              cssEase: 'linear',
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 376,
            settings: {
              centerPadding: '30px',
              fade: true,
              cssEase: 'linear',
              slidesToShow: 1,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 321,
            settings: {
              centerPadding: '30px',
              fade: true,
              cssEase: 'linear',
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
        ]
    } );

    jQuery( '#dvsha_2020_form' ).on( 'submit', function( e ) {

        //prevent Default functionality
        e.preventDefault();

        //get the action-url of the form
        var error = '';

        // console.log( jQuery( 'input[name="fullname"]' ).val().length == 0 );

        if( document.getElementById( "fullname-label" ) !== null && jQuery( 'input[name="fullname"]' ).val().length == 0 ) {
            error = error + '<li>Full Name is required.</li>';
        } 
        
        if( document.getElementById( "email-label" ) !== null) { 
            if( jQuery( 'input[name="email"]' ).val().length == 0 ) {
                error = error + '<li>Email is required.</li>';
            } else {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

                if( emailReg.test( jQuery( 'input[name="email"]' ).val() ) == false ) {
                    error = error + '<li>Email is invalid.</li>';
                } else {
                    var emailData = {
                        action: 'check_dvsha_email',
                        email: jQuery( 'input[name="email"]' ).val(),
                        term_id: jQuery( 'input[name="term_id"]' ).val()
                    };

                    jQuery.post( ajaxurl, emailData, function( response1 ) {
                        if( response1 == 'true' ) {
                            error = error + '<li>Email existed in our record.</li>';
                        }
                    });
                }
            }
        }

        if( document.getElementById( "contact-label" ) !== null ) {
            if( jQuery( 'input[name="contact"]' ).val().length == 0 ) {
                error = error + '<li>Contact Number is required.</li>';
            } else if( !jQuery( 'input[name="contact"]' ).val().match(/^\d+$/) ) {
                error = error + '<li>Contact Number must be in number format.</li>';
            } else {
                var contactData = {
                    action: 'check_dvsha_contact',
                    contact: jQuery( 'input[name="contact"]' ).val(),
                    term_id: jQuery( 'input[name="term_id"]' ).val()
                };

                jQuery.post( ajaxurl, contactData, function( response2 ) {
                    if( response2 == 'true' ) {
                        error = error + '<li> Contact Number existed in our record. </li>';
                    }
                });
            }
        } 
        
        if( document.getElementById( "outlet-label" ) !== null && jQuery( 'input[name="outlets[]"]:checked' ).length == 0 ) {
            error = error + '<li>Outlets is required.</li>';
        } 
        
        if( document.getElementById( "preferred-call-label" ) !== null && jQuery( 'input[name="preferredContact[]"]:checked' ).length == 0 ) {
            console.log( 'here' );
            error = error + '<li>Preferred Method of Contact is required.</li>';
        } 

        console.log( e );

        if( error.length !== 0 ) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '<ul class="error"> ' + error + ' </ul>',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#f04084',
                // footer: '<a href>Why do I have this issue?</a>'
            });
            console.log( false );
            return false;
        } else {
            // submit = true;
            // get_home_url().'/best-spa-hair-facials-treatments-2020/thankyou'
            console.log( true );
            // return true;
            jQuery( '#dvsha_2020_form' )[0].submit();
        }
    });
} );