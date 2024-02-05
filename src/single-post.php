<?php get_header(); ?>
<section class="post">
    <div class="container post__container">
        <div class="post__image">
            <?php $url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()), 'thumbnail' );  ?>
            <img src="<?php echo $url; ?>" alt="<?php echo get_the_title(); ?>">
        </div>
        <div class="post__content">
            <h1 class="title post__title"><?php echo get_the_title(); ?></h1>
            <div class="post__short">
            <?php echo get_the_excerpt( ); ?>
            </div>
            <div class="post__more">
            <?php echo get_the_content(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>