<?php

use DV\shortcodes\DVBAWhereToBuy\DVBAWhereToBuy;
?>
<div>
  <h2 class="eb-garamond-regular where-to-buy-title"><?php echo apply_filters(DVBAWhereToBuy::$DVBA_WHERE_TO_BUY_TITLE, 'Where To Buy') ?></h2>
  <?php if ($external_links) : ?>
    <?php foreach ($external_links as $external_link) : ?>
      <a href="<?php echo $external_link['url'] ?>" class="<?php echo apply_filters(DVBAWhereToBuy::$DVBA_WHERE_TO_BUY_BUTTON_CLASS, 'poppins-bold retail-btn px-md-4 py-md-2 me-md-2 box-shadow') ?> " target="_blank"><?php echo $external_link['label'] ?></a>
    <?php endforeach; ?>
  <?php endif; ?>
</div>