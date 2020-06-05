<?php
// Filter to replace default css class names for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'nexgi_css_classes_for_vc_row_and_vc_column', 10, 2);
function nexgi_css_classes_for_vc_row_and_vc_column($class_string, $tag)
{

    if ($tag == 'vc_row' || $tag == 'vc_row_inner') {
        $class_string = str_replace('vc_row', 'row', $class_string);
        $class_string = str_replace('vc_row-fluid', 'nexgi_row-fluid', $class_string); // This will replace "vc_row-fluid" with "my_row-fluid"
    }

    if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
        $class_string = preg_replace('/vc_col-xs-(\d{1,2})/', 'col-xs-$1', $class_string);
        $class_string = preg_replace('/vc_col-lg-(\d{1,2})/', 'col-lg-$1', $class_string);
        $class_string = preg_replace('/vc_col-md-(\d{1,2})/', 'col-md-$1', $class_string);
        $class_string = preg_replace('/vc_col-sm-(\d{1,2})/', 'col-sm-$1', $class_string); // This will replace "vc_col-sm-%" with "my_col-sm-%"
    }
    return $class_string; // Important: you should always return modified or original $class_string
}

// remove default params of WpBakery
add_action('vc_before_init', function () {
    vc_remove_param("vc_btn", "color");
    vc_remove_param("vc_btn", "shape");
});


// default vc_btn remap
add_action('vc_after_init', 'nexgi_remap_vc_btn_style_params');
function nexgi_remap_vc_btn_style_params()
{
    // style
    $param = WPBMap::getParam('vc_btn', 'style');
    $param['value'] = array();
    $param['value'][__('Primary')] = 'btn-primary';
    $param['value'][__('Secondary')] = 'btn-secondary';
    $param['value'][__('Outline Primary')] = 'btn-outline-primary';
    $param['value'][__('Outline Secondary')] = 'btn-outline-secondary';
    vc_update_shortcode_param('vc_btn', $param);
}

add_action('vc_after_init', 'nexgi_remap_vc_btn_size_params');
function nexgi_remap_vc_btn_size_params()
{
    // style
    $param = WPBMap::getParam('vc_btn', 'size');
    $param['value'] = array();
    $param['value'][__('Default')] = '';
    $param['value'][__('Small')] = 'btn-sm';
    $param['value'][__('Large')] = 'btn-lg';
    vc_update_shortcode_param('vc_btn', $param);
}
