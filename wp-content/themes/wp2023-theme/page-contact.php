<?php
/*
Template Name: Trang liên hệ - layout

*/


?>

<?php
$contact_phone = get_theme_mod('contact_phone');
$contact_email = get_theme_mod('contact_email');
?>

<?php global $theme_uri; ?>
<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <?php the_content() ?>
    <h3>thêm form dùng short code của contact form</h3>
    <?= do_shortcode('[contact-form-7 id="2fe6124" title="Contact form 1"]') ?>
    <h2>code cua trang lien he</h2>
    <section>
        <p>phone: <?= $contact_phone ?> </p>
        <p>email: <?= $contact_email ?> </p>
        <p>phone: <?= $contact_phone ?> </p>
    </section>


<?php endwhile; ?>

<?php get_footer(); ?>