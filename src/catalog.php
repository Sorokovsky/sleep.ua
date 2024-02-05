<?php 
// Template name: Catalog
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
        'orderby' => 'id',
        'order' => 'ASC',
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
<? get_header(); ?>
    <section class="catalog">
        <div class="container catalog__container">
            <div class="filter catalog__filter">
                <h1 class="title catalog__title">Фільтр</h1>
                <h2 class="title catalog__title catalog__subtitle">Категорії</h2>
                <div class="catalog__cats">
                    <?php foreach ($cats as $cat) : ?>
                        <?php get_checkbox($cat->slug, $cat->slug, $cat->name); ?>                       
                    <?php endforeach; ?>
                </div>
            </div>
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
<?php get_footer(); ?>