<div class="form-check">
  <input class="form-check-input <?php

                                  use DV\shortcodes\TaxonomyFilterList\TaxonomyFilterList;

                                  echo $model['term_id'] ?>-checkbox" type="checkbox" value="<?php echo $model['slug'] ?>" id="<?php echo $model['slug'] ?>" name="<?php echo $model['taxonomy'] ?>[]" <?php echo apply_filters(TaxonomyFilterList::$TAXONOMY_FILTER_LIST_SECTION_ITEMS_ATTRS, $model); ?> />
  <label class="form-check-label filter-label" for="<?php echo $model['slug'] ?>"><?php echo $model['name'] ?></label>
</div>