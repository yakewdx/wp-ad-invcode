<?php
/**
Plugin Name: wp-ad-invcode
Plugin URI:
Description: Invitation Code
Version: 0.1
Author: Adai
Author URI:
Licence: GPL
*/

// Define database,
// and require files.
global $wpdb, $adai_hellowp_table_name;
$adai_hellowp_table_name = $wpdb->prefix .'adai_invcode1';

if ( ! defined ( 'WPINC' ) ) {
    die;
}

require_once(__DIR__ . '/php/class-invcode-main.php');
function adai_hellowp_page_init(){
    $invmain = new adai_invcode_main();
    $invmain->init_actions();
}

function adai_hellowp_check_db() {
    // test if table adai_invcode exists
    // if not then create
    global $wpdb, $adai_hellowp_table_name;
    $charset_collate = $wpdb->get_charset_collate();
    if ($wpdb->get_var('show tables like '.$adai_hellowp_table_name) != $adai_hellowp_table_name) {
        $sql = "CREATE TABLE $adai_hellowp_table_name (
            id integer not null auto_increment,
            invcode varchar(20),
            userid  int(10),
            purchase_date datetime,
            available_times int,
            primary key (id),
            unique key id (id)
        )ENGINE=MyISAM  DEFAULT CHARSET=utf8;";
        require_once(ABSPATH. 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        add_option("adai_invcode_db_version","1.0");
    } else {
        error_log(print_r('detected table' . $adai_hellowp_table_name));
    }
}

register_activation_hook(__FILE__, 'adai_hellowp_check_db');
add_action('plugins_loaded', 'adai_hellowp_page_init');

?>
