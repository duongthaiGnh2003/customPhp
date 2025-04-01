<!-- nếu ko chọn trang mẫu trong phần sửa trang thì nó sẽ tự chọn front-page.php cái trang này lm trang home
  -->
<?php
/*
Template Name: Trang home  

*/
?>

<?php global $theme_uri; ?>
<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
  <h2>code cua trang homee</h2>
  <?= do_shortcode('[shortcode_header_cart show_wishlist=0]'); ?> <!-- nếu không muốn hiện thì set thuộc tính bằng 0 -->

<?php endwhile; ?>

<?php get_footer(); ?>