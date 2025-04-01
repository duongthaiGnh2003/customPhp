<?php
class WP2023_Tags extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'WP2023_tags', // Base ID
            'WP2023_Tags', // Name
            [
                'description' => __('Widget thôi', 'wp2023-theme')
            ] // Args
        );
    }

    public function widget($args, $instance)
    {
        // outputs the content of the widget
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $limit = isset($instance['limit']) ? $instance['limit'] : 5;
        echo $before_widget;
        if (! empty($title)) {
            echo $before_title . $title . $after_title;
        }
        ob_start();
        // Lấy tags
        $terms = get_terms([
            'taxonomy' => 'post_tag',
            'hide_empty' => false,
        ]);


?>

        <div class="blog__sidebar__item__tags">

            <?php foreach ($terms as $term): ?>
                <a href="<?= get_term_link($term); ?>"> <?= $term->name; ?></a>
            <?php endforeach; ?>
        </div>



    <?php
        echo ob_get_clean();
        echo $after_widget;
    }

    public function form($instance)
    {
        // outputs the options form in the admin
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('New title', 'text_domain');
        }

        $limit = isset($instance['limit']) ? $instance['limit'] : 5;
    ?>

        <p>
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo $this->get_field_name('limit'); ?>"><?php _e('Number of posts:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>"
                name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo esc_attr($limit); ?>" />
        </p>

<?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['limit'] = (! empty($new_instance['limit'])) ? intval($new_instance['limit']) : 5;
        return $instance;
    }
}
new WP2023_Tags;
