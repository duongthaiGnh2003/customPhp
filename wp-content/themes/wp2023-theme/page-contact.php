<?php
/*
Template Name: Trang liên hệ - layout

*/


?>

<?php
$contact_phone = get_theme_mod('contact_phone');
$contact_email = get_theme_mod('contact_email');
echo $contact_email, $contact_phone ?>

<?php global $theme_uri; ?>
<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>
    <h2>code cua trang lien he</h2>
    <section>
        <p>phone: <?= $contact_phone ?> </p>
        <p>email: <?= $contact_email ?> </p>
        <p>phone: <?= $contact_phone ?> </p>
    </section>


<?php endwhile; ?>

<?php get_footer(); ?>