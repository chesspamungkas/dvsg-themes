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
            <div class="col-5 pt-3 pb-2 px-md-5 py-md-4 slide-button-container">
              <button type="button" id="<?php echo $id;  ?>-prev" class="alt-slick-prev slick-disabled"><i class="fas fa-chevron-left"></i></button>
              <button type="button" id="<?php echo $id;  ?>-next" class="alt-slick-next"><i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
          <div class="row g-0 m-0 dvba_list_card_container " id="<?php echo $id;  ?>-slider-container">          
            <?php if($query->have_posts()): ?>
              <?php while($query->have_posts()): $query->the_post(); ?>
                <?php echo $this->render('ScrollableList/_item', ['post'=>$post]); ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script>
  jQuery(document).ready(function($) {
    var containerID = "<?php echo $id ?>-slider-container";
    var prevBtn = "<?php echo $id;  ?>-prev";
    var nextBtn = "<?php echo $id;  ?>-next"
    var prodArgs = {
      dots: false,
      infinite: false,
      speed: 300,
      lazyLoad: 'ondemand',
      slidesToShow: <?php echo $item_show ?>,
      slidesToScroll: <?php echo $item_show ?>,
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
      prevArrow: $('#'+prevBtn),
      nextArrow: $('#'+nextBtn)
      // appendArrows: '.slide-button-container'
    };    
    $('#'+containerID).slick( prodArgs );
  });
  
</script>