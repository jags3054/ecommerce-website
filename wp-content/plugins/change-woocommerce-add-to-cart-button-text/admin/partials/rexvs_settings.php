<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://rextheme.com
 * @since      1.0.0
 *
 * @package    Variation_Swatches_For_Woocommerce
 * @subpackage Variation_Swatches_For_Woocommerce/admin/partials
 */
?>

<?php
  $rexvs_setup_data = unserialize(get_option('rexvs_setup_data'));

  $simple_single_button_text = esc_attr( get_option( 'simple_single_button_text' ) );
  $variable_single_button_text = esc_attr( get_option( 'variable_single_button_text' ) );
  $grouped_single_button_text = esc_attr( get_option( 'grouped_single_button_text' ) );
  $external_single_button_text = esc_attr( get_option( 'external_single_button_text' ) );

  $simple_button_text = esc_attr( get_option( 'simple_button_text' ) );
  $variable_button_text = esc_attr( get_option( 'variable_button_text' ) );
  $external_button_text = esc_attr( get_option( 'external_button_text' ) );
  $grouped_button_text = esc_attr( get_option( 'grouped_button_text' ) );
?>

<div class="rexvs-settings">
    <div id="rexvs-tabs" class="rexvs-tabs">
        <ul class="rexvs-tab-nav">
            <li class="logo"><img src="<?php echo REXVS_PLUGIN_DIR_URL .'images/logo.png' ?>" alt="logo"></li>
            <li><a href="#general"><?php _e('General','rexvs'); ?></a></li>
            <li><a href="#controls"><?php _e('Controls','rexvs'); ?></a></li>
            <li><a href="#adc_btx"><?php _e('Button Text','rexvs'); ?></a></li>
        </ul>

        <div class="rexvs-tab-content">
            <div id="general" class="general">
                <div class="tab-content-header">
                    <h4><?php _e('General Settings','rexvs'); ?></h4>
                </div>
                
                <div class="tab-content-wrapper">
                    <div class="rexvs-box global-style">
                        <div class="rexvs-divider-style">
                            <h2><?php _e('Swatches Global Style','rexvs'); ?></h2>
                        </div>

                        <div class="rexvs-form-group shape-height">
                            <span class="label"><?php _e('Shape Height: ','rexvs'); ?></span>
                            <?php
                              $rexvs_shape_height = '';
                              if (isset($rexvs_setup_data['rexvs_shape_height'])) {
                                  $rexvs_shape_height = $rexvs_setup_data['rexvs_shape_height'];
                              }
                            ?>
                            <input type="number" name="rexvs_shape_height" value="<?php echo $rexvs_shape_height; ?>" min="0">
                            <span class="hints">px</span>
                        </div>

                        <div class="rexvs-form-group shape-width">
                            <span class="label"><?php _e('Shape Width: ','rexvs'); ?></span>
                            <?php
                              $rexvs_shape_width = '';
                              if (isset($rexvs_setup_data['rexvs_shape_width'])) {
                                  $rexvs_shape_width = $rexvs_setup_data['rexvs_shape_width'];
                              }
                            ?>
                            <input type="number" name="rexvs_shape_width" value="<?php echo $rexvs_shape_width; ?>" min="0">
                            <span class="hints">px</span>
                        </div>

                        <div class="rexvs-form-group shape-font-size">
                            <span class="label"><?php _e('Font Size: ','rexvs'); ?></span>
                            <?php
                              $rexvs_swatches_font_size = '';
                              if (isset($rexvs_setup_data['rexvs_swatches_font_size'])) {
                                  $rexvs_swatches_font_size = $rexvs_setup_data['rexvs_swatches_font_size'];
                              }
                            ?>
                            <input type="number" name="rexvs_swatches_font_size" value="<?php echo $rexvs_swatches_font_size; ?>" min="0">
                            <span class="hints">px</span>
                        </div>

                        <div class="rexvs-form-group shape-bg-color">
                            <span class="label"><?php _e('Background Color: ','rexvs'); ?></span>
                            <?php
                              $rexvs_swatches_bg_color = '';
                              if (isset($rexvs_setup_data['rexvs_swatches_bg_color'])) {
                                  $rexvs_swatches_bg_color = $rexvs_setup_data['rexvs_swatches_bg_color'];
                              }
                            ?>
                            <input type="text" name="rexvs_swatches_bg_color" value="<?php echo $rexvs_swatches_bg_color; ?>" class="rexsv-color-picker">
                        </div>

                        <div class="rexvs-form-group shape-font-color">
                            <span class="label"><?php _e('Font Color:','rexvs'); ?> </span>
                            <?php
                              $rexvs_swatches_color = '';
                              if (isset($rexvs_setup_data['rexvs_swatches_color'])) {
                                  $rexvs_swatches_color = $rexvs_setup_data['rexvs_swatches_color'];
                              }
                            ?>
                            <input type="text" name="rexvs_swatches_color" value="<?php echo $rexvs_swatches_color; ?>" class="rexsv-color-picker">
                        </div>

                        <div class="rexvs-form-group shpae-style">
                            <span class="label"><?php _e('Shape Style: ','rexvs'); ?></span>
                            <ul class="rexvs-radio">
                              <?php
                              if (isset($rexvs_setup_data['rexvs_shape_style']) && $rexvs_setup_data['rexvs_shape_style'] == 'squared') {
                                ?>
                                  <li>
                                      <input type="radio" name="rexvs_shape_style" id="rounded" value="rounded" >
                                      <label for="rounded"><span></span>Rounded</label>
                                  </li>
                                  <li>
                                      <input type="radio" name="rexvs_shape_style" id="squared" value="squared" checked>
                                      <label for="squared"><span></span>Squared</label>
                                  </li>
                                <?php
                              }
                              else {
                                ?>
                                  <li>
                                      <input type="radio" name="rexvs_shape_style" id="rounded" value="rounded" checked>
                                      <label for="rounded"><span></span>Rounded</label>
                                  </li>
                                  <li>
                                      <input type="radio" name="rexvs_shape_style" id="squared" value="squared">
                                      <label for="squared"><span></span>Squared</label>
                                  </li>
                                <?php
                              }
                              ?>
                            </ul>
                        </div>

                        <div class="rexvs-form-group shape-border-switch">
                            <span class="label"><?php _e('Border Enable/Disable:','rexvs'); ?></span>
                            <div class="rexvs-switcher">
                               <?php
                                  if (isset($rexvs_setup_data['rexvs_swatches_border']) && $rexvs_setup_data['rexvs_swatches_border'] == 'on') {
                                      ?>
                                        <input class="switch" id="rexvs_swatches_border" name="rexvs_swatches_border" type="checkbox" checked>
                                      <?php
                                  }
                                  else {
                                    ?>
                                      <input class="switch" id="rexvs_swatches_border" name="rexvs_swatches_border" type="checkbox">
                                    <?php
                                  }
                                ?>
                                <label for="rexvs_swatches_border"></label>
                            </div>
                        </div>

                        <div class="rexvs-form-group tooltip-switch">
                            <span class="label"><?php _e('Tooltip Enable/Disable:','rexvs'); ?></span>
                            <div class="rexvs-switcher">
                               <?php
                                  if (isset($rexvs_setup_data['rexvs_tooltip']) && $rexvs_setup_data['rexvs_tooltip'] == 'on') {
                                      ?>
                                        <input class="switch" id="rexvs_tooltip" name="rexvs_tooltip" type="checkbox" checked>
                                      <?php
                                  }
                                  else {
                                    ?>
                                      <input class="switch" id="rexvs_tooltip" name="rexvs_tooltip" type="checkbox">
                                    <?php
                                  }
                                ?>

                                <label for="rexvs_tooltip"></label>
                            </div>
                        </div>

                        <div class="enabled-swatches-border enabled-global-swatches-border">
                            <div class="rexvs-form-group">
                                <span class="label"><?php _e('Border:','rexvs'); ?></span>
                                <div class="border-style">
                                    <?php
                                      $rexvs_swatches_border_size = '';
                                      $rexvs_swatches_border_color = '';
                                      $rexvs_swatches_border_style = '';

                                      if (isset($rexvs_setup_data['rexvs_swatches_border_size'])) {
                                          $rexvs_swatches_border_size = $rexvs_setup_data['rexvs_swatches_border_size'];
                                      }

                                      if (isset($rexvs_setup_data['rexvs_swatches_border_color'])) {
                                          $rexvs_swatches_border_color = $rexvs_setup_data['rexvs_swatches_border_color'];
                                      }

                                      if (isset($rexvs_setup_data['rexvs_swatches_border_style'])) {
                                          $rexvs_swatches_border_style = $rexvs_setup_data['rexvs_swatches_border_style'];
                                      }
                                    ?>
                                    <input type="number" name="rexvs_swatches_border_size" value="<?php echo $rexvs_swatches_border_size; ?>" min="0">
                                    <span class="hints">px</span>
                                    <select name="rexvs_swatches_border_style">
                                        <option value="solid" <?php echo $rexvs_swatches_border_style == 'solid'? 'selected' : ''; ?>>Solid</option>
                                        <option value="dashed" <?php echo $rexvs_swatches_border_style == 'dashed'? 'selected' : ''; ?> >Dashed</option>
                                        <option value="dotted" <?php echo $rexvs_swatches_border_style == 'dotted'? 'selected' : ''; ?>>Dotted</option>
                                        <option value="double" <?php echo $rexvs_swatches_border_style == 'double'? 'selected' : ''; ?>>Double</option>
                                    </select>
                                    <input type="text" name="rexvs_swatches_border_color" value="<?php echo $rexvs_swatches_border_color; ?>" class="rexsv-color-picker">
                                </div>
                            </div>
                        </div>

                        <div class="enabled-tooltip enabled-global-tooltip">
                            <div class="tooltip-field-wrapper">
                                <div class="rexvs-form-group">
                                    <span class="label"><?php _e('Tooltip Font Size:','rexvs'); ?> </span>
                                    <?php
                                      $rexvs_tooltip_fnt_size = '';
                                      if (isset($rexvs_setup_data['rexvs_tooltip_fnt_size'])) {
                                          $rexvs_tooltip_fnt_size = $rexvs_setup_data['rexvs_tooltip_fnt_size'];
                                      }
                                    ?>
                                    <input type="number" name="rexvs_tooltip_fnt_size" value="<?php echo $rexvs_tooltip_fnt_size; ?>"  min="0">
                                </div>

                                <div class="rexvs-form-group">
                                    <span class="label"><?php _e('Tooltip Text Color: ','rexvs'); ?></span>
                                    <?php
                                      $rexvs_tooltip_color = '';
                                      if (isset($rexvs_setup_data['rexvs_tooltip_color'])) {
                                          $rexvs_tooltip_color = $rexvs_setup_data['rexvs_tooltip_color'];
                                      }
                                    ?>
                                    <input type="text" name="rexvs_tooltip_color" value="<?php echo $rexvs_tooltip_color; ?>" class="tooltip_color rexsv-color-picker">
                                </div>

                                <div class="rexvs-form-group">
                                    <span class="label"><?php _e('Tooltip Background Color: ','rexvs'); ?></span>
                                    <?php
                                      $rexvs_tooltip_bg_color = '';
                                      if (isset($rexvs_setup_data['rexvs_tooltip_bg_color'])) {
                                          $rexvs_tooltip_bg_color = $rexvs_setup_data['rexvs_tooltip_bg_color'];
                                      }
                                    ?>
                                    <input type="text" name="rexvs_tooltip_bg_color" value="<?php echo $rexvs_tooltip_bg_color; ?>" class="tooltip_bg_color rexsv-color-picker">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--/rexvs-box-->
                    
                    <div class="rexvs-box hover-style">
                        <div class="rexvs-divider-style">
                            <h2><?php _e('Swatches Hover Style','rexvs'); ?></h2>
                        </div>

                        <div class="rexvs-form-group">
                            <span class="label"><?php _e('Background Color:','rexvs'); ?> </span>
                            <?php
                              $rexvs_hvr_swatches_bg_color = '';
                              if (isset($rexvs_setup_data['rexvs_hvr_swatches_bg_color'])) {
                                  $rexvs_hvr_swatches_bg_color = $rexvs_setup_data['rexvs_hvr_swatches_bg_color'];
                              }
                            ?>
                            <input type="text" name="rexvs_hvr_swatches_bg_color" value="<?php echo $rexvs_hvr_swatches_bg_color; ?>" class="rexsv-color-picker">
                        </div>

                        <div class="rexvs-form-group">
                            <span class="label"><?php _e('Color:','rexvs'); ?></span>
                            <?php
                              $rexvs_hvr_swatches_color = '';
                              if (isset($rexvs_setup_data['rexvs_hvr_swatches_color'])) {
                                  $rexvs_hvr_swatches_color = $rexvs_setup_data['rexvs_hvr_swatches_color'];
                              }
                            ?>
                            <input type="text" name="rexvs_hvr_swatches_color" value="<?php echo $rexvs_hvr_swatches_color; ?>" class="rexsv-color-picker">
                        </div>

                        <div class="enabled-swatches-border enabled-global-swatches-border">
                            <div class="rexvs-form-group">
                                <span class="label"><?php _e('Border width:','rexvs'); ?></span>
                                <div class="border-style">
                                    <?php
                                      $rexvs_hvr_swatches_border_size = '';

                                      if (isset($rexvs_setup_data['rexvs_hvr_swatches_border_size'])) {
                                          $rexvs_hvr_swatches_border_size = $rexvs_setup_data['rexvs_hvr_swatches_border_size'];
                                      }
                                    ?>
                                    <input type="number" name="rexvs_hvr_swatches_border_size" value="<?php echo $rexvs_hvr_swatches_border_size; ?>" min="0">
                                    <span class="hints">px</span>
                                </div>
                            </div>

                            <div class="rexvs-form-group">
                                <span class="label"><?php _e('Border color:','rexvs'); ?></span>
                                <div class="border-style">
                                    <?php
                                      $rexvs_hvr_swatches_border_color = '';

                                      if (isset($rexvs_setup_data['rexvs_hvr_swatches_border_color'])) {
                                          $rexvs_hvr_swatches_border_color = $rexvs_setup_data['rexvs_hvr_swatches_border_color'];
                                      }
                                    ?>
                                    <input type="text" name="rexvs_hvr_swatches_border_color" value="<?php echo $rexvs_hvr_swatches_border_color; ?>" class="rexsv-color-picker">
                                </div>
                            </div>
                        </div>
                        <!--/enabled-swatches-border-->

                    </div>
                    <!--/rexvs-box-->
                    
                    <div class="rexvs-box selected-style">
                        <div class="rexvs-divider-style">
                            <h2><?php _e('Swatches Selected Style','rexvs'); ?></h2>
                        </div>

                        <div class="rexvs-form-group">
                            <span class="label"><?php _e('Background Color:','rexvs'); ?> </span>
                            <?php
                              $rexvs_seltd_swatches_bg_color = '';
                              if (isset($rexvs_setup_data['rexvs_seltd_swatches_bg_color'])) {
                                  $rexvs_seltd_swatches_bg_color = $rexvs_setup_data['rexvs_seltd_swatches_bg_color'];
                              }
                            ?>
                            <input type="text" name="rexvs_seltd_swatches_bg_color" value="<?php echo $rexvs_seltd_swatches_bg_color; ?>" class="rexsv-color-picker">
                        </div>

                        <div class="rexvs-form-group">
                            <span class="label"><?php _e('Color:','rexvs'); ?></span>
                            <?php
                              $rexvs_seltd_swatches_color = '';
                              if (isset($rexvs_setup_data['rexvs_seltd_swatches_color'])) {
                                  $rexvs_seltd_swatches_color = $rexvs_setup_data['rexvs_seltd_swatches_color'];
                              }
                            ?>
                            <input type="text" name="rexvs_seltd_swatches_color" value="<?php echo $rexvs_seltd_swatches_color; ?>" class="rexsv-color-picker">
                        </div>

                        <div class="enabled-swatches-border enabled-global-swatches-border">
                            <div class="rexvs-form-group">
                                <span class="label"><?php _e('Border width:','rexvs'); ?></span>
                                <div class="border-style">
                                    <?php
                                      $rexvs_seltd_swatches_border_size = '';

                                      if (isset($rexvs_setup_data['rexvs_seltd_swatches_border_size'])) {
                                          $rexvs_seltd_swatches_border_size = $rexvs_setup_data['rexvs_seltd_swatches_border_size'];
                                      }
                                    ?>
                                    <input type="number" name="rexvs_seltd_swatches_border_size" value="<?php echo $rexvs_seltd_swatches_border_size; ?>" min="0">
                                    <span class="hints">px</span>
                                </div>
                            </div>

                            <div class="rexvs-form-group">
                                <span class="label"><?php _e('Border color:','rexvs'); ?></span>
                                <div class="border-style">
                                    <?php
                                      $rexvs_seltd_swatches_border_color = '';

                                      if (isset($rexvs_setup_data['rexvs_seltd_swatches_border_color'])) {
                                          $rexvs_seltd_swatches_border_color = $rexvs_setup_data['rexvs_seltd_swatches_border_color'];
                                      }
                                    ?>
                                    <input type="text" name="rexvs_seltd_swatches_border_color" value="<?php echo $rexvs_seltd_swatches_border_color; ?>" class="rexsv-color-picker">
                                </div>
                            </div>
                        </div>
                        <!--/enabled-swatches-border-->
                    </div>
                    
                </div>
            </div>
            <!--/general tab content-->

            <div id="controls" class="controls">
                <div class="tab-content-header">
                    <h4><?php _e('Controls','rexvs'); ?></h4>
                </div>

                <div class="tab-content-wrapper">
                    <div class="rexvs-box">

                        <div class="rexvs-form-group">
                            <span class="label"><?php _e('Dropdowns to Button Swatch:','rexvs'); ?> </span>
                            <div class="rexvs-switcher">
                                <?php
                                  if (isset($rexvs_setup_data['rexvs_default_dropdown_to_button']) && $rexvs_setup_data['rexvs_default_dropdown_to_button'] == 'on') {
                                      ?>
                                        <input class="switch" id="rexvs_default_dropdown_to_button" name="rexvs_default_dropdown_to_button" type="checkbox" checked>
                                      <?php
                                  }
                                  else {
                                    ?>
                                      <input class="switch" id="rexvs_default_dropdown_to_button" name="rexvs_default_dropdown_to_button" type="checkbox">
                                    <?php
                                  }
                                ?>
                                <label for="rexvs_default_dropdown_to_button"></label>
                            </div>
                            <span class="hints"><?php _e('Auto Convert Dropdowns to Button Swatch (only for "select" attribute type) by Default','rexvs'); ?></span>
                        </div>

                        <div class="rexvs-form-group">
                            <span class="label"><?php _e('Delete data on plugin uninstall:','rexvs'); ?></span>
                            <div class="rexvs-switcher">
                                <?php
                                  if (isset($rexvs_setup_data['rexvs_delete_data']) && $rexvs_setup_data['rexvs_delete_data'] == 'on') {
                                      ?>
                                        <input class="switch" id="rexvs_delete_data" name="rexvs_delete_data" type="checkbox" checked>
                                      <?php
                                  }
                                  else {
                                    ?>
                                      <input class="switch" id="rexvs_delete_data" name="rexvs_delete_data" type="checkbox">
                                    <?php
                                  }
                                ?>
                                <label for="rexvs_delete_data"></label>
                            </div>
                            <span class="hints"><?php _e('Delete all plugin data on plugin uninstall.','rexvs'); ?></span>
                        </div>

                        <div class="rexvs-form-group">
                            <span class="label"><?php _e('Disable default plugin stylesheet:','rexvs'); ?></span>
                            <div class="rexvs-switcher">
                                <?php
                                  if (isset($rexvs_setup_data['rexvs_disable_stylesheet']) && $rexvs_setup_data['rexvs_disable_stylesheet'] == 'on') {
                                      ?>
                                        <input class="switch" id="rexvs_disable_stylesheet" name="rexvs_disable_stylesheet" type="checkbox" checked>
                                      <?php
                                  }
                                  else {
                                    ?>
                                      <input class="switch" id="rexvs_disable_stylesheet" name="rexvs_disable_stylesheet" type="checkbox">
                                    <?php
                                  }
                                ?>
                                <label for="rexvs_disable_stylesheet"></label>
                            </div>
                            <span class="hints"><?php _e('Option to enable/disable default plugin stylesheet for theme developer','rexvs'); ?></span>
                        </div>

                    </div>
                </div>
            </div>
            <!--/controls tab content-->

                        <!--Add to cart button text-->
            <div id="adc_btx" class="controls">
                <div class="tab-content-header">
                    <h4><?php _e('Add to cart button text','rexvs'); ?></h4>
                </div>

                <div class="tab-content-wrapper">
                    <div class="rexvs-box">
                      <h2>Add to cart button text for single page</h2><br>
                      <div class="rexvs-form-group">
                          <span class="label"><?php _e('Simple Product:','rexvs'); ?></span>
                          <input type='text' name='simple_single_button_text' value='<?php echo $simple_single_button_text; ?>' style="Width:200px;" />
                      </div>
                      <div class="rexvs-form-group">
                          <span class="label"><?php _e('Variable Product:','rexvs'); ?></span>
                          <input type='text' name='variable_single_button_text' value='<?php echo $variable_single_button_text; ?>' style="Width:200px;" />
                      </div>
                      <div class="rexvs-form-group">
                          <span class="label"><?php _e('Grouped Product:','rexvs'); ?></span>
                          <input type='text' name='grouped_single_button_text' value='<?php echo $grouped_single_button_text; ?>' style="Width:200px;" />
                      </div>
                      <div class="rexvs-form-group">
                          <span class="label"><?php _e('External Product:','rexvs'); ?></span>
                          <input type='text' name='external_single_button_text' value='<?php echo $external_single_button_text; ?>' style="Width:200px;" />
                      </div>
                    </div>
                    <div class="rexvs-box">
                      <h2>Add To Cart Button Text For Archive Pages</h2><br>
                      <div class="rexvs-form-group">
                          <span class="label"><?php _e('Simple Product:','rexvs'); ?></span>
                          <input type='text' name='simple_button_text' value='<?php echo $simple_button_text; ?>' style="Width:200px;" />
                      </div>
                      <div class="rexvs-form-group">
                          <span class="label"><?php _e('Variable Product:','rexvs'); ?></span>
                          <input type='text' name='variable_button_text' value='<?php echo $variable_button_text; ?>' style="Width:200px;" />
                      </div>
                      <div class="rexvs-form-group">
                          <span class="label"><?php _e('Grouped Product:','rexvs'); ?></span>
                          <input type='text' name='external_button_text' value='<?php echo $external_button_text; ?>' style="Width:200px;" />
                      </div>
                      <div class="rexvs-form-group">
                          <span class="label"><?php _e('External Product:','rexvs'); ?></span>
                          <input type='text' name='grouped_button_text' value='<?php echo $grouped_button_text; ?>' style="Width:200px;" />
                      </div>
                    </div>
                </div>
            </div>
            <!--Add to cart button text-->

            <div class="button-area">
                <button type="button" class="btn-default save-settings" id="rexvs_settings_submit">
                    Save Settings
                    <svg id="rexsv-spinner" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="sync-alt" class="svg-inline--fa fa-sync-alt fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path fill="currentColor" d="M370.72 133.28C339.458 104.008 298.888 87.962 255.848 88c-77.458.068-144.328 53.178-162.791 126.85-1.344 5.363-6.122 9.15-11.651 9.15H24.103c-7.498 0-13.194-6.807-11.807-14.176C33.933 94.924 134.813 8 256 8c66.448 0 126.791 26.136 171.315 68.685L463.03 40.97C478.149 25.851 504 36.559 504 57.941V192c0 13.255-10.745 24-24 24H345.941c-21.382 0-32.09-25.851-16.971-40.971l41.75-41.749zM32 296h134.059c21.382 0 32.09 25.851 16.971 40.971l-41.75 41.75c31.262 29.273 71.835 45.319 114.876 45.28 77.418-.07 144.315-53.144 162.787-126.849 1.344-5.363 6.122-9.15 11.651-9.15h57.304c7.498 0 13.194 6.807 11.807 14.176C478.067 417.076 377.187 504 256 504c-66.448 0-126.791-26.136-171.315-68.685L48.97 471.03C33.851 486.149 8 475.441 8 454.059V320c0-13.255 10.745-24 24-24z"></path></svg>
                </button>
                <p class="validation-msg" id="rexvs_settings_status" style="display:none;"></p>
            </div>

        </div>
    </div>
</div>
