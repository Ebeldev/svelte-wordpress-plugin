<?php
/**
 *
 * Plugin Name: Svelte Plugin
 * Plugin URI:
 * Description: Enables to use Svelte js as a plugin
 * Version:     0.1
 * Author:      Étienne Bélanger
 * Author URI:  https://github.com/Ebeldev
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: svelte-plugin
 * Domain Path: /languages
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation. You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

if ( ! class_exists( 'Svelte_Plugin' ) ) :
    class Svelte_Plugin {

        public function __construct() {
            $this->init_actions();
        }
        public function init_actions() {
            add_action( 'admin_enqueue_scripts', [$this, 'svelte_scripts'] );
            add_action( 'admin_menu', [$this, 'my_admin_menu'] );

        }


        public function my_admin_menu() {
            add_menu_page(
                'Svelte in Admin', // $page_title
                'Svelte in Admin', // $menu_title
                'manage_options', // $capability
                'svelte-plugin-in-admin.php', // $menu_slug
                [$this, 'svelte_plugin_callback'], // callback function
                'dashicons-tickets', //dashboard icon
                6 // position
            );
        }

        public function svelte_scripts($hook) {
            if('toplevel_page_svelte-plugin-in-admin' != $hook)
                return;

            wp_enqueue_script( 'svelteJS', plugins_url('/dist/bundle.js', __FILE__), [], $this->set_version(), true );
            wp_enqueue_style( 'svelte-dist-style', plugins_url('/dist/bundle.css', __FILE__), '', $this->set_version() );
        }

        public function set_version() {
            $date = new DateTime();
            return $date->getTimestamp();
        }

        public function svelte_plugin_callback(){
            ?>
            <div class="wrap">
                <h2>Welcome To Svelte inside the admin</h2>
                <div id="svelte-admin"></div>
            </div>
            <?php
        }


    }

    $svelte_plugin = new Svelte_Plugin();
    // add_action( 'plugins_loaded', array( 'Svelte_Plugin', 'init_actions' ) );

endif;
