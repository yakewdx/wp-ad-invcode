<?php

require_once(__DIR__ . '/includes/adai-invcode-generator.php');
class ivc_purchase_page {

    private $ivc_generator;
    public function __construct($ivc_length) {
        // codes...
        add_action('admin_enqueue_scripts', array($this, 'add_script'));
        add_action('wp_ajax_add_invcode', array($this, 'add_invcode'));
        $this->ivc_generator = new adai_invcode_generator($ivc_length);
    }
    public function add_script() {
        wp_enqueue_script('ivc_main_js', plugin_dir_url(__FILE__) . '../js/adai-ivc-main.js');
    }
    public function purchase_page() {

        // header
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

    }

    private function get_header() {
        ?>
        <h1> Buy new invitation codes here! </h1>
        <?php
    }

    private function get_footer() {

    }

    public function add_invcode() {
        $this->ivc_generator->add_invcode(get_current_user_id());
        echo 'Successfully Purchased';
        wp_die();
    }
}
?>
