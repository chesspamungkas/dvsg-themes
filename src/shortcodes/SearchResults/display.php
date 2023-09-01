<?php if ($posts) : ?>
  <div class="list-post-wrapper p-5 mt-2 mb-2">
    <div class="container" id="list-post-content">
      <?php if ($args['title']) : ?>
        <div class="row">
          <div class="col">
            <?php
            if ($args['title'] == "1") :
              $title = 'SEARCH RESULTS FOUND FOR: "' . strtoupper($keyword) . '"';
              echo do_shortcode("[section-header header='' subheader='" . $title . "']");
            endif;
            ?>
          </div>
        </div>
      <?php endif; ?>
      <div class="row">
        <?php
        echo $this->render('SearchResults/_item', ['posts' => $posts]);
        ?>
      </div>
      <div class="row">
        <div class="col">
          <?php
          echo $this->pagination($keyword, $args['paged'], $totalPages);
          ?>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>