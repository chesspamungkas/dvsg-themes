<?php if ($posts) : ?>
  <div class="list-post-wrapper p-5 mt-2 mb-2">
    <div class="container" id="list-post-content">
      <?php if ($args['title']) : ?>
        <div class="row">
          <div class="col">
            <?php if ($args['title'] == "1") : ?>
              <?= do_shortcode("[section-header header='" . $args['header'] . "' subheader='" . $args['header'] . "']"); ?>
            <?php endif; ?>
          </div>
        </div>
      <?php endif; ?>
      <div class="row">
        <?php
        if ($posts->have_posts()) :
          while ($posts->have_posts()) :
            $posts->the_post();
            echo $this->render('ListPosts/_item', ['post' => $posts->post]);
          endwhile;
        endif;
        ?>
      </div>
      <div class="row">
        <div class="col">
          <?php
          if (isset($args['author'])) {
            echo $this->pagination($args['author'], $args['paged'], $totalPages);
          } else {
            echo $this->pagination('', $args['paged'], $totalPages);
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php wp_reset_postdata(); ?>
<?php endif; ?>