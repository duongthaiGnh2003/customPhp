<?php
if (is_search()) {
    $s = get_query_var('s'); // $_GET

    $page_sub_title = 'Kết quả tìm kiếm cho : ' . $s;
}

?>
<!-- Start Loop -->
<h1> Search page</h1>

<h3><?= $page_sub_title ?></h3>

<?php while (have_posts()): the_post(); ?>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <?php get_template_part('parts/post/content', null); ?>
    </div>
<?php endwhile; ?>
<!-- End loop -->