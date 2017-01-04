<?php
class ivc_register_page {

    private $invcode_length;

    public function __construct($ivc_length) {
        $this->invcode_length = $ivc_length;
    }

    // Action Handler
    // Action: register
    public function adai_ivc_register() {
    ?>
        <a href = "<?php echo plugin_dir_url(__FILE__) . 'includes/ivc-register-page-content.php'?>">register</a>
    <?php
    }

    // Action Handler
    // Action: register_form
    function ivc_add_register_form () {
        $invcode = (!empty($_POST['invcode'])) ? $_POST['invcode'] : '';
?>
        <p>
            <label for="invcode">Invitation Code <br />
            <input type="text" name="invcode" class="input" size="25" value=<?php echo esc_attr($invcode)?> ></label>
        </p>

    <?php
    }

    // Action Handler
    // Action: 'registration_errors'
    function ivc_registration_errors ($errors, $sanitized_user_login, $user_email) {
        global $wpdb, $adai_hellowp_table_name;

        // filter -- invalid invitation code
        $has_error = false;
        if (empty( $_POST['invcode']))// || strlen($_POST['invcode'] != $this->invcode_length))
            $has_error = true;
        else {
            $sql = "SELECT `available_times` FROM $adai_hellowp_table_name where invcode = '". $_POST['invcode']."'";
            $array=$wpdb->get_results($sql);
            // debug: $errors->add('invcode_test', '<strong>Testing</strong> The result is ' . $array[0]);
            // debug: error_log(print_r($array));
            if ((int)$array[0] < 1) $has_error=true;
        }
        if($has_error)
            $errors->add('invcode_error', '<strong>ERROR</strong>: You have an invalid invitation code.');



        // filter -- invalid email address
        // for instance: filter @qq.com
        $email_addr = $_POST['user_email'];
        $filtered_text= '/@qq|@163/';
        if(preg_match($filtered_text,strtolower($email_addr)))
            $errors->add('email_error', '<strong>ERROR</strong>: QQ mails, 163 mails cannot be used for registration.');
        return $errors;
    }

    // Action Handler
    // Action: 'user_register'
    function ivc_user_register( $user_id ) {
        global $wpdb, $adai_hellowp_table_name;
        $sql = "UPDATE $adai_hellowp_table_name SET `available_times`=`available_times`-1 WHERE `invcode`='". $_POST['invcode'] ."'";
        $wpdb->query($sql);
    }
}

?>


