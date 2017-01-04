<?php

// generate invitation code
// and insert them into db

class adai_invcode_generator {

    private $invcode_length;
    // constructor
    public function __construct($code_length = 13) {
        // codes...
        $this->invcode_length = $code_length;
        global $wpdb, $adai_hellowp_table_name;
    }

    public function get_availble_invcode() {
        global $adai_hellowp_table_name, $wpdb;
        $sql = "SELECT COUNT(*) FROM $adai_hellowp_table_name where invcode = ";
        $invcode="";
        while (true) {
            error_log(print_r($this->invcode_length));
            $invcode = $this->generate_random_invcode($this->invcode_length);
            error_log(print_r($invcode, TRUE));
            if (! $wpdb->get_results($sql . $invcode)) break;
        }
        return $invcode;
    }

    private function generate_random_invcode($length) {
        // 密码字符集，可任意添加你需要的字符
        $chars = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h',
        'i', 'j', 'k', 'l','m', 'n', 'o', 'p', 'q', 'r', 's',
        't', 'u', 'v', 'w', 'x', 'y','z', 'A', 'B', 'C', 'D',
        'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L','M', 'N', 'O',
        'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z',
        '0', '1', '2', '3', '4', '5', '6', '7', '8', '9');
        // 在 $chars 中随机取 $length 个数组元素键名
        $char_txt = '';
        for($i = 0; $i < $length; $i++){
            //将 $length 个数组元素连接成字符串
            $char_txt .= $chars[array_rand($chars)];
        }
        return $char_txt;
    }

    public function add_invcode($userid) {
        global $adai_hellowp_table_name, $wpdb;
        $invcode = $this->get_availble_invcode();
        $sql = 'INSERT INTO {$adai_hellowp_table_name} (invcode, userid, purchase_data, available_times) VALUES({$invcode}, {$userid}, now(), 1)';

        $result = $wpdb->insert($adai_hellowp_table_name,
            array(
                'invcode' => $invcode,
                'userid'  => $userid,
                'purchase_date' => current_time('mysql', 1),
                'available_times' => 1
            ));
        if ($result == false) return false;
        else return true;
    }
}


?>
