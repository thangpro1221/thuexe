<?php // Do not allow direct access to the file.
if( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
* WooCommerce Cart
*/

function constructions_wc_cart_count() {

// Returns an empty string, if the cart item is not found

    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		global $woocommerce;
		$total = $woocommerce->cart->get_cart_total();
        $count = WC()->cart->cart_contents_count;	
        ?><a title="<?php __('View your cart','constructions'); ?>" class="cart-contents" href="<?php echo wc_get_cart_url(); ?>"><?php
        
			if ( $count == 0 ) {
				?>
				<span class="cart-contents-count"> </span>
				<span class="dashicons dashicons-cart">
					<div class="s-cart_num">0</div>
				</span>
				<?php            
			}		
			if ( $count == 1 ) {
				?>
				<span class="dashicons dashicons-cart"><div class="s-cart_num"><?php echo esc_html( $count ); ?></div></span>
				<?php
			}
			if ( $count > 1 ) {
				?>
				<span class="dashicons dashicons-cart"><div class="s-cart_num"><?php echo esc_html( $count ); ?></div></span>
				<?php
			}		
		
        ?></a>
		<?php
    }
 
}
add_action( 'constructions_header_top', 'constructions_wc_cart_count' );

/**
 * Ensure cart contents update when products are added to the cart via AJAX
 */
 
function constructions_header_add_to_cart_fragment( $fragments ) {
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
    ob_start();
		global $woocommerce;	
		$total = $woocommerce->cart->get_cart_total();
		$count = WC()->cart->cart_contents_count;
		?><a title="<?php __('View your cart','constructions'); ?>" class="cart-contents" href="<?php echo wc_get_cart_url(); ?>"><?php

			if ( $count == 0 ) {
				?>
				<span class="cart-contents-count"></span>
				<span class="dashicons dashicons-cart">
					<div class="s-cart_num">0</div>
				</span>
				<?php            
			}
			
			if ( $count == 1 ) {
				?>
				<span class="dashicons dashicons-cart"><div class="s-cart_num"><?php echo esc_html( $count ); ?></div></span>
				<?php            
			}
			if ( $count > 1 ) {
				?>
				<span class="dashicons dashicons-cart"><div class="s-cart_num"><?php echo esc_html( $count ); ?></div></span>
				<?php
			}			
		?></a>
		<?php
 
    $fragments['a.cart-contents'] = ob_get_clean();
     
    return $fragments;
	}
}
add_filter( 'woocommerce_add_to_cart_fragments', 'constructions_header_add_to_cart_fragment' );
