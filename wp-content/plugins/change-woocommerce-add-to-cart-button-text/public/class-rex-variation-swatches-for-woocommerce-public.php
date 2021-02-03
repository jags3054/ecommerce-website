<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    Variation_Swatches_For_Woocommerce
 * @subpackage Variation_Swatches_For_Woocommerce/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Variation_Swatches_For_Woocommerce
 * @subpackage Variation_Swatches_For_Woocommerce/public
 * @author     RexTheme <sakib@coderex.co>
 */
class Variation_Swatches_For_Woocommerce_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Variation_Swatches_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Variation_Swatches_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        $rexvs_setup_data = unserialize(get_option('rexvs_setup_data'));

        if(isset($rexvs_setup_data['rexvs_disable_stylesheet']) && $rexvs_setup_data['rexvs_disable_stylesheet'] != 'on'){
		    wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/variation-swatches-for-woocommerce-public.css', array(), $this->version, 'all' );
        }
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Variation_Swatches_For_Woocommerce_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Variation_Swatches_For_Woocommerce_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
        
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rex-variation-swatches-for-woocommerce-public.js', array( 'jquery' ), $this->version, false );
        
        wp_enqueue_script( 'rexvs-frontend', plugin_dir_url( __FILE__ ) . 'js/frontface.js', array( 'jquery' ));
	}

	/**
	 * Filter function to add swatches bellow the default selector
	 *
	 * @param $html
	 * @param $args
	 *
	 * @return string
	 */
	public function get_swatch_html( $html, $args ) {
		$rexvs_setup_data = unserialize(get_option('rexvs_setup_data'));
		$swatch_types = rex_variation_master()->types;
		$attr         = rex_variation_master()->get_tax_attribute( $args['attribute'] );
		// Return if this is normal attribute
		if ( empty( $attr ) ) {
			return $html;
		}

		// if ( ! array_key_exists( $attr->attribute_type, $swatch_types ) ) {
		// 	return $html;
		// }

		$options   = $args['options'];
		$product   = $args['product'];
		$attribute = $args['attribute'];
		$class     = "variation-selector variation-select-{$attr->attribute_type}";
		$swatches  = '';

		if ( empty( $options ) && ! empty( $product ) && ! empty( $attribute ) ) {
			$attributes = $product->get_variation_attributes();
			$options    = $attributes[$attribute];
		}

		if ( array_key_exists( $attr->attribute_type, $swatch_types ) ) {
			if ( ! empty( $options ) && $product && taxonomy_exists( $attribute ) ) {
				// Get terms if this is a taxonomy - ordered. We need the names too.
				$terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );

				foreach ( $terms as $term ) {
					if ( in_array( $term->slug, $options ) ) {
						$swatches .= apply_filters( 'rexvs_swatch_html', '', $term, $attr->attribute_type, $args );
					}
				}
			}

			if ( ! empty( $swatches ) ) {
				$class .= ' hidden';
				$swatches = '<div class="rexvs-swatches" data-attribute_name="attribute_' . esc_attr( $attribute ) . '">' . $swatches . '</div>';
				$html     = '<div class="' . esc_attr( $class ) . '">' . $html . '</div>' . $swatches;
				//===dynamic Style===//
				$html .= '<style>';
                    if(isset($rexvs_setup_data['rexvs_disable_stylesheet']) && $rexvs_setup_data['rexvs_disable_stylesheet'] != 'on'){
                        if($rexvs_setup_data['rexvs_individual_attr_style'] != 'on'){
                        
                            if(isset($rexvs_setup_data['rexvs_tooltip']) && $rexvs_setup_data['rexvs_tooltip'] == 'on'){
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch .cv-tooltip{
                                        display: block;
                                        font-size : '.$rexvs_setup_data['rexvs_tooltip_fnt_size'].'px;
                                        color: '.$rexvs_setup_data['rexvs_tooltip_color'].';
                                        background-color: '.$rexvs_setup_data['rexvs_tooltip_bg_color'].';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch .cv-tooltip:before{
                                        background-color: '.$rexvs_setup_data['rexvs_tooltip_bg_color'].';
                                    }
                                ';
                            }

                            //----swatches rounded/square style------
                            if(isset($rexvs_setup_data['rexvs_shape_style']) && $rexvs_setup_data['rexvs_shape_style'] == 'squared'){
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-image img,
                                    .rexvs-variations .rexvs-swatches .swatch:before,
                                    .rexvs-variations .rexvs-swatches .swatch{
                                        border-radius: 0;
                                    }
                                ';
                            }

                            //----swatches style------
                            if(isset($rexvs_setup_data['rexvs_shape_height']) && !empty($rexvs_setup_data['rexvs_shape_height']) ){
                                $height = $rexvs_setup_data['rexvs_shape_height'];
                            }else{
                                $height = 40;
                            }

                            if(isset($rexvs_setup_data['rexvs_shape_width']) && !empty($rexvs_setup_data['rexvs_shape_width']) ){
                                $width = $rexvs_setup_data['rexvs_shape_width'];
                            }else{
                                $width = 40;
                            }

                            if(isset($rexvs_setup_data['rexvs_swatches_font_size']) && !empty($rexvs_setup_data['rexvs_swatches_font_size']) ){
                                $font_size = $rexvs_setup_data['rexvs_swatches_font_size'];
                            }else{
                                $font_size = 15;
                            }

                            if(isset($rexvs_setup_data['rexvs_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_swatches_bg_color']) ){
                                $swatches_bg_color = $rexvs_setup_data['rexvs_swatches_bg_color'];
                            }else{
                                $swatches_bg_color = '#555';
                            }

                            if(isset($rexvs_setup_data['rexvs_swatches_color']) && !empty($rexvs_setup_data['rexvs_swatches_color']) ){
                                $swatches_color = $rexvs_setup_data['rexvs_swatches_color'];
                            }else{
                                $swatches_color = '#fff';
                            }

                            //--------hover background color---------
                            if(isset($rexvs_setup_data['rexvs_hvr_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_hvr_swatches_bg_color']) ){
                                $swatches_hvr_bg_color = $rexvs_setup_data['rexvs_hvr_swatches_bg_color'];
                            }
                            if(isset($rexvs_setup_data['rexvs_hvr_swatches_color']) && !empty($rexvs_setup_data['rexvs_hvr_swatches_color']) ){
                                $swatches_hvr_color = $rexvs_setup_data['rexvs_hvr_swatches_color'];
                            }

                            $html .='
                                .rexvs-variations .rexvs-swatches .swatch{
                                    height: '.$height.'px;
                                    width: '.$width.'px;
                                    font-size: '.$font_size.'px;
                                    background-color: '.$swatches_bg_color.';
                                    color: '.$swatches_color.';
                                }
                                .rexvs-variations .rexvs-swatches .swatch:hover{
                                    background-color: '.$swatches_hvr_bg_color.';
                                    color: '.$swatches_hvr_color.';
                                }
                                .rexvs-variations .rexvs-swatches .swatch.swatch-image{
                                    background-color: transparent;
                                }
                                .rexvs-variations .rexvs-swatches .swatch.swatch-image:hover {
                                    opacity: 0.4;
                                }
                            ';

                            //----swatches border style------
                            if(isset($rexvs_setup_data['rexvs_swatches_border']) && $rexvs_setup_data['rexvs_swatches_border'] == 'on'){

                                if(isset($rexvs_setup_data['rexvs_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_swatches_border_size']) ){
                                    $rexvs_swatches_border_size = $rexvs_setup_data['rexvs_swatches_border_size'];
                                }else{
                                    $rexvs_swatches_border_size = 1;
                                }

                                if(isset($rexvs_setup_data['rexvs_swatches_border_style']) && !empty($rexvs_setup_data['rexvs_swatches_border_style']) ){
                                    $rexvs_swatches_border_style = $rexvs_setup_data['rexvs_swatches_border_style'];
                                }else{
                                    $rexvs_swatches_border_style = 'solid';
                                }

                                if(isset($rexvs_setup_data['rexvs_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_swatches_border_color']) ){
                                    $rexvs_swatches_border_color = $rexvs_setup_data['rexvs_swatches_border_color'];
                                }else{
                                    $rexvs_swatches_border_color = '#333';
                                }

                                //-----selected border-width and border-color---
                                if(isset($rexvs_setup_data['rexvs_seltd_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_seltd_swatches_border_size']) ){
                                    $rexvs_seltd_swatches_border_size = $rexvs_setup_data['rexvs_seltd_swatches_border_size'];
                                }
                                if(isset($rexvs_setup_data['rexvs_seltd_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_seltd_swatches_border_color']) ){
                                    $rexvs_seltd_swatches_border_color = $rexvs_setup_data['rexvs_seltd_swatches_border_color'];
                                }
                                
                                //-----hover border-width and border-color---
                                if(isset($rexvs_setup_data['rexvs_hvr_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_hvr_swatches_border_size']) ){
                                    $rexvs_hvr_swatches_border_size = $rexvs_setup_data['rexvs_hvr_swatches_border_size'];
                                }
                                if(isset($rexvs_setup_data['rexvs_hvr_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_hvr_swatches_border_color']) ){
                                    $rexvs_hvr_swatches_border_color = $rexvs_setup_data['rexvs_hvr_swatches_border_color'];
                                }

                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch{
                                        border: '.$rexvs_swatches_border_size.'px '.$rexvs_swatches_border_style.' ' .$rexvs_swatches_border_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch:hover{
                                        border-width: '.$rexvs_hvr_swatches_border_size.'px;
                                        border-color: '.$rexvs_hvr_swatches_border_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.selected{
                                        border-width: '.$rexvs_seltd_swatches_border_size.'px;
                                        border-color: '.$rexvs_seltd_swatches_border_color.';
                                    }
                                ';
                            }

                            //----selected swatches style------
                            if(isset($rexvs_setup_data['rexvs_seltd_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_seltd_swatches_bg_color']) ){
                                $rexvs_seltd_swatches_bg_color = $rexvs_setup_data['rexvs_seltd_swatches_bg_color'];
                            }else{
                                $rexvs_seltd_swatches_bg_color = '#444';
                            }

                            if(isset($rexvs_setup_data['rexvs_seltd_swatches_color']) && !empty($rexvs_setup_data['rexvs_seltd_swatches_color']) ){
                                $rexvs_seltd_swatches_color = $rexvs_setup_data['rexvs_seltd_swatches_color'];
                            }else{
                                $rexvs_seltd_swatches_color = '#fff';
                            }

                            $html .='
                                .rexvs-variations .rexvs-swatches .swatch:before {
                                    background-color: '.$rexvs_seltd_swatches_bg_color.';
                                    color: '.$rexvs_seltd_swatches_color.';
                                }
                                .rexvs-variations .rexvs-swatches .swatch:after {
                                    border-color: '.$rexvs_seltd_swatches_color.';
                                }
                                .rexvs-variations .rexvs-swatches .swatch.swatch-image:before {
                                    background-color: '.$rexvs_seltd_swatches_bg_color.';
                                    color: '.$rexvs_seltd_swatches_color.';
                                    opacity: 0.4;
                                }

                            ';
                        
                        }//--end  rexvs_individual_attr_style condition--
                        
                        
                        //-----clear button style----
                        if(isset($rexvs_setup_data['rexvs_clr_btn_height']) && !empty($rexvs_setup_data['rexvs_clr_btn_height']) ){
                            $clr_btn_height = $rexvs_setup_data['rexvs_clr_btn_height'];
                        }
                        if(isset($rexvs_setup_data['rexvs_clr_btn_width']) && !empty($rexvs_setup_data['rexvs_clr_btn_width']) ){
                            $clr_btn_width = $rexvs_setup_data['rexvs_clr_btn_width'];
                        }
                        if(isset($rexvs_setup_data['rexvs_clr_btn_font_size']) && !empty($rexvs_setup_data['rexvs_clr_btn_font_size']) ){
                            $clr_btn_fnt_size = $rexvs_setup_data['rexvs_clr_btn_font_size'];
                        }
                        if(isset($rexvs_setup_data['rexvs_clr_btn_radius']) && !empty($rexvs_setup_data['rexvs_clr_btn_radius']) ){
                            $clr_btn_radius = $rexvs_setup_data['rexvs_clr_btn_radius'];
                        }
                        if(isset($rexvs_setup_data['rexvs_clr_btn_bg_color']) && !empty($rexvs_setup_data['rexvs_clr_btn_bg_color']) ){
                            $clr_btn_bg_color = $rexvs_setup_data['rexvs_clr_btn_bg_color'];
                        }
                        if(isset($rexvs_setup_data['rexvs_clr_btn_color']) && !empty($rexvs_setup_data['rexvs_clr_btn_color']) ){
                            $clr_btn_color = $rexvs_setup_data['rexvs_clr_btn_color'];
                        }
                        $html .='
                            .rexvs-variations .reset_variations{
                                width: '.$clr_btn_width.'px;
                                height: '.$clr_btn_height.'px;
                                line-height: '.$clr_btn_height.'px;
                                font-size: '.$clr_btn_fnt_size.'px!important;
                                background-color: '.$clr_btn_bg_color.';
                                color: '.$clr_btn_color.';
                                border-radius: '.$clr_btn_radius.'px;
                                
                            }
                            
                        ';

                    }//--end rexvs_disable_stylesheet condition--

				$html .= '</style>';
				//===dynamic Style===//
			}
		}
		else {
			if (isset($rexvs_setup_data['rexvs_default_dropdown_to_button']) && $rexvs_setup_data['rexvs_default_dropdown_to_button'] == 'on') {
				if ( ! empty( $options ) && $product && taxonomy_exists( $attribute ) ) {
					// Get terms if this is a taxonomy - ordered. We need the names too.
					$terms = wc_get_product_terms( $product->get_id(), $attribute, array( 'fields' => 'all' ) );

					foreach ( $terms as $term ) {
						if ( in_array( $term->slug, $options ) ) {
							$swatches .= apply_filters( 'rexvs_swatch_html', '', $term, 'default', $args );
						}
					}
				}

				if ( ! empty( $swatches ) ) {
					$class .= ' hidden';
					$swatches = '<div class="rexvs-swatches" data-attribute_name="attribute_' . esc_attr( $attribute ) . '">' . $swatches . '</div>';
					$html     = '<div class="' . esc_attr( $class ) . '">' . $html . '</div>' . $swatches;
					//===dynamic Style for default dropdown===//
					$html .= '<style>';
                        if(isset($rexvs_setup_data['rexvs_disable_stylesheet']) && $rexvs_setup_data['rexvs_disable_stylesheet'] != 'on'){
                            
                            if($rexvs_setup_data['rexvs_individual_attr_style'] != 'on'){
                                if(isset($rexvs_setup_data['rexvs_tooltip']) && $rexvs_setup_data['rexvs_tooltip'] == 'on'){
                                    $html .='
                                        .rexvs-variations .rexvs-swatches .swatch .cv-tooltip{
                                            display: block;
                                            font-size : '.$rexvs_setup_data['rexvs_tooltip_fnt_size'].'px;
                                            color: '.$rexvs_setup_data['rexvs_tooltip_color'].';
                                            background-color: '.$rexvs_setup_data['rexvs_tooltip_bg_color'].';
                                        }
                                        .rexvs-variations .rexvs-swatches .swatch .cv-tooltip:before{
                                            background-color: '.$rexvs_setup_data['rexvs_tooltip_bg_color'].';
                                        }
                                    ';
                                }

                                //----swatches style------
                                if(isset($rexvs_setup_data['rexvs_swatches_font_size']) && !empty($rexvs_setup_data['rexvs_swatches_font_size']) ){
                                    $font_size = $rexvs_setup_data['rexvs_swatches_font_size'];
                                }else{
                                    $font_size = 15;
                                }

                                if(isset($rexvs_setup_data['rexvs_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_swatches_bg_color']) ){
                                    $swatches_bg_color = $rexvs_setup_data['rexvs_swatches_bg_color'];
                                }else{
                                    $swatches_bg_color = '#555';
                                }

                                if(isset($rexvs_setup_data['rexvs_swatches_color']) && !empty($rexvs_setup_data['rexvs_swatches_color']) ){
                                    $swatches_color = $rexvs_setup_data['rexvs_swatches_color'];
                                }else{
                                    $swatches_color = '#fff';
                                }
                                
                                //--------hover background color---------
                                if(isset($rexvs_setup_data['rexvs_hvr_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_hvr_swatches_bg_color']) ){
                                    $swatches_hvr_bg_color = $rexvs_setup_data['rexvs_hvr_swatches_bg_color'];
                                }
                                if(isset($rexvs_setup_data['rexvs_hvr_swatches_color']) && !empty($rexvs_setup_data['rexvs_hvr_swatches_color']) ){
                                    $swatches_hvr_color = $rexvs_setup_data['rexvs_hvr_swatches_color'];
                                }
                                
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch{
                                        font-size: '.$font_size.'px;
                                        background-color: '.$swatches_bg_color.';
                                        color: '.$swatches_color.';
                                        border-color: '.$swatches_bg_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch:hover{
                                        background-color: '.$swatches_hvr_bg_color.';
                                        color: '.$swatches_hvr_color.';
                                        border-color: '.$swatches_hvr_bg_color.';
                                    }
                                ';

                                
                                //----selected swatches style------
                                if(isset($rexvs_setup_data['rexvs_seltd_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_seltd_swatches_bg_color']) ){
                                    $rexvs_seltd_swatches_bg_color = $rexvs_setup_data['rexvs_seltd_swatches_bg_color'];
                                }else{
                                    $rexvs_seltd_swatches_bg_color = '#444';
                                }

                                if(isset($rexvs_setup_data['rexvs_seltd_swatches_color']) && !empty($rexvs_setup_data['rexvs_seltd_swatches_color']) ){
                                    $rexvs_seltd_swatches_color = $rexvs_setup_data['rexvs_seltd_swatches_color'];
                                }else{
                                    $rexvs_seltd_swatches_color = '#fff';
                                }

                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch.selected {
                                        border-color: '.$rexvs_seltd_swatches_bg_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch:before{
                                        background-color: '.$rexvs_seltd_swatches_bg_color.';
                                        color: '.$rexvs_seltd_swatches_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch:after{
                                        border-color: '.$rexvs_seltd_swatches_color.';
                                    }
                                ';

                                //----swatches border style when border in enabled------
                                if(isset($rexvs_setup_data['rexvs_swatches_border']) && $rexvs_setup_data['rexvs_swatches_border'] == 'on'){

                                    if(isset($rexvs_setup_data['rexvs_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_swatches_border_size']) ){
                                        $rexvs_swatches_border_size = $rexvs_setup_data['rexvs_swatches_border_size'];
                                    }else{
                                        $rexvs_swatches_border_size = 1;
                                    }

                                    if(isset($rexvs_setup_data['rexvs_swatches_border_style']) && !empty($rexvs_setup_data['rexvs_swatches_border_style']) ){
                                        $rexvs_swatches_border_style = $rexvs_setup_data['rexvs_swatches_border_style'];
                                    }else{
                                        $rexvs_swatches_border_style = 'solid';
                                    }

                                    if(isset($rexvs_setup_data['rexvs_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_swatches_border_color']) ){
                                        $rexvs_swatches_border_color = $rexvs_setup_data['rexvs_swatches_border_color'];
                                    }else{
                                        $rexvs_swatches_border_color = '#333';
                                    }
                                    
                                    //-----selected border-width and border-color---
                                    if(isset($rexvs_setup_data['rexvs_seltd_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_seltd_swatches_border_size']) ){
                                        $rexvs_seltd_swatches_border_size = $rexvs_setup_data['rexvs_seltd_swatches_border_size'];
                                    }
                                    if(isset($rexvs_setup_data['rexvs_seltd_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_seltd_swatches_border_color']) ){
                                        $rexvs_seltd_swatches_border_color = $rexvs_setup_data['rexvs_seltd_swatches_border_color'];
                                    }

                                    //-----hover border-width and border-color---
                                    if(isset($rexvs_setup_data['rexvs_hvr_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_hvr_swatches_border_size']) ){
                                        $rexvs_hvr_swatches_border_size = $rexvs_setup_data['rexvs_hvr_swatches_border_size'];
                                    }
                                    if(isset($rexvs_setup_data['rexvs_hvr_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_hvr_swatches_border_color']) ){
                                        $rexvs_hvr_swatches_border_color = $rexvs_setup_data['rexvs_hvr_swatches_border_color'];
                                    }

                                    $html .='
                                        .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch{
                                            border: '.$rexvs_swatches_border_size.'px '.$rexvs_swatches_border_style.' ' .$rexvs_swatches_border_color.';
                                        }
                                        .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch:hover{
                                            border-width: '.$rexvs_hvr_swatches_border_size.'px;
                                            border-color: '.$rexvs_hvr_swatches_border_color.';
                                        }
                                        .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch.selected{
                                            border-width: '.$rexvs_seltd_swatches_border_size.'px;
                                            border-color: '.$rexvs_seltd_swatches_border_color.';
                                        }
                                    ';
                                }


                            }//--end rexvs_individual_attr_style condition--
                        }//--end rexvs_disable_stylesheet condition--

					$html .= '</style>';
					//===dynamic Style for default dropdown===//
				}
			}
		}

		return $html;
	}

	/**
	 * Print HTML of a single swatch
	 *
	 * @param $html
	 * @param $term
	 * @param $type
	 * @param $args
	 *
	 * @return string
	 */
	public function swatch_html( $html, $term, $type, $args ) {
		$selected = sanitize_title( $args['selected'] ) == $term->slug ? 'selected' : '';
		$name     = esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name ) );
        $rexvs_setup_data = unserialize(get_option('rexvs_setup_data'));
        
		if ($term->description) {
			$tooltip = $term->description;
		}
		else {
			$tooltip = $name;
		}

        
		switch ( $type ) {
			case 'color':
				$color = get_term_meta( $term->term_id, 'color', true );
				list( $r, $g, $b ) = sscanf( $color, "#%02x%02x%02x" );
				$html = sprintf(
					'<span class="swatch swatch-color swatch-%s %s" style="background-color:%s; color:%s;" data-value="%s"><p class="cv-tooltip">%s</p></span>',
					esc_attr( $term->slug ),
					$selected,
					esc_attr( $color ),
					"rgba($r,$g,$b,0.5)",
					// esc_attr( $term->description ),
					esc_attr( $term->slug ),
					//$name,
					esc_attr( $tooltip )
				);
                //===dynamic Style===//
				$html .= '<style>';
                    if(isset($rexvs_setup_data['rexvs_disable_stylesheet']) && $rexvs_setup_data['rexvs_disable_stylesheet'] != 'on'){
                        
                        if($rexvs_setup_data['rexvs_individual_attr_style'] == 'on'){
                        
                            if(isset($rexvs_setup_data['rexvs_color_tooltip']) && $rexvs_setup_data['rexvs_color_tooltip'] == 'on'){
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-color .cv-tooltip{
                                        display: block;
                                        font-size : '.$rexvs_setup_data['rexvs_color_tooltip_fnt_size'].'px;
                                        color: '.$rexvs_setup_data['rexvs_color_tooltip_color'].';
                                        background-color: '.$rexvs_setup_data['rexvs_color_tooltip_bg_color'].';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-color .cv-tooltip:before{
                                        background-color: '.$rexvs_setup_data['rexvs_color_tooltip_bg_color'].';
                                    }
                                ';
                            }

                            //----swatches rounded/square style------
                            if(isset($rexvs_setup_data['rexvs_color_shape_style']) && $rexvs_setup_data['rexvs_color_shape_style'] == 'color_squared'){
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-color:before,
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-color{
                                        border-radius: 0;
                                    }
                                ';
                            }

                            //----swatches style------
                            if(isset($rexvs_setup_data['rexvs_color_shape_height']) && !empty($rexvs_setup_data['rexvs_color_shape_height']) ){
                                $height = $rexvs_setup_data['rexvs_color_shape_height'];
                            }else{
                                $height = 40;
                            }

                            if(isset($rexvs_setup_data['rexvs_color_shape_width']) && !empty($rexvs_setup_data['rexvs_color_shape_width']) ){
                                $width = $rexvs_setup_data['rexvs_color_shape_width'];
                            }else{
                                $width = 40;
                            }

                            if(isset($rexvs_setup_data['rexvs_color_swatches_font_size']) && !empty($rexvs_setup_data['rexvs_color_swatches_font_size']) ){
                                $font_size = $rexvs_setup_data['rexvs_color_swatches_font_size'];
                            }else{
                                $font_size = 15;
                            }

                            if(isset($rexvs_setup_data['rexvs_color_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_color_swatches_bg_color']) ){
                                $swatches_bg_color = $rexvs_setup_data['rexvs_color_swatches_bg_color'];
                            }else{
                                $swatches_bg_color = '#555';
                            }

                            if(isset($rexvs_setup_data['rexvs_color_swatches_color']) && !empty($rexvs_setup_data['rexvs_color_swatches_color']) ){
                                $swatches_color = $rexvs_setup_data['rexvs_color_swatches_color'];
                            }else{
                                $swatches_color = '#fff';
                            }
                            
                            //--------hover style---------
                            if(isset($rexvs_setup_data['rexvs_color_hvr_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_color_hvr_swatches_bg_color']) ){
                                $swatches_hvr_bg_color = $rexvs_setup_data['rexvs_color_hvr_swatches_bg_color'];
                            }
                            if(isset($rexvs_setup_data['rexvs_color_hvr_swatches_color']) && !empty($rexvs_setup_data['rexvs_color_hvr_swatches_color']) ){
                                $swatches_hvr_color = $rexvs_setup_data['rexvs_color_hvr_swatches_color'];
                            }

                            $html .='
                                .rexvs-variations .rexvs-swatches .swatch.swatch-color{
                                    height: '.$height.'px;
                                    width: '.$width.'px;
                                    font-size: '.$font_size.'px;
                                    background-color: '.$swatches_bg_color.';
                                    color: '.$swatches_color.';
                                }
                                .rexvs-variations .rexvs-swatches .swatch.swatch-color:hover{
                                    background-color: '.$swatches_hvr_bg_color.';
                                    color: '.$swatches_hvr_color.';
                                }
                            ';

                            //----swatches border style------
                            if(isset($rexvs_setup_data['rexvs_color_swatches_border']) && $rexvs_setup_data['rexvs_color_swatches_border'] == 'on'){

                                if(isset($rexvs_setup_data['rexvs_color_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_color_swatches_border_size']) ){
                                    $rexvs_swatches_border_size = $rexvs_setup_data['rexvs_color_swatches_border_size'];
                                }else{
                                    $rexvs_swatches_border_size = 1;
                                }

                                if(isset($rexvs_setup_data['rexvs_color_swatches_border_style']) && !empty($rexvs_setup_data['rexvs_color_swatches_border_style']) ){
                                    $rexvs_swatches_border_style = $rexvs_setup_data['rexvs_color_swatches_border_style'];
                                }else{
                                    $rexvs_swatches_border_style = 'solid';
                                }

                                if(isset($rexvs_setup_data['rexvs_color_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_color_swatches_border_color']) ){
                                    $rexvs_swatches_border_color = $rexvs_setup_data['rexvs_color_swatches_border_color'];
                                }else{
                                    $rexvs_swatches_border_color = '#333';
                                }
                                
                                //------hover style-------
                                if(isset($rexvs_setup_data['rexvs_color_hvr_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_color_hvr_swatches_border_size']) ){
                                    $rexvs_hvr_swatches_border_size = $rexvs_setup_data['rexvs_color_hvr_swatches_border_size'];
                                }
                                if(isset($rexvs_setup_data['rexvs_color_hvr_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_color_hvr_swatches_border_color']) ){
                                    $rexvs_hvr_swatches_border_color = $rexvs_setup_data['rexvs_color_hvr_swatches_border_color'];
                                }
                                
                                //------selected style-------
                                if(isset($rexvs_setup_data['rexvs_color_seltd_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_color_seltd_swatches_border_size']) ){
                                    $rexvs_seltd_swatches_border_size = $rexvs_setup_data['rexvs_color_seltd_swatches_border_size'];
                                }
                                if(isset($rexvs_setup_data['rexvs_color_seltd_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_color_seltd_swatches_border_color']) ){
                                    $rexvs_seltd_swatches_border_color = $rexvs_setup_data['rexvs_color_seltd_swatches_border_color'];
                                }

                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-color{
                                        border: '.$rexvs_swatches_border_size.'px '.$rexvs_swatches_border_style.' ' .$rexvs_swatches_border_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-color:hover{
                                        border-width: '.$rexvs_hvr_swatches_border_size.'px;
                                        border-color: '.$rexvs_hvr_swatches_border_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-color.selected{
                                        border-width: '.$rexvs_seltd_swatches_border_size.'px;
                                        border-color: '.$rexvs_seltd_swatches_border_color.';
                                    }
                                ';
                            }

                            //----selected swatches style------
                            if(isset($rexvs_setup_data['rexvs_color_seltd_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_color_seltd_swatches_bg_color']) ){
                                $rexvs_seltd_swatches_bg_color = $rexvs_setup_data['rexvs_color_seltd_swatches_bg_color'];
                            }else{
                                $rexvs_seltd_swatches_bg_color = '#444';
                            }

                            if(isset($rexvs_setup_data['rexvs_color_seltd_swatches_color']) && !empty($rexvs_setup_data['rexvs_color_seltd_swatches_color']) ){
                                $rexvs_seltd_swatches_color = $rexvs_setup_data['rexvs_color_seltd_swatches_color'];
                            }else{
                                $rexvs_seltd_swatches_color = '#fff';
                            }

                            $html .='
                                .rexvs-variations .rexvs-swatches .swatch.swatch-color:before{
                                    background-color: '.$rexvs_seltd_swatches_bg_color.';
                                    color: '.$rexvs_seltd_swatches_color.';
                                }
                                .rexvs-variations .rexvs-swatches .swatch.swatch-color:after{
                                    border-color: '.$rexvs_seltd_swatches_color.';
                                }
                            ';
                        
                        }//--end  rexvs_individual_attr_style condition--

                    }//--end rexvs_disable_stylesheet condition--

				$html .= '</style>';
				//===dynamic Style===//
				break;

			case 'image':
				$image = get_term_meta( $term->term_id, 'image', true );
				$image = $image ? wp_get_attachment_image_src( $image ) : '';
				$image = $image ? $image[0] : WC()->plugin_url() . '/assets/images/placeholder.png';
				$html  = sprintf(
					'<span class="swatch swatch-image swatch-%s %s" data-value="%s"><img src="%s" alt="%s"><p class="cv-tooltip">%s</p></span>',
					esc_attr( $term->slug ),
					$selected,
					// esc_attr( $term->description ),
					esc_attr( $term->slug ),
					esc_url( $image ),
					esc_attr( $name ),
					// esc_attr( $name ),
					esc_attr( $tooltip )
				);
                //===dynamic Style===//
				$html .= '<style>';
                    if(isset($rexvs_setup_data['rexvs_disable_stylesheet']) && $rexvs_setup_data['rexvs_disable_stylesheet'] != 'on'){
                        
                        if($rexvs_setup_data['rexvs_individual_attr_style'] == 'on'){
                        
                            if(isset($rexvs_setup_data['rexvs_image_tooltip']) && $rexvs_setup_data['rexvs_image_tooltip'] == 'on'){
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-image .cv-tooltip{
                                        display: block;
                                        font-size : '.$rexvs_setup_data['rexvs_image_tooltip_fnt_size'].'px;
                                        color: '.$rexvs_setup_data['rexvs_image_tooltip_color'].';
                                        background-color: '.$rexvs_setup_data['rexvs_image_tooltip_bg_color'].';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-image .cv-tooltip:before{
                                        background-color: '.$rexvs_setup_data['rexvs_image_tooltip_bg_color'].';
                                    }
                                ';
                            }

                            //----swatches rounded/square style------
                            if(isset($rexvs_setup_data['rexvs_image_shape_style']) && $rexvs_setup_data['rexvs_image_shape_style'] == 'image_squared'){
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-image:before,
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-image{
                                        border-radius: 0;
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-image img {
                                        border-radius: 0;
                                    }
                                ';
                            }

                            //----swatches style------
                            if(isset($rexvs_setup_data['rexvs_image_shape_height']) && !empty($rexvs_setup_data['rexvs_image_shape_height']) ){
                                $height = $rexvs_setup_data['rexvs_image_shape_height'];
                            }else{
                                $height = 40;
                            }

                            if(isset($rexvs_setup_data['rexvs_image_shape_width']) && !empty($rexvs_setup_data['rexvs_image_shape_width']) ){
                                $width = $rexvs_setup_data['rexvs_image_shape_width'];
                            }else{
                                $width = 40;
                            }

                            if(isset($rexvs_setup_data['rexvs_image_swatches_font_size']) && !empty($rexvs_setup_data['rexvs_image_swatches_font_size']) ){
                                $font_size = $rexvs_setup_data['rexvs_image_swatches_font_size'];
                            }else{
                                $font_size = 15;
                            }

                            if(isset($rexvs_setup_data['rexvs_image_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_image_swatches_bg_color']) ){
                                $swatches_bg_color = $rexvs_setup_data['rexvs_image_swatches_bg_color'];
                            }else{
                                $swatches_bg_color = '#555';
                            }

                            if(isset($rexvs_setup_data['rexvs_image_swatches_color']) && !empty($rexvs_setup_data['rexvs_image_swatches_color']) ){
                                $swatches_color = $rexvs_setup_data['rexvs_image_swatches_color'];
                            }else{
                                $swatches_color = '#fff';
                            }
                            
                            //--------hover style---------
                            if(isset($rexvs_setup_data['rexvs_image_hvr_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_image_hvr_swatches_bg_color']) ){
                                $swatches_hvr_bg_color = $rexvs_setup_data['rexvs_image_hvr_swatches_bg_color'];
                            }
                            if(isset($rexvs_setup_data['rexvs_image_hvr_swatches_color']) && !empty($rexvs_setup_data['rexvs_image_hvr_swatches_color']) ){
                                $swatches_hvr_color = $rexvs_setup_data['rexvs_image_hvr_swatches_color'];
                            }
                                
                            $html .='
                                .rexvs-variations .rexvs-swatches .swatch.swatch-image{
                                    height: '.$height.'px;
                                    width: '.$width.'px;
                                    font-size: '.$font_size.'px;
                                    background-color: '.$swatches_bg_color.';
                                    color: '.$swatches_color.';
                                }
                                .rexvs-variations .rexvs-swatches .swatch.swatch-image:hover{
                                    background-color: '.$swatches_hvr_bg_color.';
                                    color: '.$swatches_hvr_color.';
                                }
                            ';

                            //----swatches border style------
                            if(isset($rexvs_setup_data['rexvs_image_swatches_border']) && $rexvs_setup_data['rexvs_image_swatches_border'] == 'on'){

                                if(isset($rexvs_setup_data['rexvs_image_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_image_swatches_border_size']) ){
                                    $rexvs_swatches_border_size = $rexvs_setup_data['rexvs_image_swatches_border_size'];
                                }else{
                                    $rexvs_swatches_border_size = 1;
                                }

                                if(isset($rexvs_setup_data['rexvs_image_swatches_border_style']) && !empty($rexvs_setup_data['rexvs_image_swatches_border_style']) ){
                                    $rexvs_swatches_border_style = $rexvs_setup_data['rexvs_image_swatches_border_style'];
                                }else{
                                    $rexvs_swatches_border_style = 'solid';
                                }

                                if(isset($rexvs_setup_data['rexvs_image_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_image_swatches_border_color']) ){
                                    $rexvs_swatches_border_color = $rexvs_setup_data['rexvs_image_swatches_border_color'];
                                }else{
                                    $rexvs_swatches_border_color = '#333';
                                }

                                //------hover style-------
                                if(isset($rexvs_setup_data['rexvs_image_hvr_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_image_hvr_swatches_border_size']) ){
                                    $rexvs_hvr_swatches_border_size = $rexvs_setup_data['rexvs_image_hvr_swatches_border_size'];
                                }
                                if(isset($rexvs_setup_data['rexvs_image_hvr_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_image_hvr_swatches_border_color']) ){
                                    $rexvs_hvr_swatches_border_color = $rexvs_setup_data['rexvs_image_hvr_swatches_border_color'];
                                }
                                
                                //------selected style-------
                                if(isset($rexvs_setup_data['rexvs_image_seltd_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_image_seltd_swatches_border_size']) ){
                                    $rexvs_seltd_swatches_border_size = $rexvs_setup_data['rexvs_image_seltd_swatches_border_size'];
                                }
                                if(isset($rexvs_setup_data['rexvs_image_seltd_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_image_seltd_swatches_border_color']) ){
                                    $rexvs_seltd_swatches_border_color = $rexvs_setup_data['rexvs_image_seltd_swatches_border_color'];
                                }
                                    
                                
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-image{
                                        border: '.$rexvs_swatches_border_size.'px '.$rexvs_swatches_border_style.' ' .$rexvs_swatches_border_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-image:hover{
                                        border-width: '.$rexvs_hvr_swatches_border_size.'px;
                                        border-color: '.$rexvs_hvr_swatches_border_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-image.selected{
                                        border-width: '.$rexvs_seltd_swatches_border_size.'px;
                                        border-color: '.$rexvs_seltd_swatches_border_color.';
                                    }
                                ';
                            }

                            //----selected swatches style------
                            if(isset($rexvs_setup_data['rexvs_image_seltd_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_image_seltd_swatches_bg_color']) ){
                                $rexvs_seltd_swatches_bg_color = $rexvs_setup_data['rexvs_image_seltd_swatches_bg_color'];
                            }else{
                                $rexvs_seltd_swatches_bg_color = '#444';
                            }

                            if(isset($rexvs_setup_data['rexvs_image_seltd_swatches_color']) && !empty($rexvs_setup_data['rexvs_image_seltd_swatches_color']) ){
                                $rexvs_seltd_swatches_color = $rexvs_setup_data['rexvs_image_seltd_swatches_color'];
                            }else{
                                $rexvs_seltd_swatches_color = '#fff';
                            }

                            $html .='
                                .rexvs-variations .rexvs-swatches .swatch.swatch-image:before{
                                    background-color: '.$rexvs_seltd_swatches_bg_color.';
                                    color: '.$rexvs_seltd_swatches_color.';
                                }
                                .rexvs-variations .rexvs-swatches .swatch.swatch-image:after{
                                    border-color: '.$rexvs_seltd_swatches_color.';
                                }

                            ';
                        
                        }//--end  rexvs_individual_attr_style condition--

                    }//--end rexvs_disable_stylesheet condition--

				$html .= '</style>';
				//===dynamic Style===//
				break;

			case 'label':
				$label = get_term_meta( $term->term_id, 'label', true );
				$label = $label ? $label : $name;
				$html  = sprintf(
					'<span class="swatch swatch-label swatch-%s %s" data-value="%s">%s<p class="cv-tooltip">%s</p></span>',
					esc_attr( $term->slug ),
					$selected,
					// esc_attr( $term->description ),
					esc_attr( $term->slug ),
					esc_html( $label ),
					esc_attr( $tooltip )
				);
                //===dynamic Style===//
				$html .= '<style>';
                    if(isset($rexvs_setup_data['rexvs_disable_stylesheet']) && $rexvs_setup_data['rexvs_disable_stylesheet'] != 'on'){
                        
                        if($rexvs_setup_data['rexvs_individual_attr_style'] == 'on'){
                        
                            if(isset($rexvs_setup_data['rexvs_label_tooltip']) && $rexvs_setup_data['rexvs_label_tooltip'] == 'on'){
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-label .cv-tooltip{
                                        display: block;
                                        font-size : '.$rexvs_setup_data['rexvs_label_tooltip_fnt_size'].'px;
                                        color: '.$rexvs_setup_data['rexvs_label_tooltip_color'].';
                                        background-color: '.$rexvs_setup_data['rexvs_label_tooltip_bg_color'].';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-label .cv-tooltip:before{
                                        background-color: '.$rexvs_setup_data['rexvs_label_tooltip_bg_color'].';
                                    }
                                ';
                            }

                            //----swatches rounded/square style------
                            if(isset($rexvs_setup_data['rexvs_label_shape_style']) && $rexvs_setup_data['rexvs_label_shape_style'] == 'label_squared'){
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-label:before,
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-label{
                                        border-radius: 0;
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-label img {
                                        border-radius: 0;
                                    }
                                ';
                            }

                            //----swatches style------
                            if(isset($rexvs_setup_data['rexvs_label_shape_height']) && !empty($rexvs_setup_data['rexvs_label_shape_height']) ){
                                $height = $rexvs_setup_data['rexvs_label_shape_height'].'px';
                            }else{
                                $height = 'auto';
                            }

                            if(isset($rexvs_setup_data['rexvs_label_shape_width']) && !empty($rexvs_setup_data['rexvs_label_shape_width']) ){
                                $width = $rexvs_setup_data['rexvs_label_shape_width'].'px';
                            }else{
                                $width = 'auto';
                            }

                            if(isset($rexvs_setup_data['rexvs_label_swatches_font_size']) && !empty($rexvs_setup_data['rexvs_label_swatches_font_size']) ){
                                $font_size = $rexvs_setup_data['rexvs_label_swatches_font_size'];
                            }else{
                                $font_size = 15;
                            }

                            if(isset($rexvs_setup_data['rexvs_label_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_label_swatches_bg_color']) ){
                                $swatches_bg_color = $rexvs_setup_data['rexvs_label_swatches_bg_color'];
                            }else{
                                $swatches_bg_color = '#555';
                            }

                            if(isset($rexvs_setup_data['rexvs_label_swatches_color']) && !empty($rexvs_setup_data['rexvs_label_swatches_color']) ){
                                $swatches_color = $rexvs_setup_data['rexvs_label_swatches_color'];
                            }else{
                                $swatches_color = '#fff';
                            }
                            
                            if(isset($rexvs_setup_data['rexvs_label_top_padding']) && !empty($rexvs_setup_data['rexvs_label_top_padding']) ){
                                $padding_top = $rexvs_setup_data['rexvs_label_top_padding'];
                            }else{
                                $padding_top = 0;
                            }
                            
                            if(isset($rexvs_setup_data['rexvs_label_right_padding']) && !empty($rexvs_setup_data['rexvs_label_right_padding']) ){
                                $padding_right = $rexvs_setup_data['rexvs_label_right_padding'];
                            }else{
                                $padding_right = 0;
                            }
                            
                            if(isset($rexvs_setup_data['rexvs_label_bottom_padding']) && !empty($rexvs_setup_data['rexvs_label_bottom_padding']) ){
                                $padding_bottom = $rexvs_setup_data['rexvs_label_bottom_padding'];
                            }else{
                                $padding_bottom = 0;
                            }
                            
                            if(isset($rexvs_setup_data['rexvs_label_left_padding']) && !empty($rexvs_setup_data['rexvs_label_left_padding']) ){
                                $padding_left = $rexvs_setup_data['rexvs_label_left_padding'];
                            }else{
                                $padding_left = 0;
                            }
                            
                            //--------hover style---------
                            if(isset($rexvs_setup_data['rexvs_label_hvr_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_label_hvr_swatches_bg_color']) ){
                                $swatches_hvr_bg_color = $rexvs_setup_data['rexvs_label_hvr_swatches_bg_color'];
                            }
                            if(isset($rexvs_setup_data['rexvs_label_hvr_swatches_color']) && !empty($rexvs_setup_data['rexvs_label_hvr_swatches_color']) ){
                                $swatches_hvr_color = $rexvs_setup_data['rexvs_label_hvr_swatches_color'];
                            }
                                
                            $html .='
                                .rexvs-variations .rexvs-swatches .swatch.swatch-label{
                                    height: '.$height.';
                                    width: '.$width.';
                                    min-height: 30px;
                                    min-width: 30px;
                                    line-height: normal;
                                    font-size: '.$font_size.'px;
                                    background-color: '.$swatches_bg_color.';
                                    color: '.$swatches_color.';
                                    padding: '.$padding_top.'px '.$padding_right.'px '.$padding_bottom.'px '.$padding_left.'px;
                                }
                                .rexvs-variations .rexvs-swatches .swatch.swatch-label:hover{
                                    background-color: '.$swatches_hvr_bg_color.';
                                    color: '.$swatches_hvr_color.';
                                }
                            ';

                            //----swatches border style------
                            if(isset($rexvs_setup_data['rexvs_label_swatches_border']) && $rexvs_setup_data['rexvs_label_swatches_border'] == 'on'){

                                if(isset($rexvs_setup_data['rexvs_label_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_label_swatches_border_size']) ){
                                    $rexvs_swatches_border_size = $rexvs_setup_data['rexvs_label_swatches_border_size'];
                                }else{
                                    $rexvs_swatches_border_size = 1;
                                }

                                if(isset($rexvs_setup_data['rexvs_label_swatches_border_style']) && !empty($rexvs_setup_data['rexvs_label_swatches_border_style']) ){
                                    $rexvs_swatches_border_style = $rexvs_setup_data['rexvs_label_swatches_border_style'];
                                }else{
                                    $rexvs_swatches_border_style = 'solid';
                                }

                                if(isset($rexvs_setup_data['rexvs_label_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_label_swatches_border_color']) ){
                                    $rexvs_swatches_border_color = $rexvs_setup_data['rexvs_label_swatches_border_color'];
                                }else{
                                    $rexvs_swatches_border_color = '#333';
                                }

                                //------hover style-------
                                if(isset($rexvs_setup_data['rexvs_label_hvr_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_label_hvr_swatches_border_size']) ){
                                    $rexvs_hvr_swatches_border_size = $rexvs_setup_data['rexvs_label_hvr_swatches_border_size'];
                                }
                                if(isset($rexvs_setup_data['rexvs_label_hvr_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_label_hvr_swatches_border_color']) ){
                                    $rexvs_hvr_swatches_border_color = $rexvs_setup_data['rexvs_label_hvr_swatches_border_color'];
                                }
                                
                                //------selected style-------
                                if(isset($rexvs_setup_data['rexvs_label_seltd_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_label_seltd_swatches_border_size']) ){
                                    $rexvs_seltd_swatches_border_size = $rexvs_setup_data['rexvs_label_seltd_swatches_border_size'];
                                }
                                if(isset($rexvs_setup_data['rexvs_label_seltd_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_label_seltd_swatches_border_color']) ){
                                    $rexvs_seltd_swatches_border_color = $rexvs_setup_data['rexvs_label_seltd_swatches_border_color'];
                                }
                                
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-label{
                                        border: '.$rexvs_swatches_border_size.'px '.$rexvs_swatches_border_style.' ' .$rexvs_swatches_border_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-label:hover{
                                        border-width: '.$rexvs_hvr_swatches_border_size.'px;
                                        border-color: '.$rexvs_hvr_swatches_border_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.swatch-label.selected{
                                        border-width: '.$rexvs_seltd_swatches_border_size.'px;
                                        border-color: '.$rexvs_seltd_swatches_border_color.';
                                    }
                                ';
                            }

                            //----selected swatches style------
                            if(isset($rexvs_setup_data['rexvs_label_seltd_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_label_seltd_swatches_bg_color']) ){
                                $rexvs_seltd_swatches_bg_color = $rexvs_setup_data['rexvs_label_seltd_swatches_bg_color'];
                            }else{
                                $rexvs_seltd_swatches_bg_color = '#444';
                            }

                            if(isset($rexvs_setup_data['rexvs_label_seltd_swatches_color']) && !empty($rexvs_setup_data['rexvs_label_seltd_swatches_color']) ){
                                $rexvs_seltd_swatches_color = $rexvs_setup_data['rexvs_label_seltd_swatches_color'];
                            }else{
                                $rexvs_seltd_swatches_color = '#fff';
                            }

                            $html .='
                                .rexvs-variations .rexvs-swatches .swatch.swatch-label:before{
                                    background-color: '.$rexvs_seltd_swatches_bg_color.';
                                    color: '.$rexvs_seltd_swatches_color.';
                                }
                                .rexvs-variations .rexvs-swatches .swatch.swatch-label:after{
                                    border-color: '.$rexvs_seltd_swatches_color.';
                                }

                            ';
                        
                        }//--end  rexvs_individual_attr_style condition--

                    }//--end rexvs_disable_stylesheet condition--

				$html .= '</style>';
				//===dynamic Style===//
				break;

			case 'default':
				// $name = substr($name, 0, 2);
				$html  = sprintf(
					'<span class="swatch rex-default-swatch swatch-%s %s" data-value="%s">%s<p class="cv-tooltip">%s</p></span>',
					esc_attr( $term->slug ),
					$selected,
					// esc_attr( $term->description ),
					esc_attr( $term->slug ),
					esc_html( $name ),
					esc_attr( $tooltip )
				);
                //===dynamic Style===//
				$html .= '<style>';
                    if(isset($rexvs_setup_data['rexvs_disable_stylesheet']) && $rexvs_setup_data['rexvs_disable_stylesheet'] != 'on'){
                        
                        if($rexvs_setup_data['rexvs_individual_attr_style'] == 'on'){
                        
                            if(isset($rexvs_setup_data['rexvs_select_tooltip']) && $rexvs_setup_data['rexvs_select_tooltip'] == 'on'){
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch .cv-tooltip{
                                        display: block;
                                        font-size : '.$rexvs_setup_data['rexvs_select_tooltip_fnt_size'].'px;
                                        color: '.$rexvs_setup_data['rexvs_select_tooltip_color'].';
                                        background-color: '.$rexvs_setup_data['rexvs_select_tooltip_bg_color'].';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch .cv-tooltip:before{
                                        background-color: '.$rexvs_setup_data['rexvs_select_tooltip_bg_color'].';
                                    }
                                ';
                            }

                            //----swatches rounded/square style------
                            if(isset($rexvs_setup_data['rexvs_select_shape_style']) && $rexvs_setup_data['rexvs_select_shape_style'] == 'label_squared'){
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch:before,
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch{
                                        border-radius: 0;
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch img {
                                        border-radius: 0;
                                    }
                                ';
                            }

                            //----swatches style------
                            if(isset($rexvs_setup_data['rexvs_select_shape_height']) && !empty($rexvs_setup_data['rexvs_select_shape_height']) ){
                                $height = $rexvs_setup_data['rexvs_select_shape_height'].'px';
                            }else{
                                $height = 'auto';
                            }

                            if(isset($rexvs_setup_data['rexvs_select_shape_width']) && !empty($rexvs_setup_data['rexvs_select_shape_width']) ){
                                $width = $rexvs_setup_data['rexvs_select_shape_width'].'px';
                            }else{
                                $width = 'auto';
                            }

                            if(isset($rexvs_setup_data['rexvs_select_swatches_font_size']) && !empty($rexvs_setup_data['rexvs_select_swatches_font_size']) ){
                                $font_size = $rexvs_setup_data['rexvs_select_swatches_font_size'];
                            }else{
                                $font_size = 15;
                            }

                            if(isset($rexvs_setup_data['rexvs_select_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_select_swatches_bg_color']) ){
                                $swatches_bg_color = $rexvs_setup_data['rexvs_select_swatches_bg_color'];
                            }else{
                                $swatches_bg_color = '#555';
                            }

                            if(isset($rexvs_setup_data['rexvs_select_swatches_color']) && !empty($rexvs_setup_data['rexvs_select_swatches_color']) ){
                                $swatches_color = $rexvs_setup_data['rexvs_select_swatches_color'];
                            }else{
                                $swatches_color = '#fff';
                            }
                            
                            if(isset($rexvs_setup_data['rexvs_select_top_padding']) && !empty($rexvs_setup_data['rexvs_select_top_padding']) ){
                                $padding_top = $rexvs_setup_data['rexvs_select_top_padding'];
                            }else{
                                $padding_top = 0;
                            }
                            
                            if(isset($rexvs_setup_data['rexvs_select_right_padding']) && !empty($rexvs_setup_data['rexvs_select_right_padding']) ){
                                $padding_right = $rexvs_setup_data['rexvs_select_right_padding'];
                            }else{
                                $padding_right = 0;
                            }
                            
                            if(isset($rexvs_setup_data['rexvs_select_bottom_padding']) && !empty($rexvs_setup_data['rexvs_select_bottom_padding']) ){
                                $padding_bottom = $rexvs_setup_data['rexvs_select_bottom_padding'];
                            }else{
                                $padding_bottom = 0;
                            }
                            
                            if(isset($rexvs_setup_data['rexvs_select_left_padding']) && !empty($rexvs_setup_data['rexvs_select_left_padding']) ){
                                $padding_left = $rexvs_setup_data['rexvs_select_left_padding'];
                            }else{
                                $padding_left = 0;
                            }

                            //--------hover style---------
                            if(isset($rexvs_setup_data['rexvs_select_hvr_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_select_hvr_swatches_bg_color']) ){
                                $swatches_hvr_bg_color = $rexvs_setup_data['rexvs_select_hvr_swatches_bg_color'];
                            }
                            if(isset($rexvs_setup_data['rexvs_select_hvr_swatches_color']) && !empty($rexvs_setup_data['rexvs_select_hvr_swatches_color']) ){
                                $swatches_hvr_color = $rexvs_setup_data['rexvs_select_hvr_swatches_color'];
                            }
                            
                            $html .='
                                .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch{
                                    height: '.$height.';
                                    width: '.$width.';
                                    min-height: 30px;
                                    min-width: 30px;
                                    line-height: normal;
                                    font-size: '.$font_size.'px;
                                    background-color: '.$swatches_bg_color.';
                                    color: '.$swatches_color.';
                                    padding: '.$padding_top.'px '.$padding_right.'px '.$padding_bottom.'px '.$padding_left.'px;
                                }
                                .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch:hover{
                                    background-color: '.$swatches_hvr_bg_color.';
                                    color: '.$swatches_hvr_color.';
                                }
                            ';

                            //----swatches border style------
                            if(isset($rexvs_setup_data['rexvs_select_swatches_border']) && $rexvs_setup_data['rexvs_select_swatches_border'] == 'on'){

                                if(isset($rexvs_setup_data['rexvs_select_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_select_swatches_border_size']) ){
                                    $rexvs_swatches_border_size = $rexvs_setup_data['rexvs_select_swatches_border_size'];
                                }else{
                                    $rexvs_swatches_border_size = 1;
                                }

                                if(isset($rexvs_setup_data['rexvs_select_swatches_border_style']) && !empty($rexvs_setup_data['rexvs_select_swatches_border_style']) ){
                                    $rexvs_swatches_border_style = $rexvs_setup_data['rexvs_select_swatches_border_style'];
                                }else{
                                    $rexvs_swatches_border_style = 'solid';
                                }

                                if(isset($rexvs_setup_data['rexvs_select_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_select_swatches_border_color']) ){
                                    $rexvs_swatches_border_color = $rexvs_setup_data['rexvs_select_swatches_border_color'];
                                }else{
                                    $rexvs_swatches_border_color = '#333';
                                }

                                //------hover style-------
                                if(isset($rexvs_setup_data['rexvs_select_hvr_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_select_hvr_swatches_border_size']) ){
                                    $rexvs_hvr_swatches_border_size = $rexvs_setup_data['rexvs_select_hvr_swatches_border_size'];
                                }
                                if(isset($rexvs_setup_data['rexvs_select_hvr_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_select_hvr_swatches_border_color']) ){
                                    $rexvs_hvr_swatches_border_color = $rexvs_setup_data['rexvs_select_hvr_swatches_border_color'];
                                }
                                
                                //------selected style-------
                                if(isset($rexvs_setup_data['rexvs_select_seltd_swatches_border_size']) && !empty($rexvs_setup_data['rexvs_select_seltd_swatches_border_size']) ){
                                    $rexvs_seltd_swatches_border_size = $rexvs_setup_data['rexvs_select_seltd_swatches_border_size'];
                                }
                                if(isset($rexvs_setup_data['rexvs_select_seltd_swatches_border_color']) && !empty($rexvs_setup_data['rexvs_select_seltd_swatches_border_color']) ){
                                    $rexvs_seltd_swatches_border_color = $rexvs_setup_data['rexvs_select_seltd_swatches_border_color'];
                                }
                                
                                $html .='
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch{
                                        border: '.$rexvs_swatches_border_size.'px '.$rexvs_swatches_border_style.' ' .$rexvs_swatches_border_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch:hover{
                                        border-width: '.$rexvs_hvr_swatches_border_size.'px;
                                        border-color: '.$rexvs_hvr_swatches_border_color.';
                                    }
                                    .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch.selected{
                                        border-width: '.$rexvs_seltd_swatches_border_size.'px;
                                        border-color: '.$rexvs_seltd_swatches_border_color.';
                                    }
                                ';
                            }

                            //----selected swatches style------
                            if(isset($rexvs_setup_data['rexvs_select_seltd_swatches_bg_color']) && !empty($rexvs_setup_data['rexvs_select_seltd_swatches_bg_color']) ){
                                $rexvs_seltd_swatches_bg_color = $rexvs_setup_data['rexvs_select_seltd_swatches_bg_color'];
                            }else{
                                $rexvs_seltd_swatches_bg_color = '#444';
                            }

                            if(isset($rexvs_setup_data['rexvs_select_seltd_swatches_color']) && !empty($rexvs_setup_data['rexvs_select_seltd_swatches_color']) ){
                                $rexvs_seltd_swatches_color = $rexvs_setup_data['rexvs_select_seltd_swatches_color'];
                            }else{
                                $rexvs_seltd_swatches_color = '#fff';
                            }

                            $html .='
                                .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch:before{
                                    background-color: '.$rexvs_seltd_swatches_bg_color.';
                                    color: '.$rexvs_seltd_swatches_color.';
                                }
                                .rexvs-variations .rexvs-swatches .swatch.rex-default-swatch:after{
                                    border-color: '.$rexvs_seltd_swatches_color.';
                                }

                            ';
                        
                        }//--end  rexvs_individual_attr_style condition--

                    }//--end rexvs_disable_stylesheet condition--

				$html .= '</style>';
				//===dynamic Style===//
				break;

		}

		return $html;
	}

}
