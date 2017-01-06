<?php

require_once(__DIR__ . '/includes/adai-invcode-generator.php');
class ivc_purchase_page {

    private $ivc_generator;
    public function __construct($ivc_length) {
        // codes...
        add_action('admin_menu', array($this, 'my_plugin_menu'));
        add_action('admin_enqueue_scripts', array($this, 'add_script'));
        //add_action('inv_notify', array($this, 'notify'));
        //add_action('wp_ajax_add_invcode', array($this, 'add_invcode'));
        add_action('wp_ajax_call_api', array($this, 'notify'));
       // add_action('init', array($this, 'add_rules'));
        $this->ivc_generator = new adai_invcode_generator($ivc_length);
    }

    #public function add_rules() {
    #    error_log(print_r("rules added"));
    #    //add_rewrite_rule('^ivc/[A-Za-z]+/?', 'wp-admin/index.php?page=$matches[1]', 'top');
    #    add_rewrite_rule('^ivc/[A-Za-z]+/?', 'wp-admin/index.php', 'top');
    #    add_rewrite_rule('^leaf/([0-9]+)/?', 'index.php?page_id=$matches[1]', 'top');
    #}

    public function my_plugin_menu() {
        add_dashboard_page('My Plugin Dashboard', 'Notify', 'read', 'notify', 'my_plugin_function');
    }
    public function add_script() {
        //wp_enqueue_script('ivc_main_js', plugin_dir_url(__FILE__) . '../js/adai-ivc-main.js');
        wp_enqueue_script('request_send', plugin_dir_url(__FILE__) . '../js/request_send.js');
    }
    public function purchase_page() {

/*        // header
        $this->get_header();

        // form
?>
        <form class="ivc-form" method="post" id="ivc-purchase-form" action="", >
            <input type="hidden" name="id">
            <div class="basic">
                <input type="submit" value="Buy Code" name="Buy Code" class="ivc-btn">
            </div>
        </form>
        <div id='ivc-outputs'></div>
<?php
        // footer
        $this->get_footer();
 */
    require_once(__DIR__ . '/includes/SPAY_alipay_SDK/index.php');
    }

    private function get_header() {
        ?>
        <h1> Buy new invitation codes here! </h1>
        <?php
    }

    private function get_footer() {

    }

    public function notify() {
        require_once(__DIR__ . '/includes/SPAY_alipay_SDK/alipayapi.php');
        //echo 'message notified';
        //header("Location:". plugin_dir() . '/includes/SPAY_alipay_SDK/alipayapi.php');
        //error_log(print_r('notify get called.'));
        //wp_redirect(__DIR__ . '/includes/SPAY_alipay_SDK/alipayapi.php');
        wp_die();
        //exit;
    }
    public function add_invcode() {
        $this->ivc_generator->add_invcode(get_current_user_id());
        echo 'Successfully Purchased';
        wp_die();
    }
}
?>
