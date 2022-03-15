<?php 
  use DV\shortcodes\ScrollableList\ScrollableList;  
?>
<div class="col cat-products dvba_list_card_container <?php echo $id;  ?> p-0">
  <div class="card p-2 px-md-4 dvba_list_card_item" id="<?php echo $post->ID; ?>" aria-hidden="false">
    <a href="<?php the_permalink(); ?>" target="_blank">
      <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'full') ?>" class="card-img-top" alt="<?php echo get_the_post_thumbnail_caption($post->ID) ?>">
    </a>
    <div class="card-body px-0">
      <?php do_action(ScrollableList::$SCROLLABLE_LIST_BEFORE_ITEM_TITLE) ?>
      <h5 class="card-title"><a href="<?php the_permalink(); ?>" class="poppins-medium" target="_blank" tabindex="0"><?php the_title(); ?></a></h5>
      <?php do_action(ScrollableList::$SCROLLABLE_LIST_AFTER_ITEM_TITLE) ?>
      <?php do_action(ScrollableList::$SCROLLABLE_LIST_BEFORE_ITEM_LINK) ?>
      <div class="more-detail-container">
        <a href="<?php the_permalink(); ?>" class="poppins-medium more-details-btn" target="_blank" tabindex="0"><?php echo apply_filters(ScrollableList::$SCROLLABLE_ITEM_VIEW_MORE_BTN_TEXT, 'More Details') ?></a>
      </div>
      <?php do_action(ScrollableList::$SCROLLABLE_LIST_AFTER_ITEM_LINK) ?>
    </div>
  </div>
</div>