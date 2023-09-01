// const clearIcon = document.querySelector(".clear-icon");
// const searchBar = document.querySelector(".search");

// searchBar.addEventListener("keyup", () => {
//   if(searchBar.value && clearIcon.style.visibility != "visible"){
//     clearIcon.style.visibility = "visible";
//   } else if(!searchBar.value) {
//     clearIcon.style.visibility = "hidden";
//   }
// });

// clearIcon.addEventListener("click", () => {
//   searchBar.value = "";
//   clearIcon.style.visibility = "hidden";
// });

// document.getElementById( 'topbar-toggle-btn' ).addEventListener( 'click', function() {
//     console.log( 'Screen height: ' + screen.height );
//     document.getElementById( 'navbarText' ).setAttribute( "style", "height:" + screen.height + "px" );
// } );

jQuery( document ).ready( function( $ ) {
    // homepage products section
    var item_length = $('.slider > div').length - 1;
    var prodArgs = {
        dots: false,
        infinite: false,
        speed: 300,
        lazyLoad: 'ondemand',
        slidesToShow: 4,
        slidesToScroll: 4,
        pauseOnFocus: true,
        pauseOnHover: true,
        responsive: [
          {
            breakpoint: 481,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 2,
              infinite: false,
              dots: false
            }
          },
        ],
        arrows: true,
        prevArrow: $( '.alt-slide-prev' ),
        nextArrow: $( '.alt-slide-next' )
        // appendArrows: '.slide-button-container'
    };

    $( '.skincare' ).slick( prodArgs );
    $( '.makeup' ).slick( prodArgs );
    $( '.body-care' ).slick( prodArgs );
    $( '.hair-care' ).slick( prodArgs );

    if( $('.skincare-container .alt-slick-prev').length ) {
        $('.skincare-container .alt-slick-prev').on('click', function(){
            $('.skincare').slick("slickPrev");
        });

        $('.skincare-container  .alt-slick-next').on('click', function(){
            $('.skincare').slick("slickNext");
        });
    }

    $('.skincare').on('afterChange', function( event, slick, currentSlide ){
        // console.log(Math.ceil(slick.slideCount / 2));
        if( currentSlide == 0 ) {
            $('.skincare-container .alt-slick-prev').addClass('slick-disabled');
        } else {
            $('.skincare-container .alt-slick-prev').removeClass('slick-disabled');
        }

        if( currentSlide == 8 ) {
            $('.skincare-container .alt-slick-next').addClass('slick-disabled');
        } else {
            $('.skincare-container .alt-slick-next').removeClass('slick-disabled');
        }
    });

    if( $('.makeup-container .alt-slick-prev').length ) {
        $('.makeup-container .alt-slick-prev').on('click', function(){
            $('.makeup').slick("slickPrev");
        });
        
        $('.makeup-container  .alt-slick-next').on('click', function(){
            $('.makeup').slick("slickNext");
        });
    }

    $('.makeup').on('afterChange', function( event, slick, currentSlide ){
        // console.log(currentSlide);
        if( currentSlide == 0 ) {
            $('.makeup-container .alt-slick-prev').addClass('slick-disabled');
        } else {
            $('.makeup-container .alt-slick-prev').removeClass('slick-disabled');
        }

        if( currentSlide == 8 ) {
            $('.makeup-container .alt-slick-next').addClass('slick-disabled');
        } else {
            $('.makeup-container .alt-slick-next').removeClass('slick-disabled');
        }
    });

    if( $('.body-care-container .alt-slick-prev').length ) {
        $('.body-care-container .alt-slick-prev').on('click', function(){
            $('.body-care').slick("slickPrev");
        });
        
        $('.body-care-container  .alt-slick-next').on('click', function(){
            $('.body-care').slick("slickNext");
        });
    }

    $('.body-care').on('afterChange', function( event, slick, currentSlide ){
        // console.log(currentSlide);
        if( currentSlide == 0 ) {
            $('.body-care-container .alt-slick-prev').addClass('slick-disabled');
        } else {
            $('.body-care-container .alt-slick-prev').removeClass('slick-disabled');
        }

        if( currentSlide == 8 ) {
            $('.body-care-container .alt-slick-next').addClass('slick-disabled');
        } else {
            $('.body-care-container .alt-slick-next').removeClass('slick-disabled');
        }
    });

    if( $('.hair-care-container .alt-slick-prev').length ) {
        $('.hair-care-container .alt-slick-prev').on('click', function(){
            $('.hair-care').slick("slickPrev");
        });
        
        $('.hair-care-container  .alt-slick-next').on('click', function(){
            $('.hair-care').slick("slickNext");
        });
    }

    $('.hair-care').on('afterChange', function( event, slick, currentSlide ){
        // console.log(currentSlide);
        if( currentSlide == 0 ) {
            $('.hair-care-container .alt-slick-prev').addClass('slick-disabled');
        } else {
            $('.hair-care-container .alt-slick-prev').removeClass('slick-disabled');
        }

        if( currentSlide == 8 ) {
            $('.hair-care-container .alt-slick-next').addClass('slick-disabled');
        } else {
            $('.hair-care-container .alt-slick-next').removeClass('slick-disabled');
        }
    });

    // topbar
    $( '#topbar-toggle-open-btn' ).on( 'click', function() {
        $( '#navbarText-bg' ).toggle();
        $( '#navbarText-bg' ).animate( { height: $( window ).height()+"px" } );
    } );
    
    $( '#topbar-toggle-close-btn' ).on( 'click', function() {
        $( '#navbarText-bg' ).toggle('1');
    } );

    // judges section
    var judgeArgs = {
        dots: true,
        appendDots: $( '.slider-dots' ),
        infinite: false,
        speed: 500,
        lazyLoad: 'ondemand',
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 5000,
        pauseOnFocus: true,
        pauseOnHover: true,
    };

    $( '#judges-slider' ).slick( judgeArgs );

    // category topbar
    var catArgs = {
        dots: false,
        infinite: false,
        speed: 300,
        lazyLoad: 'ondemand',
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 2000,
        pauseOnFocus: true,
        pauseOnHover: true,
        responsive: [
          {
            breakpoint: 481,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 3,
              infinite: false,
              dots: false,
              arrows: false,
              autoplay: true,
              autoplaySpeed: 2000,
              pauseOnFocus: true,
              pauseOnHover: true,
              prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
              nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
            }
          },
        ],
    };

    if( $( window ).width() <= 900 ) {
        $( '#category-topbar-slider' ).addClass( 'cat-slick-slider' );
        $( '.cat-slick-slider' ).slick( catArgs );
    }

    if( $( window ).width() > 900 ) {
        $( '.category-topbar-slider-note' ).css('display', 'none');
    }

    var ids = '';

    //load more ajax call
    $( 'body' ).on( 'click', '.more-products-btn', function( e ) {
        e.preventDefault();

        var totalPages = 0;
        var termID = 0;
        var postPerPage = 0;

        var id = this.id.split( '-' );
        termID = id[0];
        totalPages = id[1];
        postID = id[2];
        postPerPage = id[3];

        var prodList = $( '.product-list .card' );

        console.log( prodList );

        $.each( prodList, function() {
            if( ids.length ) {
                ids = ids + ',' + this.id;
            } else {
                ids = this.id
            }
        } );

        if( id[2] ) {
            ids = ids + ',' + id[2];
        }

        console.log( ids );

        // var currentUrl = window.location.href;
        var searchParams = new URLSearchParams(window.location.search);
        var keyword = '';

        console.log( window.location.href );

        // console.log( searchParams );

        if( searchParams.has( 'k' ) ) {
            keyword = searchParams.get( 'k' );
        }
        
        // jQuery( '.more-stories-btn' ).fadeOut( 'slow' );
        $( '.more-products-btn' ).html( '<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>Loading...' );
        console.log( 'more stories' );
        load_products( totalPages, termID, postPerPage, ids, keyword, postID );
    });

    var ppp = 4; // Post per page
    var pageNumber = 1;

    function load_products( totalPages, termID, postPerPage, ids, keyword, postID ){
        pageNumber++;
        
        var searchParams = new URLSearchParams(window.location.search);
        var st = '';
        var sc = '';
        var htc = '';
        var br = '';
        var aw = '';
        var pr = '';
        var orderby = '';

        if( searchParams.has('st') ) {
            st = searchParams.get('st');
        }

        if( searchParams.has('sc') ) {
            sc = searchParams.get('sc');
        }

        if( searchParams.has('htc') ) {
            htc = searchParams.get('htc');
        }
        
        if( searchParams.has('br') ) {
            br = searchParams.get('br');
        }
        
        if( searchParams.has('aw') ) {
            aw = searchParams.get('aw');
        }
        
        if( searchParams.has('pr') ) {
            pr = searchParams.get('pr');
        }
        
        if( searchParams.has('orderby') ) {
            orderby = searchParams.get('orderby');
        }
        

        var str = '&pageno=' + pageNumber + '&posts_per_page=' + postPerPage + '&term_id=' + termID + '&ids=' + ids + '&s=' + keyword + '&st=' + st + '&sc=' + sc + '&htc=' + htc + '&br=' + br + '&aw=' + aw + '&pr=' + pr + '&orderby=' + orderby + '&post_id=' + postID + '&action=ajaxLoadMoreProducts';

        var old_scroll = jQuery(window).scrollTop();

        jQuery.ajax({
            type: "POST",
            // dataType: "html",
            url: ajaxUrl,
            data: str,
            success: function(data){
                var $data = jQuery( data );

                if( $data.length ){
                    jQuery( '.product-list' ).append( $data );

                    if( pageNumber >= totalPages ) {
                        jQuery( '.more-products-btn' ).fadeOut( 'slow' );
                    } else {
                        jQuery( '.more-products-btn' ).html( 'LOAD MORE' );
                    }

                    jQuery( window ).scrollTop( old_scroll );
                } else{
                    jQuery( '.more-products-btn' ).fadeOut( 'slow' );
                }

                // if( keyword ) {
                //     var newurl = homeBase + '/best-beauty-products/search/?k=' + keyword + '&pageno=' + pageNumber;
                //     window.history.pushState( { path:newurl }, '', newurl ); 
                // }
            },
            error : function(jqXHR, textStatus, errorThrown) {
                // console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
    
        });

        return false;
    }

    // product gallery
    var galleryArgs = {
        dots: false,
        infinite: false,
        speed: 300,
        lazyLoad: 'ondemand',
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2000,
        pauseOnFocus: true,
        pauseOnHover: true,
        arrows: true,
        // appendArrows: $( '.product-gallery' ),
        prevArrow: $( '.gallery-prev-btn' ),
        nextArrow: $( '.gallery-next-btn' ),
        // prevArrow: '<button type="button" class="gallery-prev-btn slick-prev"><i class="fa fa-angle-left" aria-hidden="true"></i></button>',
        // nextArrow: '<button type="button" class="gallery-next-btn slick-next"><i class="fa fa-angle-right" aria-hidden="true"></i></button>',
        // adaptiveHeight: true,
        responsive: [
          {
            breakpoint: 481,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1,
                infinite: true,
                dots: false,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 2000,
                pauseOnFocus: true,
                pauseOnHover: true,
            //   appendArrows: $( '.product-gallery-nav' ),
                prevArrow: $( '.gallery-prev-btn' ),
                nextArrow: $( '.gallery-next-btn' ),
                // adaptiveHeight: true
            }
          },
        ],
    };

    $( '.product-gallery' ).slick( galleryArgs );

    var searchParams = new URLSearchParams(window.location.search);

    // console.log( searchParams );

    if( searchParams.has( 'hash' ) ) {
        // param = searchParams.get( 'hash' );
        $('html, body').animate({ scrollTop: $('[name="' + searchParams.get( 'hash' ) + '"]').offset().top}, 1000);
    }

    // console.log( param );
	// $('html, body').animate({ scrollTop: $('[name=\"" . $_GET['sto'] . "\"]').offset().top}, 1000);


    $( '#keyword' ).keypress( function( e ) {
        if( e.which == 13 ){//Enter key pressed
            $( '.search-icon' ).click(); //Trigger search button click event
            return false;
        }
    } );

    $( '.search-icon' ).on( 'click', function() {
        var keyword = $( '#keyword' ).val();

        // console.log( encodeURIComponent( keyword ) );
        if( !keyword.length ) {
            swal(
                {
                    title: "Sorry",
                    text: "You must enter a keyword to search!",
                    type: "warning",
                    showCancelButton: false,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Close",
                    // cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: true,
                    // closeOnCancel: false
                }
            );
        } else {
            var newUrl = homeBase + '/best-beauty-products-singapore/2021/search/?k=' + encodeURIComponent( keyword );
            window.location = newUrl;
        }

        return false;
    } );

    $( '.sort-by' ).on( 'click', function() {
        var id = this.id;
        var searchParams = new URLSearchParams(window.location.search);

        if( searchParams.has('orderby') ) {
            searchParams.delete( 'orderby' );
            history.pushState( null, null, "?"+searchParams.toString() );
        }

        var newUrl = window.location;
        
        if( window.location.search ) {

            newUrl += '&orderby=' + id;
            window.location = newUrl;
        } else {
            newUrl += '?orderby=' + id;
            window.location = newUrl;
        }
    } );

    $( '.apply-btn' ).on( 'click', function() {
        var prefix = 'dvba_2021_';

        var skinTypes = '';
        var skinConcerns = '';
        var hairConcerns = '';
        var brands = '';
        var awards = '';
        var prices = '';

        var filterArr = [ "skin_types", "skin_concerns", "hair_types_concerns", "brands", "award_tiers", "price_range" ];

        var searchParams = new URLSearchParams(window.location.search);

        var newUrl = window.location.href.split('?')[0] + '/?';

        $.each( filterArr, function( index, value ) {
            if( $( '.' + prefix + value + '-checkbox:checked' ).length ) {
                $( '.' + prefix + value + '-checkbox:checked' ).each( function() {
                    switch( value ) {
                        case 'skin_types':
                            if( skinTypes ) {
                                skinTypes = skinTypes + ',' + $( this ).val();
                            } else {
                                skinTypes = $( this ).val();
                            }
                            break;
                        case 'skin_concerns':
                            if( skinConcerns ) {
                                skinConcerns = skinConcerns + ',' + $( this ).val();
                            } else {
                                skinConcerns = $( this ).val();
                            }
                            break;
                        case 'hair_types_concerns':
                            if( hairConcerns ) {
                                hairConcerns = hairConcerns + ',' + $( this ).val();
                            } else {
                                hairConcerns = $( this ).val();
                            }
                            break;
                        case 'brands':
                            if( brands ) {
                                brands = brands + ',' + $( this ).val();
                            } else {
                                brands = $( this ).val();
                            }
                            break;
                        case 'award_tiers':
                            if( awards ) {
                                awards = awards + ',' + $( this ).val();
                            } else {
                                awards = $( this ).val();
                            }
                            break;
                        case 'price_range':
                            if( prices ) {
                                prices = prices + ',' + $( this ).val();
                            } else {
                                prices = $( this ).val();
                            }
                            break;
                    }
                } );
            }
        } );

        if( skinTypes ) {
            newUrl += 'st=' + encodeURIComponent( skinTypes ) + '&';
        }

        if( skinConcerns ) {
            newUrl += 'sc=' + encodeURIComponent( skinConcerns ) + '&';
        }

        if( hairConcerns ) {
            newUrl += 'htc=' + encodeURIComponent( hairConcerns ) + '&';
        }

        if( brands ) {
            newUrl += 'br=' + encodeURIComponent( brands ) + '&';
        }

        if( awards ) {
            newUrl += 'aw=' + encodeURIComponent( awards ) + '&';
        }

        if( prices ) {
            newUrl += 'pr=' + encodeURIComponent( prices ) + '&';
        }

        if( searchParams.has( 'orderby' ) ) {
            newUrl += 'orderby=' + searchParams.get( 'orderby' );
        }

        window.location = newUrl;
        // console.log( newUrl );
    } );

    $( '.reset-btn' ).on( 'click', function() {
        // console.log( 'reset' );
        $( '#filterForm input[type="checkbox"]:checked' ).each( function() {
            // console.log( $( this ).val() );
            $( this ).attr( 'checked', false );
        } );
    } );

    $( '.uncheck-filter-btn' ).on( 'click', function() {
        var slug = $( this ).attr( 'id' );
        
        $( '#filterForm input[type="checkbox"]:checked' ).each( function() {
            // console.log( $( this ).val() );
            if( $( this ).val() === slug ) {
                $( this ).attr( 'checked', false );
            }
        } );

        $( '.apply-btn' ).click(); 
    } );

    $( '.zoom-image' )
    // .wrap( '<span style="display: inline-block;"></span>' )
    .zoom({
        on: 'mouseover',
        touch: true,
        magnify: 10
    });
});