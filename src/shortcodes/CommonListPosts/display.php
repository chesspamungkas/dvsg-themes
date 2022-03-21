<?php global $post; ?>
<section id="<?php echo $id;  ?>">
  <div class="container-fluid <?php echo $id;  ?>-container pb-4">
    <div class="row g-0 m-0">
      <div class="col p-0">
        <div class="container px-0">
          <div class="row g-0 m-0 align-items-center">
            <div class="col-7 pt-3 pb-2 px-md-5 py-md-4 px-2">
              <h2><a href="<?php echo $titleLink; ?>" class="eb-garamond-regular home-cat-link" target="_blank"><?php echo $title;  ?></a></h2>
            </div>
          </div>
          <div class="row g-0 m-0 dvba_list_card_container " id="<?php echo $id;  ?>-items-container">          
            <?php if($query->have_posts()): ?>
              <?php while($query->have_posts()): $query->the_post(); ?>
                <?php echo $this->render('CommonListPosts/_item', ['post'=>$post]); ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>