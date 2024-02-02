<?php 
// Template name: Index
$popular_category = get_category_by_slug("popular");
?>
<? get_header(); ?>
    <section class="hero">
        <div class="container hero__container">
        <h1 class="title hero__title"><?php echo $popular_category->name; ?></h1>
        </div>
        <div class="swiper container hero-slider">
            <div class="swiper-wrapper">
                <?php  
                $args = array(
                    'posts_per_page'   => -1,
                    'category'         => $popular_category->ID,
                    'orderby'          => 'name',
                    'order'            => 'ASC',
                );
                
                $posts = get_posts($args)
                ?>
                <?php foreach ($posts as $post) : 
                    setup_postdata($post);
                ?>
                    <div class="swiper-slide hero-slide" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>')">
                    <div class="hero__description">
                    <h2 class="hero__name"><?php echo the_title(); ?></h2>
                    <?php echo the_content(); ?>
                    <a href="<?php echo the_permalink(); ?>" class="button hero__button">Перейти</a>
                    </div>
                </div>
                <?php
                    wp_reset_postdata(); 
                endforeach; 
                ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>
<?php get_footer(); ?>