<?php
// trang chi tiết


?>

<?php
get_header()
?>

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <?php
                get_sidebar()
                ?>
            </div>
            <div class="col-lg-8">


                <!-- / bài viết -->

                <div class="row featured__filter">
                    <?php while (have_posts()) : the_post();   ?>

                        <?php get_template_part('parts/post/post_title') ?>
                        <?php get_template_part('parts/post/contentSigle') ?>
                        <?php get_template_part('parts/post/postRelated') ?>
                    <?php endwhile ?>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- Featured Section End -->

<?php
get_footer()
?>
<!-- Js Plugins -->
<?php
wp_footer()
?>




</body>

</html>