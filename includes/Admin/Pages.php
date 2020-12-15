<?php

namespace Naija\Admin;

/**
 * Admin menu pages handler
 */
class Pages {
    /**
     * Builds the Pages class
     */
    function __construct() {

    }

    /**
     * Initializes the main plugin page
     *
     * @return void
     */
    public function main_page() {
        wp_enqueue_style( 'naija-admin-template-style' );
        wp_enqueue_script( 'naija-admin-script' );
        naija_template( __DIR__, 'mainpage.php' );
    }
}