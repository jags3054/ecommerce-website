<?php
/**
 * Uninstall plugin
 */

// If uninstall not called from WordPress exit
if( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}


$rexvs_setup_data = unserialize(get_option('rexvs_setup_data'));
if (isset($rexvs_setup_data['rexvs_delete_data']) && $rexvs_setup_data['rexvs_delete_data'] == 'off') {

}
