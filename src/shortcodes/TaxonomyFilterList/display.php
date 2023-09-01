<form method="GET" action="<?php echo $formLink; ?>" id="filterForm">
  <div class="btn-group">
    <button type="button" class="sort-btn poppins-bold box-shadow py-2 px-5 ms-0 ms-md-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
      Filter
    </button>
    <div class="container dropdown-menu dropdown-menu-end">
      <div class="row g-0 m-0">
        <div class="col-6">
          <ul class="filter-dropdown">
            <?php foreach ($mainSectionTermOrder as $section) : ?>
              <?php echo $this->render('TaxonomyFilterList/_sections', ['title' => $section, 'items' => $mainSectionTerms[$section]]) ?>
            <?php endforeach; ?>
          </ul>
        </div>
        <div class="col-6">
          <ul class="filter-dropdown">
            <?php foreach ($subSectionTermOrder as $section) : ?>
              <?php echo $this->render('TaxonomyFilterList/_sections', ['title' => $section, 'items' => $subSectionTerms[$section]]) ?>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <div class="row g-0 m-0 justify-content-center">
        <div class="col text-center py-3">
          <button type="submit" class="apply-btn poppins-bold box-shadow py-1 px-4 me-1">Apply</button>
          <input type="reset" value="Reset" class="reset-btn poppins-bold box-shadow py-1 px-4 ms-1" />
        </div>
      </div>
    </div>
  </div>
</form>