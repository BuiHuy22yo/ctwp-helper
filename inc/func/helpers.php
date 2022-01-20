<?php
/**
 * Created by groot.
 * User: groot
 * Date: 1/20/2022
 * Time: 10:30 AM
 */

if(!function_exists('ctwpGetAllPostsSelect2')):
    function ctwpGetAllPostsSelect2($post_type='post') {
        $arr = array();
        $posts = get_posts(array(
            'post_type' => $post_type,
            'posts_per_page' => 20,
            'order' => 'DESC',
            'orderby' => 'date',
        ));
        if (!empty($posts)) {
            foreach ($posts as $post) {
                $arr[$post->ID] = $post->post_title;
            }
        }
        return $arr;
    }
endif;
if(!function_exists('ctwpGetAllCategoriesSelect2')):
    function ctwpGetAllCategoriesSelect2($taxonomy='category') {
        $arr = array();
        $terms = get_terms( array(
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        ) );
        if (!empty($terms)) {
            foreach ($terms as $category) {
                $arr[$category->term_id] = $category->name;
            }
        }
        return $arr;
    }
endif;
if(!function_exists('ctwpStringLimitWords')):
    function ctwpStringLimitWords($string, $word_limit) {
        $words = explode(' ', $string, ($word_limit + 1));
        if(count($words) > $word_limit)
            array_pop($words);
        return implode(' ', $words);
    }
endif;

function ctwp_template($settings,$taxonomy,$swiper) {
    $wc_query = array();
    $params = array(
        'posts_per_page' => $settings['limit'],
        'post_type' => array('product', 'product_variation'),
    );
    if (!empty($taxonomy)) {
        $params['tax_query'] = array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => $taxonomy,
            ),
        );
    }
    $wc_query = new WP_Query($params);
    ?>
    <div <?php echo isset($settings['slides_per_view_mobile']) ? 'data-limit-mobile='.$settings['slides_per_view_mobile'].' ' : ''; echo isset($settings['slides_per_view_tablet']) ? 'data-limit-tablet='.$settings['slides_per_view_tablet'] . ' ' : '';echo isset($settings['slides_per_view']) ? 'data-limit-desktop='.$settings['slides_per_view'] . ' ' : '' ?> class="elementor-ctwp_product-tabs-wrapper<?php echo ( $swiper == true ) ? " swiper swiper-container" : ""; ?>">
        <?php if ($swiper === true): ?>
        <div class="swiper-wrapper">
            <?php else: ?>
            <div class="container">
                <div class="row">
                    <?php endif; ?>
                    <?php if ($wc_query->have_posts()) :
                        while ($wc_query->have_posts()) :
                            $wc_query->the_post();
                            $product = wc_get_product( get_the_ID() );
                            ?>
                            <div class="col-product <?php echo $product->get_type(); ?><?php echo ( $swiper === true ) ? ' swiper-slide' : ""; ?>">
                                <div class="item-product">
                                    <?php echo '<a href="' . esc_url( get_the_permalink() ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">'; ?>
                                    <?php woocommerce_show_product_loop_sale_flash(); ?>
                                    <?php woocommerce_template_loop_product_thumbnail(); ?>
                                    <?php echo '<h2 class="' . esc_attr( 'woocommerce-loop-product__title' ) . '">' . get_the_title() . '</h2>'; ?>
                                    <?php
                                    if ( wc_review_ratings_enabled() ) {
                                        echo wc_get_rating_html( $product->get_average_rating() );
                                    }
                                    ?>
                                    <?php woocommerce_template_loop_price(); ?>
                                    <?php echo '</a>'; ?>
                                    <?php echo "<div class=primary-button>";woocommerce_template_loop_add_to_cart(array()); echo '</div>' ?>
                                </div>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    else:  ?>
                        <p><?php _e( 'No Products' );?></p>
                    <?php endif; ?>
                    <?php if ($swiper === true): ?>
                </div>
                <div class="swiper-pagination"></div><div class="swiper-button-prev"></div><div class="swiper-button-next"></div>
                <?php else: ?>
            </div>
        </div>
    <?php endif; ?>
    </div>
    <?php
}