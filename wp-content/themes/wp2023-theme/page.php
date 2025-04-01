<?php
$page_title = '';

if (is_page()) {
    $page_title = get_the_title();
}



?>


<?php
get_header() ?>

<h2>trang : <?= $page_title ?></h2>
<?php while (have_posts()): the_post(); ?>
    <section class="page spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

<?php endwhile ?>

<?php get_footer() ?>