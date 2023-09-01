<?php

use DV\shortcodes\TaxonomyFilterList\TaxonomyFilterList;

?>
<li class="skin-type-header">
  <h6 class="dropdown-header"><?php echo apply_filters(TaxonomyFilterList::$TAXONOMY_FILTER_LIST_SECTION_TITLE_FILTER, $title); ?></h6>
</li>
<li class="skin-type-container">
  <div class="filter-wrapper">
    <?php foreach ($items as $item) : ?>
      <?php echo $this->render('TaxonomyFilterList/_items', ['model' => $item->to_array()]) ?>
    <?php endforeach; ?>
  </div>
</li>