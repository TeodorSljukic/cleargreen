<?php
/*
Template Name: Custom Blog Page
*/
get_header();
?>

<section class="blog-section">
    <div class="container">
        <div class="blog-hero-section">
            <div class="blog-hero-text">
                <span class="blog-subtitle"><?php echo esc_html(bcms_get('bcms_blog_subtitle', 'Blog & News')); ?></span>
                <h1 class="blog-title"><?php echo esc_html(bcms_get('bcms_blog_title', 'Articles on growth & marketing')); ?></h1>
                <p><?php echo esc_html(bcms_get('bcms_blog_desc', 'Lorem ipsum consectetur amet dolor sit comeneer ilremislom dolce isilum acalim leonisom duoycuon. Lorem ipsum consectetur amet dolor sit comeneer.')); ?></p>
            </div>
        </div>

        <div class="blog-featured">
            <?php
            $featured_args = [
                'posts_per_page' => 1,
                'post_status'    => 'publish'
            ];
            $featured_query = new WP_Query($featured_args);
            if ($featured_query->have_posts()):
                while ($featured_query->have_posts()): $featured_query->the_post();
                    ?>
                    <div class="featured-post">
                        <div class="featured-image">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('large'); ?>
                            </a>
                        </div>
                        <div class="featured-content">
                            <div class="categories">
                                <?php
                                $cats = get_the_category();
                                foreach ($cats as $cat) {
                                    echo '<span class="cat-badge cat-' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</span> ';
                                }
                                ?>
                            </div>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo get_the_excerpt(); ?></p>
                        </div>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

        <div class="blog-grid">
            <?php
            $secondary_args = [
                'posts_per_page' => 2,
                'offset'         => 1,
                'post_status'    => 'publish'
            ];
            $secondary_query = new WP_Query($secondary_args);
            if ($secondary_query->have_posts()):
                while ($secondary_query->have_posts()): $secondary_query->the_post();
                    ?>
                    <div class="blog-card">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                        <div class="categories">
                            <?php
                            $cats = get_the_category();
                            foreach ($cats as $cat) {
                                echo '<span class="cat-badge cat-' . esc_attr($cat->slug) . '">' . esc_html($cat->name) . '</span> ';
                            }
                            ?>
                        </div>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo get_the_excerpt(); ?></p>
                    </div>
                <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
</section>

<!-- Ovdje ispod možeš dodati sledeću sekciju po potrebi -->

<?php get_footer(); ?>
