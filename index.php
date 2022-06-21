<?php
/**
 * The main template file
 *
 */
    get_header();
?>
<main>
    <h1 class=""><?php echo the_title(); ?></h1>
    <?php 
    while ( have_posts() ) : the_post(); ?>
        <div class="container">
            <?php the_content(); ?>
        </div>
    <?php
    endwhile;
    wp_reset_query();
    ?> 
</main>
<?php
get_footer();