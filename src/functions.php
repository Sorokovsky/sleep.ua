<?php 
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-logo' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'style', get_template_directory_uri().'/css/style.min.css' );
    wp_enqueue_script( 'script', get_template_directory_uri().'/js/script.min.js', array(), false, true);
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function get_menu(string $name = "menu"): array {
    $args = array(
    'order'                  => 'ASC',
    'orderby'                => 'menu_order',
    'post_type'              => 'nav_menu_item',
    'post_status'            => 'publish',
    'output'                 => ARRAY_A,
    'output_key'             => 'menu_order',
    'nopaging'               => true,
    'update_post_term_cache' => false );
    $items = wp_get_nav_menu_items( $name, $args ); 
    return $items;
}
function get_custom_logo_url()
{
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    return $image[0];
}
function get_posts_by_category_ID(int $id): array {
    $args = array(
        'posts_per_page'   => -1,
        'category'         => $id,
        'offset' => 0,
        'orderby'          => 'name',
        'order'            => 'ASC',
        "post_type" => 'post'
    );
    
    $posts = get_posts($args);
    return $posts;
}
function get_theme_file(string $path): string {
    return get_template_directory_uri().$path;
}
function get_popular_block() {
    $popular_category = get_category_by_slug("popular");
    $populars = get_posts_by_category_ID($popular_category->term_id);
    ?>
    <section class="hero">
        <div class="container hero__container">
        <h1 class="title hero__title"><?php echo $popular_category->name; ?></h1>
        </div>
        <div class="swiper container hero-slider">
            <div class="swiper-wrapper">
                <?php  
                ?>
                <?php foreach ($populars as $popular) {
                    setup_postdata($popular);
                    $url = wp_get_attachment_url( get_post_thumbnail_id($popular->ID), 'thumbnail' );
                ?>
                    <div class="swiper-slide hero-slide" style="background-image: url('<?php echo $url; ?>')">
                    <div class="hero__description">
                    <h2 class="hero__name"><?php echo $popular->post_title; ?></h2>
                    <?php echo the_content(); ?>
                    <a href="<?php echo the_permalink(); ?>" class="button hero__button">Перейти</a>
                    </div>
                </div>
                <?php
                    wp_reset_postdata(); 
                }
                ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </section>
    <?php
}
function get_tels() {
    $tels_cat = get_category_by_slug("tels");
    $tels = get_posts_by_category_ID($tels_cat->term_id);
    ?>
    <div class="tels">
        <?php foreach ($tels as $tel) :
            setup_postdata( $tel ); 
            ?>
            <a href="<?php echo $tel->post_title; ?>" class="tels__item">
                <img src="<?php echo get_theme_file("/img/tel.png") ?>" alt="">
                <?php echo $tel->post_title; ?>
            </a>
        <?php
        wp_reset_postdata(); 
        endforeach; ?>
    </div>
<?php }
function get_sociables() {
    $sociables_cat = get_category_by_slug( 'social' );
    $sociables = get_posts_by_category_ID($sociables_cat->term_id);
    ?>
    <div class="sociables">
        <?php foreach ($sociables as $sociable) :
            setup_postdata( $sociable );
            $url = wp_get_attachment_url( get_post_thumbnail_id($sociable->ID), 'thumbnail' ); 
            ?>
            <a href="<?php echo $sociable->post_title; ?>" class="sociables__item">
                <img src="<?php echo $url; ?>" alt="sleep.ua">
            </a>
        <?php 
        wp_reset_postdata();
        endforeach; 
        ?>
    </div>
    <?php
}
function get_benefits_block() {
    $benefit_category = get_category_by_slug("benefits");
    $benefits = get_posts_by_category_ID($benefit_category->term_id);
    ?>
    <section class="benefits">
        <div class="benefits__container container">
            <h2 class="title benefits__title"><?php echo $benefit_category->name; ?></h2>
            <div class="benefits__plate">
            <?php foreach ($benefits as $benefit) :
                setup_postdata($benefit); 
                $url = wp_get_attachment_url( get_post_thumbnail_id($benefit->ID), 'thumbnail' );
                ?>
                <article>
                    <figure>
                        <img src="<?php echo $url; ?>" alt="<?php echo $benefit->post_title; ?>">
                        <figcaption><?php echo $benefit->post_title; ?></figcaption>
                    </figure>
                    <?php echo the_content(); ?>
                </article>
                <?php
                wp_reset_postdata(); 
                endforeach; 
            ?>
            </div>
        </div>
    </section>
<?php }