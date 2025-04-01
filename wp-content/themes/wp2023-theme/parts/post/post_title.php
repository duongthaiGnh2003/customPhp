<?php global $theme_uri; ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <h2><?php the_title(); ?></h2>
                    <ul>
                        <li>By <?php echo get_the_author_meta('display_name'); ?></li>
                        <li><?php echo get_the_date(); ?></li>
                        <li><?php echo get_comments_number(); ?> Comments</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>