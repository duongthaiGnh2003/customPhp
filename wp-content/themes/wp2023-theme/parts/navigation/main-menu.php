<nav class="header__menu">

    <?php
    wp_nav_menu([ //để hiển thị menu điều hướng mà bạn đã đăng ký trong register_nav_menus()
        'theme_location' => 'primary',
        'menu_class' => 'menu-wrapper',
        'container_class' => 'header__menu',
        'container' => false,
        'items_wrap' => '  <ul class="%2$s" id="primary-menu-ul">%3$s</ul> ',
        //%2$s: Đại diện cho giá trị của 'menu_class'
        //%3$s: Đại diện cho các mục menu <li>...
        'fallback_cb' => false
    ]);

    ?>

</nav>