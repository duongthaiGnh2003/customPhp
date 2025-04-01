<?php
$page_title = '';
// if (is_category()) {
$page_title = single_cat_title('', false);
// } 
?>

<?php if (is_category()): ?>
    <h2>Category page : <?= $page_title ?></h2>
<?php endif ?>
<?php if (is_tag()): ?>
    <h2>tag page : <?= $page_title ?></h2>
<?php endif ?>
<?php while (have_posts()): the_post(); ?>
    <div class="col-lg-6 col-md-6 col-sm-6  " style="border-bottom: 1px solid; margin-top:10px">
        <?php get_template_part('parts/post/content', null); ?>
    </div>
<?php endwhile; ?>