<?php
namespace Naija;
/**
 * Handles frontend things
 */
class Frontend {

    /**
     * Build the frontend class
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'enqueue_assets'] );
        add_action( 'init', [$this, 'redirect'] );
    }

    /**
     * Enqueue assets
     *
     * @return void
     */
    public function enqueue_assets() {
        wp_enqueue_style( 'naija-frontend-style' );
        wp_enqueue_script( 'naija-frontend-script' );
        wp_enqueue_script('naija-frontend-script');
    }

    public function redirect() {
        if ( is_admin() ) {
            return;
        }

        $location = naija_user_location();
        $plain    = "$location->city, $location->country";
        $lat      = $location->lat;
        $lon      = $location->lon;

        if ( !isset( $_SESSION ) ) {
            session_start();
        }

        if ( !isset( $_SESSION['naija_user_redirected'] ) ) {
            $_SESSION['naija_user_redirected'] = false;
        }

        if ( !isset( $_GET['location'] ) && $_SESSION['naija_user_redirected'] == false ) {
            wp_redirect( get_site_url() . "/browse-ads/?location=$plain&latitude=$lat&longitude=$lon" );
        }

        $_SESSION['naija_user_redirected'] = true;
    }
}