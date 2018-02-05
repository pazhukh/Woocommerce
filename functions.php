// Remove Add to Cart from Related Products	
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);	

add_action ('woocommerce_share', 'links_for_unlogged', 5);
function links_for_unlogged () {
	
	if (!is_user_logged_in()) {
		get_template_part('woocommerce/single-product/no-buy-button', get_post_type());
	}
}

//ajax оновлення кількості товару на сторінці кошика
add_action( 'wp_footer', 'cart_update_qty_script' );
function cart_update_qty_script() {
  if (is_cart()) :
   ?>
    <script>
        jQuery('div.woocommerce').on('change', '.qty', function(){
           jQuery("[name='update_cart']").removeAttr('disabled');
           jQuery("[name='update_cart']").trigger("click"); 
        });
   </script>
<?php
endif;
}

************************************************************************************************************

//відразу виходити з облікового запису
function iconic_bypass_logout_confirmation() {
	global $wp;
	if ( isset( $wp->query_vars['customer-logout'] ) ) {
		wp_redirect( str_replace( '&amp;', '&', wp_logout_url( wc_get_page_permalink( 'myaccount' ) ) ) );
		exit;
	}
}
add_action( 'template_redirect', 'iconic_bypass_logout_confirmation' );

************************************************************************************************************

//add quick link to dashboard hook
add_action ('woocommerce_single_product_summary', 'link_to_dashboard', 5);
function link_to_dashboard () {
	
	if (is_user_logged_in()) {
		edit_post_link('');
	}
}

************************************************************************************************************
	
//show chosen product variation in cart page
//parameters 'pa_dress-color', $_product
function the_prod_attr_cart($taxonomy, $_product){
	$meta = $_product->attributes[$taxonomy];
	if($meta){
		$term = get_term_by('slug', $meta, $taxonomy);

		echo '<p>' . $term->name . '</p>';
	} else {
		return false;
	}
	
}

************************************************************************************************************
	
//забрати непотрібні посилання в мому акаунті
add_filter ( 'woocommerce_account_menu_items', 'remove_my_account_links' );
function remove_my_account_links( $menu_links ){

	unset( $menu_links['edit-address'] ); // Addresses
	//unset( $menu_links['dashboard'] ); // Dashboard
	//unset( $menu_links['payment-methods'] ); // Payment Methods
	//unset( $menu_links['orders'] ); // Orders
	unset( $menu_links['downloads'] ); // Downloads
	unset( $menu_links['edit-account'] ); // Account details
	//unset( $menu_links['customer-logout'] ); // Logout

	return $menu_links;
}
