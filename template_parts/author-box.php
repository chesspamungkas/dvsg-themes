<?php

/**
 * Author Box for single post
 *
 * @package SimpleMag
 * @since 	SimpleMag 1.0
 **/
global $post;

$roles = get_the_author_meta('roles');

?>

<div class="single-box author-box single-author-box mt-5 mb-5 p-2">
  <div class="container">
    <div class="row">
      <div class="col-4">
        <div class="authorIntro">
          About the Author
        </div>
        <div class="avatar">
          <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>">
            <img src="<?php echo get_field("image", 'user_' . $post->post_author); ?>" class="clip-circle" />
          </a>
        </div><!-- .avatar -->
      </div>
      <div class="author-info col-8" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person">
        <div class="vcard author mb-3">
          <span class="fn">
            <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="authorLink" itemprop="url">
              <span itemprop="name"><?php the_author_meta('display_name'); ?></span>
            </a>
          </span>
        </div>
        <p itemprop="description" id="author_description">
          <?php $description = the_author_meta('description');
          if (strlen($description) > 30)
            echo substr($description, 30) . '...';
          else
            echo $description;
          ?>
        </p>
      </div><!-- .info -->
    </div>

  </div>

  <div id="author-bio" class="clearfix grid-8 column-2">
    
    
  </div><!-- #author-bio -->

</div><!-- .tabs -->
<script>
  jQuery(document).ready(function($) {
    $("#author_description").dotdotdot({
      //	configuration goes here
    });
    $("#author_description").trigger("isTruncated", function(isTruncated) {
      if (isTruncated) {
        //	do something
        $('.author-link').show();
      }
    });
  })
</script>