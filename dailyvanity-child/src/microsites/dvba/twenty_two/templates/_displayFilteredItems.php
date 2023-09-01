<?php 
  use DVChild\microsites\dvba\twenty_two\DVBA_2022;
?>
<div class="row g-0 mx-0 my-2">
  <div class="col">
    <ul class="filter-criteria ps-0">
      <?php foreach(DVBA_2022::getFactory()->getFilterTerms() as $term): ?>
        <li>
          <span class="criteria poppins-medium px-3 py-1 mx-1"><?php echo $term->name ?> &nbsp;
            <span class="uncheck-filter-btn" id="<?php echo $term->slug ?>">
              <i class="fas fa-times"></i>
            </span>
          </span>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</div>