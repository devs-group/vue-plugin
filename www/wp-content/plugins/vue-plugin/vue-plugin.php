<?php

/*
Plugin Name: Vue Hot Reload Plugin
Description: Vue Hot Reloading inside of WordPress.
Version: 1.0.0
*/

class VuePlugin
{
    public function __construct() {
        $this->register_hooks();
    }

    private function register_hooks() {
        // Register hook to add a menu to the admin page
        add_action('admin_menu', [ $this, 'add_admin_menu' ]);
        add_action('admin_enqueue_scripts', [ $this, 'load_scripts' ]);
    }

    public function add_admin_menu() {
        add_menu_page(
            'Vue Plugin Example',
            'Vue Plugin',
            'manage_options',
            'vue-plugin',
            [ $this, 'load_vue_plugin_page' ],
            'dashicons-smiley',
            4
        );
    }

    public function load_vue_plugin_page() {
        wp_enqueue_style( 'backend-vue-style' );
        wp_enqueue_script( 'backend-vue-script' );

        // For a better overview we load page templates separately
        require_once 'templates/vue-plugin-admin.php';
    }

    public function load_scripts() {
        $vueDirectory    = join( DIRECTORY_SEPARATOR, [ plugin_dir_url(__FILE__), 'vue', 'dist' ] );
        wp_register_style( 'backend-vue-style', $vueDirectory . '/app.css' );
        wp_register_script( 'backend-vue-script', $vueDirectory . '/app.js', [], '1.0.0', true );
    }

}

new VuePlugin();
