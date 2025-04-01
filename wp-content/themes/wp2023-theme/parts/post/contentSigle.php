<div>
    <div>
        <?= get_the_post_thumbnail(get_the_ID(), 'large') ?>
    </div>
    <div>
        <h3>noi dung:</h3>
        <?= get_the_content() ?>
    </div>


    <div>
        <h2>tac gia:</h2>
        <div>
            <img src="<?= get_avatar_url(get_the_author_meta("ID")) ?>" alt="">
            <h3><?= get_the_author_meta("display_name") ?></h3>
        </div>
    </div>
    <div>
        <h3>danh muc</h3>
        <?php
        $post_categories = wp_get_post_categories(get_the_ID());

        foreach ($post_categories as $cat_id) {
            $category = get_category($cat_id);

            echo "<a class='category_detail' href=" . get_term_link($category) . ">$category->name</a>";
        }
        ?>
    </div>


    <div>
        <h3>tags: </h3>
        <?php
        $post_tags = wp_get_post_tags(get_the_ID());

        foreach ($post_tags as $post_tag) {


            echo "<a class='category_detail tag_tag' href=" . get_term_link($post_tag) . ">$post_tag->name</a>";
        }
        ?>
    </div>
</div>