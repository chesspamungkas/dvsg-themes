<?php

namespace DV\shortcodes\TaxonomyFilterList;

use DV\base\ShortCode;
use DV\core\BaseStyle;

class TaxonomyFilterList extends ShortCode
{

  public $attributes = [];

  public static $TAXONOMY_FILTER_LIST_BEFORE_ITEM_TITLE = "TAXONOMY_FILTER_LIST_BEFORE_ITEM_TITLE";
  public static $TAXONOMY_FILTER_LIST_AFTER_ITEM_TITLE = "TAXONOMY_FILTER_LIST_AFTER_ITEM_TITLE";

  public static $TAXONOMY_FILTER_LIST_BEFORE_ITEM_LINK = "TAXONOMY_FILTER_LIST_BEFORE_ITEM_LINK";
  public static $TAXONOMY_FILTER_LIST_AFTER_ITEM_LINK = "TAXONOMY_FILTER_LIST_AFTER_ITEM_LINK";


  public static $TAXONOMY_FILTER_LIST_QUERY_FILTER = "TAXONOMY_FILTER_LIST_QUERY_FILTER";
  public static $TAXONOMY_FILTER_LIST_GROUP_TERMS_FILTER = "TAXONOMY_FILTER_LIST_GROUP_TERMS_FILTER";
  public static $TAXONOMY_FILTER_LIST_TERMS_FILTER = "TAXONOMY_FILTER_LIST_TERMS_FILTER";
  public static $TAXONOMY_FILTER_LIST_VIEW_DETAIL_BTN_TEXT = "TAXONOMY_FILTER_LIST_VIEW_MORE_BTN_TEXT";
  public static $TAXONOMY_FILTER_LIST_SECTION_TITLE_FILTER = 'TAXONOMY_FILTER_LIST_SECTION_TITLE_FILTER';

  public static $TAXONOMY_FILTER_LIST_SECTION_ITEMS_ATTRS = 'TAXONOMY_FILTER_LIST_SECTION_ITEMS_ATTRS';

  public static function init($args)
  {
    $model = new TaxonomyFilterList();

    $model->attributes = shortcode_atts(array(
      'filter' => null,
      'order' => 'ASC',
      'order_by' => 'term_id',
      'hide_empty' => "0",
      'identifier' => 'TAXONOMY_FILTER_LIST',
      'group_by' => 'taxonomy'
    ), $args);
    return $model->generate();
  }

  public function makeQuery($section)
  {
    $query = [
      'orderby'    => $this->attributes['orderby'],
      'order'      => $this->attributes['order'],
      'hide_empty'  => boolval($this->attributes['hide_empty'])
    ];

    if ($this->attributes['filter']) {
      $query['name__like'] = $this->attributes['filter'];
    }

    $query = apply_filters(self::$TAXONOMY_FILTER_LIST_QUERY_FILTER, $query, $this->attributes, $section);
    return new \WP_Term_Query($query);
  }

  private function groupTerms($terms)
  {
    $returnGroup = [];
    foreach ($terms as $term) {
      $groupBy = $this->attributes['group_by'];
      if (!isset($returnGroup[$term->$groupBy])) {
        $returnGroup[$term->$groupBy] = [];
      }
      $returnGroup[$term->$groupBy][] = $term;
    }
    return $returnGroup;
  }

  public function generate()
  {
    $query = $this->makeQuery('main');
    $filteredTerms = apply_filters(self::$TAXONOMY_FILTER_LIST_TERMS_FILTER, $query->get_terms(), $this->attributes, 'main');
    $mainSectionTerms = $this->groupTerms($filteredTerms);
    $mainSectionTermOrder = apply_filters(self::$TAXONOMY_FILTER_LIST_GROUP_TERMS_FILTER, array_keys($mainSectionTerms), $this->attributes, 'main');

    $query = $this->makeQuery('sub');
    $filteredTerms = apply_filters(self::$TAXONOMY_FILTER_LIST_TERMS_FILTER, $query->get_terms(), $this->attributes, 'sub');
    $subSectionTerms = $this->groupTerms($filteredTerms);
    $subSectionTermOrder = apply_filters(self::$TAXONOMY_FILTER_LIST_GROUP_TERMS_FILTER, array_keys($subSectionTerms), $this->attributes, 'sub');

    return $this->render('TaxonomyFilterList/display', [
      'mainSectionTerms' => $mainSectionTerms,
      'subSectionTerms' => $subSectionTerms,
      'subSectionTermOrder' => $subSectionTermOrder,
      'mainSectionTermOrder' => $mainSectionTermOrder
    ]);
  }
}
