<?php
add_action('customize_register', 'wp2023_customize_register');
function wp2023_customize_register($wp_customize)
{

    $wp_customize->add_section('contact_section', array( //Thêm một phần mới vào Customizer.
        'title' => __('tùy chỉnh phone'),
        'priority' => 30 // thứ tự hiển thị của section. Số càng nhỏ thì hiển thị càng cao. 
    ));



    wp2023_custom_add_input($wp_customize, 'contact_phone', 'contact_section', 'Contact phone', 'textarea');
    wp2023_custom_add_input($wp_customize, 'contact_email', 'contact_section', 'Contact email');
}


function wp2023_custom_add_input($wp_customize, $setting_id, $section_id, $label, $type = 'text')
{
    $wp_customize->add_setting($setting_id, array( //dùng để lưu trữ thông tin
        'default' => '', // gt mặc định
    ));

    $wp_customize->add_control($setting_id, [
        'section' => $section_id,
        'settings' => $setting_id,
        'label' => __($label, 'wp2023-theme'), //wp2023-theme: để sau nay làm biên dịch ngôn ngữ
        'type' => $type,
    ]);

    return $wp_customize;
}
