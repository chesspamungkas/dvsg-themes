<?php

namespace DV\widgets;

class FooterOneWidget extends \WP_Widget
{
  function __construct()
  {
    parent::__construct(
      // widget ID
      "ttesting_widget",
      // widget name
      "Footer One Widget",
      // widget description
      array('description' => "Content for footer one",)
    );
  }
  public function widget($args, $instance)
  {
    $title = apply_filters('widget_title', $instance['title']);
    echo $args['before_widget'];
    //if title is present
    if (!empty($title))
      echo $args['before_title'] . $title . $args['after_title'];
    //output
    echo "Adding Footer Widget";
    echo $args['after_widget'];
  }
  public function form($instance)
  {
    if (isset($instance['title']))
      $title = $instance['title'];
    else
      $title = __('Default Title', 'hstngr_widget_domain');
?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('content'); ?>"><?php _e('Content:'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
    </p>
<?php
  }
  public function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    $instance['content'] = (!empty($new_instance['content'])) ? strip_tags($new_instance['content']) : '';
    return $instance;
  }
}
