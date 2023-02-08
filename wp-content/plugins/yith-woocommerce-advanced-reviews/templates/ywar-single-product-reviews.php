<?php

if (!defined('ABSPATH')) exit; // Exit if accessed directly


global $review_stats;
global $product;
$product_id = yit_get_prop( $product, 'id' );
$customer_reviews_label = apply_filters( 'ywar_customer_review_label' , __('Customers\' review', 'yith-woocommerce-advanced-reviews' ) );
?>

<div>

    <div id="reviews_summary">

        <h3><?php echo $customer_reviews_label; ?></h3>

        <?php do_action('ywar_summary_prepend', $product) ?>
        <div class="review-panel">
        <div class="reviews_bar">

            <?php for ($i = 5; $i >= 1; $i--) :
                $perc = ($review_stats['total'] == '0') ? 0 : floor($review_stats[$i] / $review_stats['total'] * 100);
                ?>

                <div class="ywar_review_row">
                    <?php do_action('ywar_summary_row_prepend', $i, $product_id) ?>

                    <span
                        class="ywar_stars_value"><?php printf(_n('%s star', '%s stars', $i, 'yith-woocommerce-advanced-reviews'), $i); ?></span>
                    <span class="ywar_num_reviews"><?php echo $review_stats[$i]; ?></span>
    				<span class="ywar_rating_bar">
    					<span style="background-color:<?php echo get_option('ywar_summary_bar_color'); ?>"
                              class="ywar_scala_rating">
    						<span class="ywar_perc_rating"
                                  style="width: <?php echo $perc; ?>%; background-color:<?php echo get_option('ywar_summary_percentage_bar_color'); ?>">
    							<?php if ('yes' == get_option('ywar_summary_percentage_value')) : ?>
                                    <span style="color:<?php echo get_option('ywar_summary_percentage_value_color'); ?>"
                                          class="ywar_perc_value"><?php printf('%s %%', $perc); ?></span>
                                <?php endif; ?>
    						</span>
    					</span>
    				</span>

                    <?php do_action('ywar_summary_row_append', $i, $product_id) ?>
                </div>
            <?php endfor; ?>
        </div>
        <div class="review-btn">
        <button class="btn button write_review">Write a review</button>
        <button class="btn button cancel_review">Cancel a review</button>
        </div>
        </div>

        <?php do_action('ywar_summary_append') ?>

        <div id="reviews_header">
            <?php do_action('ywar_reviews_header', $review_stats) ?>
        </div>
    </div>
    
</div>
<script type="text/javascript">
    $( document ).ready(function() {
    $('.cancel_review').css('display','none');    
    $('.write_review').on('click',function(){
    $('#review_form').show();
    $('.cancel_review').show();
    $('.write_review').hide();
});

    $('.cancel_review').on('click',function(){
    $('#review_form').hide();
    $('.cancel_review').hide();
    $('.write_review').show();
});
});
</script>
<style type="text/css">
    #review_form{display: none;}
    .cancel_review{display: none;}
</style>


