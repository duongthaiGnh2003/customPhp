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
                <div class="row">

                    <h2>baif post: </h2>

                    <!-- / bài viết -->
                    <div class="row featured__filter">
                        <?php while (have_posts()) : the_post();   ?>
                            <div class="col-lg-3 col-md-4 col-6 mix leaf ">
                                <?php get_template_part("parts/post/content", null, ['post_id' => get_the_ID()]); ?>
                            </div>


                        <?php endwhile ?>
                        <div>
                            <?= get_the_posts_pagination() ?>
                        </div>
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





</body>

</html>