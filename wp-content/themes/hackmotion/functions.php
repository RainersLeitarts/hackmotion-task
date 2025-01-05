<?php
function hm_register_styles(){
    wp_enqueue_style("hm_style", get_template_directory_uri() . "/style.css");
}

function hm_register_scripts() {
    wp_enqueue_script("hm_script", get_template_directory_uri() . "/script.js", array(), "1.0", true);
}
add_action("wp_enqueue_scripts", "hm_register_styles");
add_action("wp_enqueue_scripts", "hm_register_scripts");

function handle_title(){
    $options = Array("Par", "80", "90", "100");
    $distance_param = $_GET["distance"] ?? $options[0];

    $itemId = array_search(strtolower($distance_param), $options);

    if($itemId){
        return $options[$itemId];
    } else {
        return $options[0];
    }
}