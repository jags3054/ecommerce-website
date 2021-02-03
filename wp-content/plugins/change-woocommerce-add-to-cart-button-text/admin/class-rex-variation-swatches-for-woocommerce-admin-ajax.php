<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    Variation_Swatches_For_Woocommerce
 * @subpackage Variation_Swatches_For_Woocommerce/admin
 */

class Variation_Swatches_For_Woocommerce_Admin_Ajax {

  /**
  * General settings
  */
  function rexvs_settings_submit() {
    $rexvs_default_dropdown_to_button = sanitize_text_field($_POST['rexvs_default_dropdown_to_button']);
    $rexvs_delete_data = sanitize_text_field($_POST['rexvs_delete_data']);
    $rexvs_disable_stylesheet = sanitize_text_field($_POST['rexvs_disable_stylesheet']);
    $rexvs_individual_attr_style = sanitize_text_field($_POST['rexvs_individual_attr_style']);
    $rexvs_tooltip = sanitize_text_field($_POST['rexvs_tooltip']);

    $rexvs_shape_style = sanitize_text_field($_POST['rexvs_shape_style']);
    $rexvs_shape_height = sanitize_text_field($_POST['rexvs_shape_height']);
    $rexvs_shape_width = sanitize_text_field($_POST['rexvs_shape_width']);

    $rexvs_tooltip_fnt_size = sanitize_text_field($_POST['rexvs_tooltip_fnt_size']);
    $rexvs_tooltip_color = sanitize_text_field($_POST['rexvs_tooltip_color']);
    $rexvs_tooltip_bg_color = sanitize_text_field($_POST['rexvs_tooltip_bg_color']);

    $rexvs_swatches_font_size = sanitize_text_field($_POST['rexvs_swatches_font_size']);
    $rexvs_swatches_bg_color = sanitize_text_field($_POST['rexvs_swatches_bg_color']);
    $rexvs_swatches_color = sanitize_text_field($_POST['rexvs_swatches_color']);

    $rexvs_swatches_border = sanitize_text_field($_POST['rexvs_swatches_border']);
    $rexvs_swatches_border_size = sanitize_text_field($_POST['rexvs_swatches_border_size']);
    $rexvs_swatches_border_style = sanitize_text_field($_POST['rexvs_swatches_border_style']);
    $rexvs_swatches_border_color = sanitize_text_field($_POST['rexvs_swatches_border_color']);

    $rexvs_seltd_swatches_bg_color = sanitize_text_field($_POST['rexvs_seltd_swatches_bg_color']);
    $rexvs_seltd_swatches_color = sanitize_text_field($_POST['rexvs_seltd_swatches_color']);
    $rexvs_seltd_swatches_border_size = sanitize_text_field($_POST['rexvs_seltd_swatches_border_size']);
    $rexvs_seltd_swatches_border_color = sanitize_text_field($_POST['rexvs_seltd_swatches_border_color']);

    $rexvs_hvr_swatches_bg_color = sanitize_text_field($_POST['rexvs_hvr_swatches_bg_color']);
    $rexvs_hvr_swatches_color = sanitize_text_field($_POST['rexvs_hvr_swatches_color']);
    $rexvs_hvr_swatches_border_size = sanitize_text_field($_POST['rexvs_hvr_swatches_border_size']);
    $rexvs_hvr_swatches_border_color = sanitize_text_field($_POST['rexvs_hvr_swatches_border_color']);

    $rexvs_clr_btn_height = sanitize_text_field($_POST['rexvs_clr_btn_height']);
    $rexvs_clr_btn_width = sanitize_text_field($_POST['rexvs_clr_btn_width']);
    $rexvs_clr_btn_font_size = sanitize_text_field($_POST['rexvs_clr_btn_font_size']);
    $rexvs_clr_btn_radius = sanitize_text_field($_POST['rexvs_clr_btn_radius']);
    $rexvs_clr_btn_bg_color = sanitize_text_field($_POST['rexvs_clr_btn_bg_color']);
    $rexvs_clr_btn_color = sanitize_text_field($_POST['rexvs_clr_btn_color']);

    //------color attribute style-------
    $rexvs_color_tooltip = sanitize_text_field($_POST['rexvs_color_tooltip']);

    $rexvs_color_shape_style = sanitize_text_field($_POST['rexvs_color_shape_style']);
    $rexvs_color_shape_height = sanitize_text_field($_POST['rexvs_color_shape_height']);
    $rexvs_color_shape_width = sanitize_text_field($_POST['rexvs_color_shape_width']);

    $rexvs_color_tooltip_fnt_size = sanitize_text_field($_POST['rexvs_color_tooltip_fnt_size']);
    $rexvs_color_tooltip_color = sanitize_text_field($_POST['rexvs_color_tooltip_color']);
    $rexvs_color_tooltip_bg_color = sanitize_text_field($_POST['rexvs_color_tooltip_bg_color']);

    $rexvs_color_swatches_font_size = sanitize_text_field($_POST['rexvs_color_swatches_font_size']);
    $rexvs_color_swatches_bg_color = sanitize_text_field($_POST['rexvs_color_swatches_bg_color']);
    $rexvs_color_swatches_color = sanitize_text_field($_POST['rexvs_color_swatches_color']);

    $rexvs_color_swatches_border = sanitize_text_field($_POST['rexvs_color_swatches_border']);
    $rexvs_color_swatches_border_size = sanitize_text_field($_POST['rexvs_color_swatches_border_size']);
    $rexvs_color_swatches_border_style = sanitize_text_field($_POST['rexvs_color_swatches_border_style']);
    $rexvs_color_swatches_border_color = sanitize_text_field($_POST['rexvs_color_swatches_border_color']);

    $rexvs_color_seltd_swatches_bg_color = sanitize_text_field($_POST['rexvs_color_seltd_swatches_bg_color']);
    $rexvs_color_seltd_swatches_color = sanitize_text_field($_POST['rexvs_color_seltd_swatches_color']);
    $rexvs_color_seltd_swatches_border_size = sanitize_text_field($_POST['rexvs_color_seltd_swatches_border_size']);
    $rexvs_color_seltd_swatches_border_color = sanitize_text_field($_POST['rexvs_color_seltd_swatches_border_color']);

    $rexvs_color_hvr_swatches_bg_color = sanitize_text_field($_POST['rexvs_color_hvr_swatches_bg_color']);
    $rexvs_color_hvr_swatches_color = sanitize_text_field($_POST['rexvs_color_hvr_swatches_color']);
    $rexvs_color_hvr_swatches_border_size = sanitize_text_field($_POST['rexvs_color_hvr_swatches_border_size']);
    $rexvs_color_hvr_swatches_border_color = sanitize_text_field($_POST['rexvs_color_hvr_swatches_border_color']);

    //------image attribute style-------
    $rexvs_image_tooltip = sanitize_text_field($_POST['rexvs_image_tooltip']);

    $rexvs_image_shape_style = sanitize_text_field($_POST['rexvs_image_shape_style']);
    $rexvs_image_shape_height = sanitize_text_field($_POST['rexvs_image_shape_height']);
    $rexvs_image_shape_width = sanitize_text_field($_POST['rexvs_image_shape_width']);

    $rexvs_image_tooltip_fnt_size = sanitize_text_field($_POST['rexvs_image_tooltip_fnt_size']);
    $rexvs_image_tooltip_color = sanitize_text_field($_POST['rexvs_image_tooltip_color']);
    $rexvs_image_tooltip_bg_color = sanitize_text_field($_POST['rexvs_image_tooltip_bg_color']);

    $rexvs_image_swatches_font_size = sanitize_text_field($_POST['rexvs_image_swatches_font_size']);
    $rexvs_image_swatches_bg_color = sanitize_text_field($_POST['rexvs_image_swatches_bg_color']);
    $rexvs_image_swatches_color = sanitize_text_field($_POST['rexvs_image_swatches_color']);

    $rexvs_image_swatches_border = sanitize_text_field($_POST['rexvs_image_swatches_border']);
    $rexvs_image_swatches_border_size = sanitize_text_field($_POST['rexvs_image_swatches_border_size']);
    $rexvs_image_swatches_border_style = sanitize_text_field($_POST['rexvs_image_swatches_border_style']);
    $rexvs_image_swatches_border_color = sanitize_text_field($_POST['rexvs_image_swatches_border_color']);

    $rexvs_image_seltd_swatches_bg_color = sanitize_text_field($_POST['rexvs_image_seltd_swatches_bg_color']);
    $rexvs_image_seltd_swatches_color = sanitize_text_field($_POST['rexvs_image_seltd_swatches_color']);
    $rexvs_image_seltd_swatches_border_size = sanitize_text_field($_POST['rexvs_image_seltd_swatches_border_size']);
    $rexvs_image_seltd_swatches_border_color = sanitize_text_field($_POST['rexvs_image_seltd_swatches_border_color']);

    $rexvs_image_hvr_swatches_bg_color = sanitize_text_field($_POST['rexvs_image_hvr_swatches_bg_color']);
    $rexvs_image_hvr_swatches_color = sanitize_text_field($_POST['rexvs_image_hvr_swatches_color']);
    $rexvs_image_hvr_swatches_border_size = sanitize_text_field($_POST['rexvs_image_hvr_swatches_border_size']);
    $rexvs_image_hvr_swatches_border_color = sanitize_text_field($_POST['rexvs_image_hvr_swatches_border_color']);

    //------label attribute style-------
    $rexvs_label_tooltip = sanitize_text_field($_POST['rexvs_label_tooltip']);

    $rexvs_label_shape_style = sanitize_text_field($_POST['rexvs_label_shape_style']);
    $rexvs_label_shape_height = sanitize_text_field($_POST['rexvs_label_shape_height']);
    $rexvs_label_shape_width = sanitize_text_field($_POST['rexvs_label_shape_width']);

    $rexvs_label_tooltip_fnt_size = sanitize_text_field($_POST['rexvs_label_tooltip_fnt_size']);
    $rexvs_label_tooltip_color = sanitize_text_field($_POST['rexvs_label_tooltip_color']);
    $rexvs_label_tooltip_bg_color = sanitize_text_field($_POST['rexvs_label_tooltip_bg_color']);

    $rexvs_label_swatches_font_size = sanitize_text_field($_POST['rexvs_label_swatches_font_size']);
    $rexvs_label_swatches_bg_color = sanitize_text_field($_POST['rexvs_label_swatches_bg_color']);
    $rexvs_label_swatches_color = sanitize_text_field($_POST['rexvs_label_swatches_color']);

    $rexvs_label_top_padding = sanitize_text_field($_POST['rexvs_label_top_padding']);
    $rexvs_label_right_padding = sanitize_text_field($_POST['rexvs_label_right_padding']);
    $rexvs_label_bottom_padding = sanitize_text_field($_POST['rexvs_label_bottom_padding']);
    $rexvs_label_left_padding = sanitize_text_field($_POST['rexvs_label_left_padding']);

    $rexvs_label_swatches_border = sanitize_text_field($_POST['rexvs_label_swatches_border']);
    $rexvs_label_swatches_border_size = sanitize_text_field($_POST['rexvs_label_swatches_border_size']);
    $rexvs_label_swatches_border_style = sanitize_text_field($_POST['rexvs_label_swatches_border_style']);
    $rexvs_label_swatches_border_color = sanitize_text_field($_POST['rexvs_label_swatches_border_color']);

    $rexvs_label_seltd_swatches_bg_color = sanitize_text_field($_POST['rexvs_label_seltd_swatches_bg_color']);
    $rexvs_label_seltd_swatches_color = sanitize_text_field($_POST['rexvs_label_seltd_swatches_color']);
    $rexvs_label_seltd_swatches_border_size = sanitize_text_field($_POST['rexvs_label_seltd_swatches_border_size']);
    $rexvs_label_seltd_swatches_border_color = sanitize_text_field($_POST['rexvs_label_seltd_swatches_border_color']);

    $rexvs_label_hvr_swatches_bg_color = sanitize_text_field($_POST['rexvs_label_hvr_swatches_bg_color']);
    $rexvs_label_hvr_swatches_color = sanitize_text_field($_POST['rexvs_label_hvr_swatches_color']);
    $rexvs_label_hvr_swatches_border_size = sanitize_text_field($_POST['rexvs_label_hvr_swatches_border_size']);
    $rexvs_label_hvr_swatches_border_color = sanitize_text_field($_POST['rexvs_label_hvr_swatches_border_color']);

    //------select attribute style-------
    $rexvs_select_tooltip = sanitize_text_field($_POST['rexvs_select_tooltip']);

    $rexvs_select_shape_style = sanitize_text_field($_POST['rexvs_select_shape_style']);
    $rexvs_select_shape_height = sanitize_text_field($_POST['rexvs_select_shape_height']);
    $rexvs_select_shape_width = sanitize_text_field($_POST['rexvs_select_shape_width']);

    $rexvs_select_tooltip_fnt_size = sanitize_text_field($_POST['rexvs_select_tooltip_fnt_size']);
    $rexvs_select_tooltip_color = sanitize_text_field($_POST['rexvs_select_tooltip_color']);
    $rexvs_select_tooltip_bg_color = sanitize_text_field($_POST['rexvs_select_tooltip_bg_color']);

    $rexvs_select_swatches_font_size = sanitize_text_field($_POST['rexvs_select_swatches_font_size']);
    $rexvs_select_swatches_bg_color = sanitize_text_field($_POST['rexvs_select_swatches_bg_color']);
    $rexvs_select_swatches_color = sanitize_text_field($_POST['rexvs_select_swatches_color']);

    $rexvs_select_top_padding = sanitize_text_field($_POST['rexvs_select_top_padding']);
    $rexvs_select_right_padding = sanitize_text_field($_POST['rexvs_select_right_padding']);
    $rexvs_select_bottom_padding = sanitize_text_field($_POST['rexvs_select_bottom_padding']);
    $rexvs_select_left_padding = sanitize_text_field($_POST['rexvs_select_left_padding']);

    $rexvs_select_swatches_border = sanitize_text_field($_POST['rexvs_select_swatches_border']);
    $rexvs_select_swatches_border_size = sanitize_text_field($_POST['rexvs_select_swatches_border_size']);
    $rexvs_select_swatches_border_style = sanitize_text_field($_POST['rexvs_select_swatches_border_style']);
    $rexvs_select_swatches_border_color = sanitize_text_field($_POST['rexvs_select_swatches_border_color']);

    $rexvs_select_seltd_swatches_bg_color = sanitize_text_field($_POST['rexvs_select_seltd_swatches_bg_color']);
    $rexvs_select_seltd_swatches_color = sanitize_text_field($_POST['rexvs_select_seltd_swatches_color']);
    $rexvs_select_seltd_swatches_border_size = sanitize_text_field($_POST['rexvs_select_seltd_swatches_border_size']);
    $rexvs_select_seltd_swatches_border_color = sanitize_text_field($_POST['rexvs_select_seltd_swatches_border_color']);

    $rexvs_select_hvr_swatches_bg_color = sanitize_text_field($_POST['rexvs_select_hvr_swatches_bg_color']);
    $rexvs_select_hvr_swatches_color = sanitize_text_field($_POST['rexvs_select_hvr_swatches_color']);
    $rexvs_select_hvr_swatches_border_size = sanitize_text_field($_POST['rexvs_select_hvr_swatches_border_size']);
    $rexvs_select_hvr_swatches_border_color = sanitize_text_field($_POST['rexvs_select_hvr_swatches_border_color']);

    $setup_data= array(
      'rexvs_default_dropdown_to_button' => $rexvs_default_dropdown_to_button,
      'rexvs_delete_data' => $rexvs_delete_data,
      'rexvs_disable_stylesheet' => $rexvs_disable_stylesheet,
      'rexvs_individual_attr_style' => $rexvs_individual_attr_style,
      'rexvs_tooltip' => $rexvs_tooltip,

      'rexvs_shape_style' => $rexvs_shape_style,
      'rexvs_shape_height' => $rexvs_shape_height,
      'rexvs_shape_width' => $rexvs_shape_width,

      'rexvs_tooltip_fnt_size' => $rexvs_tooltip_fnt_size,
      'rexvs_tooltip_color' => $rexvs_tooltip_color,
      'rexvs_tooltip_bg_color' => $rexvs_tooltip_bg_color,

      'rexvs_swatches_font_size' => $rexvs_swatches_font_size,
      'rexvs_swatches_bg_color' => $rexvs_swatches_bg_color,
      'rexvs_swatches_color' => $rexvs_swatches_color,

      'rexvs_swatches_border' => $rexvs_swatches_border,
      'rexvs_swatches_border_size' => $rexvs_swatches_border_size,
      'rexvs_swatches_border_style' => $rexvs_swatches_border_style,
      'rexvs_swatches_border_color' => $rexvs_swatches_border_color,

      'rexvs_seltd_swatches_bg_color' => $rexvs_seltd_swatches_bg_color,
      'rexvs_seltd_swatches_color' => $rexvs_seltd_swatches_color,
      'rexvs_seltd_swatches_border_size' => $rexvs_seltd_swatches_border_size,
      'rexvs_seltd_swatches_border_color' => $rexvs_seltd_swatches_border_color,

      'rexvs_hvr_swatches_bg_color' => $rexvs_hvr_swatches_bg_color,
      'rexvs_hvr_swatches_color' => $rexvs_hvr_swatches_color,
      'rexvs_hvr_swatches_border_size' => $rexvs_hvr_swatches_border_size,
      'rexvs_hvr_swatches_border_color' => $rexvs_hvr_swatches_border_color,

      'rexvs_clr_btn_height' => $rexvs_clr_btn_height,
      'rexvs_clr_btn_width' => $rexvs_clr_btn_width,
      'rexvs_clr_btn_font_size' => $rexvs_clr_btn_font_size,
      'rexvs_clr_btn_radius' => $rexvs_clr_btn_radius,
      'rexvs_clr_btn_bg_color' => $rexvs_clr_btn_bg_color,
      'rexvs_clr_btn_color' => $rexvs_clr_btn_color,


    //------------color attribute style------------
      'rexvs_color_tooltip' => $rexvs_color_tooltip,

      'rexvs_color_shape_style' => $rexvs_color_shape_style,
      'rexvs_color_shape_height' => $rexvs_color_shape_height,
      'rexvs_color_shape_width' => $rexvs_color_shape_width,

      'rexvs_color_tooltip_fnt_size' => $rexvs_color_tooltip_fnt_size,
      'rexvs_color_tooltip_color' => $rexvs_color_tooltip_color,
      'rexvs_color_tooltip_bg_color' => $rexvs_color_tooltip_bg_color,

      'rexvs_color_swatches_font_size' => $rexvs_color_swatches_font_size,
      'rexvs_color_swatches_bg_color' => $rexvs_color_swatches_bg_color,
      'rexvs_color_swatches_color' => $rexvs_color_swatches_color,

      'rexvs_color_swatches_border' => $rexvs_color_swatches_border,
      'rexvs_color_swatches_border_size' => $rexvs_color_swatches_border_size,
      'rexvs_color_swatches_border_style' => $rexvs_color_swatches_border_style,
      'rexvs_color_swatches_border_color' => $rexvs_color_swatches_border_color,

      'rexvs_color_seltd_swatches_bg_color' => $rexvs_color_seltd_swatches_bg_color,
      'rexvs_color_seltd_swatches_color' => $rexvs_color_seltd_swatches_color,
      'rexvs_color_seltd_swatches_border_size' => $rexvs_color_seltd_swatches_border_size,
      'rexvs_color_seltd_swatches_border_color' => $rexvs_color_seltd_swatches_border_color,

      'rexvs_color_hvr_swatches_bg_color' => $rexvs_color_hvr_swatches_bg_color,
      'rexvs_color_hvr_swatches_color' => $rexvs_color_hvr_swatches_color,
      'rexvs_color_hvr_swatches_border_size' => $rexvs_color_hvr_swatches_border_size,
      'rexvs_color_hvr_swatches_border_color' => $rexvs_color_hvr_swatches_border_color,


    //------------image attribute style------------
      'rexvs_image_tooltip' => $rexvs_image_tooltip,

      'rexvs_image_shape_style' => $rexvs_image_shape_style,
      'rexvs_image_shape_height' => $rexvs_image_shape_height,
      'rexvs_image_shape_width' => $rexvs_image_shape_width,

      'rexvs_image_tooltip_fnt_size' => $rexvs_image_tooltip_fnt_size,
      'rexvs_image_tooltip_color' => $rexvs_image_tooltip_color,
      'rexvs_image_tooltip_bg_color' => $rexvs_image_tooltip_bg_color,

      'rexvs_image_swatches_font_size' => $rexvs_image_swatches_font_size,
      'rexvs_image_swatches_bg_color' => $rexvs_image_swatches_bg_color,
      'rexvs_image_swatches_color' => $rexvs_image_swatches_color,

      'rexvs_image_swatches_border' => $rexvs_image_swatches_border,
      'rexvs_image_swatches_border_size' => $rexvs_image_swatches_border_size,
      'rexvs_image_swatches_border_style' => $rexvs_image_swatches_border_style,
      'rexvs_image_swatches_border_color' => $rexvs_image_swatches_border_color,

      'rexvs_image_seltd_swatches_bg_color' => $rexvs_image_seltd_swatches_bg_color,
      'rexvs_image_seltd_swatches_color' => $rexvs_image_seltd_swatches_color,
      'rexvs_image_seltd_swatches_border_size' => $rexvs_image_seltd_swatches_border_size,
      'rexvs_image_seltd_swatches_border_color' => $rexvs_image_seltd_swatches_border_color,

      'rexvs_image_hvr_swatches_bg_color' => $rexvs_image_hvr_swatches_bg_color,
      'rexvs_image_hvr_swatches_color' => $rexvs_image_hvr_swatches_color,
      'rexvs_image_hvr_swatches_border_size' => $rexvs_image_hvr_swatches_border_size,
      'rexvs_image_hvr_swatches_border_color' => $rexvs_image_hvr_swatches_border_color,


    //------------label attribute style------------
      'rexvs_label_tooltip' => $rexvs_label_tooltip,

      'rexvs_label_shape_style' => $rexvs_label_shape_style,
      'rexvs_label_shape_height' => $rexvs_label_shape_height,
      'rexvs_label_shape_width' => $rexvs_label_shape_width,

      'rexvs_label_tooltip_fnt_size' => $rexvs_label_tooltip_fnt_size,
      'rexvs_label_tooltip_color' => $rexvs_label_tooltip_color,
      'rexvs_label_tooltip_bg_color' => $rexvs_label_tooltip_bg_color,

      'rexvs_label_swatches_font_size' => $rexvs_label_swatches_font_size,
      'rexvs_label_swatches_bg_color' => $rexvs_label_swatches_bg_color,
      'rexvs_label_swatches_color' => $rexvs_label_swatches_color,

      'rexvs_label_top_padding' => $rexvs_label_top_padding,
      'rexvs_label_right_padding' => $rexvs_label_right_padding,
      'rexvs_label_bottom_padding' => $rexvs_label_bottom_padding,
      'rexvs_label_left_padding' => $rexvs_label_left_padding,

      'rexvs_label_swatches_border' => $rexvs_label_swatches_border,
      'rexvs_label_swatches_border_size' => $rexvs_label_swatches_border_size,
      'rexvs_label_swatches_border_style' => $rexvs_label_swatches_border_style,
      'rexvs_label_swatches_border_color' => $rexvs_label_swatches_border_color,

      'rexvs_label_seltd_swatches_bg_color' => $rexvs_label_seltd_swatches_bg_color,
      'rexvs_label_seltd_swatches_color' => $rexvs_label_seltd_swatches_color,
      'rexvs_label_seltd_swatches_border_size' => $rexvs_label_seltd_swatches_border_size,
      'rexvs_label_seltd_swatches_border_color' => $rexvs_label_seltd_swatches_border_color,

      'rexvs_label_hvr_swatches_bg_color' => $rexvs_label_hvr_swatches_bg_color,
      'rexvs_label_hvr_swatches_color' => $rexvs_label_hvr_swatches_color,
      'rexvs_label_hvr_swatches_border_size' => $rexvs_label_hvr_swatches_border_size,
      'rexvs_label_hvr_swatches_border_color' => $rexvs_label_hvr_swatches_border_color,


    //------------select attribute style------------
      'rexvs_select_tooltip' => $rexvs_select_tooltip,

      'rexvs_select_shape_style' => $rexvs_select_shape_style,
      'rexvs_select_shape_height' => $rexvs_select_shape_height,
      'rexvs_select_shape_width' => $rexvs_select_shape_width,

      'rexvs_select_tooltip_fnt_size' => $rexvs_select_tooltip_fnt_size,
      'rexvs_select_tooltip_color' => $rexvs_select_tooltip_color,
      'rexvs_select_tooltip_bg_color' => $rexvs_select_tooltip_bg_color,

      'rexvs_select_swatches_font_size' => $rexvs_select_swatches_font_size,
      'rexvs_select_swatches_bg_color' => $rexvs_select_swatches_bg_color,
      'rexvs_select_swatches_color' => $rexvs_select_swatches_color,

      'rexvs_select_top_padding' => $rexvs_select_top_padding,
      'rexvs_select_right_padding' => $rexvs_select_right_padding,
      'rexvs_select_bottom_padding' => $rexvs_select_bottom_padding,
      'rexvs_select_left_padding' => $rexvs_select_left_padding,

      'rexvs_select_swatches_border' => $rexvs_select_swatches_border,
      'rexvs_select_swatches_border_size' => $rexvs_select_swatches_border_size,
      'rexvs_select_swatches_border_style' => $rexvs_select_swatches_border_style,
      'rexvs_select_swatches_border_color' => $rexvs_select_swatches_border_color,

      'rexvs_select_seltd_swatches_bg_color' => $rexvs_select_seltd_swatches_bg_color,
      'rexvs_select_seltd_swatches_color' => $rexvs_select_seltd_swatches_color,
      'rexvs_select_seltd_swatches_border_size' => $rexvs_select_seltd_swatches_border_size,
      'rexvs_select_seltd_swatches_border_color' => $rexvs_select_seltd_swatches_border_color,

      'rexvs_select_hvr_swatches_bg_color' => $rexvs_select_hvr_swatches_bg_color,
      'rexvs_select_hvr_swatches_color' => $rexvs_hvr_select_swatches_color,
      'rexvs_select_hvr_swatches_border_size' => $rexvs_select_hvr_swatches_border_size,
      'rexvs_select_hvr_swatches_border_color' => $rexvs_select_hvr_swatches_border_color,

    );
    $data = serialize($setup_data);
    update_option('rexvs_setup_data', $data);

    //==add to cart==//
    $simple_single_button_text = sanitize_text_field($_POST['simple_single_button_text']);
    update_option('simple_single_button_text', $simple_single_button_text);

    $variable_single_button_text = sanitize_text_field($_POST['variable_single_button_text']);
    update_option('variable_single_button_text', $variable_single_button_text);

    $grouped_single_button_text = sanitize_text_field($_POST['grouped_single_button_text']);
    update_option('grouped_single_button_text', $grouped_single_button_text);

    $external_single_button_text = sanitize_text_field($_POST['external_single_button_text']);
    update_option('external_single_button_text', $external_single_button_text);


    $simple_button_text = sanitize_text_field($_POST['simple_button_text']);
    update_option('simple_button_text', $simple_button_text);

    $variable_button_text = sanitize_text_field($_POST['variable_button_text']);
    update_option('variable_button_text', $variable_button_text);

    $external_button_text = sanitize_text_field($_POST['external_button_text']);
    update_option('external_button_text', $external_button_text);

    $grouped_button_text = sanitize_text_field($_POST['grouped_button_text']);
    update_option('grouped_button_text', $grouped_button_text);
    //==add to cart==//

    $response = array(
      'status' => 'success',
      'message' => 'Successfully Saved',
    );
    wp_send_json($response);
  }

}
