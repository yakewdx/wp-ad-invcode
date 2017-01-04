<?php

require_once(__DIR__ . '/ivc-help-page.php');
require_once(__DIR__ . '/ivc-show-page.php');
require_once(__DIR__ . '/ivc-purchase-page.php');
require_once(__DIR__ . '/ivc-register-page.php');
class adai_invcode_main {

    // setting
    private $invcode_length = 13;
    // constructor
    public function __construct() {
        //$this->init();
        $this->show_page = new ivc_show_page();
        $this->purchase_page = new ivc_purchase_page($this->invcode_length);
        $this->register_page = new ivc_register_page($this->invcode_length);
        $this->setup_ajax_request();

    }
    // init
    public function init_actions() {
        // add action to all the objects.
        add_action('register_form', array($this->register_page, 'ivc_add_register_form'));
        add_filter('registration_errors', array($this->register_page, 'ivc_registration_errors'), 10, 3);
        add_action('user_register', array($this->register_page, 'ivc_user_register'));
        //add_filter('register', array($this->register_page, 'adai_ivc_register'));
        add_action('admin_menu', array($this,'menu_setup'));
    }

    public function setup_ajax_request() {
        //add_action('wp_ajax_add_invcode', array($this->purchase_page, 'add_invcode'));
        //add_action('wp_ajax_add_invcode', 'add_invcode');
    }
    public function menu_setup() {
        add_menu_page('Invitation Code', 'Invitation Code', 'read', 'ivc_main', array($this->show_page, 'show_page'));
        add_submenu_page('ivc_main', 'Help page', 'Help page', 'read', 'ivc_help_page', 'adai_hellowp_help_page');
        add_submenu_page('ivc_main', 'Purchase', 'Purchase', 'read', 'ivc_purchase_page', array($this->purchase_page, 'purchase_page'));
    }

}

?>
