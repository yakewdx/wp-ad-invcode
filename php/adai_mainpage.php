<?php // not in use?>
<h1>Invitation Code</h1>

<h3>Available codes:</h3>
<?php

function purchase_new_ic() {
    echo "testing";
    wp.redirect("new-page.php");
    exit;
}


?>
<?php
//
function get_available_codes ($userID) {
    // select invitation_code,
    //        purchase_date,
    //        available_time
    // from   adai_invcode
    global $wpdb, $adai_hellowp_table_name;
    $sql= "SELECT * FROM $adai_hellowp_table_name WHERE userid=$userID";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    $row = $wpdb->get_results( $sql, 'OBJECT' );
    return $row;

}

$data = get_available_codes(get_current_user_id());
?>
<table>
    <thead>
        <tr>
            <th>Code</th>
            <th>Purchase date</th>
            <th>Available Time</th>
        </tr>
    </thead>
    <tbody>
<?php
if (empty($data)) {
?>
    <tr>
        <td> There is no data. </td>
    </tr>
    <?php
}
foreach ($data as $table) {
    ?>
    <tr>
        <td><?php echo $table->invcode ?></td>
        <td><?php echo $table->purchase_date ?></td>
        <td><?php echo $table->available_times ?></td>
    </tr>
    <?php
}
            ?>

</table>



