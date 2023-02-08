<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

$heading = apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) );

?>

<?php if ( $heading ) : ?>
	<h2><?php echo esc_html( $heading ); ?></h2>
<?php endif; ?>
<div class="description">
<?php the_content();echo '<a class="read_more">Read more...</a>'.'<a  class="read_less">Read less</a>'; ?>
</div>
<style>
    .read_less{
        display:none;
    }
    .description p:not(:first-child) {
        display: none;
    }
</style>
<script>
$('.read_more').click(function(){
	$('.read_more').hide();
	$('.read_less').show();
	$("p").slideDown();
});
$('.read_less').click(function(){
    $('.read_more').show();
	$('.read_less').hide();
	$(".description p:not(:first-child)").slideUp();
	
});
</script>