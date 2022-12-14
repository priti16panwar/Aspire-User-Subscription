<?php 
/*
*
*	***** Aspire Subscribers *****
*
*	Shortcodes
*	
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
/*
*
*  Build The Custom Plugin Form
*
*  Display Anywhere Using Shortcode: [awp_custom_email_subscribers]
*
*/
function as_custom_plugin_form_display($atts, $content = NULL){
		extract(shortcode_atts(array(
      	'el_class' => '',
      	'el_id' => '',	
		),$atts));  
            
            $out ='';
            $out .= '<div id="as_custom_plugin_form_wrap" class="as-form-wrap">';
            $out .= '<form id="as_custom_plugin_form">';
            $out .= 'Subscribe now to receive the offer on your wishlist products.</strong>';
            $out .= '<p><input type="email" name="email" id="Email" placeholder="Your Email" required></p>';
            $out .= '<p><input type="number" name="percentage" id="Percentage" placeholder="Enter the Number to receive the offer above discount" onchange="handleChange(this);" required /></p>';
            $out .= '<p class="checkbox"><input type="checkbox" name="status" id="Status"/><label for="Status">Status</label></p>';
            // Final Submit Button
            $out .= '<p><input type="submit" id="submit_btn" name="submit" value="Subscribe Now"></p>';
            $out .= '<p style="text-align:center;"><img src="'.plugins_url( 'loader.gif' , __FILE__ ).'" class="image_loader" alt="Processing..." style="display:none;"></p>
                <div class="response_area"></div>';        
            $out .= '</form>';
            $out .= '<script>function handleChange(input) {if (input.value < 0) input.value = 0;if (input.value > 100) input.value = 100;}</script>';
             // Form Ends
            $out .='</div><!-- as_custom_plugin_form_wrap -->'; 
            return $out;
}
/*
Register All Shorcodes At Once
*/
add_action( 'init', 'as_register_shortcodes');
function as_register_shortcodes(){
	// Registered Shortcodes
	add_shortcode ('awp_custom_email_subscribers', 'as_custom_plugin_form_display' );
};