<?php
global $theme_dir;
include_once $theme_dir . '/inc/widgets/WP2023_Recent_News.php';
include_once $theme_dir . '/inc/widgets/WP2023_Tags.php';
add_action('widgets_init', 'wp2023_register_widgets');

function wp2023_register_widgets()
{
    // Đăng ký sidebar
    register_sidebar( //đăng ký một sidebar
        array(
            'id'            => 'primary',
            'name'          => __('Primary Sidebar',),
            'description'   => __('A short description of the sidebar.'),
            'before_widget' => '<div id="%1$s" class="blog__sidebar__item %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        )
    );
    // Đăng ký widget 

    register_widget('WP2023_Recent_News');
    register_widget('WP2023_Tags');
}
