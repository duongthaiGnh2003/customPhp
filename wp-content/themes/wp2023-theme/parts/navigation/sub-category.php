      <div class="hero__categories">

          <div class="hero__categories__all">
              <i class="fa fa-bars"></i>
              <span>Danh mục sản phẩm</span>
          </div>

          <?php
            wp_nav_menu([
                'theme_location' => 'vertical',
                'menu_class' => 'ulClass',
                'items_wrap' => '  <ul class="%2$s" id="vertical-menu-ul">%3$s</ul> ',
                'fallback_cb' => false
            ]);

            ?>

      </div>

      <script>
          jQuery(document).ready(function() {
              // alert('Jquery')
              jQuery('.hero__categories__all').on('click', function() {
                  var displayValue = jQuery('.ulClass').css('display');
                  jQuery('.ulClass').css('display', displayValue === 'block' ? "none" : 'block');


              });
          });
      </script>