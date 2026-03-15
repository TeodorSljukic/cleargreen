<?php get_header(); ?>

<section class="single-post-section">
    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="single-featured-image">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>
                <h1 class="single-title"><?php the_title(); ?></h1>
                <div class="single-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
</section>

<?php get_footer(); ?>
