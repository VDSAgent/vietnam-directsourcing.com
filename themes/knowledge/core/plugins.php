<?php
function knowledgetheme_plugin_activation() {
        $plugins = array(
                array(
                        'name' => 'Redux Framework',
                        'slug' => 'redux-framework',
                        'required' => true
                )
        );
        $configs = array(
                'menu' => 'tp_plugin_install',
                'has_notice' => true,
                'dismissable' => false,
                'is_automatic' => true
        );
        tgmpa( $plugins, $configs );
 
}
add_action('tgmpa_register', 'knowledgetheme_plugin_activation');
function knowledgetheme_plugin_activation_js_composer() {
        $plugins = array(
                array(
                        'name' => 'Visual Composer',
                        'slug' => 'js_composer',
						'source'   => get_stylesheet_directory() . '/plugin/js_composer.zip',
                        'required' => true
                )
        );
        $configs = array(
                'menu' => 'tp_plugin_install',
                'has_notice' => true,
                'dismissable' => false,
                'is_automatic' => true
        );
        tgmpa( $plugins, $configs );
 
}
add_action('tgmpa_register', 'knowledgetheme_plugin_activation_js_composer');
function knowledgetheme_plugin_activation_js_composer_advanced_custom() {
        $plugins = array(
                array(
                        'name' => 'Advanced Custom Fields',
                        'slug' => 'advanced-custom-fields-pro',
						'source'   => get_stylesheet_directory() . '/plugin/advanced-custom-fields-pro.zip',
                        'required' => true
                )
        );
        $configs = array(
                'menu' => 'tp_plugin_install',
                'has_notice' => true,
                'dismissable' => false,
                'is_automatic' => true
        );
        tgmpa( $plugins, $configs );
 
}
add_action('tgmpa_register', 'knowledgetheme_plugin_activation_js_composer_advanced_custom');
?>