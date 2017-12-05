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
