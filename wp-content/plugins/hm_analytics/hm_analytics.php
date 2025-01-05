<?php
/*
Plugin Name: HM Analytics
Description: -
Version: 1.0
*/

function hm_analytics_create_tables() {
    require_once(ABSPATH . "wp-admin/includes/upgrade.php");
    global $wpdb;
    $visitor_data_table_name = $wpdb->prefix . "hm_visitor_data";
    $charset = $wpdb->get_charset_collate();

    $create_visitor_data_table = "CREATE TABLE $visitor_data_table_name (
        id INT NOT NULL AUTO_INCREMENT,
        visitor_id VARCHAR(36) NOT NULL,
        ip_addr VARCHAR(15),
        user_agent VARCHAR(512),
        page_url VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset;";

    dbDelta($create_visitor_data_table);

    $events_table_name = $wpdb->prefix . "hm_events";
    $create_events_table = "CREATE TABLE $events_table_name (
        id INT NOT NULL AUTO_INCREMENT,
        visitor_id VARCHAR(36) NOT NULL,
        event_name VARCHAR(24) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
        PRIMARY KEY (id)
    ) $charset";

    dbDelta($create_events_table);
}

register_activation_hook(__FILE__, "hm_analytics_create_tables");


function hm_analytics_init() {
    if(!isset($_COOKIE["hm_visitor_id"])){
        $visitor_id = wp_generate_uuid4();
        setcookie("hm_visitor_id", $visitor_id);
    } else {
        $visitor_id = $_COOKIE["hm_visitor_id"];
    }

    global $hm_visitor_id;
    $hm_visitor_id = $visitor_id;
}

add_action("init", "hm_analytics_init");


function hm_store_visitor_data() {
    global $wpdb;
    global $hm_visitor_id;

    $rows_count_query = "SELECT COUNT(*) FROM wp_hm_visitor_data WHERE visitor_id = \"$hm_visitor_id\";";
    $rows_count = $wpdb->get_var($rows_count_query);

    if($rows_count > 0){
        return;
    }

    $ip_addr = $_SERVER["REMOTE_ADDR"];
    $user_agent = $_SERVER["HTTP_USER_AGENT"];
    $page_url = $_SERVER["REQUEST_URI"];

    $visitor_data = [
        "visitor_id" => $hm_visitor_id,
        "ip_addr" => $ip_addr,
        "user_agent" => $user_agent,
        "page_url" => $page_url
    ];

    $wpdb->insert($wpdb->prefix . "hm_visitor_data", $visitor_data);
}

add_action("wp", "hm_store_visitor_data");


function hm_save_page_view_event() {
    if(!is_front_page()){
        return;
    }

    global $wpdb;
    global $hm_visitor_id;

    $event_data = [
        "visitor_id" => $hm_visitor_id,
        "event_name" => "PAGE_VIEW"
    ];

    $wpdb->insert($wpdb->prefix . "hm_events", $event_data);
}

add_action("wp_head", "hm_save_page_view_event");

function hm_get_client_event() {
    global $hm_visitor_id;
    $event = $_POST["event"];

    if(!$event){
        return;
        wp_send_json_error("No event provided");
    }

    global $wpdb;

    $event_data = [
        "visitor_id" => $hm_visitor_id,
        "event_name" => "VIDEO_WATCHED"
    ];

    $wpdb->insert($wpdb->prefix . "hm_events", $event_data);

    wp_send_json_success($event . " event logged");
}

add_action('wp_ajax_log_client_event', 'hm_get_client_event');
add_action('wp_ajax_nopriv_log_client_event', 'hm_get_client_event');


function hm_register_analytics_scripts() {
    wp_enqueue_script("hm_analytics", plugins_url('/hm_analytics.js', __FILE__), ["wp-util"], null, true);
    wp_localize_script("hm_analytics", "ajax", array("url" => admin_url("admin-ajax.php")));
}

add_action("wp_enqueue_scripts", "hm_register_analytics_scripts");