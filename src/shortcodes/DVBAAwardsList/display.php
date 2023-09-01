<?php

use DV\shortcodes\DVBAAwardsList\DVBAAwardsList;
?>
<ul class="<?php echo apply_filters(DVBAAwardsList::$DVBA_AWARDS_CONTAINER_CLASS, 'awards-list p-0 mt-1', $post_id); ?>">
  <?php foreach ($terms as $term) : ?>
    <li class="poppins-semibold px-3 py-1"><?php echo $term->name; ?></li>
  <?php endforeach; ?>
</ul>