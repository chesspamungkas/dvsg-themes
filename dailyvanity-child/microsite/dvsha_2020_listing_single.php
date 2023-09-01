<?php
// Template Name: DVSHA 2020 Listing Single Template

$mode = 'subpage';

include_once(__DIR__.'/../shortcodes/google-dfp/google-dfp.php');
get_header();
$slug = get_queried_object()->post_name;

?>
<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvsha-listing-2020/css/custom.css?v=<?php echo current_time( 'timestamp' ); ?>">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
</script>

<div class="container-fluid no-padding">
    <div class="row no-margin">
        <div class="col-12 no-padding header-bg">
            <!-- Header above nav start -->
            <?php include( "dvsha-listing-2020/top-header.php" ); ?>
            <?php 
                if( strpos( $slug, 'thank-you' ) === false ) { 
                    $term_id = $_REQUEST[ 'term_id' ];
                    $post = get_post( $term_id );
            ?>
            <div class="container no-padding" style="margin-top: 20px;">
                <div class="row no-margin">
                    <div class="col-12 white-bg">
                        <?php
                            if( get_field( 'have_promotion', $term_id ) == 'yes' ) {
                                echo get_field( 'promotion_content', $term_id );
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php 
                } else { 
                    $response = save_details();

                    $post = get_post( $_POST[ 'term_id' ] );

                    $terms = get_the_terms( $_POST[ 'term_id' ], 'dvsha_2020_brands' );

                    // print_r( $terms[0]->name );
            ?>
            <div class="container no-padding" style="margin-top: 20px;">
                <div class="row no-margin">
                    <div class="col-12 white-bg" style="text-align:center;">

                    <?php if( !$response ) { ?>
                        <h4 style="font-family: 'Avenir-Next-Regular'; text-transform: none;">Sorry, we detected your Email or Contact Number has been subscribed to this promotion.</h4>
                    <?php } else { ?>
                        <h4 style="font-family: 'Avenir-Next-Regular'; text-transform: none;">Thank you for signing up for <span style="font-family: 'Avenir-Next-Medium';"><?php echo $post->post_title; ?></span> through Daily Vanity Spa & Hair Awards 2020! <span style="font-family: 'Avenir-Next-Medium';"><?php echo $terms[0]->name; ?></span> will be getting in touch with you to arrange an appointment soon.</h4>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<script src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/microsite/dvsha-listing-2020/js/custom.js?v=<?php echo current_time( 'timestamp' ); ?>"></script>

<?php
get_footer();
?>
