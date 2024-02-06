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
function get_posts_by_category_ID(int $id, int $limit = -1): array {
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
                    <a href="<?php echo get_permalink( $popular); ?>" class="swiper-slide hero-slide" style="background-image: url('<?php echo $url; ?>')">
                </a>
                <?php
                    wp_reset_postdata(); 
                }
                ?>
            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>
        </div>
        <div class="container hero__container">
           <h2 class="title hero__title hero__subtitle">Пошиття за індивідуальним розміром прораховується індивідуально</h2>
            <h2 class="title hero__title hero__subtitle">Пошиття простирадла на резинці +100грн до ціни</h2>
        </div>
    </section>
    <?php
}
function get_one_tell() {
    $tels_cat = get_category_by_slug("tels");
    $tels = get_posts_by_category_ID($tels_cat->term_id, 1);
    foreach ($tels as $tel) {
        setup_postdata($tel);
        ?>
        <a href="tel:<?php echo $tel->post_title; ?>" class="call">
            <img src="<?php echo get_theme_file("/img/tel.svg"); ?>" alt="Позвонити">
        </a>
        <?php
        wp_reset_postdata();
    }
}
function get_tels() {
    $tels_cat = get_category_by_slug("tels");
    $tels = get_posts_by_category_ID($tels_cat->term_id);
    ?>
    <div class="tels">
        <?php foreach ($tels as $tel) :
            setup_postdata( $tel ); 
            ?>
            <a href="tel:<?php echo $tel->post_title; ?>" class="tels__item">
                <img src="<?php echo get_theme_file("/img/tel.svg") ?>" alt="">
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
            <a target="_blank" href="<?php echo $sociable->post_title; ?>" class="sociables__item">
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
function get_checkbox(string $name, string $value, string $content) {
    $checked = false;
    if(isset($_GET[$name])) {
        $checked = true;
    }
    ?>  
    <label class="checkbox">
        <input <?php echo $checked ? "checked" : ""; ?> type="checkbox" name="<?php echo $name; ?>" value="<?php echo $value; ?>">
        <span><?php echo $content; ?></span>
    </label>
    <?php
} 
function get_card($product) {
    $url = wp_get_attachment_url( get_post_thumbnail_id($product->ID), 'thumbnail' ); 
    ?>
    <article class="card">
        <a href="<?php echo get_permalink($product); ?>" class="card__image">
            <img src="<?php echo $url; ?>" alt="<?php echo $product->post_title; ?>">
        </a>
        <div class="card__description">
            <h3 class="card__name"><?php echo $product->post_title; ?></h3>
            <?php echo $product->post_excerpt; ?>
            <a href="<?php echo get_permalink($product); ?>" class="button">Детальніше</a>
        </div>
    </article>
    <?php
}
function get_catalog() {
    $main_cat = get_category_by_slug('products');
$taxonomies = array( 
    'category',
);

$args = array(
    'parent'         => $main_cat->term_id,
    // 'child_of'      => $parent_term_id, 
); 

$cats = get_categories(
    array(
        'child_of' => $main_cat->term_id,
        'post_status' => 'publish', 
        'orderby' => 'publish_date', 
        'order' => 'DESC',
        'hide_empty' => '0'
        )
);
$cats_ids = array();
foreach ($cats as $cat) {
    if(isset($_GET[$cat->slug])) {
        $cats_ids[count($cats_ids)] = $cat->term_id;
    }
}
if(count($cats_ids) == 0)
{
    foreach ($cats as $cat) {
        $cats_ids[count($cats_ids)] = $cat->term_id;
    }
}
    ?>
    <section class="catalog">
        <div class="container catalog__container">
            <!-- <div class="filter catalog__filter">
                <h2 class="title catalog__title catalog__subtitle">Категорії</h2>
                <div class="catalog__cats">
                    <?php foreach ($cats as $cat) : ?>
                        <?php get_checkbox($cat->slug, $cat->slug, $cat->name); ?>                       
                    <?php endforeach; ?>
                </div>
            </div> -->
            <div class="catalog__plate">
                <?php
                $products = get_posts_by_category_ID($main_cat->term_id); 
                foreach ($products as $product) {
                    setup_postdata($product);
                    $product_cats = (get_the_category( $product->ID ));
                    $can_show = false;
                    foreach($product_cats as $cat) {
                        foreach($cats_ids as $id) {
                            if($id == $cat->term_id) {
                                $can_show = true;
                            }
                        }
                    }
                    if($can_show)
                    {
                        get_card($product);
                    }
                    wp_reset_postdata();
                }
                ?>
            </div>
        </div>
    </section>
    <?php
}